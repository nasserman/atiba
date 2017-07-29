<?php

class N2_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $ci = &get_instance();

        $user_is_logged_in = user_is_logged_in();
        if($user_is_logged_in){
            $_current_user = get_current_site_user();
            $this->current_user = $_current_user;
        } else {
            $this->current_user = null;
        }
    }
}


// -----------------------------------------------------------------------------
require_once APPPATH .'/libraries/site_core/Authenticated_Controller.php';
require_once APPPATH .'/libraries/site_core/User_Controller.php';
require_once APPPATH .'/libraries/site_core/Operator_Controller.php';
require_once APPPATH .'/libraries/site_core/Admin_Controller.php';
