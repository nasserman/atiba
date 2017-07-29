<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Template
 *
 * @author nasser
 */
class Template {

    protected $template_name = 'uikit';
    protected $layout_name = 'index';
    protected $contents = [];


    //==========================================================================

    public function set_layout($layout_name = 'index')
    {
        $this->layout_name = $layout_name;
    }

    //==========================================================================

    public function __construct()
    {
        $this->ci = &get_instance();

        $this->ci->load->helper('path');
        $this->ci->load->helper('html');
        $this->ci->load->helper('url');

        $this->ci->load->helper('site_core/menu');
        $this->ci->load->helper('site_core/user');



        $menu1 = generate_menu('menu1');
        $this->set_content($menu1, 'menu1');


        $offcanvas_menu1 = generate_offcanvas_menu('menu1' , uri_string());
        $this->set_content($offcanvas_menu1, 'offcanvas');
    }

    //==========================================================================

    public function set_content($content = "" , $position_name = "main")
    {
        if(!array_key_exists($position_name, $this->contents)){
            $this->contents[$position_name] = "";
        }
        $this->contents[$position_name] .= $content;
    }

    //==========================================================================

    public function render()
    {
        $this->ci->load->helper('file');
        $version = file_get_contents('version.txt');
        $this->set_content('version : ' . $version , 'version');

        ob_start();
        include(set_realpath('templates/' . $this->template_name . '/' . $this->layout_name . '.php'));
        $output_html = ob_get_contents();
        ob_end_clean();

        echo $output_html;
    }

    // =========================================================================

    public function add_to_head($tag_for_add_to_head){
        if(!array_key_exists('_head', $this->contents)){
            $this->contents['_head'] = [];
        }
        $this->contents['_head'][] = $tag_for_add_to_head;
    }

    // =========================================================================

    public function add_js($js_file_name_in_js_folder){
        if(!array_key_exists('_js', $this->contents)){
            $this->contents['_js'] = [];
        }
        $this->contents['_js'][] = $js_file_name_in_js_folder;
    }

    // =========================================================================

    public function add_css($js_file_name_in_js_folder){
        if(!array_key_exists('_css', $this->contents)){
            $this->contents['_css'] = [];
        }
        $this->contents['_css'][] = $js_file_name_in_js_folder;
    }


}
