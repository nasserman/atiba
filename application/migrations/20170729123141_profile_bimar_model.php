<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Profile_bimar_model extends CI_Migration {

        public function up()
        {
            $table_name = "profile_bimar";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `stime` int(11) NOT NULL,
                        `etime` int(11) NOT NULL,
                        `name` varchar(200) NOT NULL,
                        `lastname` varchar(200) NOT NULL,
                        `name_pedar` varchar(200) NOT NULL,
                        `jensiat` varchar(20) NOT NULL,
                        `codemelli` varchar(20) NOT NULL,
                        `tel` varchar(20) NOT NULL,
                        `mobile` varchar(20) NOT NULL,
                        `time_tavalod` int(11) NOT NULL,
                        `adres` varchar(300) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "profile_bimar";
            $this->dbforge->drop_table($table_name);
        }
}
