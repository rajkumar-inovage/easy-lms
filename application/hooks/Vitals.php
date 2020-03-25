<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vitals extends MX_Controller {


	// Load default settings
	public function load_defaults () {
		if ( ! $this->session->has_userdata('SITE_TITLE')) {			
    		$config = $this->common_model->load_defaults ();
    		$options = array ();
    		foreach ($config as $name=>$value) {
    			$name = strtoupper ($name);
    			if ( ! defined($name)) {
    				define ($name, $value);
    				$options[$name] = $value;
    			} 
    		}
    		$this->session->set_userdata ($options);
		} else {
		    define ('SITE_TITLE', $this->session->userdata ('SITE_TITLE'));
		    define ('CONTACT_EMAIL', $this->session->userdata ('CONTACT_EMAIL'));
		    define ('HOME_URL', $this->session->userdata ('HOME_URL'));
		    define ('MAX_FILE_SIZE', $this->session->userdata ('MAX_FILE_SIZE'));
		}
	}
	
	public function validate_session () {
		
		$module = $this->uri->segment (1, 0);
		$controller = $this->uri->segment (2, 0);
		$method = $this->uri->segment (3, 0);
		
		if ($module == 'public') {
			// Do Nothing
			/* 
				For PUBLIC module login is not required, user will not be redirected to Dashboard OR Logout page
			*/
		} else if ($module == '' || $module === FALSE || $module == 'login') {
			if ($method == 'logout') {
				// Do Nothing
			} else if ($this->session->userdata ('is_logged_in') == TRUE) {
				// Auto login
				$dasboard_url = $this->session->userdata ('dashboard');
				redirect ($dasboard_url);
			}
		} else if ($module != FALSE && $controller != FALSE && $method != FALSE) {
			// This should be a coaching-login
			if ($this->session->has_userdata ('is_logged_in')) {
			} else {
				$this->message->set ('Your session has expired. Login again', 'danger', true);
				redirect ('login/page/index');				
			}
		}
	}
		
	// Load default settings
	public function load_acl_menu () {
		$role_id = $this->session->userdata ('role_id');
		if ( ! $this->session->has_userdata ('MAIN_MENU')) {
    		$menus = $this->common_model->load_acl_menus ($role_id, 0, MENUTYPE_SIDEMENU);
    		$this->session->set_userdata ('MAIN_MENU', $menus);
		}
		if ( ! $this->session->has_userdata ('DASHBOARD_MENU')) {
    		$menus = $this->common_model->load_acl_menus ($role_id, 0, MENUTYPE_DASHBOARD);
    		$this->session->set_userdata ('DASHBOARD_MENU', $menus);
		}
		if ( ! $this->session->has_userdata ('FOOTER_MENU')) {
    		$menus = $this->common_model->load_acl_menus ($role_id, 0, MENUTYPE_FOOTER);
    		$this->session->set_userdata ('FOOTER_MENU', $menus);
		}
	}
	
	
}