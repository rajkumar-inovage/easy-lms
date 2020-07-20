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
	public function create_edit_action($coaching_id=0, $category_id=0, $course_id=0) {
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		if ($this->form_validation->run() == true) {
			if ($this->courses_model->add_course($coaching_id, $category_id, $course_id, COURSE_STATUS_ACTIVE)) {
				if ($course_id > 0) {
					$message = 'Course updated successfully';
					$redirect = 'coaching/courses/index/' . $coaching_id;
				} else {
					$message = 'Course created successfully';
					$redirect = 'coaching/courses/index/' . $coaching_id;
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
	public function delete($coaching_id, $category_id, $course_id)	{		
		$this->courses_model->delete_course ($course_id);
		$this->message->set("Course deleted successfully", "success", TRUE);
		redirect("coaching/courses/index/".$coaching_id.'/'.$category_id);
	}
	public function assign_teachers($coaching_id = 0, $course_id = 0){
		$this->form_validation->set_rules('users[]', 'Users', 'required');
		if ($this->form_validation->run() == true) {
			if ($this->courses_model->add_teachers_assignment($coaching_id, $course_id)) {
				$message = 'Teacher assigned to this Course successfully';
				$redirect = "coaching/courses/teachers/$coaching_id/$course_id/".TEACHERS_ASSIGNED;
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
	public function assign_teacher($coaching_id = 0, $course_id = 0, $member_id = 0){
		$this->courses_model->add_teacher_assignment($coaching_id, $course_id, $member_id);
		$this->message->set("Teacher assigned to this course successfully", "success", TRUE);
		redirect("coaching/courses/teachers/".$coaching_id.'/'.$course_id.'/'.TEACHERS_ASSIGNED);
	}
	public function unassign_teachers($coaching_id = 0, $course_id = 0){
		$this->form_validation->set_rules('users[]', 'Users', 'required');
		if ($this->form_validation->run() == true) {
			if ($this->courses_model->remove_teachers_assignment($coaching_id, $course_id)) {
				$message = 'Teacher assignment removed from this course successfully.';
				$redirect = "coaching/courses/teachers/$coaching_id/$course_id/".TEACHERS_ASSIGNED;
				$this->message->set($message, 'info', true);
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
	public function unassign_teacher($coaching_id = 0, $course_id = 0, $member_id = 0){
		$this->courses_model->remove_teacher_assignment($coaching_id, $course_id, $member_id);
		$this->message->set("Teacher assignment removed from this course successfully", "info", TRUE);
		redirect("coaching/courses/teachers/".$coaching_id.'/'.$course_id.'/'.TEACHERS_ASSIGNED);
	}
}