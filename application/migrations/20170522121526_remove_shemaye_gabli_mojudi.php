<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_remove_shemaye_gabli_mojudi extends CI_Migration {

        public function up()
        {
            $table_name = "mojudi";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "sabte_mojudi";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "sabte_mojudi_item";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "mojudi_shobe";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "kharid";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "kharid_item";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "entegal";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "entegal_item";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "furush";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
            $table_name = "furush_item";
            $this->dbforge->drop_table($table_name);
            // -----------------------------------------------------------------
        }

        // ---------------------------------------------------------------------

        public function down()
        {
        }
}
