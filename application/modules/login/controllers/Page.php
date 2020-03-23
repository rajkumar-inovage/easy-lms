<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {
    
    public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model', 'admin/coachings_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}
	
    public function index ($coaching_slug='') {

	}

    public function login ($coaching_slug='') {

		$data['coaching_slug'] = $coaching_slug;
		$coaching = $this->coachings_model->get_coaching_by_slug ($coaching_slug);
		$data['coaching_name'] = $coaching['coaching_name'];

		$sys_dir = $this->config->item ('sys_dir');
		$coaching_dir = 'coachings/' . $coaching['id'] . '/';
		$logo = $this->config->item ('coaching_logo');
		$logo_path = $sys_dir . $coaching_dir . $logo;
		$data['coaching_logo'] = base_url ($logo_path);
		
		//$data['script'] = $this->load->view ('scripts/index', $data, true); 
		$this->load->view ('header', $data);
		$this->load->view ('login', $data);
		$this->load->view ('footer', $data);
    }
	
		/* Register Page */
	public function register ($coaching_id=0) {

		$this->login_model->logout ();
		$coaching = $this->login_model->get_coaching_name ($coaching_id );
		$data['coaching_id'] = $coaching_id;
		$data['coaching'] = $coaching;
		$data['page_title'] = "Register";
		$data['show_header'] = false;
		$data['show_sidebar'] = false;
		$data['bc'] = array ( 'Login'=>'login/page/login' );
		
		$this->load->view ( 'header', $data); 
		$this->load->view ( 'register', $data); 
		$this->load->view ( 'footer', $data); 
	}
	
	/* Change Password Page */
	public function change_password ($md5_login='') {		
		
		$this->login_model->logout ();
		
		$data['page_title'] = "Create New Password";
		
		$data['details'] = $result = $this->login_model->get_member_by_md5login ($md5_login);		
		if ($result) {
			$data['member_id'] = $result['member_id'];
			$data['md5_login'] = $md5_login;
			$link_send_time	=	$result['link_send_time'];
			$diffrence	=	time() - $link_send_time;		
			if ($diffrence > 3600) {
				echo 'This link has expired. Please '.anchor ('login/page/forgot_pasword', 'Try again');
			} else {			
				$this->load->view ( 'header', $data); 
				$this->load->view( 'password', $data);						
				$this->load->view ( 'footer', $data); 
			}
		} else {
			echo 'Invalid request!';
		}
	}
	 
	/* create password for new user register */
	public function create_password ($user_id=''){
		
		if ($this->session->userdata('is_logged_in')) {
			$this->login_model->logout ();
		}

		$result			=	$this->login_model->get_member_by_md5login ($user_id);
		$coaching_id	=	$result['coaching_id'];
		
		$link_send_time	=	$result['link_send_time'];
		$difference		=	time() - $link_send_time;
		if ($difference > 3600) {		// Email link is valid only for 48 hours
			echo 'This link has expired. Please '.anchor ('login/page/forgot_password', 'Try again');
		} else {
			$coaching = $this->login_model->get_coaching_name ($coaching_id );
			$data['coaching_id'] 		= $coaching_id;
			$data['coaching'] 			= $coaching;
			$data['member_id'] 			= $result['member_id'];
			$data['result'] 			= $result;
			$data['page_title'] 		= 'Create Password';
			$data['hide_left_sidebar'] 	= true;
			
			$this->load->view( 'header', $data);
			$this->load->view( 'password', $data);
			$this->load->view( 'footer', $data);
		}
	}
	
	/* forget password */
	public function forgot_password($coaching_id=0){
		$this->login_model->logout ();
		$coaching = $this->login_model->get_coaching_name ($coaching_id );
		$data['coaching_id'] 		= $coaching_id;
		$data['coaching'] 			= $coaching;
		$data['page_title'] 		= 'Forgot Password';

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
}