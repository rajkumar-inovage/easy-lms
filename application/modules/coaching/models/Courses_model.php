<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		// echo $this->db->last_query();
	}
	public function course_categories($coaching_id, $status = CATEGORY_STATUS_ACTIVE){
		$this->db->where('coaching_id', $coaching_id);
		$this->db->where('status', $status);
		$sql = $this->db->get('coaching_course_category');
		return $sql->result_array();
	}
	public function courses($coaching_id, $cat_id, $status = CATEGORY_STATUS_ACTIVE){
		$this->db->where('coaching_id', $coaching_id);
		if($cat_id>0){
			$this->db->where('cat_id', $cat_id);
		}
		$this->db->where('status', $status);
		$sql = $this->db->get('coaching_courses');
		$courses = $sql->result_array();
		foreach ($courses as $i => $course) {
			$created_by = $this->users_model->get_user($course['created_by']);
			$courses[$i]['created_by'] = $created_by['first_name'] . " " . $created_by['last_name'];
		}
		return $courses;
	}
	public function get_course_category_by_id($category_id) {
		$this->db->where('cat_id', $category_id);
		$sql = $this->db->get('coaching_course_category');
		return $sql->row_array();
	}
	public function get_course_by_id($course_id) {
		$this->db->where('course_id', $course_id);
		$sql = $this->db->get('coaching_courses');
		return $sql->row_array();
	}
	public function add_course_category($coaching_id, $category_id, $status = CATEGORY_STATUS_ACTIVE) {
		$data['title'] = $this->input->post('title');
		$data['status'] = $status;
		$member_id = $this->session->userdata('member_id');
		if ($category_id > 0) {
			$this->db->where('coaching_id', $coaching_id);
			$this->db->where('cat_id', $category_id);
			$this->db->update('coaching_course_category', $data);
		} else {
			$data['coaching_id'] = $coaching_id;
			$data['created_on'] = time();
			$data['created_by'] = $this->session->userdata('member_id');
			$this->db->insert('coaching_course_category', $data);
			$category_id = $this->db->insert_id();
		}
		return $category_id;
	}
	public function add_course($coaching_id, $category_id, $course_id, $status = CATEGORY_STATUS_ACTIVE) {
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['price'] = $this->input->post('price');
		$data['status'] = $status;
		if ($course_id > 0) {
			$this->db->where('course_id', $course_id);
			$this->db->where('coaching_id', $coaching_id);
			$this->db->where('cat_id', $category_id);
			$this->db->update('coaching_courses', $data);
			if ($this->db->affected_rows() > 0) {
				$returnValue = true;
			} else {
				$returnValue = false;
			}
		} else {
			$data['coaching_id'] = $coaching_id;
			$data['cat_id'] = $category_id;
			$data['created_on'] = time();
			$data['created_by'] = $this->session->userdata('member_id');
			$this->db->insert('coaching_courses', $data);
			if ($this->db->affected_rows() > 0) {
				$returnValue = true;
			} else {
				$returnValue = false;
			}
		}
		return $returnValue;
	}
	public function delete_course ($course_id) {
		$this->db->where ('course_id', $course_id);		
		$this->db->delete('coaching_courses');	
	}
	public function count_course_lessons ($coaching_id=0, $course_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$sql = $this->db->get ('coaching_course_lessons');
		return $sql->num_rows ();
	}
	public function count_course_tests ($coaching_id=0, $course_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$sql = $this->db->get ('coaching_tests');
		return $sql->num_rows ();
	}
}