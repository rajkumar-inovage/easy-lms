<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct () {
        $config = ['config_admin'];
        $models = ['admin/coachings_model'];
        $this->common_model->autoload_resources ($config, $models);
	}

    public function dashboard () {
		
		$data['page_title'] = 'Dashboard';
		$data['sub_title']  = 'Dashboard';

        $this->load->view (INCLUDE_PATH . 'header', $data);
		//echo 'Dashboard';
        $this->load->view (INCLUDE_PATH . 'footer');
	}
}