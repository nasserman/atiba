<?php

class Paziresh_model extends N2_Model {

    const DB_TABLE = 'paziresh_model';
    const DB_TABLE_PK = 'id';

    // -------------------------------------------------------------------------

    protected $id;
    public $stime;
    public $etime;
    /**
    * @var int time تاریخی که پذیرش انجام خواهد شد
    */
    public $time_paziresh;
    /**
    * @var int time تاریخی که پذیرش انجام شده است
    */
    public $time_paziresh_shode;
    public $id_profile_bimar;
    public $onvane_bime;

    public $hazineye_vizit;
    public $takhfif;
    public $mablage_gabele_pardakht;
    public $mablage_pardakht_shodeye_nagdi;
    public $mablage_pardakht_shodeye_kartkhan;
    public $mablage_kole_pardakht_shode;
    public $mablage_kole_bagi_mande;
    /**
    * @var string na_moshakhas|hazf_shode|anjam_shode|gayeb_dar_matab|entezar_baraye_vizit
    */
    public $vaziat;

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
            $this->time_paziresh = $this->time_paziresh_shode = -1;
            $this->id_profile_bimar = -1;
            $this->onvane_bime = "";
            $this->hazineye_vizit = $this->takhfif = $this->mablage_gabele_pardakht = $this->mablage_pardakht_shodeye_nagdi
                = $this->mablage_pardakht_shodeye_kartkhan = $this->mablage_kole_pardakht_shode = $this->mablage_kole_bagi_mande = 0;
            $this->vaziat = "na_moshakhas";
        }
    }

    // -------------------------------------------------------------------------

    public function validate()
    {
        return N2_function_result::response(1 , "OK");
    }

    // -------------------------------------------------------------------------
    /**
    *
    * @param [] $params
    *   int id_profile_bimar
    *   int page_index = 0
    *   int page_size : 20
    *   bool populate_profile_bimar = false
    *
    * @return [\Paziresh_model]
    *
    */
    public static function find($params = [])
    {
        if(!isset($params["id_profile_bimar"])){
            $params["id_profile_bimar"] = -1;
        }
        if(!isset($params["page_index"])){
            $params["page_index"] = 0;
        }
        if(!isset($params["page_size"])){
            $params["page_size"] = 20;
        }
        if(!isset($params["populate_profile_bimar"])){
            $params["populate_profile_bimar"] = false;
        }

        $paziresh_model = Paziresh_model::DB_TABLE;
        $profile_bimar_model = Profile_bimar_model::DB_TABLE;

        $c = &get_instance();
        $c->db->select("$profile_bimar_model.id as id_profile_bimar , $profile_bimar_model.stime as stime_profile_bimar , $profile_bimar_model.etime as etime_profile_bimar , $profile_bimar_model.* ,".
                        " $paziresh_model.* ")
            ->from(Paziresh_model::DB_TABLE)
            ->join("$profile_bimar_model" , "$profile_bimar_model.id = $paziresh_model.id_profile_bimar");

        if($params["id_profile_bimar"] > 0){
            $c->db->where("id_profile_bimar" , $params["id_profile_bimar"]);
        }
        $c->db->limit($params['page_size'] , $params['page_size']*$params['page_index']);

        $rows = $c->db->get()->result();

        $results = [];
        foreach($rows as $row){
            $paziresh = new Paziresh_model();
            $paziresh->populate($row);

            if($params["populate_profile_bimar"]){
                $profile_bimar = new Profile_bimar_model();
                $row->id = $row->id_profile_bimar;
                $row->stime = $row->stime_profile_bimar;
                $row->etime = $row->etime_profile_bimar;
                $profile_bimar->populate($row);
                $paziresh->profile_bimar = $profile_bimar;
            }

            $results[$paziresh->PK()] = $paziresh;
        }
        return $results;
    }

    // -------------------------------------------------------------------------

    public static function vaziathaye_paziresh($key = "")
    {
        $vaziatha = [
            "na_moshakhas"=>"نامشخص",
            "hazf_shode"=>"حذف شده",
            "anjam_shode"=>"انجام شده",
            "gayeb_dar_matab"=>"غائب در مطب",
            "entezar_baraye_vizit"=>"انتظار"
        ];
        if($key){
            return $vaziatha[$key];
        }
        return $vaziatha;
    }

    // -------------------------------------------------------------------------
}
