<?php

class Profile_bimar_model extends N2_Model {

    const DB_TABLE = 'profile_bimar';
    const DB_TABLE_PK = 'id';

    // -------------------------------------------------------------------------

    protected $id;
    public $stime;
    public $etime;
    public $name;
    public $lastname;
    public $name_pedar;
    /**
    * @var string
    *   n نامشخص
    *   f زن
    *   m مرد
    */
    public $jensiat;
    public $codemelli;
    public $tel;
    public $mobile;
    public $time_tavalod;
    public $adres;

    // -------------------------------------------------------------------------

    public function __construct($id = -1) {
        if($id > 0)
        {
            parent::__construct($id);
        }
        else
        {
            $this->id = -1;
            $this->stime = time();
            $this->etime = time();
            $this->name = $this->lastname = $this->name_pedar = "";
            $this->jensiat = "n";
            $this->codemelli = "";
            $this->tel = $this->mobile = $this->adres = "";
            $this->time_tavalod = -1;
        }
    }

    // -------------------------------------------------------------------------

    public function validate(){

        if(mb_strlen($this->name) < 3 )
        {
            return N2_function_result::response(-1 , 'طول نام انتخاب شده کوتاه است.');
        }

        return N2_function_result::response(1 , "OK");
    }

    // -------------------------------------------------------------------------
    /**
    *
    * @param [] $params
    *   string namelastname
    *   string codemelli
    *   string mobile
    *   string jensiat hame|f|m
    *   int page_index = 0
    *   int page_size : 10
    *
    * @return [\Profile_bimar_model]
    *
    */
    public static function find($params = [])
    {
        if(!isset($params["namelastname"])){
            $params["namelastname"] = "";
        }
        if(!isset($params["codemelli"])){
            $params["codemelli"] = "";
        }
        if(!isset($params["mobile"])){
            $params["mobile"] = "";
        }
        if(!isset($params["jensiat"])){
            $params["jensiat"] = "hame";
        }
        if(!isset($params["page_index"])){
            $params["page_index"] = 0;
        }
        if(!isset($params["page_size"])){
            $params["page_size"] = 10;
        }

        $c = &get_instance();
        $c->db->select("*")->from(Profile_bimar_model::DB_TABLE);

        if(strlen($params["namelastname"]) > 0){
            $c->db->group_start();
            $c->db->like("name" , $params["namelastname"] )
                ->or_like("lastname" , $params["namelastname"]);
            $c->db->group_end();
        }
        if(strlen($params["codemelli"]) > 0){
            $c->db->like("codemelli" , $params["codemelli"]);
        }
        if(strlen($params["mobile"]) > 0){
            $c->db->like("mobile" , $params["mobile"]);
        }
        if($params["jensiat"] != "hame"){
            $c->db->where("jensiat" , $params["jensiat"]);
        }
        $c->db->limit($params['page_size'] , $params['page_size']*$params['page_index']);

        $rows = $c->db->get()->result();

        $results = [];
        foreach($rows as $row){
            $profile = new Profile_bimar_model();
            $profile->populate($row);
            $results[$profile->PK()] = $profile;
        }
        return $results;
    }

    // -------------------------------------------------------------------------
}
