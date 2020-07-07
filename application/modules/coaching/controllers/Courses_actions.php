 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_actions extends MX_Controller {
	public function __construct() {
		// Load Config and Model files required throughout Users sub-module
		$config = ['config_course'];
		$models = ['tests_model', 'coaching_model', 'users_model', 'qb_model', 'courses_model'];
		$this->common_model->autoload_resources($config, $models);
	}
	public function category_action($coaching_id, $category_id = 0) {
		$this->form_validation->set_rules('title', 'Title', 'required');
		if ($this->form_validation->run() == true) {
			$cat_id = $this->courses_model->add_course_category($coaching_id, $category_id, CATEGORY_STATUS_ACTIVE);
			if ($category_id > 0) {
				$message = 'Course Category updated successfully';
				$redirect = 'coaching/courses/create/' . $coaching_id . '/' . $category_id;
			} else {
				$message = 'Course Category created successfully';
				$redirect = 'coaching/courses/create/' . $coaching_id . '/' . $cat_id;
			}
			$this->message->set($message, 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(
				json_encode(
					array(
						'status' => true,
						'message' => $message,
						'redirect' => site_url($redirect),
					)
				)
			);
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(
				json_encode(
					array(
						'status' => false,
						'error' => validation_errors(),
					)
				)
			);
		}
	}
	public function create_edit_action($coaching_id, $category_id = 0, $course_id = 0) {
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		if ($this->form_validation->run() == true) {
			if ($this->courses_model->add_course($coaching_id, $category_id, $course_id, COURSE_STATUS_ACTIVE)) {
				if ($course_id > 0) {
					$message = 'Course updated successfully';
				} else {
					$message = 'Course created successfully';
				}
				$this->message->set($message, 'success', true);
				$this->output->set_content_type("application/json");
				$this->output->set_output(
					json_encode(
						array(
							'status' => true,
							'message' => $message,
						)
					)
				);
			} else {
				$this->output->set_content_type("application/json");
				$this->output->set_output(
					json_encode(
						array(
							'status' => false,
							'error' => "<p>Oops!.. Something went wrong.</p><p>Unable to complete the operation.</p>",
						)
					)
				);
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(
				json_encode(
					array(
						'status' => false,
						'error' => validation_errors(),
					)
				)
			);
		}
	}
}