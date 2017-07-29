<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Paziresh_model extends CI_Migration {

        public function up()
        {
            $table_name = "paziresh_model";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `stime` int(11) NOT NULL,
                        `etime` int(11) NOT NULL,
                        `time_paziresh` int(11) NOT NULL,
                        `time_paziresh_shode` int(11) NOT NULL,
                        `id_profile_bimar` int(11) NOT NULL,
                        `onvane_bime` varchar(200) NOT NULL,
                        `hazineye_vizit;` int(11) NOT NULL,
                        `takhfif;` int(11) NOT NULL,
                        `mablage_gabele_pardakht;` int(11) NOT NULL,
                        `mablage_pardakht_shodeye_nagdi;` int(11) NOT NULL,
                        `mablage_pardakht_shodeye_kartkhan;` int(11) NOT NULL,
                        `mablage_kole_pardakht_shode;` int(11) NOT NULL,
                        `mablage_kole_bagi_mande;` int(11) NOT NULL,
                        `vaziat` varchar(20) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "paziresh_model";
            $this->dbforge->drop_table($table_name);
        }
}
