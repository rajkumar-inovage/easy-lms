<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Lessons extends MX_Controller {

	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model', 'lessons_model'];
		$this->common_model->autoload_resources ($config, $models);
	}

	public function index ($coaching_id=0, $course_id=0) {

		$status = '-1';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['status'] = $status;
		$data['lessons'] = $this->lessons_model->get_lessons ($coaching_id, $course_id, $status);
		$data['data']	= $data;
		$data['page_title'] = 'Lessons';

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('lessons/index', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}


	public function create ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$data['page_title'] = 'Create Lesson';

		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['lesson_id'] = $lesson_id;

		$data['lesson'] = $this->lessons_model->get_lesson ($coaching_id, $course_id, $lesson_id);
		$data['script'] = $this->load->view ("lessons/scripts/create", $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('lessons/create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}


	public function pages ($coaching_id=0, $course_id=0, $lesson_id=0) {
	
		$data['page_title'] = 'Pages';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['lesson_id'] = $lesson_id;

		$data['pages'] = $this->lessons_model->get_top_pages ($coaching_id, $course_id, $lesson_id);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view("lessons/pages", $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

	public function add_page ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
	
		$data['page_title'] = 'Add Page';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['lesson_id'] = $lesson_id;
		$data['page_id'] = $page_id;

		$data['page'] = $this->lessons_model->get_page ($coaching_id, $course_id, $lesson_id, $page_id);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view("lessons/add_page", $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}



}