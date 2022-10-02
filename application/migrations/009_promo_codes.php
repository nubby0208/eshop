<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Migration_promo_codes extends CI_Migration
{
    public function up()
    {
        /* alter field in promo_codes table */
        $fields = array(
            'no_of_repeat_usage' => array(
                'type' => 'INT',
                'constraint' => 11,
                'NULL'           => TRUE
            )
        );
        $this->dbforge->modify_column('promo_codes', $fields);
    }
    public function down()
    {
        /* alter field in promo_codes table */
        $fields = array(
            'no_of_repeat_usage' => array(
                'type' => 'INT',
                'constraint' => 11,
                'NULL'           => FALSE,
            )
        );
        $this->dbforge->modify_column('promo_codes', $fields);
    }
}
