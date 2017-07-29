<?php

class Profile_moshtari_model extends N2_Model {

    const DB_TABLE = 'profile_moshtari';
    const DB_TABLE_PK = 'id';

    protected $id;
    public $stime;
    public $name;
    public $lastname;
    public $codemelli;
    public $shmobile;
    public $tel;
    public $email;
    public $stime_tavalod;
    public $stime_tavalode_hamsar;
    /**
    * @var string m|f|namoshakhas
    */
    public $jensiat;
    /**
    * @var string diplom|foge_diplom|lisans|foge_lisans|doktora|namoshakhas
    */
    public $tahsilat;

    public $newsletter_sms;
    public $newsletter_email;
    public $other_sms;
    public $other_email;
    public $ejazeye_tamase_telefoni;
    /**
    * @var string moshtari|hamkar
    */
    public $noe;
    public $id_customer_opencart;
    /**
    * @var string sabte_name_khabarname|sabte_name_opencart|sabte_dasti_operator|namoshakhas
    */
    public $az_tarig;

    public $mahe_tavalod;
    public $rooze_tavalod;
    public $mahe_tavalode_hamsar;
    public $rooze_tavalode_hamsar;




    public function __construct($id = -1) {
        if($id > 0)
        {
            parent::__construct($id);
        }
        else
        {
            $this->id = -1;
            $this->stime = time();
            $this->name = $this->lastname = "";
            $this->codemelli = "";
            $this->shmobile = $this->tel = $this->email = "";
            $this->stime_tavalod = $this->stime_tavalode_hamsar = -1;
            $this->jensiat = "namoshakhas";
            $this->tahsilat = "namoshakhas";
            $this->newsletter_sms = $this->newsletter_email = $this->other_sms = $this->other_email = $this->ejazeye_tamase_telefoni = true;
            $this->noe = "moshtari";
            $this->id_customer_opencart = -1;
            $this->az_tarig = "namoshakhas";
            $this->mahe_tavalod = $this->mahe_tavalode_hamsar = $this->rooze_tavalod = $this->rooze_tavalode_hamsar = -1;
        }
    }




    // -------------------------------------------------------------------------
    public function validate(){

        // TODO
        if(mb_strlen($this->name) < 3 )
        {
            return N2_function_result::response(-1 , 'طول نام انتخاب شده کوتاه است.');

        }

        // TODO بررسی شماره موبایل
        if($this->noe === "moshtari"){
            if(strlen($this->shmobile) < 11){
                return N2_function_result::response(-30 , "شماره موبایل اجباری است.");
            }
        }
        // TODO بررسی اینکه شماره موبایل قبل استفاده شده است یا نه
        if(strlen($this->shmobile) > 0){
            if(Profile_moshtari_model::check_shmobile_gablan_estefade_shode($this->shmobile , $this->PK())){
                return N2_function_result::response(-20 , "شماره موبایل وارد شده قبلا توسط کاربر دیگری ثبت شده است.");
            }
        }





        if($this->rooze_tavalod > 0){
            if(($this->rooze_tavalod < 1) or ($this->rooze_tavalod > 31)){
                return N2_function_result::response(-10 , 'روز تولد نامعتبر است.');
            } else if($this->mahe_tavalod < 1) {
                return N2_function_result::response(-14 , 'ماه تولد تعیین نشده است.');
            }
        }
        if($this->rooze_tavalode_hamsar > 0){
            if(($this->rooze_tavalode_hamsar < 1) or ($this->rooze_tavalode_hamsar > 31)){
                return N2_function_result::response(-11 , 'روز تولد همسر نامعتبر است.');
            } else if($this->mahe_tavalode_hamsar < 1) {
                return N2_function_result::response(-15 , 'ماه تولد همسر تعیین نشده است.');
            }
        }
        if($this->mahe_tavalod > 0){
            if(($this->mahe_tavalod < 1) or ($this->mahe_tavalod > 12)){
                return N2_function_result::response(-12 , 'ماه تولد نامعتبر است.');
            } else if($this->rooze_tavalod < 1) {
                return N2_function_result::response(-16 , 'روز تولد تعیین نشده است.');
            }
        }
        if($this->mahe_tavalode_hamsar > 0){
            if(($this->mahe_tavalode_hamsar < 1) or ($this->mahe_tavalode_hamsar > 12)){
                return N2_function_result::response(-13 , 'ماه تولد همسر نامعتبر است.');
            } else if($this->rooze_tavalod < 1) {
                return N2_function_result::response(-17 , 'روز تولد همسر تعیین نشده است.');
            }
        }

        // بررسی صحت ایمیل
        if(mb_strlen($this->email) > 0){
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return N2_function_result::response(-9 , 'آدرس ایمیل نامعتبر است.');
            }
            // TODO بررسی اینکه ایمیل قبلا استفاده شده است یا نه
            if(Profile_moshtari_model::check_email_gablan_estefade_shode($this->email , $this->PK())){
                return N2_function_result::response(-19 , 'ایمیل وارد شده قبلا توسط کاربر دیگری ثبت شده است.');
            }
        }
        return N2_function_result::response(1 , "OK");
    }

    // -------------------------------------------------------------------------



    public static function check_email_gablan_estefade_shode($email , $id_ignore = -1)
    {
        $ci = &get_instance();

        $ci->db->select("*")->from(Profile_moshtari_model::DB_TABLE);

        if($id_ignore > 0){
            $ci->db->where('id != ' , $id_ignore);
        }
        $query = $ci->db->where('email' , $email)->get();
        $result = $query->result();

        if(count($result) > 0){
            return true;
        }
        return false;
    }

    // -------------------------------------------------------------------------

    public static function check_shmobile_gablan_estefade_shode($shmobile , $id_ignore = -1)
    {
        $ci = &get_instance();

        $ci->db->select("*")->from(Profile_moshtari_model::DB_TABLE);

        if($id_ignore > 0){
            $ci->db->where('id != ' , $id_ignore);
        }
        $query = $ci->db->where('shmobile' , $shmobile)->get();
        $result = $query->result();

        if(count($result) > 0){
            return true;
        }
        return false;
    }

    // -------------------------------------------------------------------------
    /**
    *
    * @param [] $params
    *   string namelastname
    *   string codemelli
    *   string shmobile
    *   string email
    *   string jensiat hame|f|m
    *   string tahsilat hame|sabte_name_khabarname|sabte_name_opencart|sabte_dasti_operator|namoshakhas
    *   string noe hame|hamkar|moshtari
    *   int page_index = 0
    *   int page_size : 10
    *
    *
    * @return [\Profile_moshtari_model]
    *
    */
    public static function search($params = [])
    {
        if(!isset($params["namelastname"])){
            $params["namelastname"] = "";
        }
        if(!isset($params["codemelli"])){
            $params["codemelli"] = "";
        }
        if(!isset($params["shmobile"])){
            $params["shmobile"] = "";
        }
        if(!isset($params["email"])){
            $params["email"] = "";
        }
        if(!isset($params["jensiat"])){
            $params["jensiat"] = "hame";
        }
        if(!isset($params["tahsilat"])){
            $params["tahsilat"] = "hame";
        }
        if(!isset($params["noe"])){
            $params["noe"] = "hame";
        }
        if(!isset($params["page_index"])){
            $params["page_index"] = 0;
        }
        if(!isset($params["page_size"])){
            $params["page_size"] = 10;
        }

        $c = &get_instance();
        $c->db->select("*")->from(Profile_moshtari_model::DB_TABLE);

        if(strlen($params["namelastname"]) > 0){
            $c->db->group_start();
            $c->db->like("name" , $params["namelastname"] )
                ->or_like("lastname" , $params["namelastname"]);
            $c->db->group_end();
        }
        if(strlen($params["codemelli"]) > 0){
            $c->db->like("codemelli" , $params["codemelli"]);
        }
        if(strlen($params["shmobile"]) > 0){
            $c->db->like("shmobile" , $params["shmobile"]);
        }
        if(strlen($params["email"]) > 0){
            $c->db->like("email" , $params["email"]);
        }
        if($params["jensiat"] != "hame"){
            $c->db->where("jensiat" , $params["jensiat"]);
        }
        if($params["tahsilat"] != "hame"){
            $c->db->where("tahsilat" , $params["tahsilat"]);
        }
        if($params["noe"] != "hame"){
            $c->db->where("noe" , $params["noe"]);
        }
        $c->db->limit($params['page_size'] , $params['page_size']*$params['page_index']);


        $rows = $c->db->get()->result();

        $results = [];
        foreach($rows as $row){
            $profile = new Profile_moshtari_model();
            $profile->populate($row);
            $results[$profile->PK()] = $profile;
        }
        return $results;
    }







}
