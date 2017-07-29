<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class N2_function_result {

    public $code = -1;
    public $message = "";

    public function __construct($code = -1 , $message = '')
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     *
     * @param int $code
     * @param string $message
     * @return Karvan_validation_result
     */
    public function set($code = -1 , $message = '')
    {
        $this->code = $code;
        $this->message = $message;
        return $this;
    }

    /**
     * @return json
     */
    public function get_json()
    {
        return json_encode($this);
    }

    // -------------------------------------------------------------------------
    /**
    * @param int $code
    * @param string $message
    * @param string $format
    *   values : object | json
    * @param array $additional_data
    *   [ "key"=>value , "key"=>value , ... ]
    */
    public static function response($code , $message="" , $format = "object" , $additional_data = [])
    {
        $result = new N2_function_result();
        $result->code = $code;
        $result->message = $message;
        foreach ($additional_data as $key => $value) {
            $result->{$key} = $value;
        }
        if($format === "object"){
            return $result;
        }
        else if($format === "json"){
            return $result->get_json();
        }
    }
}

// =============================================================================
