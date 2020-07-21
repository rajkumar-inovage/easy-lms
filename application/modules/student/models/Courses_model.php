<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		// echo $this->db->last_query();
	}
	public function get_users_batch_courses($coaching_id, $member_id){
		$this->db->select('course_id');
		$this->db->from('coaching_course_batch_users');
		$this->db->where('coaching_id', $coaching_id);
		$this->db->where ('member_id', $member_id);
		$sub_query = $this->db->get_compiled_select();

		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ("course_id IN ($sub_query)");
		$sql = $this->db->get ('coaching_courses');
		$courses = $sql->result_array();
		foreach ($courses as $i => $course) {
			$this->db->select('first_name, last_name');
			$this->db->where ('member_id', $course['created_by']);
			$users = $this->db->get ('members');
			$created_by = $users->row_array();
			$courses[$i]['created_by'] = $created_by['first_name'] . " " . $created_by['last_name'];
		}
		return $courses;
	}
}