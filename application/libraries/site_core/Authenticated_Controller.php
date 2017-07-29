<?php
class Authenticated_Controller extends N2_Controller
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

        $this->current_user = get_current_site_user();;
    }
}
