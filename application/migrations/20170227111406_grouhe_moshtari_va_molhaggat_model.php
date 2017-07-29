<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Grouhe_moshtari_va_molhaggat_model extends CI_Migration {

        public function up()
        {
            $table_name = "grouhe_moshtari";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `title` varchar(200) not null,
                        `deleted` tinyint(1) not null,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);

            $table_name = "profile_moshtari_grouhe_moshtari";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `id_profile_moshtari` int(11) not null,
                        `id_grouhe_moshtari` int(11) not null,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);

        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "grouhe_moshtari";
            $this->dbforge->drop_table($table_name);

            $table_name = "profile_moshtari_grouhe_moshtari";
            $this->dbforge->drop_table($table_name);

        }
}
