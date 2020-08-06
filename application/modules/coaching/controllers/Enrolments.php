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
		$is_admin = USER_ROLE_COACHING_ADMIN === intval($this->session->userdata('role_id'));
		if($is_admin){
			$data['toolbar_buttons'] = $this->toolbar_buttons;
			$data['toolbar_buttons']['<i class="fa fa-plus"></i> New Batch'] = 'coaching/enrolments/create_batch/'.$coaching_id.'/'.$course_id;
		}
		$data["bc"] = array ( 'Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
		$data['is_admin'] = $is_admin;

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/batches', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);		
	}
	
	public function create_batch ($coaching_id=0, $course_id=0, $batch_id=0) {
		$data["page_title"] 	= "Create Batch";
		$data["coaching_id"] 	= $coaching_id;
		$data["course_id"] 		= $course_id;
		$data["batch_id"] 		= $batch_id;
		$is_admin = USER_ROLE_COACHING_ADMIN === intval($this->session->userdata('role_id'));
		$data['is_admin'] = $is_admin;
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['toolbar_buttons']['<i class="fa fa-plus"></i> New Batch'] = 'coaching/enrolments/create_batch/'.$coaching_id.'/'.$course_id;
		$data["bc"] = array ( 'Batches'=>'coaching/enrolments/batches/'.$coaching_id.'/'.$course_id);

		$data['batch'] = $this->enrolment_model->get_batch ($coaching_id, $course_id, $batch_id);

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/create_batch', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);		
	}
	
	
	public function batch_users ($coaching_id=0, $course_id=0, $batch_id=0, $add_users=0) {

		$this->load->model ('student/lessons_model', 'std_lm');

		$batch = $this->enrolment_model->get_batch ($coaching_id, $course_id, $batch_id);
		$data["coaching_id"] 	= $coaching_id;
		$data["batch_id"] 		= $batch_id;
		$data["course_id"] 		= $course_id;
		$data['add_users'] 		= $add_users;

		if ($batch_id > 0) {
			$data["page_title"]  	= 'Batch Users';
			$data["bc"] = array ( 'Batches'=>'coaching/enrolments/batches/'.$coaching_id.'/'.$course_id);
		} else {
			$data["page_title"]  	= 'Enroled Users';
			$data["bc"] = array ( 'Batches'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
		}

		$is_admin = USER_ROLE_COACHING_ADMIN === intval($this->session->userdata('role_id'));
		$data['is_admin'] = $is_admin;
		$data['toolbar_buttons'] = $this->toolbar_buttons;

		$users_not_in_batch = $this->enrolment_model->users_not_in_batch ($coaching_id, $course_id, $batch_id);
		if (! empty($users_not_in_batch)) {
		    $num_users_notin = count($users_not_in_batch);
		} else {
		    $num_users_notin = 0;
		}
		$data['num_users_notin'] = $num_users_notin;
		
		$bu = $this->enrolment_model->batch_users ($coaching_id, $course_id, $batch_id);
		$users_in_batch = [];
		if (! empty($bu)) {
		    $num_users_in = count($bu);
		    foreach ($bu as $users) {
		    	$users['progress'] = $this->enrolment_model->get_progress ($users['member_id'], $coaching_id, $course_id);
		    	$users_in_batch[] = $users;
		    }
		} else {
		    $num_users_in = 0;
		}
		$data['num_users_in'] = $num_users_in;
		
		
		if ($add_users == USER_ROLE_STUDENT) {
		    $result = $users_not_in_batch;	
		} else {
		    $result = $users_in_batch;
		}		
		$data['result'] = $result;
		
		$data['script'] = $this->load->view('users/scripts/batch_users', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/batch_users', $data); 
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	
	public function schedule ($coaching_id=0, $course_id=0, $batch_id=0, $start=0) {
		
		$data['page_title'] 	= 'Schedule';
		$data['coaching_id'] 	= $coaching_id;
		$data['course_id'] 		= $course_id;
		$data['batch_id'] 		= $batch_id;

		$data["bc"] = array ( 'Batches'=>'coaching/enrolments/batches/'.$coaching_id.'/'.$course_id);
		$is_admin = USER_ROLE_COACHING_ADMIN === intval($this->session->userdata('role_id'));
		$data['is_admin'] = $is_admin;
		if ($is_admin){
			$data['toolbar_buttons'] = $this->toolbar_buttons;
			//$data['toolbar_buttons']['<i class="fa fa-plus"></i> Create Schedule'] = 'coaching/enrolments/create_schedule/'.$coaching_id.'/'.$course_id.'/'.$batch_id;
		}

		$data['batch'] = $batch = $this->enrolment_model->get_batch ($coaching_id, $course_id, $batch_id);
		$data['classrooms'] = $this->coaching_model->get_classrooms ($coaching_id);
		$data['instructors'] = $this->enrolment_model->get_course_instructors ($coaching_id, $course_id);

		$schedule = [];
		$interval = 24 * 60 * 60; 		// 1 day in seconds
		if ($start == 0) {
			$start_date = $batch['start_date'];
		} else {
			$start_date = $start;
		}
		$count = 0;
		for ($i=$start_date; $i<=$batch['end_date']; $i=$i+$interval) {
			// get data for this date
			$scd = $this->enrolment_model->get_schedule_data ($coaching_id, $course_id, $batch_id, $i);		
			$schedule[$i] = $scd;
			$count++;
			if ($count >= 7) {
				break;
			}
		}

		$data['start_date'] = $start_date;
		$data['end_date'] = $batch['end_date'];
		$data['interval'] = $interval;
		$data['schedule'] = $schedule;

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/schedule', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

	public function create_schedule ($coaching_id=0, $course_id=0, $batch_id=0) {
		
		//$data['category'] = $this->courses_model->get_course_category_by_id($cat_id);
		$data['page_title'] = 'Create Schedule';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['batch_id'] = $batch_id;

		$data["bc"] = array ( 'Batches'=>'coaching/enrolments/schedule/'.$coaching_id.'/'.$course_id);

		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['toolbar_buttons']['<i class="fa fa-plus"></i> Create Schedule'] = 'coaching/enrolments/create_schedule/'.$coaching_id.'/'.$course_id.'/'.$batch_id;

		$data['batch'] = $batch = $this->enrolment_model->get_batch ($coaching_id, $course_id, $batch_id);
		$data['classrooms'] = $this->coaching_model->get_classrooms ($coaching_id, $course_id);
		$data['instructors'] = $this->enrolment_model->get_course_instructors ($coaching_id, $course_id);
		//$data['schedule'] = $schedule = $this->enrolment_model->get_course_schedule ($coaching_id, $course_id, $batch_id);	

		$schedule = [];
		$interval = 24 * 60 * 60; 		// 1 day in seconds
		for ($i=$batch['start_date']; $i<=$batch['end_date']; $i=$i+$interval) { 
			// get data for this date
			//$scd = $this->enrolment_model->get_schedule_data ($coaching_id, $course_id, $batch_id, $i);		
			//$schedule[$i] = $scd;
		}

		$data['schedule'] = $schedule;

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/create_schedule', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

}