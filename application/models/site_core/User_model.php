<?php

class User_model extends N2_Model {

    const DB_TABLE = 'user';
    const DB_TABLE_PK = 'id';


    protected $id;
    protected $username;
    protected $password;

    public $email;
    public $email_taid_shode;

    /**
    * string : super_user , admin_user , operator_user , site_user , hesabdar_user
    */
    public $id_roleha;

    private $_clear_password ;
    private $_password_changed;


    public function __construct($id = -1) {
        if($id > 0)
        {
            parent::__construct($id);
        }
        else
        {
            $this->id = -1;
            $this->username = "";
            $this->password = "";

            $this->email = "";
            $this->email_taid_shode = false;

            $this->id_roleha = json_encode(['site_user']);

            $this->_clear_password = "";
            $this->_password_changed = FALSE;
        }
    }


    /**
     * @return [string] لیست نام گروه های کاربر را به صورت یک ارایه از رشته ها بر می گرداند
     */
    public function Roleha()
    {
        return json_decode($this->id_roleha);
    }


    /**
     * در صورتی که شی قبلا در دیتابیس ذخیره شده باشد امکان تغییر نام کاربری وجود
     * ندارد و در این حالت تابع مقدار نادرست را برمی گرداند
     * @param string $value
     * @return boolean
     */
    public function set_username($value){
        if($this->id > 0 ){
            if(mb_strtolower($value) == mb_strtolower($this->username)){
                $this->username = $value;
                return TRUE;
            } else {
                return FALSE;
            }
        }
        else
        {
            $this->username = $value;
            return TRUE;
        }
    }

    // -------------------------------------------------------------------------
    /**
     *    نام کاربری شی مربوط به کاربر را بر می گرداند
     */
    public function get_username(){
        return $this->username;
    }

    // -------------------------------------------------------------------------
    /**
     * کلمه عبور جدید را پس از هش کردن در متغیر مربوط به کلمه عبور قرار می دهد
     * @param plain string $value
     * @return bool
     */
    public function set_password($value){
        $this->_clear_password = $value;
        $this->_password_changed = TRUE;
        $this->password = password_hash($value, PASSWORD_BCRYPT);
        return TRUE;
    }

    // -------------------------------------------------------------------------
    public function get_password(){
        return $this->password;
    }

    // -------------------------------------------------------------------------
    public function validate(){

        if(mb_strlen($this->username) < 3 )
        {
            return ['code'=>-1 , 'message'=>'طول نام کاربری انتخاب شده کوتاه است'];
        }
        elseif( mb_strlen($this->username) > 20 )
        {
            return ['code'=>-2 , 'message'=>'طول نام کاربری انتخاب شده زیاد است!'];
        }
        elseif(!preg_match('/^[A-Za-z][A-Za-z0-9_]{3,20}$/', $this->username))
        {
            return ['code'=>-3 , 'message'=>'نام کاربری انتخاب شده غیرمجاز است'];
        }


        $users = $this->get(array( 'LOWER(username)'=>  mb_strtolower($this->username)), 0, 1);
        if($this->id < 1){
            if(count($users) > 0)
            {
                return ['code'=>-5 , 'message'=>'نام کاربری مورد نظر شما قبلا ثبت شده است'];
            }
        }



        if($this->id > 0)
        {
            $temp_user = array_shift($users);
            if($temp_user->PK() != $this->PK())
            {
                return ['code'=>-6 , 'message'=>'نام کاربری قبلا ثبت شده است'];
            }
        }

        if((($this->id > 0) && ($this->_password_changed)) or (($this->id < 1)))
        {
            if( mb_strlen($this->_clear_password) < 4 )
            {
                return ['code'=>-7 , 'message'=>'طول کلمه عبور کوتاه است'];
            }
            elseif (mb_strlen($this->_clear_password) > 20 )
            {
                return ['code'=>-8 , 'message'=>'طول کلمه عبور زیاد است'];
            }
        }
        if(mb_strlen($this->email) > 0){
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return ['code'=>-9 , 'message'=>'آدرس ایمیل نامعتبر است.'];
            }

            if(User_model::check_email_gablan_estefade_shode($this->email, $this->PK())){
                return ['code'=>-10 , 'message'=>'آدرس ایمیل قبلا توسط کاربر دیگری استفاده شده است..'];
            }

        }
        return ['code'=>1 , 'message'=>'مجاز'];
    }

    // -------------------------------------------------------------------------
    /**
     * @param string $email
     * @return ['code'=>int , 'message'=>string]
     */
    public function set_email($email , $validate_email = true)
    {
        if($validate_email){
            if(strlen($email) < 5){
                return ['code'=>-2 , 'message'=>'ایمیل وارد شده نامعتبر است'];
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return ['code'=>-1 , 'message'=>'ایمیل وارد شده نامعتبر است'];
            }
        }

        if($this->email !== $email){
            $this->email_taid_shode = false;
        }
        $this->email = $email;

        return ['code'=>1 , 'message'=>'OK'];
    }

    // =========================================================================

    public static function check_email_gablan_estefade_shode($email , $id_user_ignore = -1)
    {
        $ci = &get_instance();

        $ci->db->select("*")->from(User_model::DB_TABLE);

        if($id_user_ignore > 0){
            $ci->db->where('id != ' , $id_user_ignore);
        }
        $query = $ci->db->where('email' , $email)->get();
        $result = $query->result();

        if(count($result) > 0){
            return true;
        }
        return false;
    }

    // -------------------------------------------------------------------------
    /**
     * ایمیل کاربر را تایید و پیام مناسب به ایمیل ارسال می کند
     */
    public function taide_email()
    {
        $this->email_taid_shode = TRUE;
        $this->save();
    }

    // -------------------------------------------------------------------------
    /**
    * نام یک گروه کاربری را می گیرد و آن را به لیست گروه های کاربری کاربر اضافه می کند
    * @param string $id_group ex. editor_user
    * @return bool
    */
    public function add_role($name_role)
    {
        $roleha = json_decode($this->id_roleha);

        if(in_array($name_role , ["admin_user" , "super_user"])){
            return false;
        }

        if(!in_array($name_role , ["site_user" , "operator_user" , "hesabdar_user"])){
            return false;
        }

        if(!in_array($name_role , $roleha)){
            $roleha[] = $name_role;
            $this->id_roleha = json_encode($roleha);
        }
        return true;
    }

    // -------------------------------------------------------------------------
    /**
    * نام یک گروه کاربری را می گیرد و آن را از لیست گروه های کاربری کاربر حذف می کند
    * @param string $id_group ex. editor_user
    * @return bool
    */
    public function remove_role($name_role)
    {
        $groupha = json_decode($this->id_roleha);

        if(in_array($name_role , ["admin_user" , "super_user"])){
            return false;
        }

        if(in_array($name_role , $groupha)){
            $_groupha = array_diff( $groupha , [$name_role] )  ;
            $this->id_roleha = json_encode($_groupha);
        }
        return true;
    }
    // -------------------------------------------------------------------------
    /**
    * شناسه یک گروه کاربری را دریافت می کند و بررسی می کند آیا کاربر آن گروه کاربری را دارد یا نه
    * @param string $id_group
    * @return bool
    */
    public function is($id_group)
    {
        $groupha = json_decode($this->id_roleha);
        if(in_array($id_group , $groupha)){
            return true;
        }
        return false;
    }

    // -------------------------------------------------------------------------
    /**
    * @param string $username
    * @param \User_model $user by reference
    * @return \N2_function_result
    */
    public static function find_user_ba_username($username , &$user)
    {
        $c = &get_instance();

        if(strlen($username) < 1){
            return N2_function_result::response(-1 , "نام کاربری تعیین نشده است.");
        }

        $r = $c->db->select("*")->from(User_model::DB_TABLE)
                ->where("username" , $username)->limit(1)->get()->result();

        if(count($r) < 1){
            return N2_function_result::response(-2 , "کاربری با نام کاربری مشخص شده یافت نشد.");
        }

        $row = array_shift($r);
        $user = new User_model();
        $user->populate($row);

        return N2_function_result::response(1 , "OK");
    }

    // -------------------------------------------------------------------------
    /**
    * @param [] $params
    *       string role super_user|admin_user|operator_user|site_user کاربرانی که این نقش را داشته باشند فیلتر و انتخاب می شوند
    *       int page_size 20
    *       int page_index 0
    * @return [\User_model]
    */
    public static function find($params = [])
    {
        if(!isset($params["page_size"])){
            $params["page_size"] = 20;
        }
        if(!isset($params["page_index"])){
            $params["page_index"] = 0;
        }
        $c = &get_instance();
        $c->db->select("*")->from(User_model::DB_TABLE);
        if(isset($params["role"])){
            $c->db->like("id_roleha" , $params["role"]);
        }
        $c->db->limit($params["page_size"] , $params["page_size"]*$params["page_index"]);

        $result = $c->db->get()->result();

        $return = [];

        foreach ($result as $row) {
            $user = new User_model();
            $user->populate($row);
            $return[$user->PK()] = $user;
        }
        return $return;
    }

    // -------------------------------------------------------------------------

    /**
     * نام کاربری باید
     * کراکترهای مناسب داشته باشد
     * طول مناسب داشته باشد
     * قبلا توسط کاربر دیگری استفاده نشده باشد
     * @param \N2_function_result
     */
    public static function validate_username($username , $id_user_ignore = -1){
        $res = [];
        if( strlen($username) < 3 ) {
            return N2_function_result::response(-1 , "نام کاربری خیلی کوتاه تر");
        } elseif( strlen($username) > 20 ) {
            return N2_function_result::response(-2 , "نام کاربری خیلی بزرگ است!");
        } elseif ( !preg_match('/^[A-Za-z][A-Za-z0-9]{3,20}$/', $username) ) {
            return N2_function_result::response(-3 , "نام کاربری نامعتبر است.");
        } else {
            $c = &get_instance();
            $c->db->select("*")->from(User_model::DB_TABLE)->where("LOWER(username)" , mb_strtolower($username));
            if($id_user_ignore > 0){
                $c->db->where("id != " , $id_user_ignore);
            }
            $result = $c->db->get()->result();
            if(count($result) > 0){
                return N2_function_result::response(-4 , "نام کاربری قبلا توسط کاربر دیگری استفاده شده است. #1312");
            }
        }
        return N2_function_result::response(1 , "OK");
    }

    // -------------------------------------------------------------------------
    /**
    * @param string $code_dastrasi
    * @return bool
    *
    */
    public function dastrasi_darad($code_dastrasi)
    {
        $CI = get_instance();
        $CI->config->load('site_core/dastrasiha',true);
        $dastrasiha = $CI->config->item('site_core/dastrasiha')['dastrasiha'];


        $dastasi = null;
        if(count($dastrasiha) > 0){
            foreach($dastrasiha as $p){
                if($p['code'] === $code_dastrasi){
                    $dastasi = $p;
                    break;
                }
            }
        }

        if(!isset($dastasi)){
            return false;
        }

        if($dastasi["noe"] === "hame"){
            return true;
        }


        $user_is_logged_in = user_is_logged_in();

        if(($dastasi["noe"] === "fagat_login_shodeha") and ($user_is_logged_in)){
            return true;
        }
        if(($dastasi["noe"] === "fagat_login_nashodeha") and (!$user_is_logged_in)){
            return true;
        }
        if($dastasi["noe"] === "fagat_dar_grouhha"){
            if(!$user_is_logged_in){
                return false;
            }
            $current_user = get_current_site_user();
            $groupha = json_decode($current_user->id_roleha);
            foreach($p['id_grouhha'] as $_id_role){
                if(in_array($_id_role , $groupha)){
                    return true;
                }
            }
        }

        return false;
    }

    // -------------------------------------------------------------------------








}
