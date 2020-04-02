<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Virtual_class extends MX_Controller {	

	var $toolbar_buttons = [];

	public function __construct () {		
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['config_student'];
	    $models = ['virtual_class_model', 'users_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}

	public function index ($coaching_id=0, $member_id=0) {
		$this->my_classroom ($coaching_id, $member_id);
	}

	public function my_classroom ($coaching_id=0, $member_id=0) {
		
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
		$api_setting = $this->virtual_class_model->get_api_settings ();

		$class = $this->virtual_class_model->get_class ($coaching_id, $class_id);
		$join = $this->virtual_class_model->join_class ($coaching_id, $class_id, $member_id);


		$call_name = $class['call_name'];
		$query_string = $class['query_string'];
		$checksum = $class['checksum'];
		$api_url = $api_setting['api_url'];

		$final_string = $api_url . $call_name .'?'.  $query_string . '&checksum='.$checksum;

		if ($join['role'] == VM_PARTICIPANT_MODERATOR) {
			// Create room before joining
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $final_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$xml_response = curl_exec($ch);
			curl_close($ch);

			$xml = simplexml_load_string($xml_response);

			$returncode = $xml->returncode;

			if ($returncode == 'SUCCESS') {
			}
		} else {
			redirect ($join['meeting_url']);
		}
			$data['page_title'] = 'Join Classroom';
			$this->load->view(INCLUDE_PATH . 'header', $data);
		    $this->load->view('virtual_class/classroom_error', $data);
		    $this->load->view(INCLUDE_PATH . 'footer', $data);	
	}

}