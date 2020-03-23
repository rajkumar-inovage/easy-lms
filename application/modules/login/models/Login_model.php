<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    public function validate_login () {
		// this will validate if current user authentic to use resources
		// based on the received username and password
		$login		 =  $this->input->post('username');
		$password	 =  $this->input->post('password');
		$where = "(login='$login' OR adm_no='$login' OR email='$login')"; 
		$this->db->where ($where);
		$query = $this->db->get ("members");
		$row	=	$query->row_array();
		$return = array ();
		if ($query->num_rows() > 0) {
			$member_id = $row['member_id'];
			$role_id   = $row['role_id'];
			$user_name = $row['first_name'].' '.$row['second_name'].' '.$row['last_name'];
			
			// This is a valid user,  check for password
			$hashed_password = $row['password'];
			if (password_verify($password, $hashed_password)) {
				// Reset wrong passwords attempted, if any
				$this->reset_wrong_password_attempts ($member_id);
				// Generate token 
				$token = $this->generate_token ($member_id);
				if ($token) {
					// Save Token 
					$this->save_token ($member_id, $token);
					
					// Save Session 
					$session = $this->save_login_session ($member_id, $role_id, $user_name);
					$session['token'] = $token;
					// Load menus 
					$menus = $this->load_menu ($role_id, 0);					
					$return['status'] 		= LOGIN_SUCCESSFUL;
					$return['menu'] 		= $menus;
					$return['session'] 		= $session;
				} else {
					$return['status'] = LOGIN_ERROR;
				}
			} else {
				// User has input wrong password
				$wrong_attempts = $this->wrong_password_attempted ($member_id);
				if ($wrong_attempts >= MAX_WRONG_PASSWORD_ATTEMPTS) {
					$return['status'] = MAX_ATTEMPTS_REACHED;
				} else {
					$return['status'] = INVALID_PASSWORD;
				}
			} 
		} else {
			$return['status'] = INVALID_USERNAME;
		}
		return $return;
	}
	
	// Reset password attepted by a user in a day
	public function reset_wrong_password_attempts ($member_id=0) {
		$today = mktime (0, 0, 0, date ('m'), date ('d'), date ('Y'));
		$data = array ( 'member_id'=>$member_id,
						'att_date'=>$today);
		$this->db->where ($data);
		$this->db->delete ('password_attempts', $data);
	}

	// Set wrong password attepted by a user in a day
	public function wrong_password_attempted ($member_id=0) {
		$today = mktime (0, 0, 0, date ('m'), date ('d'), date ('Y'));
		$data = array ( 'member_id'=>$member_id,
						'att_date'=>$today,
					);
		$sql = $this->db->get_where ('password_attempts', $data);
		if ($sql->num_rows () > 0 ) {
			$this->db->set ('att_count', 'att_count+1');
			$this->db->where ($data);
			$this->db->update ('password_attempts');
		} else {
			$data['att_count'] = 1;
			$this->db->insert ('password_attempts', $data);
		}
	}
	
	public function generate_token ($member_id=0) {

		$this->load->library('encryption');

		$this->db->select ('member_id, login, role_id, first_name, last_name');
		$this->db->where ('member_id', $member_id);
		$sql = $this->db->get ('members');
		if ($sql->num_rows() > 0 ) {
			$row = $sql->row_array ();
			$login = $row['login']; 
			$cipher_token = $this->encryption->encrypt($login);			
			return $cipher_token; 
		} else {
			return false;
		}
	}
	
	public function save_token ($member_id=0, $token='') {
		$this->session->set_userdata ('token', $token);
	}

	public function save_login_session ($member_id=0, $role_id=0, $user_name="") {

		// Session
		$login_dt   	 = time ();
		$logout_dt  	 = "";
		$session_id 	 = "";
		$last_activity   = "";
		$ip_address   	 = $_SERVER['REMOTE_ADDR'];
		$user_agent 	 = "";
		$user_data	 	 = "";
		$status			 = "";
		$remarks		 = "";
		
		// get role details
		$this->db->where ('role_id', $role_id);
		$sql = $this->db->get ('sys_roles');			
		$roles = $sql->row_array ();			
		$role_level 	 = $roles['role_lvl'];
		$role_home  	 = $roles['dashboard'];
		$is_admin		 = $roles['admin_user'];
		
		// save login data to database			
		$this->db->insert ('login_history', array ('member_id'=>$member_id, 'login_dt'=>$login_dt, 'logout_dt'=>$logout_dt, 'session_id'=>$session_id, 'last_activity'=>$last_activity, 'ip_address'=>$ip_address, 'user_agent'=>$user_agent, 'user_data'=>$user_data, 'status'=>$status, 'remarks'=>$remarks) );
		
		// Set user's session vars 
		$options = array(
						'member_id'		=> $member_id,
						'is_admin'		=> $is_admin,	
						'user_name'		=> $user_name,
						'status'		=> $status,
						'role_id'		=> $role_id,
						'role_lvl'		=> $role_level,
						'dashboard'		=> $role_home,
						'is_logged_in'	=> true,
						);
		$profile_image = $this->config->item ('profile_picture_path') . '/pi_'.$member_id.'.gif';
		if (read_file ($profile_image)) {
			$options['profile_image'] = base_url ($profile_image);
		} else {			
			$options['profile_image'] = base_url ($this->config->item ('profile_picture_path') . '/default.png');
		}
		
		$this->session->set_userdata ($options);
		return $options;

	}

	public function load_menu ($role_id=0, $parent_id=0) {
		$menu[MENU_TYPE_SIDE_MENU] = $this->common_model->load_acl_menus ($role_id, MENU_TYPE_SIDE_MENU, $parent_id);
		$menu[MENU_TYPE_DASHBOARD] = $this->common_model->load_acl_menus ($role_id, MENU_TYPE_DASHBOARD, $parent_id);
		if ( ! empty($menu)) {
			$this->session->set_userdata ('acl_menus', $menu);
		}
		
		return $menu;
	}
	
	
	public function new_register () {
		
		$this->load->model('users/users_model');
		
		$time = time ();

		$user_data['role_id'] 		= USER_ROLE_STUDENT;
		$user_data['password'] 		= '';
		$user_data['first_name'] 	= $this->input->post('first_name');
		$user_data['last_name']  	= $this->input->post('last_name');
		$user_data['email'] 		= $this->input->post('email');
		$user_data['primary_contact'] 	= $this->input->post('primary_contact');
		$user_data['status']  		= USER_STATUS_UNCONFIRMED;
		$user_data['created_by']  	= 0;
		$user_data['creation_date'] = time ();

		$member_id = $this->users_model->create_coaching_user ($user_data);
		
		return $member_id;
	}
	

	public function logout () {
		$this->session->sess_destroy ();
		//$this->cookie->delete_cookie ();
	}
}