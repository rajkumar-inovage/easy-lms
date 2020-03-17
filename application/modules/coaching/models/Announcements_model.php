<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcements_model extends CI_Model {
 public function __construct() {
		parent::__construct();
	} 

	public function get_announcement ($coaching_id=0,$announcement_id=0) {
		$this->db->where ('announcement_id', $announcement_id);
		$this->db->where ('coaching_id', $coaching_id);
		return $this->db->get ("coaching_announcements")->row_array();
	}
	public function get_announcements () {

		return $this->db->get ("coaching_announcements")->result_array();
		return $announcements;
	}

	//=========== Model for Create/Edit tests =======================
	public function create_announcement ($coaching_id,$title, $description, $start_date, $end_date, $status, $created_by) {
		$query="insert into pwa_coaching_announcements values('$coaching_id',$title','$description','$start_date','$end_date','$status','$created_by')";
		$this->db->query($query);
	}
	
}
	

	 
	