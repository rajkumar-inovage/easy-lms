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
	public function index ($coaching_id=0, $course_id=0) {
		
		$data['bc'] = array ('Dashboard'=>'coaching/home/dashboard/'.$coaching_id);

		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['page_title'] = 'Test Plans';
		$data['coaching_id'] = $coaching_id;
		$data['course_id'] = $course_id;
		
		$result = [];
		$data['test_plans'] = $this->plans_model->coaching_test_plans ($coaching_id);
		$data['lesson_plans'] = $this->plans_model->coaching_lesson_plans ($coaching_id);
		/*
		if (! empty ($plans)) {
			foreach ($plans as $p) {
				$tests = $this->plans_model->tests_in_plan ($p['plan_id']); 
				if (! empty($tests)) {
					$num_tests = count ($tests);
					$p['tests_in_plan'] = $num_tests;
					$p['tests'] = $tests;
					$result[] = $p;
				}
			}
		}
		$data['plans'] = $result;	
		$data['coaching_id'] = $coaching_id;
		$data['category_id'] = $category_id;	
		$data['categories'] = $this->plans_model->test_plan_categories ();
		if ($category_id > 0) {
			$category = $this->plans_model->get_category ($category_id);
			$data['sub_title'] = $category['title'] . ' Test Plans';
		}
		*/
		
		$this->load->view(INCLUDE_PATH  . 'header', $data);
		$this->load->view('plans/index', $data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
	}
	
	


}