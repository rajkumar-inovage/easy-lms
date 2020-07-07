 <?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Courses_actions extends MX_Controller {
	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_coaching'];
		$models = ['tests_model', 'coaching_model', 'users_model', 'qb_model'];
		$this->common_model->autoload_resources($config, $models);
	}
}