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

        $c = &get_instance();
        $c->db->select("*")->from(Paziresh_model::DB_TABLE);

        if($params["id_profile_bimar"] > 0){
            $c->db->where("id_profile_bimar" , $params["id_profile_bimar"]);
        }
        $c->db->limit($params['page_size'] , $params['page_size']*$params['page_index']);

        $rows = $c->db->get()->result();

        $results = [];
        foreach($rows as $row){
            $profile = new Paziresh_model();
            $profile->populate($row);
            $results[$profile->PK()] = $profile;
        }
        return $results;
    }

    // -------------------------------------------------------------------------
}
