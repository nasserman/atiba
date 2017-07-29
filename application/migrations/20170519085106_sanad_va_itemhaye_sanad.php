<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_sanad_va_itemhaye_sanad extends CI_Migration {

        public function up()
        {
            $table_name = "sanad";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `guid` varchar(20) NOT NULL,
                        `noe` varchar(30) NOT NULL,
                        `time_sabt` int(11) NOT NULL,
                        `time_edit` int(11) NOT NULL,
                        `id_user_sabt_konande` int(11) NOT NULL,
                        `id_user_edit_konande` int(11) NOT NULL,
                        `id_shobe` int(11) NOT NULL,
                        `is_history` tinyint(1) NOT NULL,
                        `vaziate_sanad` varchar(20) NOT NULL,
                        `id_taraf_hesab` int(11) NOT NULL,
                        `jame_geymate_itemha` int(11) NOT NULL,
                        `jame_pardakht_shode` int(11) NOT NULL,
                        `jame_kol` int(11) NOT NULL,
                        `mande` int(11) NOT NULL,
                        `id_shobe_b` int(11) NOT NULL,
                        `vaziate_taid` varchar(20) NOT NULL,
                        `time_taid` int(11) NOT NULL,
                        `id_user_taid_konande` int(11) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);


            $table_name = "sanad_item";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `id_sanad` int(11) NOT NULL,
                        `guid` varchar(20) NOT NULL,
                        `id_item` int(11) NOT NULL,
                        `fii` double NOT NULL,
                        `fii_miyangin` double NOT NULL,
                        `id_size_tedad_ha` varchar(1000) NOT NULL,
                        `tozih` varchar(2000) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "sanad";
            $this->dbforge->drop_table($table_name);

            $table_name = "sanad_item";
            $this->dbforge->drop_table($table_name);
        }
}
