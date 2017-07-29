<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Dictionary_model extends CI_Migration {

        public function up()
        {

            $table_name = 'dictionary';
            $query = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `key` varchar(300) not null,
                        `value` varchar(2000) not null,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            $this->db->query($query);

        }

        public function down()
        {
            $table_name = 'dictionary';
            $this->dbforge->drop_table($table_name);
        }
}
