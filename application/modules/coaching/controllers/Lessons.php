<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Lessons extends MX_Controller {

	var $toolbar_buttons = [];

	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching', 'config_course'];
		$models = ['coaching_model', 'courses_model', 'lessons_model'];
		$this->common_model->autoload_resources ($config, $models);

		// Toolbar
	    $cid = $this->uri->segment (4);
        $this->toolbar_buttons['<i class="fa fa-book"></i> All Courses']= 'coaching/courses/index/'.$cid;
        $this->toolbar_buttons['<i class="fa fa-plus-circle"></i> New Course']= 'coaching/courses/create_course/'.$cid;
	}

	public function index ($coaching_id=0, $course_id=0) {

		$status = '-1';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['status'] = $status;
		$data['lessons'] = $this->lessons_model->get_lessons ($coaching_id, $course_id, $status);
		$data['data']	= $data;
		$data['page_title'] = 'Chapters';

		/* --==// Toolbar //==-- */
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['toolbar_buttons']['<i class="fa fa-plus-circle"></i> New Chapter']= 'coaching/lessons/create/'.$coaching_id.'/'.$course_id;

		/* --==// Back //==-- */
		$data['bc'] = ['Pages'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id];

		$data['script'] = $this->load->view ('lessons/scripts/sortable', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('lessons/index', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

	public function create ($coaching_id=0, $course_id=0, $lesson_id=0) {
		$data['page_title'] = 'Create Chapter';

		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['lesson_id'] = $lesson_id;

		/* --==// Toolbar //==-- */
		$data['toolbar_buttons'] = $this->toolbar_buttons;

		/* --==// Back //==-- */
		$data['bc'] = ['Lessons'=>'coaching/lessons/index/'.$coaching_id.'/'.$course_id];

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

		/* --==// Back //==-- */
		$data['bc'] = ['Lessons'=>'coaching/lessons/index/'.$coaching_id.'/'.$course_id];

		$data['lesson'] = $this->lessons_model->get_lesson ($coaching_id, $course_id, $lesson_id);
		$data['pages'] = $this->lessons_model->get_all_pages ($coaching_id, $course_id, $lesson_id);

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
		$data['attachments'] = $this->lessons_model->get_attachments ($coaching_id, $course_id, $lesson_id, $page_id);
		
		/* --==// Back //==-- */
		$data['bc'] = ['Pages'=>'coaching/lessons/pages/'.$coaching_id.'/'.$course_id.'/'.$lesson_id];

		$data['script'] = $this->load->view ("lessons/scripts/add_page", $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view("lessons/add_page", $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}

	public function preview ($coaching_id=0, $course_id=0, $lesson_id=0, $page_id=0) {
		$data['page_title'] = 'Preview';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['lesson_id'] = $lesson_id;
		$data['page_id'] = $page_id;

		$data['lessons'] = $this->lessons_model->get_lessons ($coaching_id, $course_id);
		$data['pages'] = $this->lessons_model->get_pages ($coaching_id, $course_id, $lesson_id);
		$data['page'] = $this->lessons_model->get_page ($coaching_id, $course_id, $lesson_id, $page_id);
		$data['attachments'] = $this->lessons_model->get_attachments ($coaching_id, $course_id, $lesson_id, $page_id);
		
		/* --==// Back //==-- */
		$data['bc'] = ['Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id];

		$data['script'] = $this->load->view ("lessons/scripts/add_page", $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view("course/preview", $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);

	}

	public function import_from_indiatest ($coaching_id=0, $course_id=0) {

		$data['page_title'] = 'Lesson Categories';
		$data['bc'] = array ('Test Plans'=>'admin/plans/index');
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		
		// Get all test categories from MASTER database
		$data['categories'] = $this->plans_model->its_test_plan_categories ();

		$this->load->view(INCLUDE_PATH  . 'header', $data);
		$this->load->view('plans/its_test_plans', $data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);

	}
}