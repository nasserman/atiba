<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_color_model extends CI_Migration {

        public function up()
        {
            $table_name = "color";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `title` varchar(500) NOT NULL,
                        `prefix` varchar(10) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "color";
            $this->dbforge->drop_table($table_name);
        }
}
