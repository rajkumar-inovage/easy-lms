<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Indiatests_import extends MX_Controller {
	
    var $toolbar_buttons = []; 

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = [ 'config_coaching'];
	    $models = ['coaching_model', 'subscription_model', 'tests_model', 'qb_model', 'users_model', 'indiatests_import_model'];

	    $this->common_model->autoload_resources ($config, $models);
	    $coaching_id = $this->uri->segment (4);
	    $course_id = $this->uri->segment (5);
//        $this->toolbar_buttons['<i class="fa fa-puzzle-piece"></i> All Tests']= 'coaching/tests/index/'.$coaching_id.'/'.$course_id;
        
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
