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
	
	// Load default settings
	public function temp_login () {
		if ( ! $this->session->has_userdata ('member_id')) {
    		$this->session->set_userdata ('member_id', 112);
		}
		if ( ! $this->session->has_userdata ('role_id')) {
    		$this->session->set_userdata ('role_id', 4);
		}
		if ( ! $this->session->has_userdata ('is_admin')) {
    		$this->session->set_userdata ('is_admin', 0);
		}
		if ( ! $this->session->has_userdata ('user_name')) {
    		$this->session->set_userdata ('user_name', 'Demo Student');
		}
		if ( ! $this->session->has_userdata ('coaching_id')) {
    		$this->session->set_userdata ('coaching_id', 1);
		}
	}
	
	// Load default settings
	public function load_acl_menu () {
		$role_id = $this->session->userdata ('role_id');
		if ( ! $this->session->has_userdata ('MAIN_MENU')) {
    		$menus = $this->common_model->load_acl_menus ($role_id);
    		$this->session->set_userdata ('MAIN_MENU', $menus);
		}
	}
	
	
}