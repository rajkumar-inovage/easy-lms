<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Courses extends MX_Controller {

	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model', 'users_model'];
		$this->common_model->autoload_resources($config, $models);
	}

	public function index($coaching_id = 0, $cat_id = 0) {
		$data['page_title'] = 'Courses';
		$data['bc'] = array('Dashboard' => 'coaching/home/dashboard/' . $coaching_id);
		$data['cat_id'] = $cat_id;
		$data['coaching_id'] = $coaching_id;
		$data['categories'] = $this->courses_model->course_categories($coaching_id);
		$data['courses'] = $this->courses_model->courses($coaching_id, $cat_id);
		$data['toolbar_buttons'] = array(
			'<i class="fa fa-plus-circle"></i> New Course' => 'coaching/courses/create/' . $coaching_id . '/' . $cat_id,
			'<i class="fa fa-plus-circle"></i> New Category' => 'coaching/courses/create_category/' . $coaching_id . '/' . $cat_id,
		);
		$data['script'] = $this->load->view('courses/scripts/index', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/index', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

	public function edit($coaching_id = 0, $cat_id = 0, $course_id = 0) {
		$this->create($coaching_id, $cat_id, $course_id);
	}

	public function create($coaching_id = 0, $cat_id = 0, $course_id = 0) {
		$data['page_title'] = 'Course';
		$data['sub_title'] = ($this->router->fetch_method() == "create") ? 'Create New Course' : 'Edit Course';
		$data['submit_label'] = ($this->router->fetch_method() == "create") ? 'Create' : 'Update';
		$data['submit_title'] = ($this->router->fetch_method() == "create") ? 'Create New Course' : 'Update This Course';
		$data['cat_id'] = $cat_id;
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		if ($course_id > 0) {
			$data['course'] = $this->courses_model->get_course_by_id($course_id);
		}
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

	public function edit_category($coaching_id = 0, $cat_id = 0) {
		$this->create_category($coaching_id, $cat_id);
	}

	public function create_category($coaching_id = 0, $cat_id = 0) {
		$data['page_title'] = 'Course Category';
		$data['sub_title'] = ($this->router->fetch_method() == "create_category") ? 'Create New Course Category' : 'Edit Course Category';
		$data['submit_label'] = ($this->router->fetch_method() == "create_category") ? 'Create' : 'Update';
		$data['submit_title'] = ($this->router->fetch_method() == "create_category") ? 'Create New Category' : 'Update This Category';
		if ($cat_id > 0) {
			$data['category'] = $this->courses_model->get_course_category_by_id($cat_id);
		}
		$data['cat_id'] = $cat_id;
		$data['coaching_id'] = $coaching_id;
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/create_cat', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
}