<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Profile_user_model extends CI_Migration {

        public function up()
        {

            $table_name = "profile_user";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(200) NOT NULL,
                        `lastname` varchar(200) NOT NULL,
                        `id_user` int(11) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "profile_user";
            $this->dbforge->drop_table($table_name);

        }
}
