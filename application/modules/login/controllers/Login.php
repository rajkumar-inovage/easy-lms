<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
    
    public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model'];	    
	    $this->common_model->autoload_resources ($config, $models);
	    $this->load->helper ('file');
	}
	
 	public function index () {
    	if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$access_code = $_GET['sub'];
    	} else {
    		$access_code = '';
    	}
    	$this->session->set_userdata ('access_code', $access_code);
    	$data['ac'] = $access_code;
		$data['script'] = $this->load->view ('scripts/validate', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		//$this->load->view('find_coaching', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
}