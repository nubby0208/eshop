<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Migration_order_attachments extends CI_Migration
{
    public function up()
    {
        /* adding new fields in orders table */
        $fields = array(
            'attachments' => array(
                'type' => 'VARCHAR',
                'constraint' => '2048',
                'null' => TRUE,
                'after' => 'notes'
            ),
        );
        $this->dbforge->add_column('orders', $fields);
        /* adding new fields in products table */
        $fields = array(
            'is_attachment_required' => array(
                'type' => 'TINYINT',
                'default' => '0',
                'null' => TRUE,
                'after' => 'cancelable_till'
            ),
        );
        $this->dbforge->add_column('products', $fields);
    }

    public function down()
    {
        // Drop columns >> $this->dbforge->drop_column('table_name', 'column_to_drop');
        $this->dbforge->drop_column('orders', 'attachments');
        $this->dbforge->drop_column('products', 'is_attachment_required');
    }
}
