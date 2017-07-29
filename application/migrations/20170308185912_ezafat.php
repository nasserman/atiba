<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_ezafat extends CI_Migration {

        public function up()
        {
            $table_name = "ezafat";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `guid_sanad` varchar(30) NOT NULL,
                        `tozih` varchar(500) NOT NULL,
                        `noe` varchar(30) NOT NULL,
                        `megdar` int(11) NOT NULL,
                        `mablagh` int(11) NOT NULL,
                        `noe_ezafat` varchar(20) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "ezafat";
            $this->dbforge->drop_table($table_name);
        }
}
