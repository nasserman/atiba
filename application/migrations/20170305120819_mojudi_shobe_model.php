<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_mojudi_shobe_model extends CI_Migration {

        public function up()
        {
            $table_name = "mojudi_shobe";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `id_item` int(11) NOT NULL,
                        `id_size` int(11) NOT NULL,
                        `id_shobe` int(11) NOT NULL,
                        `stime` int(11) NOT NULL,
                        `mojudie_gabli` int(11) NOT NULL,
                        `mojudie_ezafe_shode` int(11) NOT NULL,
                        `mojudie_hazf_shode` int(11) NOT NULL,
                        `mojudie_jadid` int(11) NOT NULL,
                        `guid_amel` varchar(20) NOT NULL,
                        `amel` varchar(30) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "mojudi_shobe";
            $this->dbforge->drop_table($table_name);
        }
}
