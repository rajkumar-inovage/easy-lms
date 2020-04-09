<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_actions extends MX_Controller {


	public function __construct () {
		$config = [];
	    $models = ['coaching/coaching_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}


	public function create_coaching () {

		$this->form_validation->set_rules ('coaching_name', 'Coaching Name', 'required|alpha_numeric_spaces|trim');
		$this->form_validation->set_rules ('coaching_url', 'Coaching Identifier', 'required|alpha_numeric|is_unique[coachings.coaching_url]|trim', ['is_unique'=>'This %s is already in use by someone. Try a different one']);
		$this->form_validation->set_rules ('city', 'City', 'required|trim');
		$this->form_validation->set_rules ('website', 'Website', 'valid_url|trim');
		$this->form_validation->set_rules ('first_name', 'Admin First Name', 'required|trim');
		$this->form_validation->set_rules ('last_name', 'Admin Last Name', 'required|trim');
		$this->form_validation->set_rules ('primary_contact', 'Admin Contact', 'required|numeric|trim');
		$this->form_validation->set_rules ('email', 'Admin Email', 'required|valid_email|trim');
		$this->form_validation->set_rules ('password', 'Password', 'required|min_length[8]|trim');
		$this->form_validation->set_rules ('confirm_password', 'Confirm Password', 'required|matches[password]|trim');

		if ($this->form_validation->run () == true) {
			$slug = $this->coaching_model->create_coaching ();
			$this->message->set ('Your coaching account has been set-up succesfully. Login with your credentials provided on previous page', 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Coaching account created', 'redirect'=>site_url('coaching/login/index/?sub='.$slug) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors () )));
		}
	}

	public function find_coaching () {

		$this->form_validation->set_rules ('search', 'Coaching Name', 'required|min_length[3]|trim', ['required'=>'Type in a few letters to search', 'min_length'=>'Type at-least first three letters of your coaching ']);

		if ($this->form_validation->run () == true) {
			$result = $this->coaching_model->find_coaching ();
			if (! empty($result)) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'We have found following coachings matching your search. Click on your coaching to enter', 'result'=>($result) )));
			} else {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'We have not found any coachings matching your search' )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}

}