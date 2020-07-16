<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Indiatests extends MX_Controller {
	
    var $toolbar_buttons = []; 

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = [ 'config_coaching'];
	    $models = ['coaching_model', 'subscription_model', 'tests_model', 'qb_model', 'users_model', 'indiatests_model'];

	    $this->common_model->autoload_resources ($config, $models);
	    $coaching_id = $this->uri->segment (4);
	    $course_id = $this->uri->segment (5);
        
        $this->toolbar_buttons['<i class="fa fa-puzzle-piece"></i> Purchased Plans']= 'coaching/plans/index/'.$coaching_id;
        
        if ($this->session->userdata ('is_admin') == TRUE) {
        } else {

        	// Security step to prevent unauthorized access through url
            if ($coaching_id == true && $this->session->userdata ('coaching_id') <> $coaching_id) {
                $this->message->set ('Direct url access not allowed', 'danger', true);
                redirect ('coaching/home/dashboard');
            }

        	// Check subscription plan expiry
            $coaching = $this->subscription_model->get_coaching_subscription ($coaching_id);
            $today = time ();
            $current_plan = $coaching['subscription_id'];
            if ($today > $coaching['ending_on']) {
            	$this->message->set ('Your subscription has expired. Choose a plan to upgrade', 'danger', true);
            	redirect ('coaching/subscription/browse_plans/'.$coaching_id.'/'.$current_plan);
            }
        }
	}

    public function index ($coaching_id=0) {
        if ($coaching_id == 0) {
            $coaching_id = $this->session->userdata ('coaching_id');
        }

        $this->test_plan_categories ($coaching_id);
    }

    public function test_plan_categories ($coaching_id=0, $course_id=0) {

        /* Breadcrumbs */ 
        $data['bc'] = array ('Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
        $data['toolbar_buttons'] = $this->toolbar_buttons;
        $data['page_title'] = 'Test Plans';
        $data['coaching_id'] = $coaching_id;
        $data['course_id'] = $course_id;
        
        // Get all test categories from MASTER database
        $data['categories'] = $this->indiatests_model->test_plan_categories ();

        $this->load->view(INCLUDE_PATH  . 'header', $data);
        $this->load->view('indiatests/test_plan_categories', $data);
        $this->load->view(INCLUDE_PATH  . 'footer', $data);
        
    }


    // List All Plans
    public function test_plans ($coaching_id=0, $course_id=0, $category_id=0, $amount='-1') {
        
        if ($course_id > 0) {
            $data['bc'] = array ('Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
        } else {
            $data['bc'] = array ('Manage'=>'coaching/indiatests/test_plan_categories/'.$coaching_id.'/'.$course_id);
        }

        $data['toolbar_buttons'] = $this->toolbar_buttons;
        $data['page_title'] = 'Test Plans';
        
        // Get all test categories from MASTER database
        $result = [];
        $plans = $this->indiatests_model->test_plans ($category_id, 1, $amount);
        if (! empty ($plans)) {
            foreach ($plans as $p) {                
                $tests = $this->indiatests_model->tests_in_plan ($p['plan_id']); 
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
        $data['course_id'] = $course_id;
        $data['category_id'] = $category_id;    
        $data['categories'] = $this->indiatests_model->test_plan_categories ();
        if ($category_id > 0) {
            //$category = $this->indiatests_model->get_category ($category_id);
           // $data['sub_title'] = $category['title'] . ' Test Plans';
        }
        $data['script'] = $this->load->view('indiatests/scripts/test_plans', $data, true);
        $this->load->view(INCLUDE_PATH  . 'header', $data);
        $this->load->view('indiatests/test_plans', $data);
        $this->load->view(INCLUDE_PATH  . 'footer', $data);
    }
    
    public function tests_in_plan ($coaching_id=0, $course_id=0, $plan_id=0) {

        /* Breadcrumbs */ 
        if ($course_id > 0) {
            $data['bc'] = array ('Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
        } else {
            $data['bc'] = array ('Test Plans'=>'coaching/plans/index/'.$coaching_id);
        }

        $data['toolbar_buttons'] = $this->toolbar_buttons;
        $data['page_title'] = 'Tests In Plan';
        $data['coaching_id'] = $coaching_id;
        $data['course_id'] = $course_id;
        $data['plan_id'] = $plan_id;
        
        $data['tests'] = $this->indiatests_model->tests_in_plan ($plan_id);

        $this->load->view(INCLUDE_PATH  . 'header', $data);
        $this->load->view('indiatests/tests_in_plan', $data);
        $this->load->view(INCLUDE_PATH  . 'footer', $data);        
    }

    public function buy_plan ($coaching_id=0, $plan_id=0) {
        $this->indiatests_model->buy_plan ($coaching_id, $plan_id);
        redirect ('coaching/plans/index/'.$coaching_id);
    }


    /*----===== LESSON PLANS =====----- */
    public function lesson_plan_categories ($coaching_id=0, $course_id=0) {

        /* Breadcrumbs */ 
        $data['bc'] = array ('Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
        $data['toolbar_buttons'] = $this->toolbar_buttons;
        $data['page_title'] = 'Test Plans';
        $data['coaching_id'] = $coaching_id;
        $data['course_id'] = $course_id;
        
        // Get all test categories from MASTER database
        $data['categories'] = $this->indiatests_model->lesson_plan_categories ();

        $this->load->view(INCLUDE_PATH  . 'header', $data);
        $this->load->view('indiatests/lesson_plan_categories', $data);
        $this->load->view(INCLUDE_PATH  . 'footer', $data);
        
    }


    // List All Plans
    public function lesson_plans ($coaching_id=0, $course_id=0, $category_id=0, $amount='-1') {
        
        if ($course_id > 0) {
            $data['bc'] = array ('Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
        } else {
            $data['bc'] = array ('Manage'=>'coaching/indiatests/lesson_plan_categories/'.$coaching_id.'/'.$course_id);
        }

        $data['toolbar_buttons'] = $this->toolbar_buttons;
        $data['page_title'] = 'Test Plans';
        
        // Get all test categories from MASTER database
        $result = [];
        $plans = $this->indiatests_model->lesson_plans ($category_id, 1, $amount);
        if (! empty ($plans)) {
            foreach ($plans as $p) {                
                $tests = $this->indiatests_model->lessons_in_plan ($p['plan_id']); 
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
        $data['course_id'] = $course_id;
        $data['amount'] = $amount;
        $data['category_id'] = $category_id;    
        $data['categories'] = $this->indiatests_model->lesson_plan_categories ();
        if ($category_id > 0) {
            //$category = $this->indiatests_model->get_category ($category_id);
           // $data['sub_title'] = $category['title'] . ' Test Plans';
        }
        
        $data['script'] = $this->load->view('indiatests/scripts/lesson_plans', $data, true);
        $this->load->view(INCLUDE_PATH  . 'header', $data);
        $this->load->view('indiatests/lesson_plans', $data);
        $this->load->view(INCLUDE_PATH  . 'footer', $data);
    }
    
    public function lessons_in_plan ($coaching_id=0, $course_id=0, $plan_id=0) {

        /* Breadcrumbs */ 
        if ($course_id > 0) {
            $data['bc'] = array ('Manage'=>'coaching/courses/manage/'.$coaching_id.'/'.$course_id);
        } else {
            $data['bc'] = array ('Test Plans'=>'coaching/plans/index/'.$coaching_id);
        }

        $data['toolbar_buttons'] = $this->toolbar_buttons;
        $data['page_title'] = 'Lessons In Plan';
        $data['coaching_id'] = $coaching_id;
        $data['course_id'] = $course_id;
        $data['plan_id'] = $plan_id;
        
        $data['tests'] = $this->indiatests_model->lessons_in_plan ($plan_id);

        $this->load->view(INCLUDE_PATH  . 'header', $data);
        $this->load->view('indiatests/lessons_in_plan', $data);
        $this->load->view(INCLUDE_PATH  . 'footer', $data);        
    }


}