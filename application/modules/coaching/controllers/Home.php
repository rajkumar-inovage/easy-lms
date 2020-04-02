<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Home extends MX_Controller {
	
	public function __construct () { 
	    $config = ['coaching/config_coaching'];
	    $models = ['admin/coachings_model', 'coaching/users_model', 'coaching/subscription_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}
 
	public function dashboard ($coaching_id=0, $member_id=0) {
		
		 if ($coaching_id==0) {
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if ($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
        $role_id = $this->session->userdata ('role_id');

        $data['coaching_id'] = $coaching_id;
        $data['member_id'] = $member_id;

        if ($role_id == USER_ROLE_SUPER_ADMIN || $role_id == USER_ROLE_ADMIN) {
        	$role = USER_ROLE_COACHING_ADMIN;
        } else {
        	$role = $role_id;
        }

		$data['dashboard_menu'] = $this->common_model->load_acl_menus ($role, 0, MENUTYPE_DASHBOARD);

		$data['coaching'] = $this->coachings_model->get_coaching ($coaching_id);
		$data['subscriptions'] = $this->subscription_model->get_coaching_subscription ($coaching_id);
		$data['test_packages'] = $this->coachings_model->coaching_plans ($coaching_id);
		$data['tests'] = $this->coachings_model->get_coaching_tests ($coaching_id);
		$data['users'] = $this->coachings_model->get_coaching_users ($coaching_id);
		$data['announcements'] = $this->coachings_model->get_coaching_announcements ($coaching_id);
		$data['cats_added'] = array ();		

		$data['page_title'] = $data['coaching']['coaching_name'];

        //$data['bc'] = array ('Coachings'=>'admin/coaching/index');
		
		$this->load->view (INCLUDE_PATH . 'header', $data);
		$this->load->view ('home/dashboard', $data);
		$this->load->view (INCLUDE_PATH . 'footer', $data);		
		
	}
	

}