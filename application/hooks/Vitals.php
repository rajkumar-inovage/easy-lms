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
		    define ('MAX_STORAGE', $this->session->userdata ('MAX_STORAGE'));
		}
	}
	
	public function validate_session () {
		
		$module = $this->uri->segment (1, 0);
		$controller = $this->uri->segment (2, 0);
		$method = $this->uri->segment (3, 0);
		
		/* 
			For PUBLIC module login is not required, user will not be redirected to Dashboard OR Logout page
		*/
		if ($module == 'public' ) {
			// Do Nothing
		} else if (($module != '' && $controller == 'login') || ($module == '' && $controller == '')) {
			// Do Nothing
			if ($this->session->has_userdata ('is_logged_in')) {
				//$redirect = $this->session->userdata ('dashboard');
				//redirect ($redirect);
			}
		} else if ($module != '' && ($controller != 'login' && $controller != 'login_actions') && (! $this->session->has_userdata ('is_logged_in'))) {
			$this->message->set ('Your session has expired. Trying auto renew...', 'danger', true);
			$redirect = $module . '/login/validate_session';
			redirect ($redirect);
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