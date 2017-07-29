<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_tedad_sanad_model extends CI_Migration {

        public function up()
        {
            $table_name = "sanad_item";
            if (!$this->db->field_exists('tedad', $table_name)){
                $fields = [
                    'tedad' => [
                        'type' => 'int',
                        'constraint' => '1',
                        'default'=> 0
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "sanad_item";
            if ($this->db->field_exists('tedad', $table_name)){
                $this->dbforge->drop_column($table_name, 'tedad');
            }
        }
}
