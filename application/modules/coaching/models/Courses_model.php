<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		// echo $this->db->last_query();
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
			$this->db->trans_start();
			$this->db->where('course_id', $course_id);
			$this->db->where('coaching_id', $coaching_id);
			$this->db->where('cat_id', $category_id);
			$this->db->update('coaching_courses', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === true && $this->db->affected_rows() > 0) {
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
}