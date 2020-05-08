<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
    
    public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model', 'coaching/coaching_model'];	    
	    $this->common_model->autoload_resources ($config, $models);
	    $this->load->helper ('file');
	}
	
 	public function index () {
    	
    	$access_code = '';
    	
    	if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$access_code = $_GET['sub'];
    	} else {
    		$access_code = '';
    	}
    	$data['ac'] = $access_code;
		$data['script'] = $this->load->view ('scripts/validate', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		//$this->load->view('find_coaching', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);

	}

	// For backward compatibility
	public function logout ($ac='') {
		if ($this->session->userdata ('is_admin') == true) {
			$redirect = site_url ('login/admin/index');
		} else {
			$redirect = site_url ('login/user/index/?sub='.$ac);
		}
		
		$this->session->sess_destroy ();

		redirect ($redirect);
	}

}