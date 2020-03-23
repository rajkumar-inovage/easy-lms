<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Login extends MX_Controller {
   
	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['config_student'];
	    $models = ['login_model', 'users_model'];
	    $this->common_model->autoload_resources ($config, $models);        
	}

	public function register ($coaching_id=0) { 

	}
}