 <?php if (!defined('BASEPATH')) {	exit('No direct script access allowed'); }

class Lesson_actions extends MX_Controller {

	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model', 'lessons_model'];
		$this->common_model->autoload_resources ($config, $models);
	}

	public function create_lesson ($coaching_id=0, $course_id=0, $lesson_id=0) {

		$this->form_validation->set_rules ('title', 'Title', 'required|trim');
		if ( $this->form_validation->run () == true )  {
			$id = $this->lessons_model->create_lesson ($coaching_id, $course_id, $lesson_id);
			if ($lesson_id > 0) {
				$message = 'Lesson updated successfully';
				$redirect = 'coaching/lessons/pages/'.$coaching_id.'/'.$course_id.'/'.$lesson_id;
			} else {
				$message = 'Lesson created successfully';
				$redirect = 'coaching/lessons/pages/'.$coaching_id.'/'.$course_id.'/'.$id;
			}
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url($redirect) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		} 
	}

	public function add_page ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {

		$this->form_validation->set_rules ('title', 'Title', 'required|trim');
		if ( $this->form_validation->run () == true )  {
			$id = $this->lessons_model->add_page ($coaching_id, $course_id, $lesson_id, $page_id);
			if ($page_id > 0) {
				$message = 'Page updated successfully';
			} else {
				$message = 'Page created successfully';
			}
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$id) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		} 
	}

	public function add_attachment ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {

		$this->form_validation->set_rules ('att_title', 'Resource Title', 'required|trim');
		$this->form_validation->set_rules ('page_id', 'Invalid request', 'greater_than[0]', ['greater_than'=>'Invalid request']);
		$att_type = $this->input->post ('att_type');
		if ($att_type == LESSON_ATT_YOUTUBE) {
			$this->form_validation->set_rules ('att_url_youtube', 'Youtube URL', 'required|trim');
		}
		if ($att_type == LESSON_ATT_EXTERNAL) {
			$this->form_validation->set_rules ('att_url_external', 'External URL', 'required|trim');
		}
		
		if ( $page_id > 0 && $this->form_validation->run () == true )  {
			$response = $this->lessons_model->add_attachment ($coaching_id, $course_id, $lesson_id, $page_id);
			if ($response == false) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Attachment added successfully', 'redirect'=>site_url('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$page_id) )));
			} else {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>$response )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		} 
	}

 	public function delete_page ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {

 		$att = $this->lessons_model->get_attachments ($coaching_id, $course_id, $lesson_id, $page_id);
 		if (! empty ($att)) {
 			foreach ($att as $row) {
 				$this->delete_attachment ($coaching_id, $course_id, $lesson_id, $page_id, $row['att_id'], $row['att_type'], 0);
 			}
 		}

		// Delete entry
 		$this->lessons_model->delete_page ($coaching_id, $course_id, $lesson_id, $page_id);

 		redirect ('coaching/lessons/pages/'.$coaching_id.'/'.$course_id.'/'.$lesson_id);

 	}


 	public function delete_attachment ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0, $att_id=0, $att_type=0, $redirect=1) {

 		if ($att_type == LESSON_ATT_UPLOAD) {
 			// Delete files 
 			$att = $this->lessons_model->get_attachment ($coaching_id, $course_id, $lesson_id, $page_id, $att_id);
 			$file_path = $att['att_url'];
 			@unlink ($file_path);
 		}

		// Delete entry
 		$this->lessons_model->delete_attachment ($coaching_id, $course_id, $lesson_id, $page_id, $att_id);

 		if ($redirect == 1) {
 			redirect ('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$page_id);
 		}

 	}

 	public function organize ($coaching_id=0, $course_id=0) {
		$raw_input 		= $this->input->raw_input_stream;
		//$input_data 	=  ($raw_input);
		$input_data 	= json_decode ($raw_input, true);

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'message'=>$input_data )));
 	}
}