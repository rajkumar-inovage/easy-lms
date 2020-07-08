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
				$redirect = 'coaching/lessons/content/'.$coaching_id.'/'.$course_id.'/'.$lesson_id;
			} else {
				$message = 'Lesson created successfully';
				$redirect = 'coaching/lessons/content/'.$coaching_id.'/'.$course_id.'/'.$lesson_id;
			}
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url($redirect) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		} 
	}

}