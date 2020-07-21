<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Enrolment_actions extends MX_Controller {
	
    var $toolbar_buttons = []; 

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['config_coaching'];
	    $models = ['coaching_model', 'enrolment_model' , 'enrolment_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}
	
	
	public function create_batch ($coaching_id=0, $course_id=0, $batch_id=0) {
		
		$this->form_validation->set_rules ('batch_name', 'Batch Name', 'required|min_length[3]|max_length[100]');
		
		if ( $this->form_validation->run() == true)  {
			if ($batch_id > 0) {
				$message = "Batch updated successfully.";
			} else {
				$message = "Batch created successfully.";
			}
			$this->enrolment_model->create_batch ($coaching_id, $course_id, $batch_id);
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url('coaching/enrolments/batches/'.$coaching_id.'/'.$course_id) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
		
	} 
	
	public function get_batch_users ($coaching_id=0, $batch_id=0) {
		$all_users = array ();
		$batch_users = array ();
		$as = $this->enrolment_model->get_users ($coaching_id, USER_ROLE_STUDENT);
		$bs = $this->enrolment_model->batch_users ($batch_id);
		if ( ! empty ($as) ) {
			foreach ($as as $a) {
				$all_users[] = $a['member_id'];
			}
		}
		if ( ! empty ($bs) ) {
			foreach ($bs as $a) {
				$batch_users[] = $a['member_id'];
			}
		}
		$result = array_diff($all_users, $batch_users);
		$data['result'] = $result;
		$data['batch_id'] = $batch_id;
		$data['coaching_id'] = $coaching_id;
	}
	
	
	public function save_batch_users ($coaching_id=0, $batch_id=0) {
		
		$this->form_validation->set_rules ('users[]', 'Users', 'required');
		if ($this->form_validation->run () == true) {
			$this->enrolment_model->save_batch_users ($batch_id);			
			$message = 'User(s) added to batch successfully';
			$this->message->set ($message, 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url('coaching/users/batch_users/'.$coaching_id.'/'.$batch_id.'/1') )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors () )));
		}
	}
	
	public function remove_batch_users ($coaching_id=0, $batch_id=0, $member_id=0, $add_user=0) {
		
		$this->form_validation->set_rules ('users[]', 'Users', 'required');
		if ($this->form_validation->run () == true) {
			$users = $this->input->post ('users');
			foreach ($users as $member_id) {
				$this->enrolment_model->remove_batch_user ($batch_id, $member_id);
			}
		} else {
			$this->enrolment_model->remove_batch_user ($batch_id, $member_id);			
		}
		$this->message->set ('User(s) removed from batch successfully', 'success', true);
		redirect ('coaching/users/batch_users/'.$coaching_id.'/'.$batch_id.'/'.$add_user);
	}
	

	public function remove_batch_user ($coaching_id=0, $batch_id=0, $member_id=0, $add_user=0) {
		$this->enrolment_model->remove_batch_user ($batch_id, $member_id);
		$this->message->set ('User removed from batch successfully', 'success', true);
		redirect ('coaching/users/batch_users/'.$coaching_id.'/'.$batch_id.'/'.$add_user);
	}
	
	public function delete_batch ($coaching_id=0, $batch_id=0) {
		$this->enrolment_model->delete_batch ($batch_id);
		redirect ('coaching/users/batches/'.$coaching_id);
	}	

}