<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Virtual_class extends MX_Controller {	

	var $toolbar_buttons = [];

	public function __construct () {		
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['config_student', 'config_virtual_class'];
	    $models = ['virtual_class_model', 'users_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}

	public function index ($coaching_id=0, $member_id=0) {
		$this->my_classroom ($coaching_id, $member_id);
	}

	public function my_classroom ($coaching_id=0, $member_id=0) {
		
		if ($coaching_id == 0) {
			$coaching_id = $this->session->userdata ('coaching_id');
		}
		
		if ($member_id == 0) {
			$member_id = $this->session->userdata ('member_id');
		}

		$data['coaching_id'] = $coaching_id;
		$data['member_id'] = $member_id;
		$data['bc'] = array('Dashboard'=>'student/home/dashboard/'.$coaching_id);
		$data['class'] = $this->virtual_class_model->my_classroom ($coaching_id, $member_id);

        //$data['script'] = $this->load->view('attendance/scripts/index', $data, true);
        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/my_classroom', $data);
        $this->load->view(INCLUDE_PATH . 'footer', $data);		
	}	

	public function join_class ($coaching_id=0, $class_id=0, $member_id=0) {
		
		$api_setting = $this->virtual_class_model->get_api_settings ('join_url');
		$class = $this->virtual_class_model->get_class ($coaching_id, $class_id);
		$join = $this->virtual_class_model->join_class ($coaching_id, $class_id, $member_id);
		$meeting_url = $join['meeting_url'];
		$api_join_url = $api_setting['join_url'];
		$join_url = $api_join_url . $meeting_url;
		
		$is_running = $this->virtual_class_model->is_meeting_running ($coaching_id, $class_id);

		if ( $is_running == 'true') {
			redirect ($join_url);
		} else {
			if ($join['role'] == VM_PARTICIPANT_MODERATOR)  {
				$response = $this->virtual_class_model->create_meeting ($coaching_id, $class_id);
				if ($response == 'SUCCESS') {
					redirect ($join_url);
				}
			}
		}

		$data['coaching_id'] = $coaching_id;
		$data['class_id'] = $class_id;
		$data['page_title'] = 'Classroom Not Started';
		$data['bc'] = array('Virtual Classroom'=>'student/virtual_class/index/'.$coaching_id.'/'.$member_id);

        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/error', $data);
        $this->load->view(INCLUDE_PATH . 'footer', $data);		
	}	

	public function end_meeting ($coaching_id=0, $class_id=0) {
		redirect ('student/virtual_class/index/'.$coaching_id);
	}
}