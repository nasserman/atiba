<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_order_item_size_model extends CI_Migration {

        public function up()
        {
            $table_name = "item_size";
            if (!$this->db->field_exists('order', $table_name)){
                $fields = [
                    'order' => [
                        'type' => 'int',
                        'constraint' => '11',
                        'default'=> "1"
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "item_size";
            if ($this->db->field_exists('order', $table_name)){
                $this->dbforge->drop_column($table_name, 'order');
            }
        }

        // ---------------------------------------------------------------------
}
