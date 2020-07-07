<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Lessons extends MX_Controller {
	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model', 'lessons_model'];
		$this->common_model->autoload_resources($config, $models);
	}

	public function index($coaching_id=0, $course_id=0) {
	}


	public function create ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$data['page_title'] = 'Lesson';

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('lessons/create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

	public function pages ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
	
		$data['page_title'] = 'Pages';

		$data['script'] = $this->load->view("lessons/page/scripts/$template", $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view("lessons/pages", $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

}