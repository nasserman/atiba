<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_1_furush_item_model extends CI_Migration {

        public function up()
        {
            $table_name = "furush_item";
            if (!$this->db->field_exists('fii_mohasebe_shode', $table_name)){
                $fields = [
                    'fii_mohasebe_shode' => [
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
            $table_name = "furush_item";
            if ($this->db->field_exists('fii_mohasebe_shode', $table_name)){
                $this->dbforge->drop_column($table_name, 'fii_mohasebe_shode');
            }
        }

        // ---------------------------------------------------------------------
}
