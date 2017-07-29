<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_entegal_va_itemhaye_entegal extends CI_Migration {

        public function up()
        {
            $table_name = "entegal";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `guid` varchar(20) NOT NULL,
                        `time_sabt` int(11) NOT NULL,
                        `time_edit` int(11) NOT NULL,
                        `id_user_sabt_konande` int(11) NOT NULL,
                        `id_user_edit_konande` int(11) NOT NULL,
                        `id_shobe_mabda` int(11) NOT NULL,
                        `id_shobe_magsad` int(11) NOT NULL,
                        `yaddasht` varchar(2000) NOT NULL,
                        `is_history` tinyint(1) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);


            $table_name = "entegal_item";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `guid` varchar(20) NOT NULL,
                        `id_entegal` int(11) NOT NULL,
                        `id_item` int(11) NOT NULL,
                        `id_size` int(11) NOT NULL,
                        `tedad` int(11) NOT NULL,
                        `tozih` varchar(2000) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "entegal";
            $this->dbforge->drop_table($table_name);

            $table_name = "entegal_item";
            $this->dbforge->drop_table($table_name);
        }
}
