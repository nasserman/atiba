<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends Admin_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model("atiba/Profile_user_model");
        $this->load->library("atiba/Operator_user");
    }

    // -------------------------------------------------------------------------

    public function index($id_ostan = -1 , $id_shahr = -1)
    {
        $operator_user = new Operator_user();
        $operators = $operator_user->liste_user_haye_operator();
        $data["operatorha"] = $operators;

        $main_content = $this->load->view('admin/operator/index' , $data , true);
        $template = new Template();
        $template->set_content($main_content);
        $template->render();
    }

    // -------------------------------------------------------------------------

    public function edit($id_user = -1)
    {
        $data["error"] = "";
        $id_user = intval($id_user);
        $user = new User_model();
        if($id_user>0){
            $user->load($id_user);
            if((!$user) or ($user->PK() < 1)){
                $data["error"] = "کاربر مورد نظر وجود ندارد! #1223";
            }
            else if(!$user->is("operator_user")){
                $data["error"] = "کاربر مورد نظر دارای نقش اپراتور نمی باشد. #1224";
            }
        }

        if(!$data["error"]){
            $profile = new Profile_user_model();
            if($user->PK() > 0){
                $profile = Profile_user_model::get_profile_user($user->PK());
            }
            $user->profile = $profile;
            $data["user"] = $user;
        }

        $data["id_user"] = $id_user;
        $main_content = $this->load->view('admin/operator/edit' , $data , true);
        $template = new Template();
        $template->set_layout("dialog");
        $template->set_content($main_content);
        $template->render();
    }

    // -------------------------------------------------------------------------

    public function save()
    {
        if(!$this->input->is_ajax_request()){echo "not allowed!";return;}

        $id_user = input_post_int("id_user" , -1);
        $user = new User_model();
        if($id_user> 0){
            $user->load($id_user);
            if((!$user) or ($user->PK() < 1)){
                echo N2_function_result::response(-1 , "شناسه کاربر نادرست است. #1258" , "json");
                return;
            }
            if(!$user->is("operator_user")){
                echo N2_function_result::response(-2 , "کاربر دارای نقش اپراتور در سامانه نیست. #1259" , "json");
                return;
            }
        }

        if($user->PK() < 1){
            $user->set_username(input_post_string("username", ""));
        }

        $user->set_email(input_post_string("email" , "") , false);
        $user->email_taid_shode = input_post_bool("email_taid_shode" , false);
        $_password = $this->input->post("password" , false);
        if($user->PK() < 1){
            if(strlen($_password) < 3){
                echo N2_function_result::response(-3 , "کلمه عبور وارد نشده است." , "json");
                return;
            }
            $user->set_password($_password);
        }
        else if(strlen($_password) > 0){
            $user->set_password($_password);
        }

        $user_validation = $user->validate();
        if($user_validation["code"] < 1){
            echo N2_function_result::response($user_validation["code"] , $user_validation["message"] , "json");
            return;
        }

        $profile = new Profile_user_model();
        if($user->PK() > 0){
            $profile = Profile_user_model::get_profile_user($user->PK() , true);
        }
        $profile->name = input_post_string("name" , "");
        $profile->lastname = input_post_string("lastname" , "");

        $profile_validation = $profile->validate(true);
        if($profile_validation->code < 1){
            echo $profile_validation->get_json();
            return;
        }


        $this->db->trans_start();

        if(!$user->is("operator_user")){
            $user->add_role("operator_user");
        }
        $user->save();

        $profile->id_user = $user->PK();
        $profile->save();

        $this->db->trans_complete();

        // ---------------------------------------------

        $flash_message = new Site_flash_message("" , "ذخیره شد." , "success");
        set_site_flash_message($flash_message);

        echo N2_function_result::response(1 , "ذخیره شد." , "json");
    }

    // -------------------------------------------------------------------------



















}
