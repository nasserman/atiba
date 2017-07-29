<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_account extends User_Controller {


    public function index()
    {
        $_rolehaye_user = json_decode($this->current_user->id_roleha);
        if( (in_array('admin_user', $_rolehaye_user)) or (in_array('super_user', $_rolehaye_user))
            or (in_array('operator_user', $_rolehaye_user)) or (in_array('hesabdar_user', $_rolehaye_user)) ){
                $this->load->model("atiba/Profile_user_model");
                $this->current_user->profile = Profile_user_model::get_profile_user($this->current_user->PK());
        }

        $data["current_user"] = $this->current_user;

        $main_content = $this->load->view('site_core/user_account/index' , $data , true);

        $template = new Template();
        $template->set_content($main_content);
        $template->render();
    }

    // -------------------------------------------------------------------------

    public function save()
    {
        if(!$this->input->is_ajax_request()){echo "not allowed!"; return; }

        $name = input_post_string("name" , "");
        $lastname = input_post_string("lastname" , "");
        $email = input_post_string("email" , "");
        $oldpassword = input_post_string("oldpassword" , "");
        $password = input_post_string("password" , "");
        $repassword = input_post_string("repassword" , "");

        $_rolehaye_user = json_decode($this->current_user->id_roleha);
        if( (in_array('admin_user', $_rolehaye_user)) or (in_array('super_user', $_rolehaye_user))
            or (in_array('operator_user', $_rolehaye_user)) or (in_array('hesabdar_user', $_rolehaye_user)) ){
                $this->load->model("atiba/Profile_user_model");
                $this->current_user->profile = Profile_user_model::get_profile_user($this->current_user->PK());
        }

        $set_email_result = $this->current_user->set_email($email);
        if($set_email_result["code"] < 1){
            echo N2_function_result::response(-1 , $set_email_result["message"] , "json");
            return;
        }

        if(strlen($password) > 0){
            if(strlen($oldpassword) < 1){
                echo N2_function_result::response(-2 , "کلمه عبور فعلی خود را وارد کنید." , "json");
                return;
            }
            if(!password_verify($oldpassword, $this->current_user->get_password())){
                echo N2_function_result::response(-3 , "کلمه عبور فعلی وارد شده نادرست است." , "json");
                return;
            }
            if($password !== $repassword){
                echo N2_function_result::response(-4 , "کلمه عبور جدید و تکرار آن باید با یکدیگر برابر باشند." , "json");
                return;
            }
            if((strlen($password)<4) or (strlen($password) > 40)){
                echo N2_function_result::response(-5 , "طول کلمه عبور باید بین ۴ و ۴۰ کاراکتر باشد." , "json");
                return;
            }
            $this->current_user->set_password($password);
        }
        $validate = $this->current_user->validate();
        if($validate["code"] < 1){
            echo N2_function_result::response($validate["code"] , $validate["message"] , "json");
            return;
        }

        $this->current_user->profile->name = $name;
        $this->current_user->profile->lastname = $lastname;
        $this->current_user->profile->save();

        $this->current_user->save();

        $flash_message = new Site_flash_message("" , "اطلاعات حساب کاربری شما به روز شد." , "success");
        set_site_flash_message($flash_message);

        echo N2_function_result::response(1 , "ok" , "json");
    }

    // -------------------------------------------------------------------------



















}
