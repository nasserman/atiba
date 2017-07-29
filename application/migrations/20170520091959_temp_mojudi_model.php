<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_temp_mojudi_model extends CI_Migration {

        public function up()
        {
            $table_name = "temp_mojudi";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `id_item` int(11) NOT NULL,
                        `id_size` int(11) NOT NULL,
                        `id_shobe` int(11) NOT NULL,
                        `tedad` int(11) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "temp_mojudi";
            $this->dbforge->drop_table($table_name);
        }
}
