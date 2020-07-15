<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plans_model extends CI_Model {
	
	/* Test Plan Categories */
	public function coaching_test_plans ($coaching_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$sql = $this->db->get ('coaching_test_plans');
		return $sql->result_array ();
	}


	/* Test Plan Categories */
	public function coaching_lesson_plans ($coaching_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$sql = $this->db->get ('coaching_lesson_plans');
		return $sql->result_array ();
	}


}