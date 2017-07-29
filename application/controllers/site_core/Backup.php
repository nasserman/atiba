<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller
{
    // =========================================================================
    public function index($token = "no token!")
    {
        if($token != "2123"){
            return;
        }

        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $this->load->helper('file');
        $filename = jdate('Y_m_d_H_i' , time() , '' , 'Asia/Tehran' , 'en') . ".gz";
        write_file(FCPATH . '/backup/' . $filename, $backup);

    }
    // =========================================================================
}
