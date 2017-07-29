<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paziresh extends Operator_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model("atiba/Profile_user_model");
        $this->load->model("atiba/Profile_bimar_model");
        $this->load->model("atiba/Paziresh_model");
        $this->load->library("atiba/Operator_user");
    }

    // -------------------------------------------------------------------------

    public function index()
    {
        $main_content = $this->load->view('operator/paziresh/index' , [] , true);
        $template = new Template();
        $template->set_content($main_content);
        $template->render();
    }

    // -------------------------------------------------------------------------

    public function search()
    {
        if(!$this->input->is_ajax_request()){echo "not allowed!";return;}

        $search_params["page_size"] = input_post_int("page_size" , 20);
        $search_params["page_index"] = input_post_int("page_index" , 0);

        $_bimarha = Profile_bimar_model::find($search_params);
        $bimarha = [];
        foreach($_bimarha as $_bimar){
            $row = [
                "namelastname"=>$_bimar->name. " " . $_bimar->lastname,
                "codemelli"=>$_bimar->codemelli,
                "tel"=>$_bimar->tel,
                "mobile"=>$_bimar->mobile,
                "pk"=>$_bimar->PK()
            ];
            $bimarha[] = $row;
        }

        echo N2_function_result::response(1 , "OK" , "json" , ["result"=>$bimarha]);
    }

    // -------------------------------------------------------------------------

    public function edit($id_profile_bimar = -1)
    {
        $data["error"] = "";
        $id_profile_bimar = intval($id_profile_bimar);
        $profile_bimar = new Profile_bimar_model($id_profile_bimar);
        $data["profile_bimar"] = $profile_bimar;

        $main_content = $this->load->view('operator/bimar/edit' , $data , true);
        $template = new Template();
        $template->set_layout("dialog");
        $template->set_content($main_content);
        $template->render();
    }

    // -------------------------------------------------------------------------

    public function save()
    {
        if(!$this->input->is_ajax_request()){echo "not allowed!";return;}

        $id_profile_bimar = input_post_int("id_profile_bimar" , -1);
        $profile_bimar = new Profile_bimar_model();
        if($id_profile_bimar> 0){
            $profile_bimar->load($id_profile_bimar);
        }

        if($profile_bimar->PK() > 0){
            $profile_bimar->etime = time();
        }

        $profile_bimar->name = input_post_string("name" , "");
        $profile_bimar->lastname = input_post_string("lastname" , "");
        $profile_bimar->name_pedar = input_post_string("name_pedar" , "");
        $profile_bimar->jensiat = input_post_string("jensiat" , "n");
        $profile_bimar->codemelli = input_post_string("codemelli" , "");
        $profile_bimar->tel = input_post_string("tel" , "");
        $profile_bimar->mobile = input_post_string("mobile" , "");
        $profile_bimar->adres = input_post_string("adres" , "");


        $profile_bimar_validation = $profile_bimar->validate();
        if($profile_bimar_validation->code < 1){
            echo $profile_bimar_validation->get_json();
            return;
        }

        $this->db->trans_start();
        $profile_bimar->save();
        $this->db->trans_complete();

        // ---------------------------------------------

        echo N2_function_result::response(1 , "ذخیره شد." , "json");
    }

    // -------------------------------------------------------------------------



















}
