<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Home extends MX_Controller {
	
	public function __construct () { 
	    $config = ['admin/config_admin', 'coaching/config_coaching'];
	    $models = ['admin/coachings_model', 'coaching/users_model', 'coaching/subscription_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}
 
	public function dashboard ($coaching_id=0) {
		
		$data['coaching'] = $this->coachings_model->get_coaching ($coaching_id);
		$data['subscriptions'] = $this->subscription_model->get_coaching_subscription ($coaching_id);
		$data['test_packages'] = $this->coachings_model->coaching_plans ($coaching_id);
		$data['tests'] = $this->coachings_model->get_coaching_tests ($coaching_id);
		$data['users'] = $this->coachings_model->get_coaching_users ($coaching_id);
		$data['cats_added'] = array ();
		
		$data['role_id'] = $role_id = $this->session->userdata('role_id');

		$data['page_title'] = 'Dashboard';
		$data['sub_title'] = $data['coaching']['coaching_name'];
		$data['coaching_id'] = $coaching_id;
        $data['bc'] = array ('Coachings'=>'admin/coaching/index');
		
		$this->load->view (INCLUDE_PATH . 'header', $data);
		$this->load->view ('home/dashboard', $data);
		$this->load->view (INCLUDE_PATH . 'footer', $data);		
		
	}
	

}