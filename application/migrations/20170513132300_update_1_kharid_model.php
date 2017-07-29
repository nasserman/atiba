<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_1_kharid_model extends CI_Migration {

        public function up()
        {
            $table_name = "kharid";
            if ($this->db->field_exists('id_tamin_konade', $table_name)){
                $this->dbforge->drop_column($table_name, 'id_tamin_konade');
            }
            if (!$this->db->field_exists('id_moshtari', $table_name)){
                $fields = [
                    'id_moshtari' => [
                        'type' => 'int',
                        'constraint' => '11',
                        'default'=> -1
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "kharid";
            if ($this->db->field_exists('id_moshtari', $table_name)){
                $this->dbforge->drop_column($table_name, 'id_moshtari');
            }
        }

        // ---------------------------------------------------------------------
}
