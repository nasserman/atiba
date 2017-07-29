<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_daryaft_pardakht_model extends CI_Migration {

        public function up()
        {
            $table_name = "daryaft_pardakht";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `stime` int(11) NOT NULL,
                        `id_user` int(11) NOT NULL,
                        `daryaft_ya_pardakht` varchar(20) NOT NULL,
                        `noe` varchar(30) NOT NULL,
                        `guid_noe` varchar(30) NOT NULL,
                        `babat` varchar(30) NOT NULL,
                        `guid_babat` varchar(30) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "daryaft_pardakht";
            $this->dbforge->drop_table($table_name);
        }
}
