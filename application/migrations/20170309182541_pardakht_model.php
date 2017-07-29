<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_pardakht_model extends CI_Migration {

        public function up()
        {
            $table_name = "pardakht";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `stime` int(11) NOT NULL,
                        `id_user` int(11) NOT NULL,
                        `daryaft_ya_pardakht` varchar(20) NOT NULL,
                        `noe` varchar(30) NOT NULL,
                        `guid_sanad` varchar(30) NOT NULL,
                        `mablagh` int(11) NOT NULL,
                        `emal_shode` tinyint(1) NOT NULL,
                        `data` varchar(2500) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "pardakht";
            $this->dbforge->drop_table($table_name);
        }
}
