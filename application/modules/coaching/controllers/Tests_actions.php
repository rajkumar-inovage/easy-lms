<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tests_actions extends MX_Controller {	

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['admin/config_admin', 'coaching/config_coaching'];
	    $models = ['coaching/tests_model', 'admin/coachings_model', 'coaching/users_model' ,'coaching/qb_model'];
	    $this->common_model->autoload_resources ($config, $models);
	}


	/*-----===== Test Categories =====-----*/
	public function add_category ($coaching_id=0, $category_id=0) {

		$this->form_validation->set_rules ('title', 'Title', 'required');

		if ($this->form_validation->run () == true) {
			$id = $this->tests_model->create_category ($coaching_id, $category_id);
			if ($category_id > 0) {
				$message = 'Category updated successfully';
				$redirect = 'coaching/tests/categories/'.$coaching_id;
			} else {
				$message = 'Category created successfully';
				$redirect = 'coaching/tests/categories/'.$coaching_id;
			}
			$this->message->set ($message, 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>$message, 'redirect'=>site_url ($redirect) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}	    
	}
	
	// Delete Test Plan
	public function remove_category ($coaching_id=0, $category_id=0) {
		// Check if this plan is given to any coaching
		$this->tests_model->remove_category ($coaching_id, $category_id);
		$this->message->set ('Category deleted successfully', 'success', true);
		redirect ('coaching/tests/categories/'.$coaching_id);
	}
	

    public function search_tests ($coaching_id=0) {
		$data = $this->tests_model->search_tests ($coaching_id);
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'data'=>$data)));
	}
	
	public function create_test ($coaching_id=0, $category_id=0, $test_id=0) {

		$this->form_validation->set_rules ('title', 'Title', 'required|trim');
		$this->form_validation->set_rules ('pass_marks', 'Passing Percentage', 'required|trim|less_than[100]');
		$this->form_validation->set_rules ('time_min', 'Test Duration', 'required|trim');
//		$this->form_validation->set_rules ('test_type', 'Test Type', 'required');
//		$this->form_validation->set_rules ('test_mode', 'Test Mode', 'required');
		if ( $this->form_validation->run () == true )  {
			$id = $this->tests_model->create_test ($coaching_id, $category_id, $test_id);
			$redirect = 'coaching/tests/manage/'.$coaching_id.'/'.$category_id.'/'.$id;
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Test created successfully.', 'redirect'=>site_url($redirect) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		} 
	}
	
	
	public function set_method ($category_id=0, $test_id=0, $method=0) {
		$this->tests_model->set_method ($test_id, $method);
		if ($method == TEST_ADDQ_QB) {
			redirect('coaching/tests/add_test_questions/'.$category_id.'/'.$test_id);
		} elseif ($method == TEST_ADDQ_CREATE) {
			redirect('coaching/tests/question_group_create/'.$category_id.'/'.$test_id);			 
		} elseif ($method == TEST_ADDQ_UPLOAD) {
			redirect('coaching/tests/upload_test_questions/'.$category_id.'/'.$test_id);			 
		} else {
			redirect('coaching/tests/select_method/'.$category_id.'/'.$test_id);
		}
	}

	public function save_test_questions ($category_id=0, $test_id=0, $lesson_id=0, $cat_ids=0, $diff_ids=0, $exclude=0) {
		
		//print_r ($this->input->post ()); exit;
		$this->form_validation->set_rules ('mycheck[]', 'Questions', 'required');
		$this->form_validation->set_message ('required', 'You must select question(s) before using this button');
		
		if ($this->form_validation->run() == true) {
			$questions = $this->input->post ('mycheck');
			foreach ($questions as $id ) {
				// we dont save question headings (if selected)
				$q = $this->qb_model->getQuestionDetails ($id);
				if ( $q['parent_id'] > 0 ) {
					$this->tests_model->saveQuestionsSimple($id, $test_id);
				}
			}
			$this->message->set ("Questions added to test. Select a lesson to add more questions.", 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Questions added successfully.', 'redirect'=>site_url('coaching/tests/add_test_questions/'.$category_id.'/'.$test_id.'/'.$lesson_id.'/'.$cat_ids.'/'.$diff_ids.'/'.$exclude) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
		
	}
	
	/* 
	// 	Remove Multiple Test Question
	*/
	public function remove_questions ($category_id=0, $test_id=0) {
		
		$this->form_validation->set_rules ('questions[]', 'Question', 'required');
		
		if ($this->form_validation->run () == true) {
			$i = 0;
			$questions = $this->input->post ('questions');
			foreach ($questions as $id) {
				$this->tests_model->deleteTestQuestion ($test_id, $id);
				$this->qb_model->delete_questions ($id);
				$i++;
			}
			$this->message->set ("<strong>$i</strong> Question(s) removed from test.", 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Question(s) removed successfully from test.', 'redirect'=>site_url('coaching/tests/preview_test/'.$category_id.'/'.$test_id) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>'Select Questions To Delete' )));	
		}
	}
	
	
	// Remove Individual Questions
	public function remove_question ($category_id=0, $test_id=0, $id=0, $lesson_id=0, $cat_ids=0, $diff_ids=0, $exclude=0) {
		$result = $this->tests_model->deleteTestQuestion ($test_id, $id);
		$this->message->set('Questions removed from this test', 'success', true);
		redirect ('coaching/tests/preview_test/'.$category_id.'/'.$test_id);
	}	
	
	// Remove Individual Questions From Add Questions PAge
	public function remove_added_question ($category_id=0, $test_id=0, $id=0, $lesson_id=0, $cat_ids=0, $diff_ids=0, $exclude=0) {
		$result = $this->tests_model->deleteTestQuestion ($test_id, $id);
		redirect ('coaching/tests/add_questions/'.$category_id.'/'.$test_id.'/'.$lesson_id.'/'.$cat_ids.'/'.$diff_ids.'/'.$exclude);
	}
	
	// Reset Test	
	public function reset_test ($coaching_id=0, $category_id=0, $test_id=0 ) {
		$this->tests_model->resetTest ($coaching_id, $test_id);
		$this->message->set('All questions have been removed from this test. If you again want to add questions, select a method from the below list.', 'success', true);
		redirect ('coaching/tests/manage/'.$coaching_id.'/'.$category_id.'/'.$test_id);
	}
	
	/* Finalise Test
	// 
	*/
	public function finalise_test ($coaching_id=0, $category_id=0, $test_id) {
		$question_ids = $this->tests_model->getTestQuestions($coaching_id, $test_id);
		$num_questions = 0;
		if ( is_array ($question_ids) ) {
			$num_questions = count($question_ids);
		} 
		
		$total_marks = 0;
		if ( ! empty($question_ids)) {
			foreach ($question_ids as $id) {
				// get marks of each question
				$marks = $this->tests_model->getMarks($id);
				$total_marks = $total_marks + $marks;
			}
		}
		if ($num_questions == 0) {
			$this->message->set('No questions in test. Test can not be finalized.', 'danger', true);
		} else {
			$result = $this->tests_model->finaliseTest ($coaching_id, $test_id, $total_marks);
			$this->message->set('Test published successfully', 'success', true);
		}
		redirect ('coaching/tests/manage/'.$coaching_id.'/'.$category_id.'/'.$test_id);
	}
	
	/* UnFinalise Test
	// 
	*/
	public function unfinalise_test ($coaching_id=0, $category_id=0, $test_id) {
		$result = $this->tests_model->unfinaliseTest ($coaching_id, $test_id);
		$this->message->set('Test Unpublished successfully. You can now add/remove questions or users.', 'success', true);
		redirect ('coaching/tests/manage/'.$coaching_id.'/'.$category_id.'/'.$test_id);
	}
	
	
	/* DELETE TEST
		Function to delete existing test
	*/
	public function delete_test ($coaching_id, $category_id, $test_id)	{		
		$this->tests_model->delete_tests ($test_id);	
		$this->message->set("Test deleted successfully", "success", TRUE);
		redirect("coaching/tests/index/".$coaching_id.'/'.$category_id);
	}
	
	public function export_pdf ($coaching_id=0, $category_id=0, $test_id=0) {

		$test = $this->tests_model->view_tests ($test_id);
		$coaching = $this->coachings_model->get_coaching ($coaching_id);
		$coaching_name = $coaching['coaching_name'];
		$title = $test['title'];		
		
		$this->load->helper ('tcpdf');
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);		
		
		$obj_pdf->SetTitle($title);
		$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $coaching_name, $title);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();

		$data['category_id'] = $category_id;
		$data['test_id'] 	 = $test_id;
		
		
		$questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);
		$questionMarks = $this->tests_model->getTestQuestionMarks ($coaching_id, $test_id);
		$questionTime = $this->tests_model->getTestQuestionTime ($coaching_id, $questions);
		$result = array ();
		$answers = array ();
		if ( ! empty($questions)) {
			foreach ($questions as $id) {
				$row = $this->qb_model->getQuestionDetails ($id);
				$parent_id = $row['parent_id'];
				$result[$parent_id][] = $id;
				// Correct Answer
				for ($i=1; $i<=6; $i++) {
					if ($row['answer_'.$i] > 0) {
						$answers[$id] = $row['choice_'.$i];
					}
				}
			}
		}
		$data['results'] 				= $result;
		$data['test_marks'] 			= $questionMarks;
		$data['answers'] 				= $answers;
		$data['questionTimeSeconds'] 	= $questionTime;
		$data['questionTime'] 			= date("H:i", mktime(0,0, $questionTime,0,0,0));		

		
		ob_start();
		// we can have any view part here like HTML, PHP etc
		$content = '';
		$content .= 	$this->load->view('tests/print_pdf', $data, true);
		$file = $title . '.pdf';
		$obj_pdf->writeHTML($content, true, false, false, false, '');

		$count = 1;
		$answer_content = '';
		$answer_content .= '<h4>Answer Sheet</h4>';
		if ( ! empty($questions)) {
			foreach ($questions as $id) {
				$answer_content .= '<table width="100%">';
					$answer_content .= '<tr>';
						$answer_content .= '<td width="5%">';
							$answer_content .= $count . '.';
						$answer_content .= '</td>';
						$answer_content .= '<td width="">';
							$answer_content .= $answers[$id];
						$answer_content .= '</td>';
					$answer_content .= '</tr>';
				$answer_content .= '</table>';
				$count++;
			}
		}
		$obj_pdf->AddPage();
		$obj_pdf->writeHTML($answer_content, true, false, true, false, '');
		ob_end_clean();
		$obj_pdf->Output($file, 'I');
		
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Your file is being downloaded', 'redirect'=>site_url('coaching/tests/preview_test/'.$category_id.'/'.$test_id) )));

	}
	// Ajax enrol users
	public function enrol_users ($coaching_id=0, $category_id=0, $test_id=0, $role_id=0, $class_id=0, $type=0, $batch_id=0, $status='-1') {		
		
		$this->form_validation->set_rules('users[]', 'Users', 'required');
		if ( $this->form_validation->run () == true ) {
			$ids = $this->input->post ('users');
			foreach ($ids as $member_id) {
				$this->tests_model->enrol_member ($coaching_id, $member_id, $test_id);
			}
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'User(s) enroled in test', 'redirect'=>site_url('coaching/tests/enrolments/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$role_id.'/'.$class_id.'/'.$type.'/'.$batch_id.'/'.$status) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
	// Ajax unenrol users
	public function unenrol_users ($coaching_id=0, $category_id=0, $test_id=0, $role_id=0, $class_id=0, $type=0, $batch_id=0, $status='-1') {
		
		$this->form_validation->set_rules('actions', 'Actions', 'required');
		if ( $this->form_validation->run () == true ) {			
			$ids = $this->input->post ('users');
			$actions = $this->input->post ('actions');
			if (! empty ($ids)) {				
				foreach ($ids as $id) {
					if ($actions == 'archive') {
						$x = $this->tests_model->archive_member ($test_id, $id);						
					} else if ($actions == 'unenrol') {
						$x = $this->unenrol_user ($coaching_id, $category_id, $test_id, $role_id, $class_id, $type, $batch_id, $status, $id, $redirect=0);
					}
				}
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>true, 'message'=>'User(s) un-enroled from test', 'redirect'=>site_url('coaching/tests/enrolments/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$role_id.'/'.$class_id.'/'.$type.'/'.$batch_id.'/'.$status) )));
			} else {
				$this->output->set_content_type("application/json");
				$this->output->set_output(json_encode(array('status'=>false, 'error'=>'Select one or more users to complete this action' )));
			}
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
	// Ajax unenrol user
	public function unenrol_user ($coaching_id=0, $category_id=0, $test_id=0, $role_id=0, $class_id=0, $type=0, $batch_id=0, $status='-1', $member_id=0, $redirect=1) { 
		$this->tests_model->unenrol_member ($coaching_id, $member_id, $test_id); 
		if ($redirect == 1) {
			$this->message->set ('User un-enroled from test', 'success', true);
			redirect ('coaching/tests/enrolments/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$role_id.'/'.$class_id.'/'.$type.'/'.$batch_id.'/'.$status);
		}
	}
	// Ajax validation question group
	public function validate_question_group_create ($coaching_id, $category_id=0, $test_id=0, $question_id=0) {
		$this->form_validation->set_rules('type', 'Question Type', 'required');
		$this->form_validation->set_rules('question', 'Question Group Title', 'required|trim');
		//$this->form_validation->set_rules('time', 'Time', 'required|is_natural|trim|max_length[4]');
		$this->form_validation->set_rules('marks', 'Marks', 'required|is_natural|trim|max_length[3]');
		//$this->form_validation->set_rules('negmarks', 'Negative Marks', 'is_natural|trim|max_length[2]');
		
		if (($this->form_validation->run() == true))  {
			$id = $this->qb_model->save_group ($coaching_id, 0, $question_id);
			$this->message->set ("Question heading created. Now add questions to it", 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Question created successfully', 'redirect'=>site_url('coaching/tests/question_create/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$id) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}
	
	
		// Ajax validation question 
	public function validate_question_create ($coaching_id, $category_id=0, $test_id=0, $parent_id=0, $question_id=0) {
		
		$type = $this->input->post ('type_id');
		$this->form_validation->set_rules('classification', 'Classification', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required|trim');
		$this->form_validation->set_rules('optional_feedback', 'Optional Feedback', 'trim');
		$this->form_validation->set_rules('answer_feedback', 'Answer Feedback', 'trim');
		switch ($type) {
			//
			// ===========================
			case QUESTION_TF:
				$this->form_validation->set_rules('answer', 'Correct Answer', 'required');
			break;
			//
			// ===========================
			case QUESTION_MCMC:
				$this->form_validation->set_rules('answer', 'Correct Answer', 'required');
				$this->form_validation->set_rules('choice[1]', 'Choice 1', 'required|trim'); 
				$this->form_validation->set_rules('choice[2]', 'Choice 2', 'required|trim'); 
				$this->form_validation->set_rules('choice[3]', 'Choice 3', 'required|trim'); 
				$this->form_validation->set_rules('choice[4]', 'Choice 4', 'trim'); 
				$this->form_validation->set_rules('choice[5]', 'Choice 5', 'trim'); 
				$this->form_validation->set_rules('choice[6]', 'Choice 6', 'trim'); 
			break;
			//
			// ===========================
			case QUESTION_LONG:
				$this->form_validation->set_rules('answer', 'Correct Answer', '');
				$this->form_validation->set_rules('choice[1]', 'Word Limit', 'trim'); 
				$this->form_validation->set_rules('choice[2]', 'Sample Answer', 'trim'); 
			break;
			//
			// ===========================
			case QUESTION_MATCH:
				$this->form_validation->set_rules('answer', 'Correct Answer', '');
				$this->form_validation->set_rules('choice[1]', 'COLOUMN 1', 'required|trim'); 
				$this->form_validation->set_rules('choice[2]', 'COLOUMN 2', 'required|trim'); 
				$this->form_validation->set_rules('choice[3]', 'COLOUMN 3', 'required|trim'); 
				$this->form_validation->set_rules('choice[4]', 'COLOUMN 4', 'trim'); 
				$this->form_validation->set_rules('choice[5]', 'COLOUMN 5', 'trim'); 
				$this->form_validation->set_rules('choice[6]', 'COLOUMN 6', 'trim'); 
				$this->form_validation->set_rules('option[1]', 'COLOUMN A', 'required|trim'); 
				$this->form_validation->set_rules('option[2]', 'COLOUMN B', 'required|trim'); 
				$this->form_validation->set_rules('option[3]', 'COLOUMN C', 'required|trim');
				$this->form_validation->set_rules('option[4]', 'COLOUMN D', 'trim'); 
				$this->form_validation->set_rules('option[5]', 'COLOUMN E', 'trim'); 
				$this->form_validation->set_rules('option[6]', 'COLOUMN F', 'trim'); 
			break;
			//
			// ===========================
			default:
				$this->form_validation->set_rules('answer', 'Correct Answer', 'required');
				$this->form_validation->set_rules('choice[1]', 'Choice 1', 'required|trim'); 
				$this->form_validation->set_rules('choice[2]', 'Choice 2', 'required|trim'); 
				$this->form_validation->set_rules('choice[3]', 'Choice 3', 'required|trim'); 
				$this->form_validation->set_rules('choice[4]', 'Choice 4', 'trim'); 
				$this->form_validation->set_rules('choice[5]', 'Choice 5', 'trim'); 
				$this->form_validation->set_rules('choice[6]', 'Choice 6', 'trim'); 
			break;
		}
		
		
		if (($this->form_validation->run() == true))  {
			$id = $this->qb_model->save_question ($coaching_id, 0, $parent_id, $question_id);
			$this->tests_model->saveQuestionsSimple($coaching_id, $id, $test_id);
			$this->message->set ("Question created successfully ", 'success', true);
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Question created successfully', 'redirect'=>site_url('coaching/tests/question_create/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$parent_id) )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
		}
	}

	
	public function delete_attempt ($attempt_id=0, $member_id=0, $test_id=0) {
		$this->tests_model->delete_attempt ($attempt_id, $member_id, $test_id);
		$this->message->set ('Attempt deleted successfully', 'success', true);
		redirect ('tests/reports/all_reports/0/'.$member_id.'/'.$test_id);
	}
	
	/*****************************************/
	public function submit_test ($category_id, $test_id) {
		$questions  = $this->input->post('questions');
		$attempt_id = $this->input->post('attempt_id');
		$member_id  = $this->session->userdata('member_id');
		$ans 		= $this->input->post('ans');
    
		foreach ($ans as $qid=>$answer) {
			if ( ! empty ($answer) ) {
				$this->tests_model->insert_answers ($test_id, $qid, $answer);
			}
			unset($answer);
		}
		$this->message->set ('You have successfully completed your test. Now you can review your scores', 'success', true);
		//redirect ('tests/reports/all_reports/'.$attempt_id.'/'.$member_id.'/'.$test_id);
		echo site_url('tests/frontend/test_submitted/'.$attempt_id.'/'.$member_id.'/'.$test_id);
    exit;
    //redirect ('tests/frontend/test_submitted/'.$attempt_id.'/'.$member_id.'/'.$test_id);
	} 	
}