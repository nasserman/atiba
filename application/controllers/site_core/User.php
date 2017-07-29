<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends N2_Controller {


    public function login()
    {
		$user_is_logged_in = user_is_logged_in();
        if($user_is_logged_in){
            redirect(site_url(''));
        }
        $main_content = $this->load->view('site_core/user/login' , [] , true);
        $template = new Template();
        $template->set_content($main_content);
        $template->render();
    }

    // -------------------------------------------------------------------------

    public function submit_login()
    {

        $username = input_post_string('username' , '');
        $password = input_post_string('password' , '');

        $user = user_login($username, $password);

        if(isset($user) && ($user->PK() > 0)){
            $rediarect_url = site_url('');
			echo json_encode(['code'=>1 , 'message'=>'با موفقیت وارد سایت شدید' , 'redirect_url'=>$rediarect_url]);
        }else {
            echo json_encode(['code'=>-1 , 'message'=>'اطلاعات ورود معتبر نمی باشد. ممکن است نام کاربری یا کلمه عبور شما صحیح نباشد یا اینکه حساب کاربری شما غیر فعال باشد. لطفا پس از بررسی نام کاربری و کلمه عبور، مجددا امتحان کنید.']);
        }
    }

    // -------------------------------------------------------------------------

    public function logout()
    {
        user_logout(site_url(''));
    }

    //--------------------------------------------------------------------------

    public function operator_logout()
    {
        $CI = get_instance();
        $CI->session->unset_userdata('id_shobe_entekhabi');
        user_logout(site_url(''));
    }






}
