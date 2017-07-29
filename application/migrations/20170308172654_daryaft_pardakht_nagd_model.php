<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_daryaft_pardakht_nagd_model extends CI_Migration {

        public function up()
        {
            $table_name = "daryaft_pardakht_nagd";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `guid` varchar(30) NOT NULL,
                        `mablagh` int(11) NOT NULL,
                        `be` varchar(500) NOT NULL,
                        `stime` int(11) NOT NULL,
                        `id_daryaft_pardakht` int(11) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "daryaft_pardakht_nagd";
            $this->dbforge->drop_table($table_name);
        }
}
