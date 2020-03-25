<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends MX_Controller {
    var $autoload = array ();
	public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model', 'admin/coachings_model', 'coaching/users_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}
    public function validate_login ($slug='') {		
	
		$this->form_validation->set_rules ('username', 'Username', 'required|trim');
		$this->form_validation->set_rules ('password', 'Password', 'required|trim');		
		
		if ($this->form_validation->run () == true) {
			$user_name = $this->input->post ('username');
			$password = $this->input->post ('password');
			$response = $this->login_model->validate_login ($user_name, $password, $slug);
			if ($response['status'] == LOGIN_SUCCESSFUL) {
				$redirect = $this->session->userdata ('dashboard');
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>_AT_TEXT ('LOGIN_SUCCESSFUL', 'msg'), 'redirect'=>site_url($redirect)) ));
			} else if ($response['status'] == INVALID_CREDENTIALS) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('INVALID_CREDENTIALS', 'msg'))));
			} else if ($response['status'] == MAX_ATTEMPTS_REACHED) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('MAX_ATTEMPTS_REACHED', 'msg'))));
			} else if ($response['status'] == INVALID_PASSWORD) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('INVALID_PASSWORD', 'msg'))));
			} else if ($response['status'] == INVALID_USERNAME) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('INVALID_USERNAME', 'msg'))));
			} else {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('LOGIN_ERROR', 'msg'))));
			}
			/*
			echo 'Good';
			*/
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('VALIDATION_ERROR', 'msg') )));			
			/*
			echo 'Bad';
			*/
		}
	}
	public function register ($slug='') {
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim'); 
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim'); 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules ('primary_contact', 'Primary Contact', 'is_natural|trim|max_length[10]');		
		$this->form_validation->set_rules ('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules ('confirm_password', 'Confirm Password', 'required|matches[password]');
		 
		if ( $this->form_validation->run() == false) {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));			
	    } else {			
			$coaching = $this->coachings_model->get_coaching_by_slug ($slug);
			$member_id = $this->users_model->save_account ($coaching['id']);
			$user = $this->users_model->get_user ($member_id);
			
			$coaching_name = $coaching['coaching_name'];
			$user_name = $this->input->post ('first_name');
			
			// Notification Email to coaching admin
			$to = $coaching['email'];
			$subject = 'New User Registration';
			$email_message = 'A new user <strong>'.$user['first_name'].'</strong> has registered in your coaching <strong>'.$coaching_name. '</strong>. Please approve the account.';
			$this->common_model->send_email ($to, $subject, $email_message);
		
			// Notification email to user
			$user_id = $user['adm_no'];
			$to = $this->input->post('email');
			$subject = 'Account Created';
			$email_message = '<strong> Hi '.$user['first_name'].',</strong><br>
			<p>You have created an account in <strong>'.$coaching_name.'</strong>. Your Login-Id is <strong>'.$user_id.'</strong><br>. You will need both Login-id and password to login.</p>';
			$this->common_model->send_email ($to, $subject, $email_message);
			
			// Message for user
			$message = 'Your account has been created successfully';
			$this->message->set ($message, 'success', true );

			// Auto Login
			$password = $this->input->post ('password');
			$response = $this->login_model->validate_login ($user_id, $password);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>_AT_TEXT ('LOGIN_SUCCESSFUL', 'msg'), 'redirect'=>site_url('student/home/dashboard/'.$coaching['id'].'/'.$member_id)) ));
		}
	}
	public function reset_link () {
		$this->form_validation->set_rules('userid', 'User Id', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		if ($this->form_validation->run () == true) {			
			// check if email exists
			$send_to = $this->input->post ('email');
			$login = $this->input->post ('userid');
			$email_exists = $this->login_model->check_registered_email ($send_to, $login);
			// $email_exists_status = $this->login_model->check_registered_email_status ($send_to);
			if ($email_exists == false) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'Cannot find that User-id/Login and Email' )));  
			} else {
				$member_details  =  $this->login_model->get_member_by_login ($login);
				$this->login_model->update_link_send_time($login);
				$subject = 'Change Password';
				$expiry_time = time() + 60*60;
				$md5_login = md5 ($login);
				$md5_expiry_time = md5($expiry_time);
				$reset_url = site_url('login/page/create_password/'.$md5_login.'/'.$expiry_time);
				$message = 'You have requested to reset your password for <b>'.SITE_TITLE.'</b> account.</p> <p>Click the button below to change it now</p> <br>'.anchor ('login/page/create_password/'.$md5_login.'/'.$expiry_time, 'Change Password', array('class'=>'btn btn-primary')).'<p>If you did not request a password reset, please ignore this email </p><br> If you are having any trouble clicking the password reset button copy-paste the url <br>'. site_url ('login/page/create_password/'.$md5_login.'/'.$expiry_time) .'<br>in your browser. </p><br><p><strong>Note: This link will expire in 1 hour.</strong></p>' ;
				
				$this->common_model->send_email ($send_to, $subject, $message);	
				
				$msg = 'We have sent an email containing instructions to change your password. If you do not get an email, you can repeat the process after a few minutes.';
				
				$this->message->set ($msg, 'success', true);
				
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>$reset_url, 'redirect'=>site_url('login/page/login') )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
}