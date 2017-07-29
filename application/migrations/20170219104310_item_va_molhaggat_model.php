<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Item_va_molhaggat_model extends CI_Migration {

        public function up()
        {
            $table_name = "item";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(500) not null,
                        `desc` varchar(2000) not null,
                        `code` varchar(50) not null,
                        `id_category` int(11) not null,
                        `name_tolid_konande` varchar(200) not null,
                        `image` varchar(1000) not null,
                        `geymate_furushe_omde` int(11) not null,
                        `geymate_furushe_jozi` int(11) not null,
                        `id_user_sabt_konande` int(11) not null,
                        `id_user_edit_konande` int(11) not null,
                        `time_sabt` int(11) not null,
                        `time_edit` int(11) not null,
                        `vahede_shomaresh` varchar(200) not null,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);

            $table_name = "item_size";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `id_item` int(11) not null,
                        `size` varchar(200) not null,
                        `deleted` tinyint(1) not null,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);

            $table_name = "item_geymat";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `id_item` int(11) not null,
                        `id_shobe` int(11) not null,
                        `geymate_furushe_omde` int(11) not null,
                        `geymate_furushe_jozi` int(11) not null,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "item";
            $this->dbforge->drop_table($table_name);

            $table_name = "item_size";
            $this->dbforge->drop_table($table_name);

            $table_name = "item_geymat";
            $this->dbforge->drop_table($table_name);
        }
}
