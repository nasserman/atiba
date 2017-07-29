<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_hazfe_modelhaye_daryaft_pardakht extends CI_Migration {

        public function up()
        {
            $table_name = "daryaft_pardakht";
            $this->dbforge->drop_table($table_name , true);

            $table_name = "daryaft_pardakht_nagd";
            $this->dbforge->drop_table($table_name , true);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
        }
}
