<?php

/**
 * Nasser Mansouri
 * last edited : 95 11 06
 */
class N2_Model extends CI_Model {

    const DB_TABLE = 'abstract';
    const DB_TABLE_PK = 'abstract';

    // -------------------------------------------------------------------------

    public function __construct($id = -1)
    {
        if($id>0)
        {
            $this->load($id);
        }
    }

    // -------------------------------------------------------------------------
    /**
     * create a crud friendly std object to insert/update to database
     * @return \stdClass
     */
    private function createTempStdObject(){
        $fields = $this->db->field_data($this::DB_TABLE);

        $temp_object = new stdClass();

        foreach($fields as $field)
        {
            switch ($field->type){
                case 'datetime':
                    $temp_object->{$field->name} =$this->{$field->name}->format('Y-m-d H:i:s');// '2014-01-01 00:00:00';
                    break;
                /*
                case 'object':
                    // calling to_string function (must implement in that class) to serialize object to json string
                    $temp_object->$key = $this->encode_json($value);
                    break;

                case 'array':
                    $temp_object->$key =  json_encode($value);
                    break;
                */
                default :
                    $temp_object->{$field->name} =$this->{$field->name};
                    break;
            }
        }
        return $temp_object;
    }
    // -------------------------------------------------------------------------
    /**
     * Create record.
     */
    private function insert() {
        $temp_object = $this->createTempStdObject();
        $temp_object->{$this::DB_TABLE_PK} = NULL;
        $this->db->insert($this::DB_TABLE, $temp_object);
        $this->{$this::DB_TABLE_PK} = $this->db->insert_id();
        return TRUE;
    }
    // -------------------------------------------------------------------------
    /**
     * Update record.
     */
    private function update() {
        $temp_object = $this->createTempStdObject();
        $res = $this->db->update($this::DB_TABLE, $temp_object,array($this::DB_TABLE_PK => $temp_object->{$this::DB_TABLE_PK}) );
        if($res){
            $this->{$this::DB_TABLE_PK} = $temp_object->{$this::DB_TABLE_PK};
            return TRUE;
        } else {
            return FALSE;
        }
    }
    // -------------------------------------------------------------------------

    /**
     * Populate from an array or standard class.
     * @param mixed $row
     */
    public function populate($row , $populate_foreign_fields = FALSE)
    {
        $fields = $this->db->field_data($this::DB_TABLE);
        foreach($fields as $field)
        {
            switch ($field->type)
            {
                case 'int':
                    $this->{$field->name} =  intval($row->{$field->name});
                    break;

                case 'float':
                case 'double':
                    $this->{$field->name} = floatval($row->{$field->name});
                    break;

                case 'tinyint':
                    $this->{$field->name} = $row->{$field->name}?TRUE:FALSE;
                    break;

                case 'datetime':
                    $this->{$field->name} =new DateTime($row->{$field->name});
                    //$this->{$field->name}->setTimezone(new DateTimeZone('UTC'));
                    break;
                // TODO
                /*
               case 'object':
                   // calling to_string function (must implement in that class) to serialize object to json string
                   $this->{$field->name} = $this->decode_json($row->{$field->name});
                   break;

               case 'array':
                   $this->{$field->name} = json_decode($row->{$field->name});
                   break;
                   */

                default :
                    $this->{$field->name} = $row->{$field->name};
                    break;
            }
        }
        if($populate_foreign_fields)
        {
            $this->populate_foreign_fields();
        }

    }
    // -------------------------------------------------------------------------
    /**
     * Get an array of Models with an optional limit, offset.
     * get(array('id >'=>20 , 'isvalide'=>TRUE) , 0 , 3 , array('id' , 'desc'));
     * @param int $limit Optional.
     * @param int $offset Optional; if set, requires $limit.
     * @return array Models populated by database, keyed by PK.
     */
    public function get($where = array()  , $offset = 0 , $limit = 100 , $order_by = NULL) {
        if(isset($order_by)){
            $this->db->order_by($order_by[0] , $order_by[1]);
        }
        $query = $this->db->get_where($this::DB_TABLE, $where, $limit, $offset);

        $ret_val = array();
        $class = get_class($this);
        foreach ($query->result() as $row) {
            $model = new $class;
            $model->populate($row);
            $ret_val[$row->{$this::DB_TABLE_PK}] = $model;
        }
        return $ret_val;
    }
    // -------------------------------------------------------------------------
    /**
     * Load from the database.
     * @param int $id
     */
    public function load($id)
    {
        $query = $this->db->get_where($this::DB_TABLE, array(
            $this::DB_TABLE_PK => $id,
        ));
        $row = $query->row();
        if(isset($row)){
            $this->populate($row);
            return $this->{$this::DB_TABLE_PK};
        } else {
            $this -> id = -1;
            return -1;
        }
    }
    // -------------------------------------------------------------------------
    public function load_object($where = array())
    {
        $object = $this->get_object($where);
        $this->_clone($this, $object);
    }
    // -------------------------------------------------------------------------
    public static function _clone(& $object , $object_to_clone)
    {
        foreach ($object_to_clone as $key => $value)
        {
             $object->$key = $value;
        }
    }
    // -------------------------------------------------------------------------

    /**
     * Delete the current record.
     */
    public function delete() {
        $this->db->delete($this::DB_TABLE, array(
           $this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK},
        ));
        unset($this->{$this::DB_TABLE_PK});
    }
    // -------------------------------------------------------------------------
    /**
     * Save the record.
     */
    public function save() {
        if (isset($this->{$this::DB_TABLE_PK}) && ($this->{$this::DB_TABLE_PK} > 0) ) {
            return $this->update();
        }
        else {
            return $this->insert();
        }
    }
    // -------------------------------------------------------------------------
    /**
     * شرط ها را در دیتابیس جستجو می کند و یک شی بر می گرداند
     * در صورتی که شی ای یافت نشود مقدار تهی بر می گرداند
     * Get an array of Models with an optional limit, offset.
     * get(array('id >'=>20 , 'isvalide'=>TRUE) , 0 , 3 , array('id' , 'desc'));
     * @return Object
     */
    public function get_object($where = array()) {
        $this->db->order_by('id' , 'desc');
        $query = $this->db->get_where($this::DB_TABLE, $where, 1, 0);
        $ret_val = array();
        $class = get_class($this);
        $rows = $query->result();
        if(count($rows) > 0 )
        {
            $model = new $class;
            $model->populate(array_shift($rows));
            return $model;
        }
        return NULL;
    }
    // -------------------------------------------------------------------------

    /**
     * @return \N2_function_result
     *             + int code
     *             + string message
     */
    public function validate(){
        $validation_result = new N2_function_result( 1 , 'object is valid to save into database');
        return $validation_result;
    }
    // -------------------------------------------------------------------------
    public function PK()
    {
        return $this->{$this::DB_TABLE_PK};
    }
    // -------------------------------------------------------------------------
    public function create_copy()
    {
        $copy = clone $this;
        $copy->{$this::DB_TABLE_PK} = -1;
        return $copy;
    }
    // -------------------------------------------------------------------------

}
