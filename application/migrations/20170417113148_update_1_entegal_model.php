<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_1_entegal_model extends CI_Migration {

        public function up()
        {
            $table_name = "entegal";
            $fields = [
                'vaziate_sanad' => [
                    'type' => 'varchar',
                    'constraint' => '50',
                    'default'=> "baz"
                ],
                'id_user_taed_konande' => [
                    'type' => 'int',
                    'constraint' => '11',
                    'default'=> -1
                ],
                'time_taed' => [
                    'type' => 'int',
                    'constraint' => '11',
                    'default'=> -1
                ],
                'tozih_operator' => [
                    'type' => 'varchar',
                    'constraint' => '1000',
                    'default'=> ""
                ],
                'taed_shode' => [
                    'type' => 'varchar',
                    'constraint' => '30',
                    'default'=> "namoshakhas"
                ],
            ];
            $this->dbforge->add_column($table_name, $fields);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "entegal";
            if ($this->db->field_exists('vaziate_sanad', $table_name)){
                $this->dbforge->drop_column($table_name, 'vaziate_sanad');
            }
            if ($this->db->field_exists('id_user_taed_konande', $table_name)){
                $this->dbforge->drop_column($table_name, 'id_user_taed_konande');
            }
            if ($this->db->field_exists('tozih_operator', $table_name)){
                $this->dbforge->drop_column($table_name, 'tozih_operator');
            }
            if ($this->db->field_exists('taed_shode', $table_name)){
                $this->dbforge->drop_column($table_name, 'taed_shode');
            }
            if ($this->db->field_exists('time_taed', $table_name)){
                $this->dbforge->drop_column($table_name, 'time_taed');
            }
        }

        // ---------------------------------------------------------------------
}
