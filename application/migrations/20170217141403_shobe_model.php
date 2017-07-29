<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_shobe_model extends CI_Migration {

        public function up()
        {

            $table_name = "shobe";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(500) NOT NULL,
                        `id_ostan` int(11) not null,
                        `id_shahr` int(11) not null,
                        `active` tinyint(1) not null,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "shobe";
            $this->dbforge->drop_table($table_name);
        }
}
