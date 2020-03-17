<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Announcements extends MX_Controller {

    var $toolbar_buttons = []; 

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = [ 'coaching/config_coaching'];
	    $models = ['announcements_model'];

	    $this->common_model->autoload_resources ($config, $models);
	    
        $cid = $this->uri->segment (4);
        
        // Security step to prevent unauthorized access through url
        if ($this->session->userdata ('is_admin') == TRUE) {
        } else {
            if ($this->session->userdata ('coaching_id') <> $cid) {
                //$this->message->set ('Direct url access not allowed', 'danger', true);
                //redirect ('coaching/home/dashboard');
            }
        }
	}
	public function index ($coaching_id=0, $status=0) { 

		$data['coaching_id'] = $coaching_id;
		$data['page_title']  = 'Announcements';

		
		/*---=== Back Link ===---*/
		$data['bc'] = array ('Coaching Dashboard'=>'coaching/home/dashboard/'.$coaching_id);
		$data['results'] = $this->announcements_model->get_announcements($coaching_id);
		
		/* --==// Toolbar //==-- */
		$data['toolbar_buttons'] = $this->toolbar_buttons;
	
		$this->load->view ( INCLUDE_PATH  . 'header', $data);
		$this->load->view ( 'announcements/index', $data);
		$this->load->view ( INCLUDE_PATH  . 'footer', $data);	
	}

	public function create_announcement () {

		$data['bc'] = array ('Coaching Dashboard'=>'coaching/home/dashboard/');
		/*Check submit button */
		if($this->input->post('submit'))
		{
		$coaching_id=$this->input->post('coaching_id');
		$title=$this->input->post('title');
		$description=$this->input->post('description');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$status=$this->input->post('status');
		$created_by=$this->input->post('created_by');
		
		
		$this->announcements_model->create_announcement($coaching_id,$title,$description,$start_date,$end_date,$status,$created_by);	
		echo "Records Saved Successfully";
		}
		/*load registration view form*/
		$this->load->view ( INCLUDE_PATH  . 'header', $data);
		$this->load->view ( 'announcements/create_announcement');
		$this->load->view ( INCLUDE_PATH  . 'footer', $data);
	}
	
   

   } 
	
   
	
	
	
	
	
