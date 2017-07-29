<?php
class Operator_user {

    public function __construct()
    {
        $c = &get_instance();
        $c->load->model("atiba/Profile_user_model");
    }

    // -------------------------------------------------------------------------

    public function liste_user_haye_operator($page_size = 20 , $page_index = 0)
    {
        $params["role"] = "operator_user";
        $params["page_size"] = $page_size;
        $users = User_model::find($params);

        $operators = [];
        foreach($users as $user){
            $user->profile = Profile_user_model::get_profile_user($user->PK() , true);
            if($user->profile){
                $operators[$user->PK()] = $user;
            }
        }

        return $operators;
    }

    // -------------------------------------------------------------------------




}
