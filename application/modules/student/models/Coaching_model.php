<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coaching_model extends CI_Model {
	
	public function get_coaching ($coaching_id=0) {
		$this->db->where ('coachings.id', $coaching_id);
		$this->db->from ('coachings');
		$sql = $this->db->get ();
		if  ($sql->num_rows () > 0 ) {
			$result = $sql->row_array ();
			return $result;
		} else { 
			return false;
		}
	}

	public function get_coaching_subscription ($coaching_id=0) {
		$this->db->select ('C.*, CS.starting_from, CS.ending_on, CS.created_by, SP.*, SP.id AS sp_id');
		$this->db->from ('coachings C, coaching_subscriptions CS, subscription_plans SP');
		$this->db->where('CS.coaching_id=C.id');
		$this->db->where('SP.id=CS.plan_id');
		$this->db->where ('CS.id', $coaching_id);
		$sql = $this->db->get ();
		if  ($sql->num_rows () > 0 ) {
			$result = $sql->row_array ();
			return $result;
		} else { 
			return false;
		}
	}

	public function get_coaching_by_slug ($coaching_slug='') {
		$this->db->where ('coaching_url', $coaching_slug);
		$this->db->from ('coachings');
		$sql = $this->db->get ();
		if  ($sql->num_rows () > 0 ) {
			$result = $sql->row_array ();
			return $result;
		} else {
			return false;
		}
	}

	public function get_coaching_by_uid ($coaching_uid=0) {
		$this->db->where ('reg_no', $coaching_uid);
		$sql = $this->db->get ('coachings');
		if  ($sql->num_rows () > 0 ) {
			$result = $sql->row_array ();
			return $result;
		} else { 
			return false;
		}
	}
}