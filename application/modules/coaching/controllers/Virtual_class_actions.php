<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Virtual_class_actions extends MX_Controller {	

	var $toolbar_buttons = [];

	public function __construct () {		
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['config_coaching', 'config_virtual_class'];
	    $models = ['virtual_class_model'];
	    $this->common_model->autoload_resources ($config, $models);
	    $this->load->helper ('string');

	    $cid = $this->uri->segment (4);
	}

	public function create_classroom ($coaching_id=0, $class_id=0) {
		$this->form_validation->set_rules ('class_name', 'Virtual Classroom Name', 'required|alpha_numeric|trim');
		$this->form_validation->set_rules ('moderator_pwd', 'Moderator Password', 'required|numeric|trim');
		$this->form_validation->set_rules ('attendee_pwd', 'Attendee Password', 'required|numeric|trim');
		$this->form_validation->set_rules ('welcome_message', 'Welcome Message', 'max_length[100]|trim');
		$this->form_validation->set_rules ('max_participants', 'Max Participants', 'greater_than_equal_to[1]|less_than_equal_to['.VC_MAX_PARTICIPANTS.']');
		$this->form_validation->set_rules ('duration', 'Class Duration', 'greater_than_equal_to[1]|less_than_equal_to['.VC_DURATION.']');

		if ($this->form_validation->run () == true) {
			$id = $this->virtual_class_model->create_classroom ($coaching_id, $class_id);
			if ($id > 0) {
				$this->message->set ('Classroom created successfully', 'success', true);
				$this->output->set_content_type("application/json");
		        $this->output->set_output(json_encode(array('status'=>true, 'message'=>'Virtual classroom created successfully. Now add participants to this classroom', 'redirect'=>site_url ('coaching/virtual_class/index/'.$coaching_id.'/'.$id ) )));
			} else {
				$this->output->set_content_type("application/json");
		        $this->output->set_output(json_encode(array('status'=>false, 'error'=>'Error creating classroom.' )));
			}
		} else {
			$this->output->set_content_type("application/json");
	        $this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}

	public function delete_class ($coaching_id=0, $class_id=0) {
		$this->virtual_class_model->delete_class ($coaching_id, $class_id);
		$this->message->set ('Classroom deleted successfully', 'success', true);
		redirect ('coaching/virtual_class/index/'.$coaching_id.'/'.$class_id);
	}


	public function add_participants ($coaching_id=0, $class_id=0) {
		$this->form_validation->set_rules ('users[]', 'User', 'required', ['required'=>'You have not selected any %s']);

		if ($this->form_validation->run () == true) {
			$this->virtual_class_model->add_participants ($coaching_id, $class_id);
			$this->message->set ('Participants added successfully', 'success', true);
			$this->output->set_content_type("application/json");
	        $this->output->set_output(json_encode(array('status'=>true, 'message'=>'Participants added successfully', 'redirect'=>site_url ('coaching/virtual_class/add_participants/'.$coaching_id.'/'.$class_id ) )));
		} else {
			$this->output->set_content_type("application/json");
	        $this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}

	public function remove_participants ($coaching_id=0, $class_id=0) {
		$this->form_validation->set_rules ('users[]', 'User', 'required', ['required'=>'You have not selected any %s']);

		if ($this->form_validation->run () == true) {
			$this->virtual_class_model->remove_participants ($coaching_id, $class_id);
			$this->message->set ('Participants removed successfully', 'success', true);
			$this->output->set_content_type("application/json");
	        $this->output->set_output(json_encode(array('status'=>true, 'message'=>'Participants removed successfully', 'redirect'=>site_url ('coaching/virtual_class/participants/'.$coaching_id.'/'.$class_id ) )));
		} else {
			$this->output->set_content_type("application/json");
	        $this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}



}