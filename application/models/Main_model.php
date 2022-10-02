<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

	
	function validate($username, $password)
	{
		$this->db->where( array('username' => $username, 'password' => $password ) ) ;
		$query = $this->db->get('users');
		
		if($query->num_rows() == 1)
		{
			return true;
		}		
	}

	function search_by_name($name)
	{
		$this->db->like('name',$name);
		$query = $this->db->get('attendance');
		
		if($query){
			return $query->result();
		}else {
			return false;
		}	
	}



	function get_table_data($table, $where=array(), $order_field=null, $order_type=null, $limit=null)
	{
		if ($where)
			$this->db->where($where) ;

		if ($limit)
		{
			foreach ($limit as $limitKey => $limitValue) {
				$this->db->limit($limitKey,$limitValue);
			}
		} 
			//$this->db->limit($limit) ;


		if($order_field)
			$this->db->order_by($order_field, $order_type);

		$query = $this->db->get($table) ;
		if($query){
			return $query->result();
		}else {
			return false;
		}
	
	}

	function NumRows($table, $where=array(), $limit=null, $order_field=null, $order_type=null)
	{
		if ($where)
			$this->db->where($where) ;

		if ($limit) 
			$this->db->limit($limit) ;

		if($order_field)
			$this->db->order_by($order_field, $order_type);

		$query = $this->db->get($table) ;
		if($query){
			return $query->num_rows();
		}else {
			return false;
		}
	
	}


	function get_table_row($table, $where=array(), $field)
	{
		$query = $this->db->get_where($table, $where) ;

		foreach ($query->result() as $row) 
		{
			if($field)
				return $row->field;
			else
				return $row;
		}
	}


	function insert($table, $data)
	{
		$query = $this->db->insert($table, $data) ;
		if ($query) {
			
			return true;
		}
		else
		{
			return false;
		}

	}

	function update($table, $where=array(), $data)
	{
		
		$this->db->where($where) ;
		$update = $this->db->update($table, $data);

		if ($update) {
			return true;
		}else {
			return false;
		}
	}

	function delete($table, $where=array())
	{
		if($where)
			$this->db->where($where);	
		

		$query = $this->db->delete($table);
		if ($query) {
			return true;
		}else {
			return false;
		}
	}


}

/* End of file main_model.php */
/* Location: ./application/models/main_model.php */