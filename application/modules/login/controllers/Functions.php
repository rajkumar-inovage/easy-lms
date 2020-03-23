<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends MX_Controller {
    
	var $autoload = array ();

	public function __construct () {
		// Load dependencies for this Class/Module
		$dependencies = array ('login');
		$this->autoload = $this->common_model->autoload_resources ($dependencies);
	} 

    public function validate_login () {		
	
		$this->form_validation->set_rules ('username', 'Username', 'required|trim');
		$this->form_validation->set_rules ('password', 'Password', 'required|trim');		
		
		if ($this->form_validation->run () == true) {
			$response = $this->login_model->validate_login ();
			if ($response['status'] == LOGIN_SUCCESSFUL) {
				$session = $response['session'];
				$redirect = $this->session->userdata ('dashboard');
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>_AT_TEXT ('LOGIN_SUCCESSFUL', 'msg'), 'redirect'=>site_url($redirect), 'session'=>$session, 'menu'=>$response['menu']) ));
			} else if ($response['status'] == INVALID_CREDENTIALS) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('INVALID_CREDENTIALS', 'msg'))));
			} else if ($response['status'] == MAX_ATTEMPTS_REACHED) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('MAX_ATTEMPTS_REACHED', 'msg'))));
			} else if ($response['status'] == INVALID_PASSWORD) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('INVALID_PASSWORD', 'msg'))));
			} else if ($response['status'] == INVALID_USERNAME) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('INVALID_USERNAME', 'msg'))));
			} else {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('LOGIN_ERROR', 'msg'))));				
			}
			/*
			echo 'Good';
			*/
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('VALIDATION_ERROR', 'msg') )));			
			/*
			echo 'Bad';
			*/
		}
	}
}