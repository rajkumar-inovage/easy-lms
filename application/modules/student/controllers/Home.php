<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    public function __construct () {
        $config = ['admin/config_admin'];
        $models = ['admin/coachings_model'];
        $this->common_model->autoload_resources ($config, $models);
	}	
    
    public function dashboard ($coaching_id=0, $member_id=0) {
		$data['page_title'] = 'Dashboard';
		$data['sub_title']  = 'Dashboard';
        if($coaching_id==0){
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        $data['coaching_id'] = $coaching_id;
        if($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
        $data['member_id'] = $member_id;
        $role_id = $this->session->userdata ('role_id');
        $data['role_id'] = $role_id;
        $data['tests'] = $this->coachings_model->get_coaching_tests ($coaching_id);
		$data['dashboard_menu'] = $dashboard_menu = $this->common_model->load_acl_menus (4, 'dashboard_menu');
        $this->load->view (INCLUDE_PATH . 'header', $data);
        $this->load->view ( 'home/dashboard', $data);
        $this->load->view (INCLUDE_PATH . 'footer', $data);
    }
}