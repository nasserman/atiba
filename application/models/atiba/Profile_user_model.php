<?php

class Profile_user_model extends N2_Model {

    const DB_TABLE = 'profile_user';
    const DB_TABLE_PK = 'id';

    protected $id;
    public $id_user;
    public $name;
    public $lastname;




    public function __construct($id = -1) {
        if($id > 0)
        {
            parent::__construct($id);
        }
        else
        {
            $this->id = -1;
            $this->name = $this->lastname = "";
            $this->id_user = -1;
        }
    }

    // -------------------------------------------------------------------------

    public function validate($ignor_id_user = false)
    {
        if(!$ignor_id_user){
            if($this->id_user < 1){
                return N2_function_result::response(-1 , "id_user < 1");
            }
        }
        if(mb_strlen($this->name) < 2){
            return N2_function_result::response(-2 , "نام باید حداقل شامل ۲ کاراکتر باشد.");
        }
        if(mb_strlen($this->name) > 200){
            return N2_function_result::response(-3 , "نام حداکثر می تواند شامل ۲۰۰ کاراکتر باشد.");
        }
        if(mb_strlen($this->lastname) < 2){
            return N2_function_result::response(-2 , "نام خانوادگی باید حداقل شامل دو کاراکتر باشد.");
        }
        if(mb_strlen($this->lastname) > 200){
            return N2_function_result::response(-3 , "طول نام خانوادگی حداکثر ۲۰۰ کاراکتر است.");
        }
        return N2_function_result::response(1 , "اطلاعات کاربری ذخیره شد.");
    }

    // -------------------------------------------------------------------------
    /**
    * شناسه یک کاربر را دریافت می کنند و اگر کاربر دارای یکی از نقش های زیر باشد پروفایل او را بر می گرداند
    * اگر فیلد دوم صحیح باشد در صورتی که پروفایل کاربر یافت نشود یک پروفایل خالی ایجاد و برگشت داده می شود
    *   operator_user | admin_user | super_user
    * @param int $id_user
    * @param bool $create_if_not_found
    * @return \Profile_user_model | null
    */
    public static function get_profile_user($id_user , $create_if_not_found = true)
    {
        if(intval($id_user) < 1){
            return null;
        }

        $c = &get_instance();
        $query = $c->db->select("*")->from(Profile_user_model::DB_TABLE)->where("id_user" , $id_user)->get();

        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            $profile = new Profile_user_model();
            $profile->populate($row);
            return $profile;
        }

        if($create_if_not_found){
            $profile = new Profile_user_model();
            $profile->id_user = $id_user;
            $profile->save();
            return $profile;
        }

        return null;
    }

    // -------------------------------------------------------------------------

}
