<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Virtual_class_model extends CI_Model {

	public function get_all_classes ($coaching_id=0, $class_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$sql = $this->db->get ('virtual_classroom');
		return $sql->result_array ();
	}

	public function get_class ($coaching_id=0, $class_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('class_id', $class_id);
		$sql = $this->db->get ('virtual_classroom');
		return $sql->row_array ();
	}

	public function create_classroom ($coaching_id=0, $class_id=0) {
		
		if ($this->session->userdata ('site_title')) {
			$site_title = $this->session->userdata ('site_title');
		} else {
			$site_title = 'Live Classroom';
		}

		$class_name = $this->input->post ('class_name');
		$attendee_pwd = $this->input->post ('attendee_pwd');
		$moderator_pwd = $this->input->post ('moderator_pwd');
		$wait_for_moderator = $this->input->post ('wait_for_moderator');

		if ($this->input->post ('record_class')) {
			$record_class = 'true';
		} else {
			$record_class = 'false';			
		}
		
		if ($this->input->post ('welcome_message')) {
			$welcome_message = $this->input->post ('welcome_message');
		} else {
			$welcome_message = VC_WELCOME_MESSAGE . $site_title;			
		}
		$welcome_message = str_replace(' ', '+', $welcome_message);

		$start_date = $this->input->post ('start_date');
		list ($sy, $sm, $sd) = explode ("-", $start_date);
		$shh = $this->input->post ('start_time_hh');
		$smm = $this->input->post ('start_time_mm');
		$start_date = mktime ($shh, $smm, 0, $sm, $sd, $sy);

		$end_date = $this->input->post ('end_date');
		list ($ey, $em, $ed) = explode ("-", $end_date);
		$ehh = $this->input->post ('end_time_hh');
		$emm = $this->input->post ('end_time_mm');
		$end_date = mktime ($ehh, $emm, 0, $em, $ed, $ey);
				
		$record_description = $this->input->post ('record_description');
		if ($this->input->post ('max_participants')) {
			$max_participants = $this->input->post ('max_participants');
		} else {
			$max_participants = VC_MAX_PARTICIPANTS;
		}

		if ($this->input->post ('duration')) {
			$duration = $this->input->post ('duration');
		} else {
			$duration = VC_DURATION;
		}

		if ($this->session->userdata ('site_title')) {
			$bannerText = $this->session->userdata ('site_title');
		} else {
			$bannerText = VC_BANNER_TEXT;			
		}
		$bannerText = str_replace(' ', '+', $bannerText);

		$logoutURL = VC_LOGOUT_URL . '/' . $coaching_id;

		$meeting_id = $this->get_meeting_id ($coaching_id, $class_id);

		$api_setting = $this->get_api_settings ();
		$shared_secret = $api_setting['shared_secret'];

		$call_name = 'create';
		$query_string = '';
		$query_string .= 'name='.$class_name;
		$query_string .= '&meetingID='.$meeting_id;
		$query_string .= '&moderatorPW='.$moderator_pwd;
		$query_string .= '&attendeePW='.$attendee_pwd;
		$query_string .= '&welcome='.$welcome_message;
		$query_string .= '&record='.$record_class;
		$query_string .= '&duration='.$duration;
		$query_string .= '&maxParticipants='.$max_participants;
		$query_string .= '&logoutURL='.urlencode($logoutURL);
		$query_string .= '&bannerText='.$bannerText;
		$query_string .= '&muteOnStart=true';
		$query_string .= '&allowModsToUnmuteUsers=true';
		//$query_string .= '&logo='.VC_LOGO;

		$final_string = $call_name . $query_string . $shared_secret;

		$checksum = sha1 ($final_string);

		// Prepare for database
		$data['meeting_id'] 		= $meeting_id;
		$data['class_name'] 		= $class_name;
		$data['welcome_message']	= $welcome_message;
		$data['attendee_pwd'] 		= $attendee_pwd;
		$data['moderator_pwd'] 		= $moderator_pwd;
		$data['wait_for_moderator'] = $wait_for_moderator;
		$data['record_class'] 		= $record_class;
		$data['record_description'] = $record_description;
		$data['start_date'] 		= $start_date;
		$data['end_date'] 			= $end_date;
		$data['max_participants'] 	= $max_participants;
		$data['duration'] 			= $duration;
		$data['call_name'] 			= $call_name;
		$data['query_string'] 		= $query_string;
		$data['checksum'] 			= $checksum;		

		$data['coaching_id'] 		= $coaching_id;
		$data['created_by'] 		= $this->session->userdata ('member_id');
		$data['creation_date'] 		= time ();

		if ($class_id == 0) {
			$sql = $this->db->insert ('virtual_classroom', $data);
			$class_id = $this->db->insert_id ();
			$member_id = $this->session->userdata ('member_id');
			$this->add_moderator ($coaching_id, $class_id, $member_id);
		}
		return $class_id;
	}


	public function add_moderator ($coaching_id=0, $class_id=0, $member_id=0) {
		
		$user = $this->users_model->get_user ($member_id);
		$class = $this->get_class ($coaching_id, $class_id);

		$api_setting = $this->get_api_settings ();
		$shared_secret = $api_setting['shared_secret'];
		$password = $class['moderator_pwd'];
	
		$call_name = 'join';

		$participant_role = VM_PARTICIPANT_MODERATOR;

		$fullName = $user['first_name'] . ' ' . $user['last_name'] . '(Classroom Admin)';
		$fullName = str_replace(' ', '+', $fullName);
 
		$query_string = '';
		$query_string .= 'fullName='.$fullName;
		$query_string .= '&meetingID='.$class['meeting_id'];
		$query_string .= '&password='.$password;
		$query_string .= '&userID='.$member_id;

		$final_string = $call_name . $query_string . $shared_secret;
		$checksum = sha1 ($final_string);

		$meeting_url = '';
		$meeting_url .= $api_setting['api_url'];
		$meeting_url .= $call_name;
		$meeting_url .= '?';
		$meeting_url .= $query_string;
		$meeting_url .= '&checksum='.$checksum;

		$data = [];
		$data['coaching_id'] = $coaching_id;
		$data['class_id'] = $class_id;
		$data['member_id'] = $member_id;
		$data['role'] = $participant_role;
		$data['meeting_url'] = $meeting_url;
		// Insert only when not already inserted
		$this->db->where ($data);
		$sql = $this->db->get ('virtual_classroom_participants');
		if ($sql->num_rows () == 0) {
			$this->db->insert ('virtual_classroom_participants', $data);
		}

	}

	public function add_participants ($coaching_id=0, $class_id=0) {

		$class = $this->get_class ($coaching_id, $class_id);

		$api_setting = $this->get_api_settings ();
		$shared_secret = $api_setting['shared_secret'];
	
		$call_name = 'join';

		$participant_role = $this->input->post ('participant_role');
		if ($participant_role == VM_PARTICIPANT_MODERATOR) {
			$password = $class['moderator_pwd'];
		} else {
			$password = $class['attendee_pwd'];
		}

		$users = $this->input->post ('users');
		
		if (empty ($users)) {
			// Add creating user as moderator
			$admin_id = $this->session->userdata ('member_id');
			$admin_name = 'Classroom+Admin';
			$users[$admin_id] = $admin_name;
			$participant_role = VM_PARTICIPANT_MODERATOR;
		}

		foreach ($users as $member_id=>$fullName) {
			$query_string = '';
			$query_string .= 'fullName='.$fullName;
			$query_string .= '&meetingID='.$class['meeting_id'];
			$query_string .= '&password='.$password;
			$query_string .= '&userID='.$member_id;

			$final_string = $call_name . $query_string . $shared_secret;
			$checksum = sha1 ($final_string);
	
			$meeting_url = '';
			$meeting_url .= $api_setting['api_url'];
			$meeting_url .= $call_name;
			$meeting_url .= '?';
			$meeting_url .= $query_string;
			$meeting_url .= '&checksum='.$checksum;

			$data = [];
			$data['coaching_id'] = $coaching_id;
			$data['class_id'] = $class_id;
			$data['member_id'] = $member_id;
			$data['role'] = $participant_role;
			$data['meeting_url'] = $meeting_url;
			// Insert only when not already inserted
			$this->db->where ($data);
			$sql = $this->db->get ('virtual_classroom_participants');
			if ($sql->num_rows () == 0) {
				$this->db->insert ('virtual_classroom_participants', $data);
			}
		}
	}


	public function remove_participants ($coaching_id=0, $class_id=0) {
		$users = $this->input->post ('users');
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('class_id', $class_id);
		$this->db->where_in ('member_id', $users);
		$this->db->delete ('virtual_classroom_participants');
	}

	public function get_participants ($coaching_id=0, $class_id=0) {
		$this->db->select ('M.*, VCP.meeting_url, VCP.role');
		$this->db->from ('members M');
		$this->db->join ('virtual_classroom_participants VCP', 'M.member_id=VCP.member_id');
		$this->db->where ('VCP.coaching_id', $coaching_id);
		$this->db->where ('VCP.class_id', $class_id);
		$sql = $this->db->get ();
		return $sql->result_array ();
	}

	public function participants_added ($coaching_id=0, $class_id=0, $member_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('class_id', $class_id);
		$this->db->where ('member_id', $member_id);
		$sql = $this->db->get ('virtual_classroom_participants');
		return $sql->num_rows ();
	}

	public function delete_class ($coaching_id=0, $class_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('class_id', $class_id);
		$sql = $this->db->delete ('virtual_classroom_participants');

		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('class_id', $class_id);
		$sql = $this->db->delete ('virtual_classroom');
	}

	public function join_class ($coaching_id=0, $class_id=0, $member_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('class_id', $class_id);
		$this->db->where ('member_id', $member_id);
		$sql = $this->db->get ('virtual_classroom_participants');
		return $sql->row_array ();
	}

	public function get_api_settings ($param_name='') {
		$output = [];
		if ($param_name != '') {
			$this->db->where ('param_name', $param_name);
		}
		$sql = $this->db->get ('bigbluebutton_settings');
		if ($param_name != '') {
			$row = $sql->row_array ();
			$output[$row['param_name']] = $row['param_val'];
		} else {			
			foreach ($sql->result_array () as $row) {
				$output[$row['param_name']] = $row['param_val'];
			}
		}
		return $output;
	}

	public function get_api_details ($call_name='') {
		$this->db->where ('call_name', $call_name);
		$sql = $this->db->get ('bigbluebutton_api');
		return $sql->row_array ();
	}

	public function get_meeting_id ($coaching_id=0, $class_id=0) {
		if ($class_id > 0) {
			$this->db->where ('coaching_id', $coaching_id);
			$this->db->where ('class_id', $class_id);
			$sql = $this->db->get ('virtual_classroom');
			$row = $sql->row_array();
			return $row['meeting_id'];
		} else {
			$member_id = $this->session->userdata ('member_id');
			$meeting_id = random_string('alnum', 6) . $member_id;
			return $meeting_id;
		}

	}
}