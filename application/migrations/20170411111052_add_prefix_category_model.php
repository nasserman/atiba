<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_prefix_category_model extends CI_Migration {

        public function up()
        {
            $table_name = "category";
            if (!$this->db->field_exists('prefix', $table_name)){
                $fields = [
                    'prefix' => [
                        'type' => 'varchar',
                        'constraint' => '100',
                        'default'=> ""
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "category";
            if ($this->db->field_exists('prefix', $table_name)){
                $this->dbforge->drop_column($table_name, 'prefix');
            }
        }

        // ---------------------------------------------------------------------
}
