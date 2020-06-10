<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    public function __construct () {
        $config = ['config_student', 'config_virtual_class'];
        $models = ['virtual_class_model', 'tests_reports', 'tests_model', 'announcements_model'];
        $this->common_model->autoload_resources ($config, $models);

        $cid = $this->uri->segment (4);        
        
        // Security step to prevent unauthorized access through url
        if ($this->session->userdata ('is_admin') == TRUE) {
        } else {
            if ($cid == true && $this->session->userdata ('coaching_id') <> $cid) {
                $this->message->set ('Direct url access not allowed', 'danger', true);
                redirect ('student/home/dashboard');
            }
        }
	}	
    
    public function dashboard ($coaching_id=0, $member_id=0) {
		$data['page_title'] = 'Dashboard';
        if ($coaching_id==0) {
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if ($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
        $role_id = $this->session->userdata ('role_id');

        $data['coaching_id'] = $coaching_id;
        $data['member_id'] = $member_id;
        $data['role_id'] = $role_id;

        $data['my_classrooms'] = $this->virtual_class_model->my_classroom ($coaching_id, $member_id);

        $enroled = [];
        $enrolments = $this->tests_model->get_enroled_tests ($coaching_id, $member_id);
        $now = time ();
        if (! empty ($enrolments)) {
            foreach ($enrolments as $row) {
                // On going tests
                if ( $now >= $row['start_date'] && $now <= $row['end_date']) {
                    $enroled['ongoing'][] = $row;
                } else if ($now < $row['start_date'] && $now < $row['end_date']) {
                // Up coming tests
                    $enroled['upcoming'][] = $row;
                } else {
                // Archived tests
                    $enroled['archived'][] = $row;
                }
            }
        }
        $data['tests'] = $enroled;

        $data['annc'] = $this->announcements_model->get_announcements ($coaching_id);

		$data['dashboard_menu'] = $this->common_model->load_acl_menus ($role_id, 0, MENUTYPE_DASHBOARD);

        $this->load->view (INCLUDE_PATH . 'header', $data);
        $this->load->view ( 'home/dashboard', $data);
        $this->load->view (INCLUDE_PATH . 'footer', $data);
    }
}