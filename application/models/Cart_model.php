<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Cart_model extends CI_Model
{
	function get_product_id($x)
	{

    $this->db->select('product_id');
    $this->db->from('product_variants');

    $this->db->where('id', $x );


    $query = $this->db->get();

    if ( $query->num_rows() > 0 )
    {
        $row = $query->row_array();
            log_message('debug',print_r ($row,true));

	$this->db->from('products pro');
	$this->db->select('*');
    $this->db->where('pro.id', $row['product_id'] );
	    $query1 = $this->db->get();

	  if ( $query1->num_rows() > 0 )
    {
        $row1= $query1->row_array();
        log_message('debug',print_r ($row1,true));

		$d= $row1['category_id'];
		$this->db->from('categories cat');
	$this->db->select('*');
    $this->db->where('cat.id', $d );
	    $query2 = $this->db->get();

	  if ( $query2->num_rows() > 0 )
    {
      $row2= $query2->row_array();
        log_message('debug',print_r ($row2,true));
	 return $row2['name'];
	}
		
		
		
		
	}else{
	return 'not found';	
    }
	}
	

	}   
    function add_to_cart($data, $check_status = TRUE)
    {
        $data = escape_array($data);
        $product_variant_id = explode(',', $data['product_variant_id'] ?? '');
		$product_temp=$data['product_variant_id'];
		//log_message('debug',print_r ( $product_temp,true));
		$c=$this->get_product_id($product_temp);
        log_message('debug',print_r ("ddddddd". $c,true));
       $qty = explode(',', $data['qty'] ?? '');
if ($c=="Press"){
	        log_message('debug',print_r ($data,true));
 $cart_data = [
                'user_id' => $data['user_id'],
                'product_id' => $product_temp,
                'qty' => $data['qty'],
            ];
            $this->db->insert('press', $cart_data);
			
			   $notification_data = [
            'title' => "new order",
            'message' => $product_temp,
            'type' => "Press",
        ];
		    $this->load->model('Notification_model', 'Notification_model');

            $this->Notification_model->add_notification($notification_data);
	
}else{
	if ($check_status == TRUE) {
            $check_current_stock_status = validate_stock($product_variant_id, $qty);
            if (!empty($check_current_stock_status) && $check_current_stock_status['error'] == true) {
                $check_current_stock_status['csrfName'] = $this->security->get_csrf_token_name();
                $check_current_stock_status['csrfHash'] = $this->security->get_csrf_hash();
                print_r(json_encode($check_current_stock_status));
                return true;
            }
        }

        for ($i = 0; $i < count($product_variant_id); $i++) {
            $cart_data = [
                'user_id' => $data['user_id'],
                'product_variant_id' => $product_variant_id[$i],
                'qty' => $qty[$i],
                'is_saved_for_later' => (isset($data['is_saved_for_later']) && !empty($data['is_saved_for_later']) && $data['is_saved_for_later'] == '1') ? $data['is_saved_for_later'] : '0',
            ];
            if ($qty[$i] == 0) {
                $this->remove_from_cart($cart_data);
            } else {
                if ($this->db->select('*')->where(['user_id' => $data['user_id'], 'product_variant_id' => $product_variant_id[$i]])->get('cart')->num_rows() > 0) {
                    $this->db->set($cart_data)->where(['user_id' => $data['user_id'], 'product_variant_id' => $product_variant_id[$i]])->update('cart');
                } else {
                    $this->db->insert('cart', $cart_data);
                }
            }
        }
        return false;
    
	
}
 

        }

    function remove_from_cart($data)
    {
        if (isset($data['user_id']) && !empty($data['user_id'])) {
            $this->db->where('user_id', $data['user_id']);
            // return;
            if (isset($data['product_variant_id'][0]) && !empty($data['product_variant_id'][0])) {
                $product_variant_id = explode(',', $data['product_variant_id'] ?? '');
                $this->db->where_in('product_variant_id', $product_variant_id);
            }
            return $this->db->delete('cart');
        } else {
            return false;
        }
    }

    function get_user_cart($user_id, $is_saved_for_later = 0, $product_variant_id = '')
    {

        $q = $this->db->join('product_variants pv', 'pv.id=c.product_variant_id')
            ->join('products p', 'p.id=pv.product_id')->join('`taxes` tax', 'tax.id = p.tax', 'LEFT')
            ->where(['user_id' => $user_id, 'p.status' => '1', 'pv.status' => 1, 'qty !=' => '0', 'is_saved_for_later' => $is_saved_for_later]);
        if (!empty($product_variant_id)) {
            $q->where('c.product_variant_id', $product_variant_id);
        }
        $res =  $q->select('c.*,p.is_prices_inclusive_tax,p.name,p.id,p.image,p.short_description,p.minimum_order_quantity,p.quantity_step_size,p.total_allowed_quantity,pv.price,pv.special_price,pv.id as product_variant_id,tax.percentage as tax_percentage')->order_by('c.id', 'DESC')->get('cart c')->result_array();

        if (!empty($res)) {

            $res = array_map(function ($d) {
                $percentage = (isset($d['tax_percentage']) && intval($d['tax_percentage']) > 0 && $d['tax_percentage'] != null) ? $d['tax_percentage'] : '0';
                if ((isset($d['is_prices_inclusive_tax']) && $d['is_prices_inclusive_tax'] == 0) || (!isset($d['is_prices_inclusive_tax'])) && $percentage > 0) {
                    $price_tax_amount = $d['price'] * ($percentage / 100);
                    $special_price_tax_amount = $d['special_price'] * ($percentage / 100);
                } else {
                    $price_tax_amount = 0;
                    $special_price_tax_amount = 0;
                }
                $d['price'] =  $d['price'] + $price_tax_amount;
                $d['special_price'] =  $d['special_price'] + $special_price_tax_amount;
                $d['minimum_order_quantity'] =  isset($d['minimum_order_quantity']) && !empty($d['minimum_order_quantity']) ? $d['minimum_order_quantity'] : 1;
                $d['quantity_step_size'] =  isset($d['quantity_step_size']) && !empty($d['quantity_step_size']) ? $d['quantity_step_size'] : 1;
                $d['total_allowed_quantity'] =  isset($d['total_allowed_quantity']) && !empty($d['total_allowed_quantity']) ? $d['total_allowed_quantity'] : '';
                $d['product_variants'] = get_variants_values_by_id($d['product_variant_id']);
                return $d;
            }, $res);
        }
        return $res;
    }
}
