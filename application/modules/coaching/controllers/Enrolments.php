<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enrolments extends MX_Controller {

	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model', 'lessons_model', 'users_model'];
		$this->common_model->autoload_resources($config, $models);
	}

	public function enrolments ($coaching_id=0, $course_id=0) {
		
	}

	/*
	 * Batches
	*/
	public function batches ($coaching_id=0, $course_id=0, $batch_id=0) {
		$data["page_title"] 	= "Batches";
		$data["coaching_id"] 	= $coaching_id;
		$data["course_id"] 		= $course_id;
		$data["batch_id"] 		= $batch_id;
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['toolbar_buttons']['<i class="fa fa-plus"></i> New Batch'] = 'coaching/users/create_batch/'.$coaching_id;
		$data["bc"] = array ( 'Users'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id );
		$data['all_batches'] = $this->users_model->get_batches ($coaching_id);

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('users/batches', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);		
	}
	
	public function create_batch ($coaching_id=0, $batch_id=0) {
		$data["page_title"] = "Create Batch";
		$data["sub_title"] = "Create New Batch";
		$data["batch_id"] = $batch_id;
		$data["coaching_id"] = $coaching_id;
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['toolbar_buttons']['<i class="fa fa-plus"></i> New Batch'] = 'coaching/users/create_batch/'.$coaching_id;
		$data["bc"] = array ( 'Batches'=>'coaching/users/batches/'.$coaching_id );
		$data['batch'] = $this->users_model->get_batch_details ($batch_id);
        if ($data['batch']) {
            $data['sub_title'] = 'Edit Batch: ' . $data['batch']['batch_name'];
        }
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('users/batch_create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);		
	}
	
	
	public function batch_users ($coaching_id=0, $batch_id=0, $add_users=0) {
		$batch = $this->users_model->get_member_batches ($batch_id);
		if ( ! empty ($batch)) {
			$batch_title = $batch['batch_name'];
		} else {
			$batch_title = 'Batch Users';
		}
		$data["page_title"]  = 'Batch Users';
		$data["sub_title"] = "Users in ";
        if ($batch) {
            $data['sub_title'] .= $batch['batch_name'];
        }
		$data["batch_title"] = $batch_title;
		$data["batch_id"] = $batch_id;
		$data["coaching_id"] = $coaching_id;
		$data['add_users'] = $add_users;
		$data["bc"] = array ( 'Batches'=>'coaching/users/batches/'.$coaching_id);
		$data['toolbar_buttons'] = $this->toolbar_buttons;

		$users_not_in_batch = $this->users_model->users_not_in_batch ($batch_id, $coaching_id);
		if (! empty($users_not_in_batch)) {
		    $num_users_notin = count($users_not_in_batch);
		} else {
		    $num_users_notin = 0;
		}
		$data['num_users_notin'] = $num_users_notin;
		
		$users_in_batch = $this->users_model->batch_users ($batch_id);
		if (! empty($users_in_batch)) {
		    $num_users_in = count($users_in_batch);
		} else {
		    $num_users_in = 0;
		}
		$data['num_users_in'] = $num_users_in;
		
		if ($add_users > 0) {
		    $result = $users_not_in_batch;
		} else {
		    $result = $users_in_batch;
		}
		
		$data['result'] = $result;

		$data['script'] = $this->load->view('users/scripts/batch_users', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('users/batch_users', $data); 
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	
	public function create_schedule ($coaching_id=0, $course_id=0) {
		
		//$data['category'] = $this->courses_model->get_course_category_by_id($cat_id);
		$data['page_title'] = 'Create Schedule';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/create_schedule', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

}