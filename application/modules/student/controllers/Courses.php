<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends MX_Controller {
	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_student', 'config_course'];
		$models = ['courses_model', 'lessons_model'];
		$this->common_model->autoload_resources($config, $models);
	}
	public function index($coaching_id = 0, $member_id=0, $cat_id = 0) {
		$data['page_title'] = 'All Courses';
		if ($coaching_id==0) {
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if ($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
        $data['toolbar_buttons'] = array(
			'<i class="fa fa-book"></i> My Courses' => 'student/courses/my_tests/' . $coaching_id . '/' . $member_id,
		);

		$data['bc'] = array('Dashboard' => 'student/home/dashboard/' . $coaching_id);
		$data['coaching_id'] = $coaching_id;
		$data['member_id'] = $member_id;
		$data['cat_id'] = $cat_id;
		$data['courses'] = $this->courses_model->get_users_courses($coaching_id, $member_id);
		$data['script'] = $this->load->view('courses/scripts/index', $data, true);

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/index', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	public function my_tests($coaching_id = 0, $member_id=0, $cat_id = 0) {
		$data['page_title'] = 'My Courses';
		if ($coaching_id==0) {
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if ($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
        $data['toolbar_buttons'] = array(
			'<i class="fa fa-book"></i> All Courses' => 'student/courses/index/' . $coaching_id . '/' . $member_id,
		);
		$data['bc'] = array('All Courses' => 'student/courses/index/' . $coaching_id . '/' . $member_id);
		$data['coaching_id'] = $coaching_id;
		$data['member_id'] = $member_id;
		$data['cat_id'] = $cat_id;
		$data['courses'] = $this->courses_model->get_users_batch_courses($coaching_id, $member_id);
		$data['script'] = $this->load->view('courses/scripts/my_tests', $data, true);

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('courses/my_tests', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	public function view ($coaching_id=0, $member_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
		$data['page_title'] = 'View Course';
		if ($coaching_id==0) {
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if ($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
		$data['coaching_id'] = $coaching_id;
		$data['member_id'] = $member_id;
		$data['course_id'] = $course_id;
		$data['lesson_id'] = $lesson_id;
		$data['page_id'] = $page_id;

		$data['course'] = $this->courses_model->get_course_by_id($course_id);
		$data['lessons'] = $this->lessons_model->get_lessons ($coaching_id, $course_id);
		$data['pages'] = $this->lessons_model->get_all_pages ($coaching_id, $course_id, $lesson_id);
		
		if ($lesson_id > 0) {
			$data['lesson'] = $this->lessons_model->get_lesson ($coaching_id, $course_id, $lesson_id);
		} else {
			$data['lesson'] = false;
		}

		if ($page_id > 0) {
			$data['page'] = $this->lessons_model->get_page ($coaching_id, $course_id, $lesson_id, $page_id);
			$data['attachments'] = $this->lessons_model->get_attachments ($coaching_id, $course_id, $lesson_id, $page_id);
		} else {
			$data['page'] = false;
			$data['attachments'] = false;
		}

		/* --==// Back //==-- */
		// if course not purchased
		// $data['bc'] = ['All Courses'=>'student/courses/index/'.$coaching_id.'/'.$member_id];
		// if course purchased
		$data['bc'] = ['My Courses'=>'student/courses/my_tests/'.$coaching_id.'/'.$member_id];

		$data['sidebar_right'] = $this->load->view ('courses/inc/course_view', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view("courses/view", $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
}