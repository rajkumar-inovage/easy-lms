<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_actions extends MX_Controller {


	public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model', 'coaching/users_model', 'coaching/coaching_model', 'coaching/settings_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}

    public function validate_login () {
	
		$this->form_validation->set_rules ('username', 'Username', 'required|trim');
		$this->form_validation->set_rules ('password', 'Password', 'required|trim');		
		$this->form_validation->set_rules ('access_code', 'Access Code', 'required|trim');		
		
		if ($this->form_validation->run () == true) {
			
			$response = $this->login_model->validate_login ();

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
					'access_code'=>$this->session->userdata ('access_code'),
					'logo'=>$this->session->userdata ('logo'),
					'profile_image'=>$this->session->userdata ('profile_image'),
					'site_title'=>$this->session->userdata ('site_title'),
					'coaching_id'=>$this->session->userdata ('coaching_id'),
					'redirect'=>site_url($redirect),
				)));
			} else if ($response['status'] == INVALID_CREDENTIALS) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('INVALID_CREDENTIALS', 'msg'))));
			} else if ($response['status'] == ACCOUNT_DISABLED) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>_AT_TEXT ('ACCOUNT_DISABLED', 'msg'))));
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
	

	public function register () {
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim', ['required'=>'Please enter your name']); 
		$this->form_validation->set_rules ('primary_contact', 'Primary Contact', 'required|is_natural|trim|max_length[14]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|trim');
		$this->form_validation->set_rules ('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules ('access_code', 'Access Code', 'required|trim', ['required'=>'Please enter your access code which you recieved from your institution']);
		 
		if ( $this->form_validation->run() == true) {
			
			$ac = $this->input->post ('access_code');
			$coaching = $this->coaching_model->get_coaching_by_slug ($ac);
			$coaching_id = $coaching['id'];
			$email 	= $this->input->post ('email');
			$contact 	= $this->input->post ('primary_contact');
			if (! $coaching) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'You have provided wrong access code' )));
			} else if ($this->users_model->contact_exists ($contact, $coaching_id) == true) {
				// Check if already exists
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'You already have an account with this mobile number. Try Sign-in instead' )));
			} else {

				$user_role = $this->input->post ('user_role');
				$status = USER_STATUS_UNCONFIRMED;

				// Get coaching settings
				$settings = $this->settings_model->get_settings ($coaching_id);
				if ($user_role == USER_ROLE_STUDENT) {
					$approve = $settings['approve_student'];
					if ($approve == 1) {
						$status = USER_STATUS_ENABLED;
					}
				} else if ($user_role == USER_ROLE_TEACHER) {
					$approve = $settings['approve_teacher'];
					if ($approve == 1) {
						$status = USER_STATUS_ENABLED;
					}
				}

				// Save user details
				$member_id = $this->users_model->save_account ($coaching_id, 0, $status);
				// Save access code 
				$this->session->set_userdata ('access_code', $ac);				
				// Get coaching details
				$coaching_name = $coaching['coaching_name'];
				$user_name = $this->input->post ('first_name');
				
				// Notification Email to coaching admin
				$to = $coaching['email'];
				$subject = 'New Registration';
					$email_message = 'A new user <strong>'.$user_name.'</strong> has registered in your coaching <strong>'.$coaching_name. '</strong>. ';
				if ($status == USER_STATUS_UNCONFIRMED) {
					$email_message .= 'Account is pending for approval. Click here for details ' . anchor ('coaching/users/index/'.$coaching_id.'/'.$user_role.'/'.USER_STATUS_UNCONFIRMED);
				} 
				$this->common_model->send_email ($to, $subject, $email_message);
			
				// Notification email to user
				$to = $this->input->post('email');
				$subject = 'Account Created';
				if ($status == USER_STATUS_UNCONFIRMED) {				
					// Email message for user
					$email_message = '<strong> Hi '.$user_name.',</strong><br>
					<p>You have created an account in <strong>'.$coaching_name.'</strong>. You can login with your registered email and password once your account is approved. You will receive another email regarding account approval.</p>';
					// Display message for user
					$message = 'Your account has been created but pending for admin approval';
					$this->message->set ($message, 'warning', true );
				} else {
					// Email message for user
					$email_message = '<strong> Hi '.$user_name.',</strong><br>
					<p>You have created an account in <strong>'.$coaching_name.'</strong>. Your account is active now. You can login with your registered email and password.</p>';
					// Display message for user
					$message = 'Your account has been created. You can log-in to your account';
					$this->message->set ($message, 'success', true );
				}
				$this->common_model->send_email ($to, $subject, $email_message);				

				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url('login/user/index')) ));
			}
	    } else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));			
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

	public function update_session ($user_token='') {

		$data = $this->login_model->get_user_token ($user_token);

		if (! $this->session->has_userdata ('member_id')) {
			$this->session->set_userdata ('member_id', $data['member_id']);
			$this->session->set_userdata ('role_id', $data['role_id']);
			$this->session->set_userdata ('role_lvl', $data['role_lvl']);
			$this->session->set_userdata ('is_admin', $data['is_admin']);
			$this->session->set_userdata ('is_logged_in', $data['is_logged_in']);
			$this->session->set_userdata ('user_name', $data['user_name']);
			$this->session->set_userdata ('user_token', $data['user_token']);
			$this->session->set_userdata ('dashboard', $data['dashboard']);
			$this->session->set_userdata ('access_code', $data['access_code']);
			$this->session->set_userdata ('logo', $data['logo']);
			$this->session->set_userdata ('coaching_id', $data['coaching_id']);
			$this->session->set_userdata ('profile_image', $data['profile_image']);
			$this->session->set_userdata ('site_title', $data['site_title']);
		}
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Success' )));
	}

	public function send_otp_request($slug=''){
		$this->output->set_content_type("application/json");
		$this->form_validation->set_rules ('userid', 'Username', 'required|trim');
		if ($this->form_validation->run () == true) {
			$userid = $this->input->post ('userid');
			$coaching_id = $this->input->post ('coaching_id');
			$expiry_minutes = 15;
			$current_time = time();
			$expiry_time = time() + (60*$expiry_minutes);
			$member_detail = $this->users_model->get_user_by_userid($userid);
			if(is_array($member_detail)){
				$member_email = $member_detail['email'];
				$member_id = intval($member_detail['member_id']);
				$last_otp = $this->login_model->get_last_otp($member_id);
				if(is_array($last_otp)){
					if($current_time <= $last_otp['otp_expiry']){
						if($this->login_model->send_otp($member_id, $member_email, $expiry_minutes)){
							$this->output->set_output(json_encode(array(
								'status'=>true,
								'message'=>'Sending Agian... Last OTP is not expired yet.',
								'redirect'=>site_url('login/login/otp_verify/'.$member_id.'/?sub='.$slug)
							)));
						}else{
							//opt sending faliled.
							$this->output->set_output(json_encode(array(
								'status'=>false,
								'code' => 1,
								'error'=>'Unable to send OTP'
							)));
						}
					}else{
						if($this->login_model->regenerate_otp($last_otp, $current_time, $expiry_time)){
							if($this->login_model->send_otp($member_id, $member_email, $expiry_minutes)){
								$this->output->set_output(json_encode(array(
									'status'=>true,
									'message'=>'An OTP has been sent to your email successfully.',
									'redirect'=>site_url('login/login/otp_verify/'.$member_id.'/?sub='.$slug)
								)));
							}else{
								//opt sending faliled.
								$this->output->set_output(json_encode(array(
									'status'=>false,
									'code' => 2,
									'error'=>'Unable to send OTP'
								)));
							}
						}else{
							//opt regeneration faliled.
							$this->output->set_output(json_encode(array(
								'status'=>false,
								'code' => 1,
								'error'=>'Unable to regenerate OTP'
							)));
						}
					}
				}else{
					if($this->login_model->generate_otp($member_id, $current_time, $expiry_time)){
						if($this->login_model->send_otp($member_id, $member_email, $expiry_minutes)){
							$this->output->set_output(json_encode(array(
								'status'=>true,
								'message'=>'An OTP has been sent to your email successfully.',
								'redirect'=>site_url('login/login/otp_verify/'.$member_id.'/?sub='.$slug)
							)));
						}else{
							//opt sending faliled.
							$this->output->set_output(json_encode(array(
								'status'=>false,
								'code' => 3,
								'error'=>'Unable to send OTP'
							)));
						}
					}else{
						//opt generation faliled.
						$this->output->set_output(json_encode(array(
							'status'=>false,
							'code' => 2,
							'error'=>'Unable to generate OTP'
						)));
					}
				}
			}else{
				$this->output->set_output(json_encode(array(
					'status'=>false,
					'code' => 404,
					'error'=>'Cannot find that User-id/Login'
				)));
			}
		} else {
			$this->output->set_output(json_encode(array(
				'status'=>false,
				'error'=>_AT_TEXT ('VALIDATION_ERROR', 'msg')
			)));
		}
	}
	public function do_otp_verification($slug=''){
		$this->output->set_content_type("application/json");
		$this->form_validation->set_rules ('otp', 'One Time Password', 'required|trim');
		if ($this->form_validation->run () == true) {
			$otp = $this->input->post ('otp');
			$member_id = $this->input->post ('member_id');
			$coaching_id = $this->input->post ('coaching_id');
			$current_time = time();
			$last_otp = $this->login_model->get_last_otp($member_id);
			if(is_array($last_otp) && !empty($last_otp)){
				if($current_time <= $last_otp['otp_expiry']){
					if($otp===$last_otp['member_otp']){
						$response = $this->login_model->auth_otp($member_id, $coaching_id, $slug);
						if ($response['status'] == LOGIN_SUCCESSFUL) {
							$this->login_model->clear_otp($member_id);
							$redirect = $this->session->userdata ('dashboard');
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
								'logo'=>$this->session->userdata ('logo'),
								'profile_image'=>$this->session->userdata ('profile_image'),
								'site_title'=>$this->session->userdata ('site_title'),
								'coaching_id'=>$this->session->userdata ('coaching_id'),
								'redirect'=>site_url($redirect),
							)));
						} else if ($response['status'] == INVALID_USERNAME) {
							$this->output->set_output(json_encode(array(
								'status'=>false,
								'error'=>_AT_TEXT ('INVALID_USERNAME', 'msg')
							)));
						}
					}else{
						$this->output->set_output(json_encode(array(
							'status'=>false,
							'error'=>'Invalid OTP! Stop doing guesses.'
						)));
					}
				}else{
					$this->output->set_output(json_encode(array(
						'status'=>false,
						'error'=>'OTP Expired! You may try Requesting another OTP.'
					)));
				}
			}else{
				$this->output->set_output(json_encode(array(
					'status'=>false,
					'error'=>'Invalid User OTP.'
				)));
			}
		} else {
			$this->output->set_output(json_encode(array(
				'status'=>false,
				'error'=>_AT_TEXT ('VALIDATION_ERROR', 'msg')
			)));
		}
	}
	public function resend_otp($member_id=0, $slug=''){
		$this->output->set_content_type("application/json");
		$expiry_minutes = 15;
		$current_time = time();
		$member_detail = $this->users_model->get_user ($member_id);
		$last_otp = $this->login_model->get_last_otp($member_id);
		$member_email = $member_detail['email'];
		if($current_time <= $last_otp['otp_expiry']){
			if($last_otp['send_attempt']<5){
				if($this->login_model->resend_otp($member_id, $member_email, $expiry_minutes)){
					$this->output->set_output(json_encode(array(
						'status'=>true,
						'message'=>'Another OTP has been sent to your email successfully.'
					)));
				}else{
					//opt sending faliled.
					$this->output->set_output(json_encode(array(
						'status'=>false,
						'code' => 1,
						'error'=>'Unable to send OTP'
					)));
				}
			}else{
				$this->output->set_output(json_encode(array(
					'status'=>false,
					'max_attempt'=>true,
					'error'=>'Reached Max attepmt! Try again after '.($expiry_minutes + 5).' minutes.'
				)));
			}
		}else{
			$this->output->set_output(json_encode(array(
				'status'=>false,
				'error'=>'Last OTP Expired! Try Requesting another OTP.'
			)));
		}
	}

	public function logout ($ac='') {
		if ($this->session->userdata ('is_admin') == true) {
			$redirect = site_url ('login/admin/index');
		} else {
			$redirect = site_url ('login/user/index/?sub='.$ac);
		}
		
		$this->session->sess_destroy ();

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'redirect'=>$redirect)));
	}
}