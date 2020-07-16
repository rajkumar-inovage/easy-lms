<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Indiatest_actions extends MX_Controller {
	

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = [ 'config_coaching'];
	    $models = ['coaching_model', 'subscription_model', 'tests_model', 'qb_model', 'users_model', 'indiatests_model'];

	    $this->common_model->autoload_resources ($config, $models);
	    $coaching_id = $this->uri->segment (4);
	    $course_id = $this->uri->segment (5);        
        
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

    public function buy_lesson_plan ($coaching_id=0, $course_id=0, $plan_id=0) {
        $this->message->set ('Plan addedd successfully', 'success', true);
        $this->indiatests_model->buy_lesson_plan ($coaching_id, $plan_id);
        redirect ('coaching/plans/index/'.$coaching_id.'/'.$course_id);
    }

    public function import_tests ($coaching_id=0, $course_id=0, $plan_id=0) {
        $this->form_validation->set_rules ('tests[]', 'Tests', 'required', ['required'=>'You have not selected any test ']);
        if ( $this->form_validation->run () == true )  {
            $id = $this->indiatests_model->import_tests ($coaching_id, $course_id);
            $message = 'Test(s) addedd successfully';
            $redirect = 'coaching/indiatests/tests_in_plan/'.$coaching_id.'/'.$course_id.'/'.$plan_id;
            $this->output->set_content_type("application/json");
            $this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url($redirect) )));
        } else {
            $this->output->set_content_type("application/json");
            $this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
        } 
    }

   
    public function import_lessons ($coaching_id=0, $course_id=0, $plan_id=0) {
        $this->form_validation->set_rules ('lessons[]', 'Lesson', 'required', ['required'=>'You have not selected any lesson ']);
        if ( $this->form_validation->run () == true )  {
            $id = $this->indiatests_model->import_lessons ($coaching_id, $course_id);
            $message = 'Lesson(s) addedd successfully';
            $redirect = 'coaching/indiatests/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$plan_id;
            $this->output->set_content_type("application/json");
            $this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url($redirect) )));
        } else {
            $this->output->set_content_type("application/json");
            $this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
        } 
    }

}