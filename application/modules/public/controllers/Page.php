<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {
    
    public function __construct () {
		$config = ['login/config_login'];
	    $models = ['coaching/coaching_model'];	    
	    $this->common_model->autoload_resources ($config, $models);
	    $this->load->helper ('file');
	}

	public function create_coaching () {
		$data['page_title'] = 'Coaching Sign-Up';
		$data['logo'] = base_url ($this->config->item('system_logo'));
		$data['coaching'] = false;
		$data['script'] = $this->load->view ('scripts/create_coaching', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('create_coaching', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
}