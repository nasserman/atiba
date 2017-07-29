<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * این تابه محتوای ارسال شده را به همراه موضوع ارسال شده با ادرس ایمیل مشخص شده ارسال می کند
 * این تابع از ادرس ایمیل زیر برای ارسال استفاده می کند
 * info@rahbordit.ir
 * from name : کاروان
 * @param string $to : user@mail.com
 * @param string $subject
 * @param string $body
 * @return type
 */
function send_mail($to , $subject , $body , $from_email = "info@languagehut.ir" , $from_name="LanguageHut")
{
    $CI = get_instance();

    $CI->load->library('email');

    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'mail.languagehut.ir';
    $config['smtp_user'] = 'info@languagehut.ir';
    $config['smtp_pass'] = ']tA6Toz-LP=p';
    $config['smtp_port'] = 25;
    $config['smtp_timeout'] = 30;
    $config['mailtype'] = 'html';



    $config['charset'] = 'utf-8';
    $config['wordwrap'] = TRUE;

    $CI->email->initialize($config);

    $CI->email->from($from_email, $from_name);
    $CI->email->to($to);

    $CI->email->subject($subject);
    $CI->email->message($body);

    return $CI->email->send();
}



function format_to_email($title , $body)
{
    $format = '<div style="max-width:500px;width:100%;font-family:tahoma;font-size:10px;direction:rtl;text-align:right;border:1px solid #ccc;border-radius:5px;overflow: hidden;margin:10px auto;">

                <div style="font-family:tahoma;direction:rtl;text-align:right;">
                    <h3 style="margin:0px;font-family:tahoma;direction:rtl;text-align:right;background-color: rgb(22, 165, 237);color: #fff;padding: 8px 15px;border-radius: 5px 5px 0px 0px;">
                        @title
                    </h3>
                </div>

                <div style="font-family:tahoma;font-size:14px;direction:rtl;text-align:right;padding:15px;background-color:#fff;">
                    @body
                </div>

                <div style="background-color:#fff;text-align: center;">
                    <a href="http://languagehut.ir" target="_blank">
                        Languagehut . IR
                    </a>
                </div>

            </div>';
    $format = str_replace('@title' , $title, $format);
    $format = str_replace('@body' , $body , $format);
    return $format;
}
// =============================================================================
function ajax_setup($hidden_input = false){
    $ci = &get_instance();
    if($hidden_input){
        echo "<input type='hidden' name='" . $ci->security->get_csrf_token_name() . "' value='" . $ci->security->get_csrf_hash() ."'/>";
        return;
    }
    echo "$.ajaxSetup({data : {" . $ci->security->get_csrf_token_name() . " : \"" . $ci->security->get_csrf_hash() ."\"}});";
}
// =============================================================================
function input_post_int($var_name , $default = 0 ){
    $ci = &get_instance();
    $source = $ci->input->post($var_name,TRUE);
    if(!isset($source))
    {
        return $default;
    }

    $result = intval($source);
    if(is_int($result)){
        return $result;
    }
    return $default;
}
// =============================================================================
function input_post_float($var_name , $default = 0){
    $ci = &get_instance();
    $source = $ci->input->post($var_name,TRUE);
    if(!isset($source))
    {
        return $default;
    }

    $result = floatval($source);
    if(is_float($result)){
        return $result;
    }
    return $default;
}
// =============================================================================
function input_post_string($var_name , $default = "" ,$clean_xss = true){
    $ci = &get_instance();
    $source = $ci->input->post($var_name , $clean_xss);
    if(!isset($source))
    {
        return $default;
    }
    return $source;
}
// =============================================================================
function input_post_bool($var_name , $default = false){
    $ci = &get_instance();
    $source = $ci->input->post($var_name , true);
    if(!isset($source))
    {
        return $default;
    }
    if(($source === '0') or ($source === '') or ( strcasecmp($source, 'false') === 0)){
        return false;
    }
    else {
        return true;
    }
}
// =============================================================================
/**
* @param string $var_name  حاوی یک رشته تاریخ شمسی به فرمت "1394/10/23
* @param int time $default
*
*/
function input_post_tarikhe_shamsi_be_time($var_name , $default = 00 , &$error = ""){
    $ci = &get_instance();
    $source = $ci->input->post($var_name , true);
    if(!isset($source))
    {
        return $default;
    }
    $tarikhe_shamsi = $source;

    if((mb_strlen($tarikhe_shamsi) > 10) and (mb_strlen($tarikhe_shamsi) < 6)){
        $error = "تاریخ وارد شده معتبر نمی باشد";
        return -1;
    }

    $__t = explode('/', $tarikhe_shamsi);
    if(count($__t) !==3){
        $error = "تاریخ وارد شده معتبر نمی باشد";
        return -2;
    }

    $__t[0] = intval($__t[0]);
    $__t[1] = intval($__t[1]);
    $__t[2] = intval($__t[2]);

    $__t[1] = ($__t[1] === 0) ? 1 : $__t[1];
    $__t[2] = ($__t[2] === 0) ? 1 : $__t[2];

    if($__t[0]<100){
        $__t[0] = 1300+$__t[0];
    }

    if($__t[1] >12){
        $__t[1] = 12;
    }

    if($__t[2] >31){
        $__t[2] = 31;
    }

    $time = jmktime(00,00,00,$__t[1] , $__t[2] , $__t[0]);

    return $time;
}
// =============================================================================
function reshteye_tasadofi($length = 16 , $seed = null){
    if(is_null($seed))
    {
        return str_shuffle(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length));
    }
    else
    {
        return str_shuffle(substr(str_shuffle($seed), 0, $length));
    }
}
// =============================================================================

function parse_reshteye_tarikhe_shamsi_be_time($tarikhe_shamsi = "1394/10/23" , $saat="00:00:00")
{
    $return = ['code'=>-1 , 'message'=> "" ,  'time' => -1 ];

    if((mb_strlen($tarikhe_shamsi) > 10) and (mb_strlen($tarikhe_shamsi) < 6)){
        $return = ['code'=>-1615 , 'message'=> "تاریخ وارد شده معتبر نمی باشد" ,  'time' => -1 ];
        return $return;
    }

    $__t = explode('/', $tarikhe_shamsi);
    if(count($__t) !==3){
        return ['code'=>-1616 , 'message'=> "تاریخ وارد شده معتبر نمی باشد" ,  'time' => -1 ];
    }


    $__t[0] = intval($__t[0]);
    $__t[1] = intval($__t[1]);
    $__t[2] = intval($__t[2]);

    $__t[1] = ($__t[1] === 0) ? 1 : $__t[1];
    $__t[2] = ($__t[2] === 0) ? 1 : $__t[2];

    if($__t[0]<100){
        $__t[0] = 1300+$__t[0];
    }

    if($__t[1] >12){
        $__t[1] = 12;
    }

    if($__t[2] >31){
        $__t[2] = 1;
    }

    $__s = explode(":", $saat);

    $_h = intval($__s[0]);
    $_i = intval($__s[1]);
    $_s = intval($__s[2]);

    $time = jmktime($_h,$_i,$_s,$__t[1] , $__t[2] , $__t[0]);

    return ['code'=>1 , 'message'=> "" ,  'time' => $time ];
}

// =============================================================================

function display_site_flash_messages($keep_messages = false){
    $ci = & get_instance();
    $ci->load->library("site_core/Site_flash_message");

    $ses_name = 'site_flash_messages';
    $all_sess_data = $ci->session->all_userdata();
    $site_flash_messages = [];
    if(isset($all_sess_data[$ses_name])){
        $site_flash_messages = $all_sess_data[$ses_name];
    }


    foreach ($site_flash_messages as $m){
        $m = json_decode($m);
        echo '<div style="position: relative;" data-uk-alert class="flash_message uk-alert uk-alert-'.$m->type.'">';
        echo $m->text;
        echo '<a href="" class="uk-alert-close uk-close"></a>';
        echo '</div>';
    }

    if(!$keep_messages){
        $ci->session->unset_userdata($ses_name);
    }
}

function set_site_flash_message(Site_flash_message $message){
    $ci = & get_instance();
    $ci->load->library("site_core/Site_flash_message");

    $ses_name = 'site_flash_messages';
    $all_sess_data = $ci->session->all_userdata();
    $site_flash_messages = [];
    if(isset($all_sess_data[$ses_name])){
        $site_flash_messages = $all_sess_data[$ses_name];
    }
    if(!array_key_exists($message->title , $site_flash_messages)){
        $site_flash_messages[$message->title] = json_encode($message);
    }

    $ci->session->set_userdata($ses_name, $site_flash_messages);
}

// =============================================================================
/**
* این کنترلر به منظور نمایش تصاویر در اندازه های متفاوت در صفحات استفاده می شود
* به این صورت که ابتدا اندازه تصویر  و سپس نام فایل را دریافت می کند
* در صورتی که ان تصویر در پوشه تصاویر اپلود شده وجود داشته باشد کش یا تصویر ریسایز شده را بر می گرداند
* @param string $image_name : نام فایل در پوشه تصاویر
* @param string $size اندازه تصویر در پیکسل به صورت 400_300
*/
function cache_image($image_name = '' , $size = '400_300')
{
    $ci = &get_instance();
    $ci->load->helper('file');

    $cached_image_name = $size . '-' . $image_name;

    if (file_exists('uploads/cache/'.$cached_image_name)) {
        return 'uploads/cache/'.$cached_image_name;
    }
    else {

        $width = 400 ;
        $height = 300;

        try{
            $_size = explode('_', $size);
            $width = $_size[0];
            $height = $_size[1];
        }
        catch(Exception $e) {}

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'uploads/' . $image_name;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;
        $config['height']       = $height;
        $config['new_image']       = 'uploads/cache/' . $cached_image_name;

        $ci->load->library('image_lib', $config);

        $ci->image_lib->resize();

        return 'uploads/cache/'.$cached_image_name;
    }
}

// =============================================================================
function log_info($msg)
{
    $_log_path = APPPATH.'logs/';
    file_exists($_log_path) OR mkdir($_log_path, 0755, TRUE);
    if ( ! is_dir($_log_path) OR ! is_really_writable($_log_path))
    {
        return false;
    }
    $filepath = $_log_path.'infolog-'.date('Y-m-d').'.php';
    $message = '';

    if ( ! file_exists($filepath))
    {
        $newfile = TRUE;
        $message .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
    }
    if ( ! $fp = @fopen($filepath, 'ab'))
    {
        return FALSE;
    }
    flock($fp, LOCK_EX);

    $date = date('Y/m/d h:i:s', time());
    $message .= $date . "\t:\t" . $msg . "\n";
    for ($written = 0, $length = strlen($message); $written < $length; $written += $result)
    {
        if (($result = fwrite($fp, substr($message, $written))) === FALSE)
        {
            break;
        }
    }

    flock($fp, LOCK_UN);
    fclose($fp);
}
// =============================================================================
