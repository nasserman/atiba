<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_sizebandi_darad_item_model extends CI_Migration {

        public function up()
        {
            $table_name = "item";
            if (!$this->db->field_exists('sizebandi_darad', $table_name)){
                $fields = [
                    'sizebandi_darad' => [
                        'type' => 'tinyint',
                        'constraint' => '1',
                        'default'=> 1
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "item";
            if ($this->db->field_exists('sizebandi_darad', $table_name)){
                $this->dbforge->drop_column($table_name, 'sizebandi_darad');
            }
        }
}
