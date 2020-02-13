<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Subscription extends MX_Controller {
	
	public function __construct () { 
	    $config = ['admin'];
	    $models = ['coachings'];
	    $this->common_model->autoload_resources ($config, $models);
	}

}