<?php

class Dictionary_model extends N2_Model {

    const DB_TABLE = 'dictionary';
    const DB_TABLE_PK = 'id';


    protected $id;
    public $key;
    public $value;


    public function __construct($id = -1) {
        if($id>0)
        {
            parent::__construct($id);
        }
        else
        {
            $this->id = -1;
            $this->key = '';
            $this->value = "";

        }
    }

    // -------------------------------------------------------------------------

    public function validate()
    {
        $result = new N2_function_result(1,"OK");
        return $result;
    }

    // -------------------------------------------------------------------------

    public static function SET_DICTIONARY($key , $value = ""){
        $setting = Dictionary_model::GET_DICTIONARY($key);
        if(!$setting){
            $setting = new Dictionary_model();
            $setting->key = $key;
        }
        $setting->value = $value;
        $setting->save();
    }

    // -------------------------------------------------------------------------

    public static function GET_DICTIONARY($key){

        $c = &get_instance();
        $query = $c->db->select("*")->from(Dictionary_model::DB_TABLE)->where('key' , $key);
        $result = $query->get()->result();
        if(count($result) >0){
            $row = array_shift($result);
            $setting = new Dictionary_model();
            $setting->populate($row);
            return $setting;
        }
        else {
            return null;
        }
    }








}
