<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lessons extends MX_Controller {
	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model', 'lessons_model'];
		$this->common_model->autoload_resources($config, $models);
	}

	public function index($coaching_id = 0) {
	}

	public function edit($coaching_id = 0) {
		$this->create($coaching_id);
	}

	public function create($coaching_id = 0) {
		$data['page_title'] = 'Lessons';
		$data['sub_title'] = ($this->router->fetch_method() == "create") ? 'Create New Lesson' : 'Edit Lesson';
		$data['submit_label'] = ($this->router->fetch_method() == "create") ? 'Create' : 'Update';
		$data['submit_title'] = ($this->router->fetch_method() == "create") ? 'Create New Lesson' : 'Update This Lesson';
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('lessons/create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	public function page($action, $coaching_id = 0, $lesson_id = 0) {
		$data['page_title'] = 'Lessons Page';
		$data['sub_title'] = ($action == "create") ? 'Create New Page' : 'Edit Page';
		$data['submit_label'] = ($action == "create") ? 'Create' : 'Update';
		$data['submit_title'] = ($action == "create") ? 'Create New Page' : 'Update This Page';
		$template = ($action == "create" || $action == "edit") ? "create" : $action;

		$data['script'] = $this->load->view("lessons/page/scripts/$template", $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view("lessons/page/$template", $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

}