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

	public function get_attachments ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		$this->db->where ('lesson_id', $lesson_id);
		$this->db->where ('page_id', $page_id);
		$sql = $this->db->get ('coaching_course_lesson_attachments');
		return $sql->result_array ();
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
			$data['coaching_id'] = $coaching_id;
			$data['course_id'] = $course_id;
			$data['lesson_id'] = $lesson_id;
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

}