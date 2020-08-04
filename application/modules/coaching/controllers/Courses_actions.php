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
				$redirect = 'coaching/courses/index/' . $coaching_id . '/';
			} else {
				$message = 'Course Category created successfully';
				$redirect = 'coaching/courses/index/' . $coaching_id . '/' . $cat_id;
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
			$upload_dir = $this->config->item ('upload_dir'). "coachings/$coaching_id/courses/$category_id/$course_id/";
			$upload_data = array();
			$skip_feat_img = false;
			if(isset($_FILES['feat_img'])){	
				$this->load->helper ('directory');
				$this->load->helper ('file');
				
				$map = directory_map ('./' . $upload_dir);
				if ( ! is_array ($map)) {
					@mkdir ($upload_dir, 0755, true);
				}
				
				$config['upload_path'] = './' . $upload_dir; 
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite'] = true;

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('feat_img')) {
					$upload_data = $this->upload->data();
				}
			}else{
				$skip_feat_img = true;
			}
			$feat_img = (!empty($upload_data)&&!$skip_feat_img)?$upload_dir . $upload_data['file_name']:null;
			if ($this->courses_model->add_course($coaching_id, $category_id, $course_id, $feat_img, COURSE_STATUS_ACTIVE)) {
					if ($course_id > 0) {
						$message = 'Course updated successfully';
						$redirect = 'coaching/courses/manage/' . $coaching_id.'/'.$course_id;
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
	public function toggle_course_status($coaching_id, $category_id, $course_id, $status){
		$this->courses_model->toggle_course_status($coaching_id, $category_id, $course_id, $status);
		$this->message->set("Course status changed.", "info", TRUE);
		redirect("coaching/courses/index/".$coaching_id.'/'.$category_id);
	}
	public function delete_category ($coaching_id, $category_id)	{		
		$this->courses_model->delete_course_category ($category_id);
		$this->message->set("Course Category deleted successfully", "success", TRUE);
		redirect("coaching/courses/index/".$coaching_id);
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

	public function mark_for_demo ($id=0, $data=0) {
		$this->courses_model->mark_for_demo ($id, $data);
        $this->output->set_content_type("application/json");
        $this->output->set_output(json_encode(array('status'=>true, 'message'=>'marked')));
	}

}