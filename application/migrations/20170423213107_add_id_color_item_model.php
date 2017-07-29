<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_id_color_item_model extends CI_Migration {

        public function up()
        {
            $table_name = "item";
            if (!$this->db->field_exists('id_color', $table_name)){
                $fields = [
                    'id_color' => [
                        'type' => 'int',
                        'constraint' => '11',
                        'default'=> "-1"
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "item";
            if ($this->db->field_exists('id_color', $table_name)){
                $this->dbforge->drop_column($table_name, 'id_color');
            }
        }

        // ---------------------------------------------------------------------
}
