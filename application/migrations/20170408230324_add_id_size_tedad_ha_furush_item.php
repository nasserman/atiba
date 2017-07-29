<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_id_size_tedad_ha_furush_item extends CI_Migration {

        public function up()
        {
            $table_name = "furush_item";
            if (!$this->db->field_exists('id_size_tedad_ha', $table_name)){
                $fields = [
                    'id_size_tedad_ha' => [
                        'type' => 'varchar',
                        'constraint' => '500',
                        'default'=> json_encode([])
                    ]
                ];
                $this->dbforge->add_column($table_name, $fields);
            }

            if ($this->db->field_exists('id_size', $table_name)){
                $this->dbforge->drop_column($table_name, 'id_size');
            }
            if ($this->db->field_exists('tedad', $table_name)){
                $this->dbforge->drop_column($table_name, 'tedad');
            }
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "furush_item";
            $fields = [];
            if (!$this->db->field_exists('id_size', $table_name)){
                $fields['id_size'] = [
                        'type' => 'int',
                        'constraint' => '11',
                        'default'=> "-1"
                    ] ;
            }
            if (!$this->db->field_exists('tedad', $table_name)){
                $fields['tedad'] = [
                    'type' => 'int',
                    'constraint' => '11',
                    'default'=> "0"
                ];
            }
            $this->dbforge->add_column($table_name, $fields);

            if ($this->db->field_exists('id_size_tedad_ha', $table_name)){
                $this->dbforge->drop_column($table_name, 'id_size_tedad_ha');
            }
        }
}
