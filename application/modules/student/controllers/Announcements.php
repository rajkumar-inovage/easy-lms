<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Announcements extends MX_Controller {

   
	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = [ 'student/config_student'];
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
		$data['bc'] = array ('Student Dashboard'=>'student/home/dashboard/'.$coaching_id);
		$data['results'] = $this->announcements_model->get_announcements($coaching_id);
		
		/* --==// Toolbar //==-- */
	
		$this->load->view ( INCLUDE_PATH  . 'header', $data);
		$this->load->view ( 'announcements/index', $data);
		$this->load->view ( INCLUDE_PATH  . 'footer', $data);	
	}

	
   

   } 
	
   
	
	
	
	
	