<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {
    
    public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model', 'admin/coachings_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}
	
    public function index () {
    	$this->login ();
	}

    public function login () {

    	if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
			$coaching = $this->coachings_model->get_coaching_by_slug ($slug);
			if ($coaching) {
				$coaching_dir = 'contents/coachings/' . $coaching['id'] . '/';
				$coaching_logo = $this->config->item ('coaching_logo');
				$logo_path =  $coaching_dir . $coaching_logo;
				$logo = base_url ($logo_path);
				$page_title = $coaching['coaching_name'];
			} else {
				$slug = '';
	    		$logo = base_url ($this->config->item('system_logo'));
				$page_title = SITE_TITLE;
			}
    	} else {
    		$slug = '';
    		$logo = base_url ($this->config->item('system_logo'));
			$page_title = SITE_TITLE;
    	}

		$data['page_title'] = $page_title;
		$data['slug'] = $slug;
		$data['logo'] = $logo;
		
		$data['script'] = $this->load->view ('scripts/login', $data, true); 
		$this->load->view ('header', $data);
		$this->load->view ('login', $data);
		$this->load->view ('footer', $data);
    }
	
		/* Register Page */
	public function register () {

    	if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
			$coaching = $this->coachings_model->get_coaching_by_slug ($slug);
			if ($coaching) {
				$coaching_dir = 'contents/coachings/' . $coaching['id'] . '/';
				$coaching_logo = $this->config->item ('coaching_logo');
				$logo_path =  $coaching_dir . $coaching_logo;
				$logo = base_url ($logo_path);
				$page_title = $coaching['coaching_name'];				
			} else {
				$slug = '';
	    		$logo = base_url ($this->config->item('system_logo'));
				$page_title = SITE_TITLE;
			}
    	} else {    		
    		$slug = '';    		
    		$logo = base_url ($this->config->item('system_logo'));
			$page_title = SITE_TITLE;
    	}
    	if ( empty ($slug)) {
			$this->message->set ('Direct registration not allowed', 'danger', true);
			redirect ('login/page/index');    		
    	}

    	$data['page_title'] = $page_title;
		$data['slug'] = $slug;
		$data['logo'] = $logo;

		$data['bc'] = array ( 'Login'=>'login/page/login/?sub='.$slug );
		
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
	public function create_password ($user_id='', $expiry_time=''){
		if ($this->session->userdata('is_logged_in')) {
			$this->login_model->logout ();
		}
		if(time() <= $expiry_time){
			$result			=	$this->login_model->get_member_by_md5login ($user_id);
			$coaching_id	=	$result['coaching_id'];
			
			$link_send_time	=	$result['link_send_time'];
			$difference		=	time() - $link_send_time;
			if ($difference > 3600) {		// Email link is valid only for 48 hours
				echo 'This link has expired. Please '.anchor ('login/page/forgot_password', 'Try again');
			} else {
				$coaching = $this->coachings_model->get_coaching ($coaching_id );
				$data['coaching_id'] 		= $coaching_id;
				$data['coaching'] 			= $coaching;
				$data['member_id'] 			= $result['member_id'];
				$data['result'] 			= $result;
				$data['page_title'] 		= 'Create Password';
				$data['hide_left_sidebar'] 	= true;
			}
		}else{
			echo 'This link has expired. Please '.anchor ('login/page/forgot_password', 'Try again');
		}
		$slug = '';
		$logo = base_url ($this->config->item('system_logo'));
		$data['slug'] = $slug;
		$data['logo'] = $logo;
		$this->load->view( 'header', $data);
		$this->load->view( 'password', $data);
		$this->load->view( 'footer', $data);
	}
	
	/* forget password */
	public function forgot_password(){
		if ($this->session->userdata('is_logged_in')) {
			$this->login_model->logout ();
		}
		if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
			$slug = $_GET['sub'];
			$coaching = $this->coachings_model->get_coaching_by_slug ($slug);
			$data['coaching_id'] 		= $coaching['id'];
			$data['coaching'] 			= $coaching;
		}
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

	public function validate_session () {
		$data = [];
		$data['script'] = $this->load->view ('scripts/validate', $data, true);
		$this->load->view ('header', $data);
		$this->load->view ('validate', $data);
		$this->load->view ('footer', $data);
	}
}