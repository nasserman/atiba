<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_noe_col_to_mojudi_shobe_model extends CI_Migration {

        public function up()
        {
            $table_name = "mojudi_shobe";
            $fields = [
                'noe' => [
                    'type' => 'varchar',
                    'constraint' => '30',
                    'default'=> "varede"
                ]
            ];
            $this->dbforge->add_column($table_name, $fields);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "mojudi_shobe";
            $this->dbforge->drop_column($table_name, 'noe');
        }
}
