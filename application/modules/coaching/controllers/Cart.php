<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cart extends MX_Controller {	

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['admin/config_admin', 'coaching/config_coaching'];
	    $models = ['coaching/subscription_model', 'admin/coachings_model', 'coaching/users_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}

	public function cart_items ($coaching_id=0) {

		$data['coaching_id']= $coaching_id;
		$data['page_title'] = "Select A Plan";
		$data['bc'] 		= array ('Browse Plans'=>'coaching/subscription/browse_plans/'.$coaching_id);
		$member_id 			= intval($this->session->userdata('member_id'));		
		
		$data['plan_id'] = $plan_id	= $this->session->userdata ('cart');
		$data['plan'] 		= $this->subscription_model->subscription_plan ($plan_id);
		
		$member_id			= $this->session->userdata ('member_id');
		$data['user'] 		= $this->users_model->get_user ($member_id);	
		$data['gst_slab'] 	= $this->config->item ('gst_slab');
		
		//$data['script']			= $this->load->view (SCRIPT_PATH . 'coachings/select_plan', $data, true);
		$this->load->view(INCLUDE_PATH  . 'header', $data);
		$this->load->view('cart/cart_items', $data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
	}
	
	public function checkout ($coaching_id=0, $plan_id) {
		redirect ('coaching/subscription_actions/change_plan/'.$coaching_id.'/'.$plan_id);
	}
}