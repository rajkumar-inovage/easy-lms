<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcements_model extends CI_Model {
 public function __construct() {
		parent::__construct();
	} 

	
	public function get_announcements ($coaching_id=0,$status=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('status', 1);

		return $this->db->get ("coaching_announcements")->result_array();
		
	}

	
	
}
	

	 
	