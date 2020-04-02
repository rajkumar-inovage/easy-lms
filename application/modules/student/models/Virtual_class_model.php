<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Virtual_class_model extends CI_Model {

	public function get_class ($coaching_id=0, $class_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('class_id', $class_id);
		$sql = $this->db->get ('virtual_classroom');
		return $sql->row_array ();
	}

	public function join_class ($coaching_id=0, $class_id=0, $member_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('class_id', $class_id);
		$this->db->where ('member_id', $member_id);
		$sql = $this->db->get ('virtual_classroom_participants');
		return $sql->row_array ();
	}

	public function my_classroom ($coaching_id=0, $member_id=0) {
		$this->db->select ('VC.*, VCP.meeting_url, VCP.role');
		$this->db->from ('virtual_classroom VC');
		$this->db->join ('virtual_classroom_participants VCP', 'VC.class_id=VCP.class_id');
		$this->db->where ('VCP.coaching_id', $coaching_id);
		$this->db->where ('VCP.member_id', $member_id);
		$sql = $this->db->get ();
		return $sql->result_array ();
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

}