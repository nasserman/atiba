<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




//==============================================================================
/**
 * نام کاربری و کلمه عبور کاربر را به صورت رشته های ساده می گیردو در صورتی که
 * کاربری با نام کاربری معادل با حروع کوچک و ام دی پنج کلمه عبور
 * دردیتابیس باشد شی مربوط به ان کاربر را برمیگرداند
 * در غیر این صورت مقدار نال را برمی گرداند
 * @param plain string $username ex. user10
 * @param plain string $password ex. mypassword
 * @return  \User or null
 */
function user_login($username="" , $password = "")
{
    $CI = get_instance();

    $CI->db->select("*")->from(User_model::DB_TABLE);
    // $where = array(
    //     'LOWER(username)'=>strtolower($username)
    //     );
    $users = $CI->db->where('LOWER(username)' , strtolower($username))->get()->result();
    // $users = $CI->User_model->get($where, 0, 1);
    if(count($users) > 0){
        $row = array_shift($users);
        $user = new User_model();
        $user->populate($row);
        if(password_verify($password, $user->get_password()))
        {
            $CI->session->set_userdata('username' , $user->get_username());
            $CI->session->set_userdata('userid' , $user->PK());
            return $user;
        }

    }

    return NULL;

}
//==============================================================================
/**
 * این تابع شناسه کاربری را دریافت کرده و آن کاربر را لاگین می کند بودن نیاز به نام کاربری و کلمه عبور
 * @param int $id_user
 * @return bool Description
 */
function user_force_login($id_user){
    $CI = &get_instance();
    $CI->load->model('site_core/User_model');
    $user = new User_model();
    $user->load($id_user);
    if(isset($user) and $user->PK()>0){
        $CI->session->set_userdata('username' , $user->get_username());
        $CI->session->set_userdata('userid' , $user->PK());
        return TRUE;
    }
    return FALSE;
}
//==============================================================================
/**
 * کاربر کنونی سایت را بر می گرداند
 * در صورتی که کاربر لاگین نکرده باشد مقدار نال را بر می گرداند
 * @return User_Model
 */
function get_current_site_user(){
    $CI = &get_instance();
    $sess_username = $CI->session->userdata('username');
    $sess_userid = $CI->session->userdata('userid');

    if(!$sess_username or !$sess_userid){
        return NULL;
    } else {
        $CI->load->model('site_core/User_model');
        $CI->db->select("*")->from(User_model::DB_TABLE);
        $users = $CI->db->where('LOWER(username)' , strtolower($sess_username))
                    ->where('id',$sess_userid)->get()->result();
        // $where = array(
        //     'LOWER(username)'=>strtolower($sess_username),
        //     'id' => $sess_userid
        //     );
        // $users = $CI->User_model->get($where, 0, 1);
        if(count($users) > 0){
            $row = array_shift($users);
            $user = new User_model();
            $user->populate($row);
            $CI->session->set_userdata('username' , $user->get_username());
            $CI->session->set_userdata('userid' , $user->PK());
            return $user;
        }
        else {
            return null;
        }
    }
}
//==============================================================================


/**
 *
 * @param type $redirect_uri
 */
function user_logout($redirect_uri = NULL){
    $CI = get_instance();
    $CI->session->unset_userdata('username');
    $CI->session->unset_userdata('userid');
    if($redirect_uri){
        redirect($redirect_uri);
    }
}
//==============================================================================

/**
 * نام کاربری باید
 * کراکترهای مناسب داشته باشد
 * طول مناسب داشته باشد
 * @param array ('code' , 'message')
 */
function validate_username($username){
    $res = [];
    if( strlen($username) < 3 ) {
            $res = ['code'=>-1 , 'message'=>'username is too short!'];
    } elseif( strlen($username) > 20 ) {
        $res = ['code'=>-2 , 'message'=>'username too long!'];
    }
    elseif ( !preg_match('/^[A-Za-z][A-Za-z0-9]{3,20}$/', $username) )
    {
        $res = ['code'=>-3 , 'message'=>'invalide'];
    }
    else {
        $res = ['code'=>1 , 'message'=>'username is valide'];
    }
    return $res;
}
//==============================================================================


/**
 * یک رشته ساده را می گیرد و معادل آن با حروف چوچک را در دیتابیس جستجو می کند که
 * ایا کاربری با ان یا معادل آن با حروف کوچک یا بزرگ ثبت نام کرده است یا نه
 * در صورتی که نام کاربری رزرو شده باشد مقدار نادرست و در غیر این صورت مقدار درست
 * را برمیگرداند
 * @param plain string as username $username
 * @return boolean
 */
function username_is_not_taken($username){
    $CI = get_instance();
    $CI->load->model('site_core/User_model');
    $users = $CI->User_model->get(array('LOWER(username)'=>strtolower($username)), 0, 1);
    if(count($users) < 1){
        return TRUE;
    }
    return FALSE;
}
//==============================================================================
/**
 * بررسی می کند کاربری که در حال بازدید از سایت است لاگین کرده است یا نه
 * @return bool
 */
function user_is_logged_in(){
    $CI = get_instance();
    $sess_username = $CI->session->userdata('username');
    $sess_userid = $CI->session->userdata('userid');
    if(!$sess_username or !$sess_userid){
        return FALSE;
    } else {
        return TRUE;
    }
}
//==============================================================================
