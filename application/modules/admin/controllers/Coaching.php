<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coaching extends MX_Controller { 
    
    var $toolbar_buttons = []; 

    public function __construct () {
	    $config = ['admin/config_admin'];
	    $models = ['admin/coachings_model'];
	    $this->common_model->autoload_resources ($config, $models);
        $this->toolbar_buttons['<i class="fa fa-plus-circle"></i> New Coaching']= 'admin/coaching/create';
	}
    
    
    public function index () { 
		
		$data['page_title'] = 'Coachings';
		$data['sub_title']  = 'All Coachings';
		$data['bc'] = array ('Dashboard'=>'admin/home/dashboard');
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		
		$data['results'] = $this->coachings_model->get_all_coachings ();
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('coaching/index', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	
	public function edit ($coaching_id=0){
		$this->create($coaching_id);
	}
	
	public function create ($coaching_id=0) {	    
		
		$data['coaching'] = $coaching = $this->coachings_model->get_coaching ($coaching_id);

		$data['bc'] = array ('Coachings'=>'coachings/admin/index');
		$data['coaching_id'] = $coaching_id;
		$data['page_title'] = 'Coaching';
		if ($coaching_id > 0) {
			$data['sub_title']  = 'Edit Coaching';
		} else {
			$data['sub_title']  = 'Add Coaching';
		}

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('coaching/create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	
}