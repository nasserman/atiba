<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends N2_Controller
{
    // =========================================================================
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    // =========================================================================

    public function upload()
    {

        if(!$this->input->is_ajax_request()){
            echo json_encode(['code'=>-1 , 'message'=>'JUST AJAX REQUESTS ALLOWED!']);
            return;
        }

        $_field_name = input_post_string("field_name" , "userfile");
        $_client_token = input_post_string("client_token" , "");
        $_folder_name_to_upload = input_post_string('upload_dest' , '');
        if(strlen($_folder_name_to_upload) > 0){
            $_folder_name_to_upload .= '/';
        }

        $response = [];

        $config['upload_path']          = './uploads/' . $_folder_name_to_upload;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types']        = 'gif|jpg|png|GIF|JPG|PNG|jpeg|JPEG|Jpeg|Jpg|Png';
        $config['max_size']             = 512;
        $config['max_width']            = 1400;
        $config['max_height']           = 1400;
        $config['encrypt_name']           = TRUE;


        $this->load->library('upload', $config);



        if ( ! $this->upload->do_upload($_field_name))
        {
            $response['error'] = $this->upload->display_errors();
            $response['client_token'] = $_client_token;
            $response ['code'] = -1 ;

        }
        else
        {
            $upload_data = $this->upload->data();
            /*
            $this->upload->data() : Array
            (
                [file_name]     => mypic.jpg
                [file_type]     => image/jpeg
                [file_path]     => /path/to/your/upload/
                [full_path]     => /path/to/your/upload/jpg.jpg
                [raw_name]      => mypic
                [orig_name]     => mypic.jpg
                [client_name]   => mypic.jpg
                [file_ext]      => .jpg
                [file_size]     => 22.2
                [is_image]      => 1
                [image_width]   => 800
                [image_height]  => 600
                [image_type]    => jpeg
                [image_size_str] => width="800" height="200"
            )
            */

            $response['upload_data']['file_name'] = $upload_data['file_name'];
            $response['upload_data']['raw_name'] = $upload_data['raw_name'];
            $response['upload_data']['file_ext'] = $upload_data['file_ext'];
            $response['upload_data']['base_url'] = base_url('uploads/'.$_folder_name_to_upload.$upload_data['file_name']);

            $response['client_token'] = $_client_token;
            $response ['code'] = 1 ;
        }

        echo json_encode($response);
    }

    // =========================================================================

    public function upload_audio()
    {

        if(!$this->input->is_ajax_request()){
            echo json_encode(['code'=>-1 , 'message'=>'JUST AJAX REQUESTS ALLOWED!']);
            return;
        }

        $_client_token = input_post_string("client_token" , "");
        $_field_name = input_post_string("field_name" , "userfile");
        $_folder_name_to_upload = input_post_string('upload_dest' , '');
        if(strlen($_folder_name_to_upload) > 0){
            $_folder_name_to_upload .= '/';
        }

        $response = [];

        $config['upload_path']          = './uploads/audio/' . $_folder_name_to_upload;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types']        = 'mp3|MP3';
        $config['max_size']             = 4096;
        $config['encrypt_name']           = TRUE;
        $config['file_ext_tolower']           = TRUE;



        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload($_field_name))
        {
            $response['error'] = $this->upload->display_errors();
            $response ['code'] = -1 ;
            $response['client_token'] = $_client_token;
        }
        else
        {
            $upload_data = $this->upload->data();
            /*
            $this->upload->data() : Array
            (
                [file_name]     => mypic.jpg
                [file_type]     => image/jpeg
                [file_path]     => /path/to/your/upload/
                [full_path]     => /path/to/your/upload/jpg.jpg
                [raw_name]      => mypic
                [orig_name]     => mypic.jpg
                [client_name]   => mypic.jpg
                [file_ext]      => .jpg
                [file_size]     => 22.2
                [is_image]      => 1
                [image_width]   => 800
                [image_height]  => 600
                [image_type]    => jpeg
                [image_size_str] => width="800" height="200"
            )
            */
            $response['upload_data']['file_name'] = $upload_data['file_name'];
            $response['upload_data']['raw_name'] = $upload_data['raw_name'];
            $response['upload_data']['file_ext'] = $upload_data['file_ext'];
            $response['upload_data']['base_url'] = base_url('uploads/audio/'.$_folder_name_to_upload.$upload_data['file_name']);
            $response['client_token'] = $_client_token;
            $response ['code'] = 1 ;
        }

        echo json_encode($response);
    }

    // =========================================================================



    // =========================================================================

}
