<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_noe_furush_furush_model extends CI_Migration {

        public function up()
        {
            $table_name = "furush";
            if (!$this->db->field_exists('noe_furush', $table_name)){
                $fields = [
                    'noe_furush' => [
                        'type' => 'varchar',
                        'constraint' => '20',
                        'default'=> "jozi"
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "furush";
            if ($this->db->field_exists('noe_furush', $table_name)){
                $this->dbforge->drop_column($table_name, 'noe_furush');
            }
        }

        // ---------------------------------------------------------------------
}
