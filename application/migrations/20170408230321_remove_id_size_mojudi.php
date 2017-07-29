<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Remove_id_size_mojudi extends CI_Migration {

        public function up()
        {
            $table_name = "mojudi";
            if ($this->db->field_exists('id_size', $table_name)){
                $this->dbforge->drop_column($table_name, 'id_size');
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "mojudi";
            if (!$this->db->field_exists('id_size', $table_name)){
                $fields = [
                    'id_size' => [
                        'type' => 'int',
                        'constraint' => '11',
                        'default'=> "-1"
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }
}
