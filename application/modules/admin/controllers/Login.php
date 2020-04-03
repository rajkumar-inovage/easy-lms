<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
    
    public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}
	
    public function index () {
    	$this->login ();
	}

    public function login () {

		$slug = '';
		$logo = base_url ($this->config->item('system_logo'));
		$page_title = SITE_TITLE;

		$data['page_title'] = $page_title;
		$data['slug'] = $slug;
		$data['logo'] = $logo;
		
		$data['script'] = $this->load->view ('login/scripts/login', $data, true); 
		$this->load->view ('login/header', $data);
		$this->load->view ('login/login', $data);
		$this->load->view ('login/footer', $data);
    }	
	
	
	 
	/* create password for new user register */
	public function create_password ($user_id=''){
		if ($this->session->userdata('is_logged_in')) {
			$this->login_model->logout ();
		}
		if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
			$coaching = $this->coachings_model->get_coaching_by_slug ($slug);
			if ($coaching) {
				$coaching_dir = 'contents/coachings/' . $coaching['id'] . '/';
				$coaching_logo = $this->config->item ('coaching_logo');
				$logo_path =  $coaching_dir . $coaching_logo;
				$logo = base_url ($logo_path);
				$page_title = 'Create Password ' . $coaching['coaching_name'];				
			} else {
				$slug = '';
	    		$logo = base_url ($this->config->item('system_logo'));
				$page_title = 'Create Password ' . SITE_TITLE;
			}
    	} else {    		
    		$slug = '';    		
    		$logo = base_url ($this->config->item('system_logo'));
			$page_title = 'Create Password ' . SITE_TITLE;
    	}
    	if ( empty ($slug)) {
			$this->message->set ('Direct registration not allowed', 'danger', true);
			redirect ('login/page/index');    		
    	}
		$result			=	$this->login_model->get_member_by_md5login ($user_id);
		$coaching_id	=	$result['coaching_id'];
		
		$link_send_time	=	$result['link_send_time'];
		$difference		=	time() - $link_send_time;
		if ($difference > 3600*48) {		// Email link is valid only for 48 hours
			echo 'This link has expired. Please '.anchor ('login/page/forgot_password', 'Try again');
		} else {
			$coaching = $this->coachings_model->get_coaching($coaching_id );
			$data['coaching_id'] 		= $coaching_id;
			$data['coaching'] 			= $coaching;
			$data['member_id'] 			= $result['member_id'];
			$data['result'] 			= $result;
			$data['hide_left_sidebar'] 	= true;
			$data['page_title'] = $page_title;
			$data['slug'] = $slug;
			$data['logo'] = $logo;
			$this->load->view( 'header', $data);
			$this->load->view( 'password', $data);
			$this->load->view( 'footer', $data);
		}
	}
	
	/* forget password */
	public function forgot_password (){
		if ($this->session->userdata('is_logged_in')) {
			$this->login_model->logout ();
		}
		if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
			$coaching = $this->coachings_model->get_coaching_by_slug ($slug);
			if ($coaching) {
				$coaching_dir = 'contents/coachings/' . $coaching['id'] . '/';
				$coaching_logo = $this->config->item ('coaching_logo');
				$logo_path =  $coaching_dir . $coaching_logo;
				$logo = base_url ($logo_path);
				$page_title = 'Forgot Password ' . $coaching['coaching_name'];
				$coaching_id = $coaching['id'];
				$data['coaching_id'] = $coaching_id;
				$data['coaching'] 			= $coaching;
			} else {
				$slug = '';
	    		$logo = base_url ($this->config->item('system_logo'));
				$page_title = 'Forgot Password ' . SITE_TITLE;
			}
    	} else {
    		$slug = '';
    		$logo = base_url ($this->config->item('system_logo'));
			$page_title = 'Forgot Password ' . SITE_TITLE;
    	}
		$data['page_title'] 		= $page_title;
		$data['slug'] = $slug;
		$data['logo'] = $logo;
		$this->load->view( 'header', $data);
		$this->load->view('forgot_password');		
		$this->load->view( 'footer', $data);
	} 

	public function logout () {
		/*
		$data['script'] = $this->load->view (SCRIPT_PATH . 'login/logout', '',true); 
		$this->load->view ('header', $data);
		$this->load->view ('footer', $data);
		*/
		$this->login_model->logout ();
		redirect ('login/page/index');
	}

	public function validate_session () {
		$data = [];
		$data['script'] = $this->load->view ('scripts/validate', $data, true);
		$this->load->view ('header', $data);
		$this->load->view ('validate', $data);
		$this->load->view ('footer', $data);
	}
}