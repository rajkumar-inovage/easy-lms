<?php if (!defined('BASEPATH')) { exit ('No direct script access allowed'); }

class Lessons_model extends CI_Model {

	public function get_lessons ($coaching_id=0, $course_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->order_by ('position', 'ASC');
		$sql = $this->db->get ('coaching_course_lessons');
		return $sql->result_array ();
	}

	public function get_lesson ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$sql = $this->db->get ('coaching_course_lessons');
		return $sql->row_array ();
	}

	public function create_lesson ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$now  = time ();
		if ($this->input->post ('status')) {
			$status = $this->input->post  ('status');
		} else {
			$status = LESSON_STATUS_UNPUBLISHED;
		}

		$data = array (
				'title'    		  	=>ascii_to_entities ($this->input->post('title')),
				'description' 	  	=>ascii_to_entities ($this->input->post('description')),
				'status'      		=>$status,
            );
		
		if ($lesson_id > 0) {
			$this->db->where ('lesson_id', $lesson_id);
			$this->db->where ('coaching_id', $coaching_id);
			$this->db->where ('course_id', $course_id);
			$this->db->update ('coaching_course_lessons', $data);
		} else {
			$data['coaching_id']	 	= $coaching_id;
			$data['course_id']	 		= $course_id;
			$data['created_by']	  		= intval ($this->session->userdata('member_id'));
			$data['created_on']	  		= $now;
			$this->db->insert('coaching_course_lessons', $data);
			$lesson_id = $this->db->insert_id();
		}
		return $lesson_id;
	}


	public function get_top_pages ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('parent_id', 0);
		$this->db->order_by ('position', 'ASC');
		$sql = $this->db->get ('coaching_course_lesson_pages');
		return $sql->result_array ();
	}

	public function get_all_pages ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->order_by ('position', 'ASC');
		$sql = $this->db->get ('coaching_course_lesson_pages');
		return $sql->result_array ();
	}

	public function get_child_pages ($coaching_id=0, $course_id=0, $lesson_id=0, $parent_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('parent_id', $parent_id);
		$this->db->order_by ('position', 'ASC');
		$sql = $this->db->get ('coaching_course_lesson_pages');
		return $sql->result_array ();
	}

	public function get_page ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('page_id', $page_id);
		$this->db->order_by ('position', 'ASC');
		$sql = $this->db->get ('coaching_course_lesson_pages');
		return $sql->row_array ();
	}

}