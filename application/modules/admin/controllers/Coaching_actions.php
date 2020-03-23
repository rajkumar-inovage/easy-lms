<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Coaching_actions extends MX_Controller {
	
	public function __construct () { 
	    $config = ['coaching/config_coaching'];
	    $models = ['coachings_model', 'coaching/users_model'];
	    $this->common_model->autoload_resources ($config, $models);

		$this->load->dbutil ();
		$this->load->dbforge ();
	} 
	
	
	public function create_account ($coaching_id=0) {
	
        $this->load->helper('string');
		
		$this->form_validation->set_rules ('coaching_name', 'Coaching Name ', 'required');
		$this->form_validation->set_rules ('city', 'City ', 'required');
		$this->form_validation->set_rules ('website', 'Website', 'valid_url');
        if ($coaching_id == 0) {
			$this->form_validation->set_rules ('coaching_url', 'Coaching URL ', 'required|is_unique[coachings.coaching_url]', ['is_unique'=>'Coaching URL is already used. Try another']);
    		$this->form_validation->set_rules ('first_name', 'First Name', 'max_length[100]|trim|ucfirst');		
    		$this->form_validation->set_rules ('last_name', 'Last Name', 'max_length[100]|trim|ucfirst');
    		$this->form_validation->set_rules ('email', 'Email', 'required|valid_email');
    		$this->form_validation->set_rules ('primary_contact', 'Contact No', 'required|is_natural|trim');
        }
        
		if ($this->form_validation->run () == true) { 
			$email = $this->input->post ('email');
			if ($coaching_id == 0 && $this->users_model->check_unique ($email, 'email')) {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'The email <strong>'.$email.'</strong> is already registered. Please provide another email.' )));
            } else {
    			$id = $this->coachings_model->create_coaching_account ($coaching_id);
    			$message = 'Coaching account created successfully. You can '.anchor ('coaching/subscription/index/'.$id, 'add subscription plan here');
    			$redirect = site_url('admin/coaching/index');
    			$this->message->set ($message, 'success', true) ;
    			$this->output->set_content_type("application/json");
    			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>$redirect)));
            }
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
	

	public function save_settings ($coaching_id=0) {
		$this->form_validation->set_rules ('coaching_name', 'Coaching Name ', 'required');
		$this->form_validation->set_rules ('address', 'Address ', 'required');
		$this->form_validation->set_rules ('city', 'City ', 'required');
		$this->form_validation->set_rules ('state', 'State ', 'required');
		$this->form_validation->set_rules ('pin', 'Pin ', 'required');
		$this->form_validation->set_rules ('website', 'Website', 'valid_url');
		
		if ($this->form_validation->run () == true) {				
			$id = $this->coachings_model->save_settings ($coaching_id);
			$message = 'Account updated successfully';
			$redirect = site_url('coachings/admin/settings');				
			$this->message->set ($message, 'success', true) ;
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>$redirect)));		
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
	/* DELETE ACCOUNT
		Function to delete existing user accounts
	*/
	public function delete_account ($coaching_id) {
		$this->coachings_model->delete_account ($coaching_id);
		$this->message->set ('Coaching account deleted successfully', 'success', true);
		redirect('coachings/admin/index');
	}
	
	/*========================================================================*/	
	public function add_plan ($coaching_id=0, $test_catid=0) {
		
		$this->form_validation->set_rules ('plan[]', 'Plans', 'required');
		$this->form_validation->set_rules ('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules ('discount', 'Discount', 'numeric');
		
		if ($this->form_validation->run () == true) {
			$this->coachings_model->add_plan ($coaching_id);
			$this->message->set ('Coaching plan updated successfully', 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Plan added successfully', 'redirect'=>site_url ('coachings/admin/plans/'.$coaching_id))));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
	
	public function upload_logo () {
		$response = $this->coachings_model->upload_logo ();
		//print_r ($response); exit;
		if (is_array($response)) {		// Upload successful
			$coaching_id = $this->session->userdata('coaching_id');
			$upload_dir = $this->config->item ('sys_dir') . 'coachings/' .$coaching_id .'/';
			$file_name = $this->config->item ('coaching_logo');
			$file_path = $upload_dir . $file_name;
			$path = base_url ($file_path);
			$this->session->set_userdata ('coaching_logo', $path);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Logo uploaded successfully', 'redirect'=>site_url('coachings/admin/settings') )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>$response )));		
		}
	}
	
	// Edit Plan
	public function edit_plan ($coaching_id=0, $plan_id=0) {
		$this->coachings_model->edit_plan ($coaching_id, $plan_id);
		$this->message->set ('Coaching plan changed successfully', 'success', TRUE);
		redirect ('coachings/admin/plans/'.$coaching_id);
	}
	
	// ENABLE USER ACCOUNT
	public function enable_plan ($coaching_id=0, $plan_id=0) {
		$this->coachings_model->enable_plan ($coaching_id, $plan_id);
		$this->message->set ('Coaching plan enabled successfully', 'success', TRUE);
		redirect ('coachings/admin/plans/'.$coaching_id);
	}
	
	// DISABLE USER ACCOUNT
	public function disable_plan ( $coaching_id=0, $plan_id=0) {
		$this->coachings_model->disable_plan ($coaching_id, $plan_id);
		$this->message->set ('Coaching plan disabled successfully', 'success', TRUE);
		redirect ('coachings/admin/plans/'.$coaching_id);
	}
	
	public function remove_plan ($coaching_id=0, $id=0) {
		$this->coachings_model->remove_plan ($coaching_id, $id);
		$this->message->set ('Coaching plan removed successfully', 'success', true);
		redirect('coachings/admin/plans/'.$coaching_id);
	}
	
	
	public function set_coaching_id ($coaching_id=0, $url='coachings/admin/plans/') {
		// Get coaching details
		if ($coaching_id > 0) {
			$this->session->set_userdata ('coaching_id', $coaching_id);
		}
		redirect ($url.$coaching_id);
	}
	public function add_to_cart ($test_catid=0, $plan_id=0,$coaching_id=0) {
		
		$this->load->library('cart');
		// check cart data
		$cart = $this->cart->contents();
		if ( ! empty ($cart)) {
			foreach ($cart as $row_id=>$row) {
				//print_r ($row);
				//foreach ($row['options'] as $opt) {
					if ($row['options']['test_catid'] == $test_catid) {
						//$this->remove_cart ($test_catid, $row_id);
					}
				//}
			}
		}
		
		//print_r ($this->cart->contents());
		
		$cat = $this->common_model->node_details ($test_catid, SYS_TREE_TYPE_TEST);
		$name = $cat['title'];
		
		$plan_id = $this->input->post ('plan');
		$plan = $this->tests_model->get_plan ($plan_id);
		$price = $plan['price'];
		$duration = $plan['duration']; 		// in months
		$data = array(
				'id'      => $plan_id,
				'qty'     => 1,
				'price'   => $price,
				'name'    => $name,
				'options' => array('Duration' => $duration . ' Months', 
								   'test_catid' => $test_catid)
		);
		
		
		/* Get Expiration Date */
		
		// Get current subscription details
		$this->db->where ('id', $plan_id);
		
		$query = $this->db->get ('subscription_plans');
		if ($query->num_rows() > 0) {
			$row = $query->row_array ();
			$et = $row['end_date'];
			if ($et < time ()) {
				// this subscription has expired, update new start and end-dates
				// Convert months to micro seconds (UNIX Timestamp)
				$st = time ();
				$end_ts = $duration * 30 * 24 * 3600;
				$et = $st + $end_ts;
			} else if ($et >= time()) {
				// this subscription is still active, add selected months to end date
				$st = $row['start_date'];
				$et = $row['end_date'];
				$end_ts = $duration * 30 * 24 * 3600;
				$et = $et + $end_ts;
			}
		} else {
			$st = time ();
			$end_ts = $duration * 30 * 24 * 3600;
			$et = $st + $end_ts;
		}
		$data['options']['start_date'] = date('d-m-Y', $st);
		$data['options']['end_date'] = date('dS F Y', $et);
		$this->cart->insert($data);
		redirect ('coachings/admin/view_cart/'.$test_catid.'/'.$plan_id.'/'.$coaching_id);
		
	}
	public function update_cart ($test_catid=0, $plan_id=0) {
		$this->load->library('cart');
		$rowids = $this->input->post ('rowid');
		$qtys   = $this->input->post ('qty');
		$data = array();
		foreach ($rowids as $i=>$row) {			
			$rowid 	= $row;
			$qty 	= $qtys[$i];
			$data['rowid'] = $rowid;
			$data['qty']   = $qty;
		}
		$this->cart->update($data);
		
		redirect ('coachings/admin/view_cart/'.$test_catid.'/'.$plan_id);
		
	}
	public function remove_cart ($test_catid=0, $rowid, $plan_id=0) {
		$this->load->library('cart');
		$data = array();
		$data['rowid'] = $rowid;
		$data['qty']   = 0;
		$this->cart->update($data);
		
		redirect ('coachings/admin/view_cart/'.$test_catid.'/'.$plan_id);
		
	}
	public function proceed_to_subscribe ($test_catid=0, $plan_id=0,$coaching_id=0) { 
		
		$this->load->library('cart');
		
		if ($plan_id == 0) {
			$plan_id = $this->session->userdata ('plan_id');
		}
		$ids = $this->input->post ('plans');
		$cat = $this->common_model->node_details ($test_catid, SYS_TREE_TYPE_TEST);
		$name = $cat['title'];
		
		foreach ($ids as $plan_id) {
			$this->subscribe_category ($test_catid, $plan_id, $coaching_id);
		}
		$this->cart->destroy ();
		$this->message->set ('You have successfully subscribed to <strong>'.$name.'</strong>', 'success', true);
		redirect ('coachings/admin/select_plan/'.$coaching_id);
		
	}
	
	
}