<?php if (!defined('BASEPATH')) { exit ('No direct script access allowed'); }

class Lessons_model extends CI_Model {

	public function get_lessons ($coaching_id=0, $course_id=0, $status='-1') {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('course_id', $course_id);
		if ($status > 0) {
			$this->db->where ('status', $status);
		}
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

		if ($this->input->post ('duration')) {
			$duration = $this->input->post  ('duration');
		} else {
			$duration = 0;
		}

		$data = array (
				'title'    		  	=>($this->input->post('title')),
				'description' 	  	=>($this->input->post('description')),
				'status'      		=>$status,
				'duration'      	=>$duration,
				'duration_type'     =>$this->input->post('duration_type'),
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

			$ref_id = $this->generate_reference_id ($coaching_id, $course_id, $lesson_id);
			$this->db->set ('lesson_key', $ref_id);
			$this->db->where ('coaching_id', $coaching_id);
			$this->db->where ('course_id', $course_id);
			$this->db->where ('lesson_id', $lesson_id);
			$this->db->update ('coaching_course_lessons');
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
		if ($lesson_id > 0) {
			$this->db->where ('lesson_id', $lesson_id);
		}
		$this->db->order_by ('position', 'ASC');
		$sql = $this->db->get ('coaching_course_lesson_pages');
		$clp = $sql->result_array ();
		$result = [];
		if (! empty ($clp)) {
			foreach ($clp as $row) {
				$att = $this->get_attachments ($coaching_id, $course_id, $lesson_id, $row['page_id']);
				$result[$row['page_id']] = $row;
				$result[$row['page_id']]['att'] = $att;
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

	public function organize_content ($coaching_id=0, $course_id=0, $batch_id=0, $get=[]) {
		
		$member_id = $this->session->userdata ('member_id');
		$time = time ();
		if (! empty ($get)) {
			foreach ($get as $num=>$row) {
				$position = $num + 1;
				$type = $row['name'];
				$del_data = [];
				// Check if record exists
				$del_data['coaching_id'] 	= $coaching_id;
				$del_data['course_id'] 		= $course_id;
				$del_data['batch_id'] 		= $batch_id;
				$del_data['resource_id'] 	= $row['id'];
				$del_data['resource_type'] 	= $type;
				$sql = $this->db->get_where ('coaching_course_contents', $del_data);
				if ($sql->num_rows () > 0) {
					$record = $sql->row_array ();
					$this->db->set ('position', $position);
					$this->db->where ('id', $record['id']);
					$this->db->update ('coaching_course_contents');
					echo $this->db->last_query ();
				} else {
					$data = [];
					$data['coaching_id'] 	= $coaching_id;
					$data['course_id'] 		= $course_id;
					$data['batch_id'] 		= $batch_id;
					$data['resource_type'] 	= $type;
					$data['resource_id'] 	= $row['id'];
					$data['position'] 		= $position;
					$data['for_demo'] 		= 0;
					$data['created_on'] 	= $time;
					$data['created_by'] 	= $member_id;
					$this->db->insert ('coaching_course_contents', $data);					
				}
			}
		}
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