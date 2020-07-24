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
	public function courses($coaching_id, $cat_id, $status = CATEGORY_STATUS_ALL){
		$this->db->where('coaching_id', $coaching_id);
		if($cat_id>0){
			$this->db->where('cat_id', $cat_id);
		}
		if($status != CATEGORY_STATUS_ALL){
			$this->db->where('status', $status);
		}
		$sql = $this->db->get('coaching_courses');
		$courses = $sql->result_array();
		foreach ($courses as $i => $course) {
			$created_by = $this->users_model->get_user($course['created_by']);
			$courses[$i]['created_by'] = $created_by['first_name'] . " " . $created_by['last_name'];
		}
		return $courses;
	}
	public function member_courses($coaching_id, $cat_id, $status = CATEGORY_STATUS_ALL){
        $this->db->select(
        	array(
        		'pwa_coaching_courses.*',
        		'pwa_coaching_course_teachers.created_on AS assigned_on',
        		'pwa_coaching_course_teachers.created_by AS assigned_by'
        	)
        );
		if($status != CATEGORY_STATUS_ALL){
			$this->db->where('coaching_courses.status', $status);
		}
        $this->db->where('coaching_courses.coaching_id', $coaching_id);
        $this->db->where('coaching_course_teachers.member_id', $this->session->userdata ('member_id'));
        $this->db->join('coaching_course_teachers','coaching_courses.course_id = coaching_course_teachers.course_id');
        $sql = $this->db->get('coaching_courses');
		$courses = $sql->result_array();
		foreach ($courses as $i => $course) {
			$created_by = $this->users_model->get_user($course['created_by']);
			$courses[$i]['created_by'] = $created_by['first_name'] . " " . $created_by['last_name'];
			$assigned_by = $this->users_model->get_user($course['assigned_by']);
			$courses[$i]['assigned_by'] = $assigned_by['first_name'] . " " . $assigned_by['last_name'];
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
	public function get_course_cat_id($coaching_id, $course_id) {
		$this->db->select('cat_id');
		$this->db->where('course_id', $course_id);
		$this->db->where('coaching_id', $coaching_id);
		$sql = $this->db->get('coaching_courses');
		extract($sql->row_array());
		if($cat_id===null){
			$cat_id = 0;
		}
		return $cat_id;
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
	public function add_course($coaching_id, $category_id, $course_id, $feat_img, $status = CATEGORY_STATUS_ACTIVE) {
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['price'] = $this->input->post('price');
		$data['enrolment_type'] = $this->input->post('enrolment_type');
		$data['status'] = $status;
		if($feat_img!==null){
			$data['feat_img'] = $feat_img;
		}
		if ($course_id > 0) {
			$this->db->where('course_id', $course_id);
			$this->db->where('coaching_id', $coaching_id);
			if($category_id>0){
				$this->db->where('cat_id', $category_id);
			}
			if ($this->db->update('coaching_courses', $data) || $this->db->affected_rows() > 0) {
				$returnValue = true;
			} else {
				$returnValue = false;
			}
		} else {
			$data['coaching_id'] = $coaching_id;
			if ($category_id>0) {
				$data['cat_id'] = $category_id;
			}
			$data['created_on'] = time();
			$data['created_by'] = $this->session->userdata('member_id');
			if ($this->db->insert('coaching_courses', $data) || $this->db->affected_rows() > 0) {
				$returnValue = true;
			} else {
				$returnValue = false;
			}
		}
		return $returnValue;
	}
	public function toggle_course_status($coaching_id, $category_id, $course_id, $status){
		$data['status'] = $status;
		$this->db->where('coaching_id', $coaching_id);
		if ($category_id > 0) {
			$this->db->where('cat_id', $category_id);
		}
		$this->db->where('course_id', $course_id);
		$this->db->update('coaching_courses', $data);
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
	public function get_teachers_assigned ($coaching_id=0, $course_id=0, $status=1) {
		$this->db->select('member_id');
		$this->db->from('coaching_course_teachers');
		$this->db->where ('course_id', $course_id);
		$sub_query = $this->db->get_compiled_select();

		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('status', $status);
		$this->db->where ('role_id', USER_ROLE_TEACHER);
		$this->db->where ("member_id IN ($sub_query)");
		$sql = $this->db->get ('members');
		return $sql->result_array();
	}
	public function get_teachers_not_assigned ($coaching_id=0, $course_id=0, $status=1) {
		$this->db->select('member_id');
		$this->db->from('coaching_course_teachers');
		$this->db->where ('course_id', $course_id);
		$sub_query = $this->db->get_compiled_select();
		
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('status', $status);
		$this->db->where ('role_id', USER_ROLE_TEACHER);
		$this->db->where ("member_id NOT IN ($sub_query)");
		$sql = $this->db->get ('members');
		return $sql->result_array();
	}
	public function add_teachers_assignment($coaching_id, $course_id){
		$users = $this->input->post('users');
		$add_count = 0;
		$user_count = count($users);
		foreach ($users as $i => $member_id) {
			if($this->add_teacher_assignment($coaching_id, $course_id, $member_id)){
				$add_count += 1;
			}
		}
		if($add_count===$user_count){
			$returnValue = true;
		} else {
			$returnValue = false;
		}
		return $returnValue;
	}
	public function add_teacher_assignment($coaching_id, $course_id, $member_id, $status=1){
		$data['course_id'] = $course_id;
		$data['coaching_id'] = $coaching_id;
		$data['member_id'] = $member_id;
		$data['status'] = $status;
		$data['created_on'] = time();
		$data['created_by'] = $this->session->userdata('member_id');
		$this->db->insert('coaching_course_teachers', $data);
		if ($this->db->affected_rows() > 0) {
			$returnValue = true;
		} else {
			$returnValue = false;
		}
		return $returnValue;
	}
	public function remove_teachers_assignment($coaching_id, $course_id){
		$users = $this->input->post('users');
		$remove_count = 0;
		$users_count = count($users);
		foreach ($users as $i => $member_id) {
			if($this->remove_teacher_assignment($coaching_id, $course_id, $member_id)){
				$remove_count += 1;
			}
		}
		if($users_count===$remove_count){
			$returnValue = true;
		} else {
			$returnValue = false;
		}
		return $returnValue;
	}
	public function remove_teacher_assignment($coaching_id, $course_id, $member_id){
		$this->db->where ('course_id', $course_id);
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('member_id', $member_id);
		$this->db->delete('coaching_course_teachers');	
		if ($this->db->affected_rows() > 0) {
			$returnValue = true;
		} else {
			$returnValue = false;
		}
		return $returnValue;
	}
}