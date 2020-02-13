<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User_actions extends MX_Controller {
	
    var $toolbar_buttons = []; 

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['admin/config_admin'];
	    $models = ['admin/coachings_model', 'coaching/users_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}
	
	/* LIST USERS
		Function to list all or selected users 
	*/	
	
	public function search_users () {
		$data = $this->users_model->search_users ();
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'data'=>$data)));	
	}

	
	// CREATE NEW ACCOUNT
	public function create_account ($coaching_id=0, $role_id=0, $member_id=0) {
		$this->form_validation->set_rules ('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules ('user_role', 'User Role', 'required');
		$this->form_validation->set_rules ('first_name', 'First Name', 'required|max_length[50]|trim|ucfirst');
		$this->form_validation->set_rules ('second_name', 'Second Name', 'max_length[50]|trim');
		$this->form_validation->set_rules ('last_name', 'Last Name', 'required|max_length[50]|trim');
		$this->form_validation->set_rules ('primary_contact', 'Primary Contact', 'is_natural|trim');
		$this->form_validation->set_rules ('batch', 'Batch Name', '');
		$this->form_validation->set_rules ('gender', 'Gender', '');	
		
		if ($this->form_validation->run () == true) {
			$coaching = $this->coachings_model->get_coaching_subscription ($coaching_id);
			$free_users = $coaching['max_users'];
			$num_users = $this->users_model->count_users (USER_STATUS_ALL, 0, 0, $coaching_id);
			if ($num_users > $free_users && $member_id == 0) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'User limit reached. You can create a maximum of '.$free_users.' user accounts in Free Subscription plan. Upgrade your plan to create more users' )));
			} else {
				
				/* Check Unique Admission No */
				$adm_no = $this->input->post ('adm_no');
				$email  = $this->input->post ('email');
				//echo $adm_no.'<br>'.$email.'<br>'.$member_id.'<br>';				
				$adm_unique		=	$this->users_model->check_unique ($adm_no, 'adm_no', $member_id);
				$email_unique	=	$this->users_model->check_unique ($email, 'email', $member_id);
				if ($adm_unique) {
					// if userid is registered with other user, show error 
					$this->output->set_content_type("application/json");
					$this->output->set_output(json_encode(array('status'=>false, 'error'=>'The user-id <strong>'.$adm_no.'</strong> is registered with another user.' )));
				/*
				} else if ($email_unique) {
					// if email is registered with other user, show error 
					$this->output->set_content_type("application/json");
					$this->output->set_output(json_encode(array('status'=>false, 'error'=>'The email <strong>'.$email.'</strong> is registered with another user' )));
				*/
				} else  {
					$id = $this->users_model->save_account($coaching_id, $member_id);
					if ($member_id > 0) {
						$message = 'Account updated successfully';
						$redirect = 'coaching/users/index/'.$coaching_id.'/'.$role_id;
					} else {
						$this->users_model->send_confirmation_email ($id);
						$message = 'Account created successfully';
						$redirect = 'coaching/users/create/'.$coaching_id.'/'.$role_id;
					}
					$this->message->set ($message, 'success', true) ;
					$this->output->set_content_type("application/json");
					$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url ($redirect))));
				}
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
	
       
	// EDIT MY ACCOUNT
	public function my_account ($member_id=0) {
	
		$this->form_validation->set_rules ('first_name', 'First Name', 'required|max_length[50]|trim|ucfirst');
		$this->form_validation->set_rules ('second_name', 'Second Name', 'max_length[50]|trim');
		$this->form_validation->set_rules ('last_name', 'Last Name', 'required|max_length[50]|trim');
		$this->form_validation->set_rules ('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules ('primary_contact', 'Primary Contact', 'is_natural|trim');
		$this->form_validation->set_rules('dob', 'Date of Birth', '');
		$this->form_validation->set_rules('gender', 'Date of Birth', '');

		if ($this->form_validation->run () == true) {
			$id = $this->users_model->save_account ($member_id);
			if ($member_id > 0) {
				$message = 'Account updated successfully';
			} else {
				$message = 'Account created successfully';
			}
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url('coaching/users/my_account/'.$member_id) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
	
	
	/* PROFILE PICTURE */
	// UPLOAD IMAGE
	public function upload_profile_picture ($member_id) {
		$response = $this->users_model->upload_profile_picture ($member_id);
		if (is_array($response)) {		// Upload successful
		    if ($member_id == $this->session->userdata ('member_id')) {
    		    $profile_image = base_url($this->config->item ('profile_picture_path').'pi_'.$member_id.'.gif');
                $this->session->set_userdata ('profile_image', $profile_image);
		    }
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Profile picture uploaded successfully', 'redirect'=>'' )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>$response )));
		}
	}
	
	// DISPLAY IMAGE AFTER UPLOAD
	public function displayprofileimage ($member_id) {
		$profile_image = $this->users_model->view_profile_image ($member_id);
	} 
	
	/* REMOVE PROFILE IMAGE	*/
	public function remove_profile_image ($member_id, $coaching_id=0 ) {
		$user = $this->users_model->get_user ($member_id);
		$this->users_model->remove_profile_image ($member_id);
		$this->message->set ('Profile image removed successfully', 'success', true);
        redirect ('coaching/users/create/'.$user['coaching_id'].'/'.$user['role_id'].'/'.$member_id);
	}
	
	
	/* CHANGE USER PASSWORD
		Function to change password of selected user
	*/
	public function change_password ($coaching_id=0, $role=0, $member_id) {		

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[50]');			
		$this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|matches[password]');
		
		if ($this->form_validation->run() == true) {
			$password = $this->input->post ('password');
			$this->users_model->update_password ($member_id, $password); 
			$this->message->set('Password changed successfully', 'success', true);
			$member_detail = $this->users_model->get_user ($member_id);				
			
			$send_to = $member_detail['email'];				
			$subject = "Password Changed";
			$message = "Your password has been changed. If you have changed your password you can ignore this mail, else contact your system administrator";
			$this->common_model->send_email($send_to, $subject, $message );
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Password changed successfully', 'redirect'=>site_url('coaching/users/index/'.$coaching_id.'/'.$role) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		} 
	} 
	
	// Send Reset PASSWORD Link
	public function send_reset_link ($coaching_id=0, $role=0, $member_id) {
		$user_details	=	$this->users_model->get_user($id);
		$new_pass_url	=	anchor('login/admin/create_password/'.md5($user_details['email']),'Reset Your Password');
		$to = $user_details['email'];
		$subject = 'Reset Your Password';				
		$email_message = '<h2> Hi '.$user_details['first_name'].' '.$user_details['second_name'].' '.$user_details['last_name'].',</h2>Welcome,<h3>'.$user_details['adm_no'].'</h3>You can now reset your password.<br>Click on the following like to create your new password<br>'.$new_pass_url.'<br>Note: This link will expire in 1 hour.';
		$this->common_model->send_email ($to, $subject, $email_message);
		$this->login_model->update_link_send_time($user_details['email']);
	}
	/* DELETE ACCOUNT
		Function to delete existing user accounts
	*/
	public function delete_account ($coaching_id, $role_id, $member_id) {
	    if ($member_id == $this->session->userdata ('member_id')) {
    		$this->message->set ('You cannot delete your own account', 'danger', true);
	    } else {
    		// Delete user account
    		$this->users_model->delete_account ($member_id);
    		$this->message->set ('Users deleted successfully', 'success', true);
    		redirect('coaching/users/index/'.$coaching_id.'/'.$role_id); 
	    }
	}
	
	public function member_log ($coaching_id=0, $role_id=0, $member_id=0, $log_id=0) {

		$this->form_validation->set_rules ('action_log', 'Action Log', 'trim|required');
		
		if ( $this->form_validation->run() == true) {
			$this->users_model->add_member_log ($log_id, $member_id);
			$this->message->set("Log added/updated successfully", "success", true);
			if ($member_id > 0) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Log updated successfully', 'redirect'=>site_url('coaching/users/member_log/'.$coaching_id.'/'.$role_id.'/'.$member_id) )));
			} else {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Log added successfully', 'redirect'=>site_url('coaching/users/member_log/'.$coaching_id.'/'.$role_id.'/'.$member_id) )));				
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		} 		
	}

	public function delete_member_log ($coaching_id=false, $role=0, $member_id=false, $log_id=false){
		$this->users_model->delete_member_log ($log_id);
		$this->message->set("Log deleted successfully.", "success", true);
		redirect ("coaching/users/member_log/".$coaching_id."/".$role.'/'.$member_id);
	}
	
	// ENABLE USER ACCOUNT
	public function enable_member ($coaching_id=0, $role=0, $member_id=0) {		
		$this->users_model->enable_user ($member_id);
		
		$member_detail = $this->users_model->get_user ($member_id);
			
		$send_to = $member_detail['email'];				
		$subject = "Account Active";
		$message = "Your account has been activated. You can  ".anchor ('', 'log-in')." to start using the system.";
		$this->common_model->send_email($send_to, $subject, $message );
		$this->message->set ('User account enabled successfully', 'success', TRUE);
		redirect ('coaching/users/index/'.$coaching_id.'/'.$role.'/'.USER_STATUS_ENABLED);
	}
	
	// DISABLE USER ACCOUNT
	public function disable_member ( $coaching_id=0, $role=0, $member_id=0) {
		if ($member_id == $this->session->userdata ('member_id')) {
			$this->message->set ('You cannot disable your own account ', 'danger', true);
			redirect ('coaching/users/index/'.$coaching_id.'/'.$role);
		}
		$this->users_model->disable_user ($member_id);
		$member_detail = $this->users_model->get_user ($member_id);
			
		$send_to = $member_detail['email'];				
		$subject = "Account Inactive";
		$message = "Your account has been disabled by system administrators. You may contact system administrators for re-activating your account.";
		
		$this->common_model->send_email($send_to, $subject, $message );
		
		$this->message->set ('Account disabled. User will not be able to login now.', 'success', TRUE);
		redirect('coaching/users/index/'.$coaching_id.'/'.$role);
	}
	
	// confirm delete/Enable-Disable
	public function confirm ($coaching_id=0, $role=0, $status=USER_STATUS_ENABLED) {
		
		$this->form_validation->set_rules ('mycheck[]', 'Users', 'required');
		$this->form_validation->set_message ('required', 'Select users before performing this action');

		if ($this->form_validation->run () == true) {
			$member_id = $this->session->userdata ('member_id');			
			$members = $this->input->post ('mycheck');
			$action = $this->input->post ('action');
			if ($action == '0') {
				$message = 'Select an action before using this button'; 
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>$message )));
			} else if ($action == 'change' || $action == 'migrate') {
				$mem_str = implode('-', $members);
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'', 'redirect'=>site_url('coaching/users/change_class/'.$coaching_id.'/'.$role.'/'.$status.'/'.$action.'/'.$mem_str) )));
			} else if ($action == 'export') {
				$this->export_to_csv ($coaching_id, $role, $members);
			} else {
				if ( ! empty ($members)) {
					$i = 1;
					foreach ($members as $id) {
						if ($action == 'delete' && $member_id <> $id) {
							$message = 'Users deleted successfully';
							$this->users_model->delete_account ($id);
						} else if ($action == 'enable') {
							$message = 'Users enabled successfully';
							$this->users_model->enable_user ($id);
						} else if ($action == 'disable') {
							$message = 'Users disabled successfully'; 
							$this->users_model->disable_user ($id);
						}
						$i++;
					}
				}
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url('coaching/users/index/'.$coaching_id.'/'.$role.'/'.$status) )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors () )));
		}
	}	
	
	public function create_batch ($coaching_id=0, $batch_id=0) {
		
		$this->form_validation->set_rules ('batch_code', 'Batch Code', 'required');
		$this->form_validation->set_rules ('batch_name', 'Batch Name', 'required');
		
		if ( $this->form_validation->run() == true)  {
			if ($batch_id > 0) {
				$message = "Batch updated successfully.";
			} else {
				$message = "Batch created successfully.";
			}
			$this->users_model->create_batch ($coaching_id, $batch_id);
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url('coaching/users/batches/'.$coaching_id) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
		
	} 
	
	public function get_batch_users ($coaching_id=0, $batch_id=0) {
		$all_users = array ();
		$batch_users = array ();
		$as = $this->users_model->get_users ($coaching_id, USER_ROLE_STUDENT);
		$bs = $this->users_model->batch_users ($batch_id);
		if ( ! empty ($as) ) {
			foreach ($as as $a) {
				$all_users[] = $a['member_id'];
			}
		}
		if ( ! empty ($bs) ) {
			foreach ($bs as $a) {
				$batch_users[] = $a['member_id'];
			}
		}
		$result = array_diff($all_users, $batch_users);
		$data['result'] = $result;
		$data['batch_id'] = $batch_id;
		$data['coaching_id'] = $coaching_id;
	}
	
	
	public function save_batch_users ($coaching_id=0, $batch_id=0) {
		
		$this->form_validation->set_rules ('users[]', 'Users', 'required');
		if ($this->form_validation->run () == true) {
			$this->users_model->save_batch_users ($batch_id);			
		} else {
		}
		$message = 'User(s) added to batch successfully';
		$this->message->set ($message, 'success', true);
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url('coaching/users/batch_users/'.$coaching_id.'/'.$batch_id.'/1') )));
	}
	
	public function remove_batch_users ($coaching_id=0, $batch_id=0, $member_id=0, $add_user=0) {
		
		$this->form_validation->set_rules ('users[]', 'Users', 'required');
		if ($this->form_validation->run () == true) {
			$users = $this->input->post ('users');
			foreach ($users as $member_id) {
				$this->users_model->remove_batch_user ($batch_id, $member_id);
			}
		} else {
			$this->users_model->remove_batch_user ($batch_id, $member_id);			
		}
		$this->message->set ('User(s) removed from batch successfully', 'success', true);
		redirect ('coaching/users/batch_users/'.$coaching_id.'/'.$batch_id.'/'.$add_user);
	}
	

	public function remove_batch_user ($coaching_id=0, $batch_id=0, $member_id=0, $add_user=0) {
		$this->users_model->remove_batch_user ($batch_id, $member_id);
		$this->message->set ('User removed from batch successfully', 'success', true);
		redirect ('coaching/users/batch_users/'.$coaching_id.'/'.$batch_id.'/'.$add_user);
	}
	
	public function delete_batch ($coaching_id=0, $batch_id=0) {
		$this->users_model->delete_batch ($batch_id);
		redirect ('coaching/users/batches/'.$coaching_id);
	}
	
	
	/* 
		IMPORT CSV USERS
		Function to import users from csv file
	*/
	public function import_from_csv ($coaching_id=0, $role_id=USER_ROLE_STUDENT) {
		$this->load->helper ('directory');
		$this->load->helper ('file');
		$member_id = $this->session->userdata ('member_id');
		
		$upload_dir = $this->config->item ('upload_dir'). 'temp/' . $member_id . '/';
		$temp_upload = directory_map ('./' . $upload_dir);
		if ( ! is_array ($temp_upload)) {
			@mkdir ($upload_dir, 0755, true);
		}
		
		$config['upload_path'] = './' . $upload_dir; 
		$config['allowed_types'] = 'csv';
		$config['overwrite'] = true;
 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload()) {
			$errors = $this->upload->display_errors();
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>$errors )));
		} else {
			$upload_data = $this->upload->data();
			$file = $upload_dir . $upload_data['file_name'];
			//$get_file = file ($file, FILE_SKIP_EMPTY_LINES);
			$get_file = read_file ($file);
			$i = 0;
			$count_error = 0;
			if (($handle = fopen (base_url($file), "r")) !== FALSE) {
				while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
					
					$users['sr_no'] 			=  (trim($row[0]));
					$users['email'] 			=  (trim($row[1]));
					$users['first_name'] 		=  (trim($row[2]));
					$users['second_name'] 		=  (trim($row[3]));
					$users['last_name'] 		=  (trim($row[4]));
					$users['dob'] 				=  (trim($row[5]));
					$users['gender'] 			=  (trim($row[6]));
					$users['address'] 			=  (trim($row[7]));
					$users['postal'] 			=  (trim($row[8]));
					$users['city'] 				=  (trim($row[9]));
					$users['province'] 			=  (trim($row[10]));
					$users['country'] 			=  (trim($row[11]));
					$users['primary_contact'] 	=  (trim($row[12]));
					$users['mobile'] 			=  (trim($row[13]));
					$users['fax'] 				=  (trim($row[14]));

					
					if ($i > 0) {
						if ($users['email'] == '' || $users['first_name'] == '' || $users['last_name'] == '') {
							$count_error++;
						} else {
							$this->users_model->upload_users_csv ($coaching_id, $role_id, $users);
							$this->output->set_content_type("application/json");
							$this->output->set_output(json_encode(array('status'=>true, 'message'=>$i . ' users uploaded successfully. '.$count_error. ' records were skipped due to insufficient data.', 'redirect'=>site_url('coaching/users/index/'.$coaching_id.'/'.$role_id) )));
						}
					}
					$i++;
				}
			}
			
		}
		
	}
	
	
	public function export_to_csv ($coaching_id=0, $role_id=USER_ROLE_STUDENT, $members=array()) {
		
		// Load the DB utility class
		$this->load->dbutil();

		// Get list of selected users from database
		$data = $this->users_model->export_to_csv ($coaching_id, $role_id, $members);

		// Covert result into CSV
		$csv_data = $this->dbutil->csv_from_result ($data);

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		$temp_dir = $this->config->item ('temp_dir');
		$filename = 'UsersList'.date('Ymd').'.csv'; 
		$file = $temp_dir . $filename;
		//write_file($file, $csv_data);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download($filename, $csv_data);		

	}
	
	

	public function send_confirmation_email ($member_id=0) {
	
		$this->users_model->send_confirmation_email ($member_id);
		$this->message->set ('Email sent for verification', 'success') ;
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'message'=>'An email has been sent on registered user email to self-create password', 'redirect'=>'')));
	}
}