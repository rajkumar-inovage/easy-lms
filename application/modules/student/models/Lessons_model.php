<?php defined('BASEPATH') or exit ('No direct script access allowed');

class Lessons_model extends CI_Model {

	public function __construct () {
		parent:: __construct ();
	}

	public function get_lessons ($coaching_id=0, $course_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->order_by ('position', 'ASC');
		$sql = $this->db->get ('coaching_course_lessons');
		$lessons = $sql->result_array();
		foreach ($lessons as $i => $lesson) {
			$this->db->where ('coaching_id', $coaching_id);
			$this->db->where ('course_id', $course_id);
			$this->db->where ('lesson_id', $lesson['lesson_id']);
			$sql = $this->db->get ('coaching_course_progress');
			$progress = $sql->result_array();
			$lessons[$i]['progress'] = empty($progress)?false:true;
		}
		return $lessons;
	}
	public function get_lesson ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$sql = $this->db->get ('coaching_course_lessons');
		return $sql->row_array ();
	}
	public function get_top_pages ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$where = '(parent_id=0 OR parent_id="NULL")';
		$this->db->where ($where);
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
		$clp = $sql->result_array ();
		$result = [];
		if (! empty ($clp)) {
			foreach ($clp as $row) {
				$att = $this->get_attachments ($coaching_id, $course_id, $lesson_id, $row['page_id']);
				$result[$row['page_id']] = $row;
				$result[$row['page_id']]['att'] = $att;

				$this->db->where ('coaching_id', $coaching_id);
				$this->db->where ('course_id', $course_id);
				$this->db->where ('lesson_id', $lesson_id);
				$this->db->where ('page_id', $row['page_id']);
				$sql = $this->db->get ('coaching_course_progress');
				$progress = $sql->row_array();
				$result[$row['page_id']]['progress'] = empty($sql->num_rows() > 0)?false:true;
			}
		}
		return $result;
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
	public function get_last_page ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$this->db->select_max ('position');
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$sql = $this->db->get ('coaching_course_lesson_pages');
		$row = $sql->row_array ();
		$position = $row['position'];
		return $position;
	}
	public function get_next_page ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
		$this->db->select ('page_id');
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('page_id', $page_id);
		$sql = $this->db->get ('coaching_course_lesson_pages');
		$row = $sql->row_array ();
		$position = $row['position'];
		return $position;
	}
	public function get_full_progress($member_id=0, $coaching_id=0, $course_id=0){
		$this->db->where ('member_id', $member_id);
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$sql = $this->db->get ('coaching_course_progress');
		return $sql->result_array();
	}
	public function get_progress($member_id=0, $coaching_id=0, $course_id=0){
		/*
		$this->db->select ('count(lesson_id) as total_lessons');
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$sql = $this->db->get('coaching_course_lessons');
		$total_lessons = $sql->row_array();
		*/
		$this->db->select ('count(page_id) as total_pages');
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$sql = $this->db->get ('coaching_course_lesson_pages');
		$total_pages = $sql->row_array();
		
		$this->db->select ('count(progress_id) as total_progress');
		$this->db->where ('member_id', $member_id);
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$sql = $this->db->get ('coaching_course_progress');
		$total_progress = $sql->row_array();
		return array_merge($total_pages, $total_progress);
	}
	public function make_progress($member_id=0, $coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0){
		if($lesson_id > 0){
			$this->db->where ('member_id', $member_id);
			$this->db->where ('coaching_id', $coaching_id);
			$this->db->where ('course_id', $course_id);
			$this->db->where ('lesson_id', $lesson_id);
			$this->db->where ('page_id', $page_id);
			$sql = $this->db->get ('coaching_course_progress');
			if(intval($sql->num_rows()) === 0){
				$data['member_id']	 		= $member_id;
				$data['coaching_id']	 	= $coaching_id;
				$data['course_id']	 		= $course_id;
				$data['lesson_id']	 		= $lesson_id;
				$data['page_id']	 		= $page_id;
				$data['created_on']	  		= time();
				$this->db->insert('coaching_course_progress', $data);
				$progress_id = $this->db->insert_id();
			}
		}
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
	public function get_attachments ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('page_id', $page_id);
		$sql = $this->db->get ('coaching_course_lesson_attachments');
		return $sql->result_array ();
	}
	public function get_attachment ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0, $att_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('page_id', $page_id);
		$this->db->where ('att_id', $att_id);
		$sql = $this->db->get ('coaching_course_lesson_attachments');
		return $sql->row_array ();
	}
	public function add_page ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
		
		if ($this->input->post ('status')) {
			$status = $this->input->post ('status');
		} else {
			$status = LESSON_STATUS_UNPUBLISHED;
		}

		$data['title'] = $this->input->post ('title');
		$data['content'] = $this->input->post ('description');
		$data['status'] = $status;

		if ($page_id > 0) {
			$this->db->where ('coaching_id', $coaching_id);
			$this->db->where ('course_id', $course_id);
			$this->db->where ('lesson_id', $lesson_id);
			$this->db->where ('page_id', $page_id);
			$sql = $this->db->update ('coaching_course_lesson_pages', $data);
		} else {
			$position = $this->get_last_page ($coaching_id, $course_id, $lesson_id);			
			$data['coaching_id'] = $coaching_id;
			$data['course_id'] = $course_id;
			$data['lesson_id'] = $lesson_id;
			$data['position'] = $position + 1;
			$data['created_by'] = $this->session->userdata ('member_id');
			$data['created_on'] = time ();
			$sql = $this->db->insert ('coaching_course_lesson_pages', $data);
			$page_id = $this->db->insert_id ();
		}

		return $page_id;
	}
	public function add_attachment ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {		
		$att_type = $this->input->post ('att_type');
		if ($att_type == LESSON_ATT_UPLOAD) {
			$this->load->helper('directory');
			$this->load->helper('file');
			
			$upload_dir = 'contents/coachings/' . $coaching_id . '/' . $course_id . '/' .$lesson_id . '/'. $page_id . '/';
			
			if ( ! is_dir ($upload_dir) ) {
				mkdir ($upload_dir, 0755, true);
			}
			
			// upload parameters
			$allowed_types = $this->config->item ('allowed_mime_types');
			$options['upload_path'] 	= $upload_dir;
			$options['allowed_types'] 	= $allowed_types;
			$options['max_size']		= MAX_FILE_SIZE;
			$options['file_ext_tolower']	= true;
			$options['max_filename']	= 100;
			$options['overwrite']		= true;
			
			// load upload library
			$this->load->library ('upload', $options); 		
			
			if ( ! $this->upload->do_upload ('userfile') ) {
				$response = $this->upload->display_errors ();
			} else {   
				$upload_data = $this->upload->data ();

				$file_name = $upload_data['file_name'];
				$full_path = base_url ($upload_dir . $file_name);
				// Insert in database 
				$data['coaching_id'] = $coaching_id;
				$data['course_id'] = $course_id;
				$data['lesson_id'] = $lesson_id;
				$data['page_id'] = $page_id;
				$data['title'] = $this->input->post ('att_title');
				$data['att_type'] = LESSON_ATT_UPLOAD;
				$data['att_url'] = $full_path;
				$data['created_on'] = time ();
				$data['created_by'] = $this->session->userdata ('member_id');

				$this->db->insert ('coaching_course_lesson_attachments', $data);
				$response = false;
			}
		} else {
			// Insert in database 
			$data['coaching_id'] 	= $coaching_id;
			$data['course_id'] 		= $course_id;
			$data['lesson_id'] 		= $lesson_id;
			$data['page_id'] 		= $page_id;
			$data['title'] 			= $this->input->post ('att_title');
			$data['created_on'] 	= time ();
			$data['created_by'] 	= $this->session->userdata ('member_id');
			$data['att_type'] 		= $att_type;

			if ($data['att_type'] == LESSON_ATT_YOUTUBE) {
				$data['att_url'] = $this->input->post ('att_url_youtube');
			} else if ($data['att_type'] == LESSON_ATT_EXTERNAL) {
				$data['att_url'] = $this->input->post ('att_url_external');				
			}

			$this->db->insert ('coaching_course_lesson_attachments', $data);
			$response = false;
		}
		return $response;
	}
	public function delete_page ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('page_id', $page_id);
		$sql = $this->db->delete ('coaching_course_lesson_pages');
	}
	public function delete_attachment ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0, $att_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('page_id', $page_id);
		$this->db->where ('att_id', $att_id);
		$sql = $this->db->delete ('coaching_course_lesson_attachments');
	}
	/* Auto Generate Reference ID */
	public function generate_reference_id ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$prefix = ['EAL', date('Y'), $coaching_id, $course_id];
		/*
		$ref_prefix	= $this->common_model->get_sys_parameters (SYS_REF_ID_PREFIX);
		foreach ($ref_prefix as $row) {
			$prefix[] = $row['paramkey'];
		}
		*/
		if ($lesson_id > 0) {
			// This means lesson record is already inserted and the primary key is passed as lesson_id
			$num = $lesson_id;
		} else {
			// Member record is not yet inserted, show a 
			$this->db->select_max ('lesson_id');
			$sql = $this->db->get ('coaching_course_lessons');
			if ($sql->num_rows () > 0) {
				$row = $sql->row_array ();
				$id = $row['lesson_id'];
			} else { 
				$id = 0;
			}
			$num = $id+1;
		}
		$suffix = str_pad($num, 3, "0", STR_PAD_LEFT);		
		$ref_id = implode ('', $prefix);
		$ref_id = $ref_id . $suffix;
		return $ref_id;
	}
}