<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enrolments extends MX_Controller {

	var $toolbar_buttons = [];

	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model', 'lessons_model', 'users_model', 'enrolment_model'];
		$this->common_model->autoload_resources($config, $models);
	}

	public function enrolments ($coaching_id=0, $course_id=0) {
		
	}

	/*
	 * Batches
	*/
	public function batches ($coaching_id=0, $course_id=0) {
		$data["page_title"] 	= "Batches";
		$data["coaching_id"] 	= $coaching_id;
		$data["course_id"] 		= $course_id;
		$result = [];
		$all_batches 			= $this->enrolment_model->get_batches ($coaching_id, $course_id);
		if (! empty ($all_batches)) {
			foreach ($all_batches as $row) {
				$bu = $this->enrolment_model->batch_users ($coaching_id, $row['batch_id']);
				if (! empty ($bu)) {
					$num_users = count ($bu);
				} else {
					$num_users = 0;
				}
				$row['num_users'] = $num_users;
				$result[] = $row;
			}
		}
		
		$data['all_batches'] = $result;

		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['toolbar_buttons']['<i class="fa fa-plus"></i> New Batch'] = 'coaching/enrolments/create_batch/'.$coaching_id.'/'.$course_id;
		$data["bc"] = array ( 'Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/batches', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);		
	}
	
	public function create_batch ($coaching_id=0, $course_id=0, $batch_id=0) {
		$data["page_title"] 	= "Create Batch";
		$data["coaching_id"] 	= $coaching_id;
		$data["course_id"] 		= $course_id;
		$data["batch_id"] 		= $batch_id;
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['toolbar_buttons']['<i class="fa fa-plus"></i> New Batch'] = 'coaching/enrolments/create_batch/'.$coaching_id.'/'.$course_id;
		$data["bc"] = array ( 'Batches'=>'coaching/enrolments/batches/'.$coaching_id.'/'.$course_id);

		$data['batch'] = $this->enrolment_model->get_batch ($coaching_id, $course_id, $batch_id);

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/create_batch', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);		
	}
	
	
	public function batch_users ($coaching_id=0, $course_id=0, $batch_id=0, $add_users=0) {
		$batch = $this->enrolment_model->get_batch ($coaching_id, $course_id, $batch_id);
		$data["page_title"]  	= 'Batch Users';
		$data["coaching_id"] 	= $coaching_id;
		$data["batch_id"] 		= $batch_id;
		$data["course_id"] 		= $course_id;
		$data['add_users'] 		= $add_users;
		$data["bc"] = array ( 'Batches'=>'coaching/enrolments/batches/'.$coaching_id.'/'.$course_id);
		$data['toolbar_buttons'] = $this->toolbar_buttons;

		$users_not_in_batch = $this->enrolment_model->users_not_in_batch ($coaching_id, $batch_id);
		if (! empty($users_not_in_batch)) {
		    $num_users_notin = count($users_not_in_batch);
		} else {
		    $num_users_notin = 0;
		}
		$data['num_users_notin'] = $num_users_notin;
		
		$bu = $this->enrolment_model->batch_users ($coaching_id, $batch_id);
		if (! empty($bu)) {
		    $num_users_in = count($bu);
		} else {
		    $num_users_in = 0;
		}
		$data['num_users_in'] = $num_users_in;
		
		$teachers = $this->courses_model->get_teachers_assigned ($coaching_id, $course_id);
		if (! empty ($teachers)) {
			$num_teachers = count ($teachers);
		} else {
			$num_teachers = 0;
		}

		if ($add_users == USER_ROLE_STUDENT) {
		    $result = $users_not_in_batch;
		} else if ($add_users == USER_ROLE_TEACHER) {
		    $result = $teachers;
		} else {
		    $result = $bu;
		}		
		$data['result'] = $result;

		$data['teachers'] = $teachers;
		$data['num_teachers'] = $num_teachers;

		$data['script'] = $this->load->view('users/scripts/batch_users', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/batch_users', $data); 
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