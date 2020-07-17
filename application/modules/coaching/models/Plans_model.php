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


	public function test_plan_added ($coaching_id=0, $plan_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('plan_id', $plan_id);
		$sql = $this->db->get ('coaching_test_plans');
		return $sql->row_array ();
	}

	public function lesson_plan_added ($coaching_id=0, $plan_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('plan_id', $plan_id);
		$sql = $this->db->get ('coaching_lesson_plans');
		return $sql->row_array ();
	}

	public function test_in_courses ($coaching_id=0, $test_id=0) {
		$this->db->select ('C.title, C.course_id');
		$this->db->from ('coaching_tests CT');
		$this->db->join ('coaching_courses C', 'CT.course_id=C.course_id');
		$this->db->where ('CT.coaching_id', $coaching_id);
		$this->db->where ('CT.unique_test_id', $test_id);
		$sql = $this->db->get ();
		return $sql->result_array ();
	}

	public function lesson_in_courses ($coaching_id=0, $lesson_key=0) {
		$this->db->select ('C.title, C.course_id');
		$this->db->from ('coaching_course_lessons CT');
		$this->db->join ('coaching_courses C', 'CT.course_id=C.course_id');
		$this->db->where ('CT.coaching_id', $coaching_id);
		$this->db->where ('CT.lesson_key', $lesson_key);
		$sql = $this->db->get ();
		return $sql->result_array ();
	}

}