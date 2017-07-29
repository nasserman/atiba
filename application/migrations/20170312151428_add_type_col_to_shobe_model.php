<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_type_col_to_shobe_model extends CI_Migration {

        public function up()
        {
            $table_name = "shobe";
            $fields = [
                'type' => [
                    'type' => 'varchar',
                    'constraint' => '20',
                    'default'=> "shobe"
                ]
            ];
            $this->dbforge->add_column($table_name, $fields);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "shobe";
            $this->dbforge->drop_column($table_name, 'type');
        }
}
