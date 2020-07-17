<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Plans extends MX_Controller {
	
    var $toolbar_buttons = []; 

    public function __construct () {
	    $config = ['config_coaching'];
	    $models = ['test_plans_model', 'plans_model'];
	    $this->common_model->autoload_resources ($config, $models);

        $cid = $this->uri->segment (4);

        // Security step to prevent unauthorized access through url
        if ($this->session->userdata ('is_admin') == TRUE) {
        } else {
            if ($cid == true && $this->session->userdata ('coaching_id') <> $cid) {
                $this->message->set ('Direct url access not allowed', 'danger', true);
                redirect ('coaching/home/dashboard');
            }
        }

	}
	
	
	// List All Plans
	public function index ($coaching_id=0, $course_id=0, $type=1) {
		
		if ($course_id > 0) {
			$data['bc'] = array ('Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
		} else {
			$data['bc'] = array ('Dashboard'=>'coaching/home/dashboard/'.$coaching_id);
		}

		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['page_title'] = 'Test Plans';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		$data['type'] = $type;
		
		$result = [];
		$data['test_plans'] = $this->plans_model->coaching_test_plans ($coaching_id);
		$data['lesson_plans'] = $this->plans_model->coaching_lesson_plans ($coaching_id);
		
		$this->load->view(INCLUDE_PATH  . 'header', $data);
		$this->load->view('plans/index', $data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
	}
	
	


}