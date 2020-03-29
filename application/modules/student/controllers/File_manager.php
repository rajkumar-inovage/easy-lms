<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_manager extends MX_Controller {

    public function __construct () {
        $config = ['config_student'];
        $models = [];
        $this->common_model->autoload_resources ($config, $models);
		
		$this->load->library('zip');
		$this->load->library('upload');
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->helper('download');
	}	
    
    public function index ($coaching_id=0, $member_id=0) {
    	if ($member_id == 0) {
    		$member_id = $this->session->userdata ('member_id');
    	}
    	if ($coaching_id == 0) {
    		$coaching_id = $this->session->userdata ('coaching_id');
    	}
		
		/*---=== Back Link ===---*/
		$data['bc'] = array ('Dashboard'=>'student/home/dashboard/'.$coaching_id);
		
		$root_access = $this->config->item ('upload_dir').'filemanager/'.$coaching_id.'/'.$member_id.'/';
		$root_thumbnails = $root_access . 'thumbnails/';

		$directory = directory_map ($root_access, 1);

		if (! $directory) {
			@mkdir ($root_access, 0755, true);
			@mkdir ($root_thumbnails, 0755, true);
		}
		
    	$data['coaching_id'] = $coaching_id;
		$data['member_id'] = $member_id;
		$data['root_access'] = $root_access;
		$data['root_thumbnails'] = $root_thumbnails;
		$data['directory'] = $directory;

		$data['page_title']  = 'My Files';

		$data['script'] = $this->load->view ('file/scripts/index', $data, true);
			
		$this->load->view ( INCLUDE_PATH  . 'header', $data);
		$this->load->view ( 'file/index', $data);
		$this->load->view ( INCLUDE_PATH  . 'footer', $data);	
    }
}
