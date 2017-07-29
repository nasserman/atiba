<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Profile_moshtari_model extends CI_Migration {

        public function up()
        {

            $table_name = "profile_moshtari";
            $pk_name = "id";
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `".$pk_name."` int(11) NOT NULL AUTO_INCREMENT,
                        `stime` int(11) NOT NULL,
                        `name` varchar(200) NOT NULL,
                        `lastname` varchar(200) NOT NULL,
                        `codemelli` varchar(20) NOT NULL,
                        `shmobile` varchar(20) NOT NULL,
                        `tel` varchar(20) NOT NULL,
                        `email` varchar(50) NOT NULL,
                        `stime_tavalod` int(11) NOT NULL,
                        `stime_tavalode_hamsar` int(11) NOT NULL,
                        `jensiat` varchar(20) NOT NULL,
                        `tahsilat` varchar(20) NOT NULL,
                        `newsletter_sms` tinyint(1) NOT NULL,
                        `newsletter_email` tinyint(1) NOT NULL,
                        `other_sms` tinyint(1) NOT NULL,
                        `other_email` tinyint(1) NOT NULL,
                        `ejazeye_tamase_telefoni` tinyint(1) NOT NULL,
                        `noe` varchar(20) NOT NULL,
                        `id_customer_opencart` int(11) NOT NULL,
                        `mahe_tavalod` int(11) NOT NULL,
                        `mahe_tavalode_hamsar` int(11) NOT NULL,
                        `rooze_tavalod` int(11) NOT NULL,
                        `rooze_tavalode_hamsar` int(11) NOT NULL,
                        `az_tarig` varchar(100) NOT NULL,
                        PRIMARY KEY (`".$pk_name."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);
        }

        // ---------------------------------------------------------------------

        public function down()
        {
            $table_name = "profile_moshtari";
            $this->dbforge->drop_table($table_name);

        }
}
