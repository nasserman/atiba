<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_vaziate_sanad_sabte_mojudi_model extends CI_Migration {

        public function up()
        {
            $table_name = "sabte_mojudi";
            if (!$this->db->field_exists('vaziate_sanad', $table_name)){
                $fields = [
                    'vaziate_sanad' => [
                        'type' => 'varchar',
                        'constraint' => '50',
                        'default'=> "baz"
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "sabte_mojudi";
            if ($this->db->field_exists('vaziate_sanad', $table_name)){
                $this->dbforge->drop_column($table_name, 'vaziate_sanad');
            }
        }

        // ---------------------------------------------------------------------
}
