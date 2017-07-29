<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_User extends CI_Migration {

        public function up()
        {

            $this->load->model('site_core/User_model');
            $query = "CREATE TABLE IF NOT EXISTS `". User_model::DB_TABLE."` (
                        `".User_model::DB_TABLE_PK."` int(11) NOT NULL AUTO_INCREMENT,
                        `username` varchar(50) NOT NULL,
                        `password` varchar(200) NOT NULL,
                        `email` varchar(100) NOT NULL,
                        `email_taid_shode` tinyint(1) NOT NULL,
                        `id_roleha` varchar(50) NOT NULL,
                        PRIMARY KEY (`".User_model::DB_TABLE_PK."`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);




        }

        public function down()
        {

            $this->load->model('site_core/User_model');
            $this->dbforge->drop_table(User_model::DB_TABLE);

        }
}
