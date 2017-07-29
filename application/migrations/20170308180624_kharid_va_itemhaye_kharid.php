<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_kharid_va_itemhaye_kharid extends CI_Migration {

        public function up()
        {
            $table_name = "kharid";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `time_sabt` int(11) NOT NULL,
                        `time_edit` int(11) NOT NULL,
                        `id_user_sabt_konande` int(11) NOT NULL,
                        `id_user_edit_konande` int(11) NOT NULL,
                        `id_shobe` int(11) NOT NULL,
                        `yaddasht` varchar(2000) NOT NULL,
                        `id_tamin_konade` int(11) NOT NULL,
                        `jame_geymate_itemha` int(11) NOT NULL,
                        `jame_pardakht_shode` int(11) NOT NULL,
                        `jame_kol` int(11) NOT NULL,
                        `mande` int(11) NOT NULL,
                        `is_history` tinyint(1) NOT NULL,
                        `guid` varchar(20) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);


            $table_name = "kharid_item";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `id_kharid` int(11) NOT NULL,
                        `id_item` int(11) NOT NULL,
                        `id_size` int(11) NOT NULL,
                        `fii` double NOT NULL,
                        `tedad` int(11) NOT NULL,
                        `tozih` varchar(2000) NOT NULL,
                        `guid` varchar(20) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "kharid";
            $this->dbforge->drop_table($table_name);

            $table_name = "kharid_item";
            $this->dbforge->drop_table($table_name);
        }
}
