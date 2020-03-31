<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Virtual_class extends MX_Controller {	

	var $toolbar_buttons = [];

	public function __construct () {		
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['config_coaching'];
	    $models = ['virtual_class_model', 'users_model'];
	    $this->common_model->autoload_resources ($config, $models);

	    $this->load->helper ('string');

	    $cid = $this->uri->segment (4);
        $this->toolbar_buttons['<i class="fa fa-puzzle-piece"></i> Home']= 'coaching/virtual_class/index/'.$cid;
        $this->toolbar_buttons['<i class="fa fa-plus-circle"></i> Create Class']= 'coaching/virtual_class/create_class/'.$cid;
        
        // Security step to prevent unauthorized access through url
        if ($this->session->userdata ('is_admin') == TRUE) {
        } else {
            if ($this->session->userdata ('coaching_id') <> $cid) {
                $this->message->set ('Direct url access not allowed', 'danger', true);
                redirect ('coaching/home/dashboard');
            }
        }
	}

	public function index ($coaching_id=0) {
		
		$data['coaching_id'] = $coaching_id;
		$data['bc'] = array('Dashboard'=>'coaching/home/dashboard/'.$coaching_id);
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['class'] = $this->virtual_class_model->get_all_classes ($coaching_id);

        //$data['script'] = $this->load->view('attendance/scripts/index', $data, true);
        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/index', $data);
        $this->load->view(INCLUDE_PATH . 'footer', $data);		
	}

	public function create_class ($coaching_id=0, $class_id=0) {
		
		$data['coaching_id'] = $coaching_id;
		$data['class_id'] = $class_id;

		$data['bc'] = array('Dashboard'=>'coaching/home/dashboard/'.$coaching_id);
		$data['class'] = $this->virtual_class_model->get_class ($coaching_id, $class_id);
		$data['attendee_pwd'] = random_string ('numeric', 4);
		$data['moderator_pwd'] = random_string ('numeric', 4);

        //$data['script'] = $this->load->view('attendance/scripts/index', $data, true);

        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/create_class', $data);
        $this->load->view(INCLUDE_PATH . 'footer', $data);		
	}

	public function add_participants ($coaching_id=0, $class_id=0, $role_id=USER_ROLE_STUDENT, $batch_id=0) {
		
		$roles = [USER_ROLE_COACHING_ADMIN, USER_ROLE_TEACHER, USER_ROLE_STUDENT];

		if ($role_id <> USER_ROLE_STUDENT) {
			$batch_id = 0;
		}

		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['class'] = $this->virtual_class_model->get_class ($coaching_id, $class_id);
		$data['users'] = $this->users_model->get_users ($coaching_id, $role_id, USER_STATUS_ENABLED, $batch_id);
		$data['roles'] = $this->users_model->get_user_roles (0, 0, $roles);
		$data['batches'] = $this->users_model->get_batches ($coaching_id);

		$data['coaching_id'] = $coaching_id;
		$data['class_id'] = $class_id;
		$data['role_id'] = $role_id;
		$data['batch_id'] = $batch_id;
		$data['bc'] = array('Dashboard'=>'coaching/virtual_class/index/'.$coaching_id);

        //$data['script'] = $this->load->view('attendance/scripts/index', $data, true);
        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/add_participants', $data);
        $this->load->view(INCLUDE_PATH . 'footer', $data);		
	}

	public function participants ($coaching_id=0, $class_id=0) {		

		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['class'] = $this->virtual_class_model->get_class ($coaching_id, $class_id);
		$data['participants'] = $this->virtual_class_model->get_participants ($coaching_id, $class_id);

		$data['coaching_id'] = $coaching_id;
		$data['class_id'] = $class_id;
		$data['bc'] = array('Dashboard'=>'coaching/virtual_class/index/'.$coaching_id);

        //$data['script'] = $this->load->view('attendance/scripts/index', $data, true);
        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/participants', $data);
        $this->load->view(INCLUDE_PATH . 'footer', $data);		
	}


	public function class_details ($coaching_id=0, $class_id=0) {		

		$data['coaching_id'] = $coaching_id;
		$data['class_id'] = $class_id;
		$data['bc'] = array('Dashboard'=>'coaching/virtual_class/index/'.$coaching_id);

		$member_id = $this->session->userdata ('member_id');
		$user = $this->users_model->get_user ($member_id);
		$fullName = $user['first_name'];
		$class = $this->virtual_class_model->get_class ($coaching_id, $class_id);

		$api_setting = $this->virtual_class_model->get_api_settings ();
		$shared_secret = $api_setting['shared_secret'];

		$call_name = 'join';

		$query_string = '';
		$query_string .= 'fullName='.$fullName;
		$query_string .= '&meetingID='.$class['meeting_id'];
		$query_string .= '&password='.$class['moderator_pwd'];
		$query_string .= '&userID='.$user['adm_no'];

		$final_string = $call_name . $query_string . $shared_secret;

		$checksum = sha1 ($final_string);

		$meeting_url = '';
		$meeting_url .= $api_setting['api_url'];
		$meeting_url .= $call_name;
		$meeting_url .= '?';
		$meeting_url .= $query_string;
		$meeting_url .= '&checksum='.$checksum;

		$data['class'] = $class;
		$data['meeting_url'] = $meeting_url;
		$data['api_setting'] = $api_setting;

        $data['script'] = $this->load->view('virtual_class/scripts/create_class', $data, true);
        $this->load->view(INCLUDE_PATH . 'header', $data);
        $this->load->view('virtual_class/class_details', $data);
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
				redirect ($join['meeting_url']);
			}	
		}
	}

}