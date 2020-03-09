<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {	

	// Set config items. This will be a one time process
	public function logout () {
		unset ($_SESSION);
		//$this->session->destroy ();
		redirect ('public/home/index');
	}

}