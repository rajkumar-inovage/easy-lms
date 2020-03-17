<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

<<<<<<< HEAD
    public function __construct () {
        $config = ['config_admin'];
        $models = [];
        $this->common_model->autoload_resources ($config);
	}

=======
	public function __construct () {
        $config = ['config_admin'];
<<<<<<< HEAD
        $models = [];
        $this->common_model->autoload_resources ($config);
	}
    
=======
        $models = ['admin/coachings_model'];
        $this->common_model->autoload_resources ($config, $models);
	}

>>>>>>> eadc9a36944e23862708622d9a6aeca402ea609b
>>>>>>> 3e46ec3f1dcafa4f1d9657094c5dfdd94aad7f76
    public function dashboard () {
		
		$data['page_title'] = 'Dashboard';
		$data['sub_title']  = 'Dashboard';

        $this->load->view (INCLUDE_PATH . 'header', $data);
		//echo 'Dashboard';
        $this->load->view (INCLUDE_PATH . 'footer');
	}
}