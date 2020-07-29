 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_actions extends MX_Controller {
	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_student', 'config_course'];
		$models = ['courses_model', 'lessons_model'];
		$this->common_model->autoload_resources($config, $models);
	}
	public function buy_course($coaching_id=0, $member_id=0, $course_id=0){
		$this->courses_model->buy_course($coaching_id, $member_id, $course_id);
		$this->message->set("Course purchsed successfully.", "success", TRUE);
		redirect("student/courses/view/".$coaching_id.'/'.$member_id.'/'.$course_id);
	}
}