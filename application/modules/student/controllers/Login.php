<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Login extends MX_Controller {
   
	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['config_student', 'config_login'];
	    $models = ['coaching_model', 'login_model', 'users_model'];
	    $this->common_model->autoload_resources ($config, $models);        
	}

	public function index ($slug='') {
    	
    	if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
	    	$coaching = $this->coaching_model->get_coaching_by_slug ($slug);
			if ($coaching) {
				$coaching_dir = 'contents/coachings/' . $coaching['id'] . '/';
				$coaching_logo = $this->config->item ('coaching_logo');
				$logo_path =  $coaching_dir . $coaching_logo;				
				$logo = base_url ($logo_path);
				$page_title = $coaching['coaching_name'];

				$data['slug'] = $slug;
				$data['logo'] = $logo;
				$data['coaching_id'] = $coaching['id'];
				$data['page_title'] = $page_title;
				
				$data['bc'] = array ('Login'=>'coaching/login/index'); 
				$data['script'] = $this->load->view ('login/scripts/index', $data, true); 
				$this->load->view (INCLUDE_PATH . 'header', $data);
				$this->load->view ('login/index', $data);
				$this->load->view (INCLUDE_PATH . 'footer', $data);
			}
    	} else {
    		redirect ('coaching/login/index');
    	}
	}

    public function login ($slug='') {

    	$not_found = false;
    	$this->session->sess_destroy ();
    	if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
			$coaching = $this->coaching_model->get_coaching_by_slug ($slug);
			if ($coaching) {
				$coaching_dir = 'contents/coachings/' . $coaching['id'] . '/';
				$coaching_logo = $this->config->item ('coaching_logo');
				$logo_path =  $coaching_dir . $coaching_logo;				
				$logo = base_url ($logo_path);
				$page_title = $coaching['coaching_name'];

				$data['slug'] = $slug;
				$data['logo'] = $logo;
				$data['coaching_id'] = $coaching['id'];
				$data['page_title'] = $page_title;
				
				$data['bc'] = array ('Login'=>'coaching/login/index'); 
				$data['script'] = $this->load->view ('login/scripts/login', $data, true); 
				$this->load->view (INCLUDE_PATH . 'header', $data);
				$this->load->view ('login/login', $data);
				$this->load->view (INCLUDE_PATH . 'footer', $data);
			} else {
				$not_found = true;
			}
    	} else {
    		$not_found = true;
    	}

    	if ($not_found) {
    		redirect ('coaching/login/index');
    	}
    }	
	
	/* Register Page */
	public function register () {

		$not_found = false;

    	if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
			$coaching = $this->coaching_model->get_coaching_by_slug ($slug);
			if ($coaching) {
				$coaching_dir = 'contents/coachings/' . $coaching['id'] . '/';
				$coaching_logo = $this->config->item ('coaching_logo');
				$logo_path =  $coaching_dir . $coaching_logo;
				$logo = base_url ($logo_path);
				$page_title = $coaching['coaching_name'];				
		    	
    	    	if (isset ($_GET['role']) && ! empty ($_GET['role'])) {
    	    		$role_id = $_GET['role'];
    	    	} else {
    	    		$role_id = USER_ROLE_STUDENT;
    	    	}

		    	$data['page_title'] = $page_title;
				$data['slug'] = $slug;
				$data['logo'] = $logo;
				$data['coaching'] = $coaching;
				$data['coaching_id'] = $coaching['id'];
				$data['role_id'] = $role_id;

				$data['bc'] = array ( 'Login'=>'coaching/login/login/?sub='.$slug );
				
				$this->load->view (INCLUDE_PATH . 'header', $data);
				$this->load->view ( 'login/register', $data); 
				$this->load->view (INCLUDE_PATH . 'footer', $data);
			} else {
				$not_found = true;
			}
    	} else {
    		$not_found = true;
    	}

    	if ($not_found) {
    		$this->find_coaching ();
    	}

	}
	
	public function find_coaching () {
		$data['page_title'] = 'Found your coaching';
		$data['logo'] = base_url ($this->config->item('system_logo'));
		$data['coaching'] = false;
		$this->load->view (INCLUDE_PATH . 'header', $data);
		$this->load->view('login/find_coaching', $data);
		$this->load->view (INCLUDE_PATH . 'footer', $data);

	}

	public function install_app () {

		$not_found = false;

		if (isset ($_GET['sub']) && ! empty ($_GET['sub'])) {
    		$slug = $_GET['sub'];
			$coaching = $this->coaching_model->get_coaching_by_slug ($slug);
			if ($coaching) {
				$coaching_dir = 'contents/coachings/' . $coaching['id'] . '/';
				$coaching_logo = $this->config->item ('coaching_logo');
				$logo_path =  $coaching_dir . $coaching_logo;
				$logo = base_url ($logo_path);
				$page_title = $coaching['coaching_name'];				
		    	
    	    	if (isset ($_GET['role']) && ! empty ($_GET['role'])) {
    	    		$role_id = $_GET['role'];
    	    	} else {
    	    		$role_id = USER_ROLE_STUDENT;
    	    	}

		    	$data['page_title'] = $page_title;
				$data['slug'] = $slug;
				$data['logo'] = $logo;
				$data['coaching'] = $coaching;
				$data['coaching_id'] = $coaching['id'];
				$data['role_id'] = $role_id;

				$data['bc'] = array ( 'Login'=>'coaching/login/login/?sub='.$slug );
				
				$this->load->view (INCLUDE_PATH . 'header', $data);
				$this->load->view ( 'login/install_app', $data); 
				$this->load->view (INCLUDE_PATH . 'footer', $data);
			} else {
				$not_found = true;
			}
    	} else {
    		$not_found = true;
    	}

    	if ($not_found) {
    		$this->find_coaching ();
    	}
	}
}