<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_actions extends MX_Controller {


	public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model', 'coaching/users_model'];
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
				$this->output->set_output(json_encode(array(
					'status'=>true, 
					'message'=>_AT_TEXT ('LOGIN_SUCCESSFUL', 'msg'), 
					'user_token'=>$this->session->userdata ('user_token'),
					'member_id'=>$this->session->userdata ('member_id'),
					'is_logged_in'=>$this->session->userdata ('is_logged_in'),
					'is_admin'=>$this->session->userdata ('is_admin'),
					'role_id'=>$this->session->userdata ('role_id'),
					'role_lvl'=>$this->session->userdata ('role_lvl'),
					'dashboard'=>$this->session->userdata ('dashboard'),
					'user_name'=>$this->session->userdata ('user_name'),
					'slug'=>$this->session->userdata ('slug'),
					'redirect'=>site_url($redirect),
				)));
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
	

	public function reset_link () {
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		if ($this->form_validation->run () == true) {			
			// check if email exists
			$send_to = $this->input->post ('email');
			$coaching_id = $this->input->post ('coaching_id');
			$email_exists = $this->login_model->check_registered_email ($send_to, $coaching_id);
			// $email_exists_status = $this->login_model->check_registered_email_status ($send_to);
			if ($email_exists == false) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'Cannot find that User-id/Login and Email' )));  
			} else {
				$member_details  =  $this->login_model->get_member_by_email_coaching_id ($send_to, $coaching_id);
				$coaching = $this->coachings_model->get_coaching($coaching_id );
				$slug = $coaching['coaching_url'];
				$login = $member_details['login'];
				$this->login_model->update_link_send_time($login);
				$subject = 'Change Password';
				$md5_login = md5 ($login);
				$reset_url = site_url('login/page/create_password/'.$md5_login.'/?sub='.$slug);
				$message = 'You have requested to reset your password for <b>'.SITE_TITLE.'</b> account.</p> <p>Click the button below to change it now</p> <br>'.anchor ('login/page/create_password/'.$md5_login.'/?sub='.$slug, 'Change Password', array('class'=>'btn btn-primary')).'<p>If you did not request a password reset, please ignore this email </p><br> If you are having any trouble clicking the password reset button copy-paste the url <br>'. site_url ('login/page/create_password/'.$md5_login.'/?sub='.$slug) .'<br>in your browser. </p><br><p><strong>Note: This link will expire in 48 hours.</strong></p>' ;
				
				$this->common_model->send_email ($send_to, $subject, $message);	
				
				$msg = 'We have sent an email containing instructions to change your password. If you do not get an email, you can repeat the process after a few minutes.';
				
				$this->message->set ($msg, 'success', true);
				
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>$msg, 'redirect'=>site_url('login/page/login'.'/?sub='.$slug) )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}


	public function update_password ($member_id=0) {
		$this->form_validation->set_rules ('password', 'New Password', 'required|min_length[8]trim');
		$this->form_validation->set_rules ('confirm_password', 'Confirm Password', 'required|matches[password]trim');
		if ($this->form_validation->run () == true) { 
			$member_detail = $this->users_model->get_user ($member_id);			
			$send_to = $member_detail['email'];		
			$password = $member_detail['password'];		
			$coaching_id = $member_detail['coaching_id'];
			$coaching = $this->coachings_model->get_coaching ($coaching_id);
			$this->login_model->update_password ($member_id);
			// Create password
			if ($password == '') {
				$subject = "Password Created";
				$message = 'Hi '.$member_detail['first_name'];
				$message .= "<p>Your <strong>".$coaching['coaching_name']."</strong> password has been created. You can ".anchor('login/page/login/'.$coaching_id, 'login'). " with your User-id and Password. </p>";
				$this->common_model->send_email ($send_to, $subject, $message);
				$this->message->set ('Your password has been created. You can login with your user-id and password', 'success', true);
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Password Created', 'redirect'=>site_url('login/page/login/'.$coaching_id) )));
			} else {
			// update password
				$subject = "Password Changed";
				$message = 'Hi '.$member_detail['first_name'];
				$message .= "<p>Your <strong>".$coaching['coaching_name']."</strong> password has been changed. You can ".anchor('login/page/login/'.$coaching_id, 'login'). " with your User-id and Password. </p>";
				$this->common_model->send_email ($send_to, $subject, $message);
				$this->message->set ('Your password has been changed. You can login with your user-id and password', 'success', true);
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Password Changed', 'redirect'=>site_url('login/page/login/'.$coaching_id) )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}

	public function update_session ($member_id=0, $role_id=0, $role_lvl=0, $is_logged_in=0, $is_admin=0, $user_name='', $user_token='', $dashboard='') {
		$this->session->set_userdata ('member_id', $member_id);
		$this->session->set_userdata ('role_id', $role_id);
		$this->session->set_userdata ('role_lvl', $role_lvl);
		$this->session->set_userdata ('is_admin', $is_admin);
		$this->session->set_userdata ('is_logged_in', $is_logged_in);
		$this->session->set_userdata ('user_name', $user_name);
		$this->session->set_userdata ('user_token', $user_token);
		$this->session->set_userdata ('dashboard', $dashboard);

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Session updated', 'redirect'=>site_url($dashboard) )));
	}

	public function logout () {
		$this->session->sess_destroy();
		redirect ('login/page/index');
	}
}