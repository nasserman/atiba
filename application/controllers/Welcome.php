<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends N2_Controller {

	public function index()
	{
		$template = new Template();
		$main_content = $this->load->view('welcome_message' , [] , true);
    	$template->set_content($main_content);
        $template->render();
	}
}
