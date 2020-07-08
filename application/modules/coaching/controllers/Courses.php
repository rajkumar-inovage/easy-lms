<?php if (!defined('BASEPATH')) { exit ('No direct script access allowed'); }

class Courses extends MX_Controller {

	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model'];
		$this->common_model->autoload_resources ($config, $models);
	}

	public function index($coaching_id = 0) {
	}

	public function create ($coaching_id=0, $course_id=0) {
		$data['page_title'] = 'Course';
		$data['sub_title'] = ($this->router->fetch_method() == "create") ? 'Create New Course' : 'Edit Course';
		$data['submit_label'] = ($this->router->fetch_method() == "create") ? 'Create' : 'Update';
		$data['submit_title'] = ($this->router->fetch_method() == "create") ? 'Create New Course' : 'Update This Course';
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

	public function edit_category($coaching_id = 0) {
		$this->create_category($coaching_id);
	}

	public function create_category ($coaching_id = 0) {
		$data['page_title'] = 'Course';
		$data['sub_title'] = ($this->router->fetch_method() == "create_category") ? 'Create New Course Category' : 'Edit Course Category';
		$data['submit_label'] = ($this->router->fetch_method() == "create_category") ? 'Create' : 'Update';
		$data['submit_title'] = ($this->router->fetch_method() == "create_category") ? 'Create New Category' : 'Update This Category';
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/create_cat', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
}