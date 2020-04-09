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
		
		$data['coaching_id'] = $coaching_id;
		$data['member_id'] = $member_id;
		$data['bc'] = array('Dashboard'=>'student/home/dashboard/'.$coaching_id);
		$data['class'] = $this->virtual_class_model->my_classroom ($coaching_id, $member_id);

        //$data['script'] = $this->load->view('attendance/scripts/index', $data, true);
        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/my_classroom', $data);
        $this->load->view(INCLUDE_PATH . 'footer', $data);		
	}

	
	public function create_meeting ($coaching_id=0, $class_id=0) {
		
		$api_setting = $this->virtual_class_model->get_api_settings ();

		$class = $this->virtual_class_model->get_class ($coaching_id, $class_id);
		// Create call and query
		$api_url = $api_setting['api_url'];
		$call_name = $class['call_name'];
		$query_string = $class['query_string'];
		$checksum = $class['checksum'];

		$final_string = $api_url . $call_name .'?'.  $query_string . '&checksum='.$checksum;
		
		// Upload whiteboard slide
		$post_slide = '
						<modules>
					     <module name="presentation">
					      <document url="https://easycoachingapp.com/apps/whiteboard.pdf"/>
					   </module>
					</modules>
					';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $final_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $post_slide);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
		$xml_response = curl_exec($ch);
		curl_close($ch);

		$xml = simplexml_load_string($xml_response);

		$returncode = $xml->returncode;
		return $returncode;

	}

	public function join_class ($coaching_id=0, $class_id=0, $member_id=0) {
		
		$api_setting = $this->virtual_class_model->get_api_settings ();
		$class = $this->virtual_class_model->get_class ($coaching_id, $class_id);
		$join = $this->virtual_class_model->join_class ($coaching_id, $class_id, $member_id);
		$join['meeting_url'];
		
		$api_url = $api_setting['api_url'];
		
		$is_running = $this->is_meeting_running ($coaching_id, $class_id);

		if ( $is_running == true) {
			redirect ($join['meeting_url']);
		} else {
			if ($join['role'] == VM_PARTICIPANT_MODERATOR)  {
				$response = $this->create_meeting ($coaching_id, $class_id);
				if ($response == 'SUCCESS') {
					redirect ($join['meeting_url']);
				}
			}
		}
		
		$data['coaching_id'] = $coaching_id;
		$data['class_id'] = $class_id;
		$data['page_title'] = 'Classroom not found';
		$data['bc'] = array('Virtual Classroom'=>'student/virtual_class/index/'.$coaching_id.'/'.$member_id);

        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/error', $data);
        $this->load->view(INCLUDE_PATH . 'footer', $data);		
	}	

	public function is_meeting_running ($coaching_id=0, $class_id=0) {

		$api_setting = $this->virtual_class_model->get_api_settings ();
		$class = $this->virtual_class_model->get_class ($coaching_id, $class_id);
		
		$api_url = $api_setting['api_url'];
		$call_name = 'isMeetingRunning';
		$query_string = 'meetingID='.$class['meeting_id'];

		$final_string = $api_url . $call_name .'?'.  $query_string;
		$checksum = sha1 ($final_string);
		$url = $final_string . '&checksum='.$checksum;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$xml_response = curl_exec($ch);
		curl_close($ch);
		$xml = simplexml_load_string($xml_response);
		$running = $xml->running;

		return $running;
	}
}