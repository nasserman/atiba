<?php
class Operator_Controller extends N2_Controller {

    function __construct()
    {
        parent::__construct();

        $user_is_logged_in = user_is_logged_in();
        if(!$user_is_logged_in){
            user_logout();
            redirect('site_core/user/login');
            exit('No allowed to Editor section');
        }

        $_current_user = get_current_site_user();
        $_rolehaye_user = json_decode($_current_user->id_roleha);
        if(     (!in_array('operator_user', $_rolehaye_user))
            and (!in_array('admin_user', $_rolehaye_user))
            and (!in_array('super_user', $_rolehaye_user)) ){

            user_logout();
            redirect('site_core/user/login');
            exit('No allowed to this section');
        }

        $this->current_user = $_current_user;

        $this->load->model("atiba/Profile_user_model");
        $this->current_user->profile = Profile_user_model::get_profile_user($_current_user->PK());
    }
}
