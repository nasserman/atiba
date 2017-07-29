<?php
class Operator_user {

    public function __construct()
    {
        $c = &get_instance();
        $c->load->model("sirm/Profile_user_model");
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

    public static function get_id_shobeye_entekhab_shode($id_current_user)
    {
        $liste_id_shobehaye_user = Operator_user::liste_id_shobehaye_user($id_current_user);
        $id_shobe = isset($_SESSION['id_shobeye_entekhab_shode']) ? $_SESSION['id_shobeye_entekhab_shode'] : -1;
        if(in_array($id_shobe , $liste_id_shobehaye_user)){
            return $id_shobe;
        }
        $c = &get_instance();
        $c->session->unset_userdata('id_shobeye_entekhab_shode');
        return -1;
    }

    // -------------------------------------------------------------------------

    public static function widget_entekhabe_shobe()
    {
        $c = &get_instance();
        $shobehaye_user  =  [];
        $shobe_operator_ha = Shobe_operator_model::find(['id_user'=>$c->current_user->PK()]);
        foreach($shobe_operator_ha as $shobe_operator){
            $shobe = new Shobe_model($shobe_operator->id_shobe);
            $shobehaye_user[$shobe->PK()] = $shobe;
        }

        $data['shobehaye_user'] = $shobehaye_user;
        $data["id_shobeye_entekhab_shode"] = Operator_user::get_id_shobeye_entekhab_shode($c->current_user->PK());
        $data["redirect"] = "";

        $main_content = $c->load->view('operator/shobe/entekhabe_shobe' ,$data, true);
        return $main_content;
    }

    // -------------------------------------------------------------------------

    public static function liste_id_shobehaye_user($id_user)
    {
        $c = &get_instance();
        $id_shobehaye_user  =  [];
        $shobe_operator_ha = Shobe_operator_model::find(['id_user'=>$c->current_user->PK()]);
        foreach($shobe_operator_ha as $shobe_operator){
            $id_shobehaye_user[$shobe_operator->id_shobe] = $shobe_operator->id_shobe;
        }
        return $id_shobehaye_user;
    }


}
