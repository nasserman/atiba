<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_init_users extends CI_Migration {

        public function up()
        {

            $this->load->model('site_core/User_model');
            $query = 'INSERT INTO `'.User_model::DB_TABLE.'` (`id`, `username`, `password`, `email`, `email_taid_shode`, `ID_ROLEHA`) VALUES'.
                        ' (1, \'super\', \'$2y$10$dKOJ8Rof27k.p5CaVLY15ORGKi.2D45z8cJA5HPpNQ6ZYeN2uygtq\', \'nasser.man@gmail.com\', 1, \'["super_user"]\'), '.
                        ' (2, \'admin\', \'$2y$10$R6q75CqNc9VlvW2cJtLjOurdtQ4HIeFkU4RpRnJMzJvXCPEhLFMha\', \'modir@mail.com\', 0, \'["admin_user"]\');';
            $this->db->query($query);




        }

        public function down()
        {

            $this->load->model('site_core/User_model');
            $query = 'DELETE FROM '.User_model::DB_TABLE.' WHERE id = 1 ';
            $this->db->query($query);
            $query = 'DELETE FROM '.User_model::DB_TABLE.' WHERE id = 2 ';
            $this->db->query($query);

        }
}
