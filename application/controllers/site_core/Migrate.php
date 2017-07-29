<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
    // =========================================================================
    public function index($show_time = 'true')
    {
        if($show_time === 'true'){
            echo date('YmdHis');
            return;
        }

        $this->load->library('migration');

        if($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
        else
        {
            echo 'migration is done';
        }
    }
    // =========================================================================
}
