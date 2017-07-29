<?php
class User_Controller extends N2_Controller
{

    public function __construct()
    {
        parent::__construct();

        $user_is_logged_in = user_is_logged_in();
        if(!$user_is_logged_in){
            user_logout();
            redirect('site_core/user/login');
            exit('No allowed to User section');
        }

        $_current_user = get_current_site_user();
        $_rolehaye_user = json_decode($_current_user->id_roleha);

        if(!in_array('site_user', $_rolehaye_user)){

            if(!$_current_user->is("super_user") and !$_current_user->is("admin_user") and
                !$_current_user->is("operator_user") and !$_current_user->is("hesabdar_user")){

                user_logout();
                redirect('site_core/user/login');
                exit('No allowed to User section');
            }
        }

        $this->current_user = $_current_user;
    }
}
