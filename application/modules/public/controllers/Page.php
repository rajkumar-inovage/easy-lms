<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {
    
    public function __construct () {
		$config = [];
	    $models = ['coaching/coaching_model'];	    
	    $this->common_model->autoload_resources ($config, $models);
	    $this->load->helper ('file');
	}
	
    public function index ($slug='') {
    	if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
	    	redirect ('login/login/index/?sub='.$slug);
    	} else {
    		$this->find_coaching ($flush=true);
    	}
	}	
	 

	public function find_coaching ($flush=false) {
		$data['page_title'] = 'Find your coaching';
		$data['logo'] = base_url ($this->config->item('system_logo'));
		$data['coaching'] = false;
		$data['flush'] = $flush;
		$data['script'] = $this->load->view ('scripts/find_coachings', $data, true);
		$this->load->view('login/header', $data);
		$this->load->view('find_coaching', $data);
		$this->load->view('login/footer', $data);
	}

	public function create_coaching () {
		$data['page_title'] = 'Create A New Coaching';
		$data['logo'] = base_url ($this->config->item('system_logo'));
		$data['coaching'] = false;
		$this->load->view('login/header', $data);
		$this->load->view('create_coaching', $data);
		$this->load->view('login/footer', $data);
	}

	public function reset () {
		$this->session->sess_destroy ();
		$data['script'] = $this->load->view ('scripts/reset', [], true);
		$this->load->view ('login/header', $data);
		$this->load->view ('reset', $data);
		$this->load->view ('login/footer', $data);
	}
}