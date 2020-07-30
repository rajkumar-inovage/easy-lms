<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		// echo $this->db->last_query();
	}
	public function get_course_by_id($course_id) {
		$this->db->where('course_id', $course_id);
		$sql = $this->db->get('coaching_courses');
		$course = $sql->row_array();
		$this->db->where('course_id', $course_id);
		$sql = $this->db->get('coaching_course_batch_users');
		if(!empty($sql->row_array())){
			$course['in_my_course'] = true;
		}else{
			$course['in_my_course'] = false;
		}
		return $course;
	}
	public function get_users_courses($coaching_id, $member_id){
		$this->db->select('course_id');
		$this->db->from('coaching_course_batch_users');
		$this->db->where('coaching_id', $coaching_id);
		$this->db->where ('member_id', $member_id);
		$sub_query = $this->db->get_compiled_select();

		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('status', 1);
		$this->db->where ('enrolment_type', COURSE_ENROLMENT_DIRECT);
		$this->db->where ("course_id NOT IN ($sub_query)");
		$sql = $this->db->get ('coaching_courses');
		$courses = $sql->result_array();
		foreach ($courses as $i => $course) {
			$courses[$i]['lessons'] = $this->count_course_lessons($coaching_id, $course['course_id']);
			$courses[$i]['tests'] = $this->count_course_tests($coaching_id, $course['course_id']);
			$this->db->select('first_name, last_name');
			$this->db->where ('member_id', $course['created_by']);
			$users = $this->db->get ('members');
			$created_by = $users->row_array();
			$courses[$i]['created_by'] = $created_by['first_name'] . " " . $created_by['last_name'];
		}
		return $courses;
	}
	public function get_users_batch_courses($coaching_id, $member_id){
		$this->db->select('course_id');
		$this->db->from('coaching_course_batch_users');
		$this->db->where('coaching_id', $coaching_id);
		$this->db->where ('member_id', $member_id);
		$sub_query = $this->db->get_compiled_select();

		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('status', 1);
		$this->db->order_by('created_on', 'DESC');
		$this->db->where ("course_id IN ($sub_query)");
		$sql = $this->db->get ('coaching_courses');
		$courses = $sql->result_array();
		foreach ($courses as $i => $course) {
			$courses[$i]['lessons'] = $this->count_course_lessons($coaching_id, $course['course_id']);
			$courses[$i]['tests'] = $this->count_course_tests($coaching_id, $course['course_id']);
			$courses[$i]['progress'] = $this->lessons_model->get_progress($member_id, $coaching_id, $course['course_id']);
			$this->db->select('first_name, last_name');
			$this->db->where ('member_id', $course['created_by']);
			$users = $this->db->get ('members');
			$created_by = $users->row_array();
			$courses[$i]['created_by'] = $created_by['first_name'] . " " . $created_by['last_name'];
		}
		return $courses;
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
	public function buy_course($coaching_id, $member_id, $course_id, $batch_id=0){
		$this->db->where ('member_id', $member_id);
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('batch_id', $batch_id);
		$sql = $this->db->get ('coaching_course_batch_users');
		if(intval($sql->num_rows()) === 0){
			$data['coaching_id']	 	= $coaching_id;
			$data['course_id']	 		= $course_id;
			$data['batch_id']	 		= $batch_id;
			$data['member_id']	 		= $member_id;
			$this->db->insert('coaching_course_batch_users', $data);
		}
	}
	public function get_course_tests ($coaching_id=0, $course_id=0, $status='-1', $type=0) {
		if ( $course_id > 0 ) {
			$this->db->where ('course_id', $course_id);
		}
		if ( $type > 0 ) {
			$this->db->where ('test_type', $type);
		}
		$this->db->where ('finalized', 1);
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->order_by ('creation_date', 'DESC');
		
		$query = $this->db->get ("coaching_tests");
		$results = $query->result_array();	
		return $results;
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
}