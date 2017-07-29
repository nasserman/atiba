<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_category_model extends CI_Migration {

        public function up()
        {

            $table_name = "category";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `title` varchar(500) NOT NULL,
                        `id_parent` int(11) not null,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "category";
            $this->dbforge->drop_table($table_name);
        }
}
