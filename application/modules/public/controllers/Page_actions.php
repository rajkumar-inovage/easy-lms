<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_actions extends MX_Controller {


	public function __construct () {
		$config = ['coaching/config_coaching'];
	    $models = ['coaching/coaching_model', 'coaching/users_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}


	public function create_coaching () {

		$this->form_validation->set_rules ('coaching_name', 'Coaching Name', 'required|alpha_numeric_spaces|trim');
		$this->form_validation->set_rules ('first_name', 'Admin First Name', 'required|trim');
		$this->form_validation->set_rules ('primary_contact', 'Admin Contact', 'required|numeric|trim');
		$this->form_validation->set_rules ('email', 'Admin Email', 'valid_email|trim');
		$this->form_validation->set_rules ('password', 'Password', 'required|min_length[8]|trim');

		if ($this->form_validation->run () == true) {
			$contact 	= $this->input->post ('primary_contact');
			$name 		= $this->input->post ('coaching_name');
			if ($this->coaching_model->coaching_exists ($contact, $name) == true) {
				// Check if already exists
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'You already have an Admin account registered with this mobile number. Try Sign-in instead' )));
			} else {
				$access_code = $this->coaching_model->create_coaching ();
				$this->session->set_userdata ('access_code', $access_code);
				$this->message->set ('Your coaching account has been set-up succesfully. Login with your credentials provided on previous page', 'success', true);
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Coaching account created', 'redirect'=>site_url('login/user/index?sub='.$access_code) )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors () )));
		}
	}
}