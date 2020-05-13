<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_actions extends MX_Controller {


	public function __construct () {
		$config = ['config_login'];
	    $models = ['login_model', 'coaching/users_model', 'coaching/coaching_model', 'coaching/settings_model'];
	    $this->common_model->autoload_resources ($config, $models);
	    $this->load->helper ('string');
	}

    public function validate_login ($admin_login=false) {
	
		$this->form_validation->set_rules ('username', 'Username', 'required|trim');
		$this->form_validation->set_rules ('password', 'Password', 'required|trim');
		if ($admin_login == false) {
			$this->form_validation->set_rules ('access_code', 'Access Code', 'required|trim');
		}
		
		if ($this->form_validation->run () == true) {
			
			$response = $this->login_model->validate_login ($admin_login);

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

	public function reset_password () {
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric|max_length[15]|trim');
		$this->form_validation->set_rules('access_code', 'Access Code', 'required|trim');

		if ($this->form_validation->run () == true) {
			// check if contact exists
			$contact = $this->input->post ('mobile');
			$access_code = $this->input->post ('access_code');
			$coaching = $this->coaching_model->get_coaching_by_slug ($access_code);
			$user = $this->users_model->coaching_contact_exists ($contact, $coaching['id']);
			if ($user == false) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'Please check your mobile number/access code and try again') ));
			} else {
				$password = $this->login_model->reset_password ($user['member_id']);
				$data['coaching_name'] = $coaching['coaching_name'];
				$data['otp'] = $password;

				// Send SMS
				$message = $this->load->view (SMS_TEMPLATE . 'reset_password', $data, true);
				$this->sms_model->send_sms ($contact, $message);
				
				// Send Email
				if ($user['email'] != '') {
					$email = $user['email'];
					$subject = 'OTP';
					$message = $this->load->view (EMAIL_TEMPLATE . 'reset_password', $data, true);
					$this->common_model->send_email ($email, $subject, $message);					
				}				
				
				// Display Message
				$msg = 'We have sent OTP on your mobile and email. Use the OTP to sign-in to your account';
				
				$this->message->set ($msg, 'success', true);
				
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>$msg, 'redirect'=>site_url('login/user/index') )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}

	public function get_access_code () {
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric|max_length[15]|trim');

		if ($this->form_validation->run () == true) {
			// check if contact exists
			$contact = $this->input->post ('mobile');
			$user = $this->users_model->contact_exists ($contact);
			if ($user == false) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'This mobile number is not registered with any coaching' )));
			} else {
				$sms_msg = '';
				$email_msg = '';
				$send_email = false;
				foreach ($user as $row) {

					$data = [];
					$coaching = $this->coaching_model->get_coaching ($row['coaching_id']);
					$data['coaching_name'] = $coaching['coaching_name'];
					$data['access_code'] = $coaching['reg_no'];
					
					// Send SMS
					$sms_msg .= $this->load->view (SMS_TEMPLATE . 'get_access_code', $data, true);
					
					// Send Email
					if ($row['email'] != '') {
						$email = $row['email'];
						$subject = 'Access Code';
						$email_msg .= $this->load->view (EMAIL_TEMPLATE . 'get_access_code', $data, true);
						$send_email = true;
					}					
				}
				
				$this->sms_model->send_sms ($contact, $sms_msg);
				if ($send_email == true) {
					$this->common_model->send_email ($email, $subject, $email_msg);
				}

				// Display Message
				$msg = 'We have sent Access Code on your mobile and email';
				
				$this->message->set ($msg, 'success', true);
				
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>$msg, 'redirect'=>site_url('login/user/index') )));
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

			$this->login_model->load_menu ($data['role_id']);
		}

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Success' )));
	}

	public function logout ($ac='') {
		if ($this->session->userdata ('is_admin') == true) {
			$redirect = site_url ('login/admin/index');
		} else {
			if ($ac == '' || $ac == 'undefined') {
				$redirect = site_url ('login/user/index');
			} else {
				$redirect = site_url ('login/user/index/?sub='.$ac);				
			}
		}
		
		$this->session->sess_destroy ();

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'redirect'=>$redirect)));
	}
}