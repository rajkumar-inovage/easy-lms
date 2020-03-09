<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {	

	// Set config items. This will be a one time process
	public function index () {
		echo anchor ('admin/home/dashboard', 'Admin');
		echo '<br>';
		echo anchor ('student/home/dashboard', 'Student');
	}

}
