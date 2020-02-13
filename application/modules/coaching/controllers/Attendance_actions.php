<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Attendance_actions extends MX_Controller {	

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['admin/config_admin', 'coaching/config_coaching'];
	    $models = ['coaching/attendance_model', 'admin/coachings_model', 'coaching/users_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}


	/* LIST USERS
		Function to list all or selected users 
	*/	
	
	public function search_users () {
		$data = $this->attendance_model->search_users ();
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'data'=>$data)));	
	}	

	public function mark_attendance ($member_id=0, $status=0, $date=0) {
		$data = $this->attendance_model->mark_attendance ($member_id, $status, $date);
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Attendance marked')));		
	}
}