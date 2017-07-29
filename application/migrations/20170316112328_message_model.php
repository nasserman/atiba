<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_message_model extends CI_Migration {

        public function up()
        {

            $table_name = "message";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `matn` varchar(2000) NOT NULL,
                        `id_user_ersal_konande` int(11) not null,
                        `id_user_daryaft_konande` int(11) not null,
                        `stime` int(11) not null,
                        `vaziat` varchar(30) not null,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "message";
            $this->dbforge->drop_table($table_name);
        }
}
