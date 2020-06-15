<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends MX_Controller {

    public function __construct () {
		$config = ['config_student'];
	    $models = ['tests_model' ,'qb_model', 'tests_reports', 'users_model'];
		$this->common_model->autoload_resources ($config, $models);

        $cid = $this->uri->segment (4);        
        
        // Security step to prevent unauthorized access through url
        if ($this->session->userdata ('is_admin') == TRUE) {
        } else {
            if ($cid == true && $this->session->userdata ('coaching_id') <> $cid) {
                $this->message->set ('Direct url access not allowed', 'danger', true);
                redirect ('student/home/dashboard');
            }
        }

	}
    

    public function index ($coaching_id=0, $member_id=0, $test_type=TEST_TYPE_REGULAR) {
		$this->browse_tests ($coaching_id, $member_id, $test_type);
	} 
	
    public function browse_tests ($coaching_id=0, $member_id=0, $test_type=TEST_TYPE_REGULAR) {
		$data['page_title'] 	= "Browse Tests";
		
        $data['coaching_id'] 	= $coaching_id;
		$data['member_id'] 		= $member_id;
		$data['test_type'] 		= $test_type;

		if ($test_type == TEST_TYPE_REGULAR) {

			$enrolments 			= $this->tests_model->get_enroled_tests ($coaching_id, $member_id);

			$enroled = [];
			$now = time ();
			if (! empty ($enrolments)) {
				foreach ($enrolments as $row) {
					
	                $questions = $this->tests_model->getTestQuestions ($coaching_id, $row['test_id']);
	                $testMarks = $this->tests_model->getTestQuestionMarks ($coaching_id, $row['test_id']);

	                if (! empty ($questions)) {
	                    $num_test_questions = count ($questions);
	                } else {
	                    $num_test_questions = 0;
	                }

	                $row['test_marks'] = $testMarks;
	                $row['num_test_questions'] = $num_test_questions;

					$attempts = $this->tests_model->get_attempts ($member_id, $row['test_id']);
					if (! empty ($attempts)) {
						$num_attempts = count($attempts);
					} else {
						$num_attempts = 0;
					}

					// On going tests
					if ( $now >= $row['start_date'] && $now <= $row['end_date']) {
						$enroled['ongoing'][] = $row;
					} else if ($now < $row['start_date'] && $now < $row['end_date']) {
					// Up coming tests
						$enroled['upcoming'][] = $row;
					} else {
					// Archived tests
						$enroled['archived'][] = $row;
					}
				}
			}
			$data['tests'] = $enroled;
			$data['num_attempts'] = $num_attempts;
		} else {
			$data['tests'] = $this->tests_model->get_all_tests ($coaching_id, $category_id=0, $test_type);
		}
		
		$data['bc'] = array ('Dashboard'=>'student/home/dashboard/'.$coaching_id.'/'.$member_id);

		$this->load->view ( INCLUDE_PATH . 'header', $data); 
		$this->load->view ( 'tests/browse_tests', $data);
		$this->load->view ( INCLUDE_PATH . 'footer', $data);
		
    }
	
	public function tests_taken ($coaching_id=0, $member_id=0, $category_id=0, $type=0, $offset=0) {
		if($coaching_id==0){
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
        $data['coaching_id'] = $coaching_id;
		$data['member_id'] = $member_id;
		$data['category_id'] = $category_id;
		$data['type'] 		 = $type;		

		// We have to call the same method again to get ALL records. Notice fourth parameter is set true
		$test_taken = $this->tests_model->test_taken_by_member ($member_id);
		$test_cats = [];
		$num_tests = 0;
		if (! empty($test_taken)) {
			foreach ($test_taken as $t) {
				$test_cats[] = $t['category_id'];
			}
			$num_tests = count ($test_taken);
		}
		$data['top_levels'] = $this->common_model->get_top_levels ($test_cats, TREE_TYPE_TEST);

		$data['category_id'] 	= $category_id;
		$data['type'] 		 	= $type;
		$data['member_id'] 		= $member_id;		
		$data['num_tests'] 		= $num_tests;		
		$data['page_title'] 	= 'Tests Taken';
		$data['sub_title'] 	= 'Tests Taken';
		$data['bc'] 			= array ('Dashboard'=>'student/home/dashboard/'.$coaching_id.'/'.$member_id);

		/* Pagination */
		$this->load->library('pagination');
		$config['base_url'] 	= site_url('student/tests/tests_taken/'.$coaching_id.'/'.$member_id.'/'.$category_id.'/'.$type);
		$config['total_rows'] 	= $num_tests;
		$config['per_page'] 	= RECORDS_PER_PAGE; 
		$data['offset'] 		= $offset;
		$this->pagination->initialize($config);

		$data['test_taken'] = $test_taken;

		$this->load->view ( INCLUDE_PATH  . 'header', $data);
		$this->load->view('tests/my_tests',$data);
		$this->load->view ( INCLUDE_PATH  . 'footer', $data);
	}

	
	// it gives all the instructions for the test
	public function take_test ($coaching_id=0, $member_id=0, $test_id=0, $page="") {
		redirect ('student/tests/test_instructions/'.$coaching_id.'/'.$member_id.'/'.$test_id.'/'.$page);
	}
	
	public function test_instructions ($coaching_id=0, $member_id=0, $test_id=0, $nav="") {
		
		$test = $this->tests_model->view_tests ($test_id);		
		
        $questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);
        $testMarks = $this->tests_model->getTestQuestionMarks ($coaching_id, $test_id);

        if (! empty ($questions)) {
            $num_test_questions = count ($questions);
        } else {
            $num_test_questions = 0;
        }

        $data['test_marks'] = $testMarks;
        $data['num_test_questions'] = $num_test_questions;


		if ($coaching_id == 0) {
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if ($member_id == 0) {
            $member_id = $this->session->userdata ('member_id');
        }
		
		$start_test = true;
		
		// Check attempts
		$attempt = $this->tests_model->check_attempt ($coaching_id, $test_id, $member_id);
		if ( $test['num_takes'] > 0) {
			if ( $attempt > $test['num_takes'] ) {
				$start_test = false;
			} 
		}

		// Check enrolment
		if ($test['test_type'] == TEST_TYPE_REGULAR) {
			$now = time ();
			$enrolment = $this->tests_model->get_enrolment_details( $coaching_id, $test_id, $member_id);
			if ( $now >= $enrolment['start_date'] && $now <= $enrolment['end_date']) {
				$start_test = true;
			}
		}


		$page = str_replace (':', '/', $nav);

		//$data['page_stats'] = $this->tests_model->page_stats ($member_id);
		
		$data['page_title'] 	= "Instructions";
		$data['page'] 			= $page;
		$data['test'] 			= $test;
		$data['coaching_id'] 	= $coaching_id;
		$data['member_id'] 		= $member_id;
		$data['test_id'] 		= $test_id;
		$data['start_test'] 	= $start_test;
		
		$data['bc']			= array ('Dashboard'=>'student/tests/index/'.$coaching_id.'/'.$member_id);

		//$data['script'] = $this->load->view ('tests/scripts/test_instructions', $data, true);
		$this->load->view(INCLUDE_PATH  . 'header', $data);
		$this->load->view('tests/test_instructions',$data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);		
	}
	

	public function test_verification ($coaching_id=0, $member_id=0, $test_id=0) {
		
		/* Check for valid test session */
		# Test window cannot be refreshed/reloaded. This will disable/lock the current test.
		# Next test attempt cannot be taken before expiry of current test.

		$test = $this->tests_model->view_tests ($test_id);
		$member_id = $this->session->userdata ('member_id');

		if ( $test['finalized'] == 0) {
			redirect ('student/tests/test_error/'.$coaching_id.'/'.$member_id.'/'.$test_id.'/'.TEST_ERROR_UNPUBLISHED);
		} 
		
		// test attempt
		$attempt = $this->tests_model->check_attempt ($coaching_id, $test_id, $member_id);
		// not for tests with unlimited attempts
		if ( $test['num_takes'] > 0) {
			if ( $attempt > $test['num_takes'] ) {
				redirect ('student/tests/test_error/'.$coaching_id.'/'.$member_id.'/'.$test_id.'/'.TEST_ERROR_MAX_ATTEMPT_REACHED);
			} 
		}		
		
		// Recently Taken?
		// Check if this test has been recently taken (within test duration time)
		/*
		$last_attempt = $this->tests_model->check_session ($coaching_id, $test_id, $member_id);
		$now = time ();
		$test_duration = ($test['time_hour'] * 60 * 60) + ($test['time_min'] * 60);
		$next_attempt = $last_attempt + $test_duration;
		if ( $next_attempt >  $now) {
			$time_remaining = $next_attempt - $now;
			redirect ('student/tests/test_error/'.$coaching_id.'/'.$member_id.'/'.$test_id.'/'.TEST_ERROR_RECENTLY_TAKEN.'/'.$time_remaining);
		}
		*/
		
		return false;
	}
	
	public function test_error ($coaching_id=0, $member_id=0, $test_id=0, $error=0, $time_remaining=0) {

		$data['page_title'] = "Error";
		
		$data['error']				= $error;
		$data['coaching_id']		= $coaching_id;
		$data['member_id']			= $member_id;
		$data['test_id']			= $test_id;
		$data['time_remaining']		= $time_remaining;
		$data['bc']					= ['Tests'=>'student/tests/index/'.$coaching_id.'/'.$member_id];

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/test_error', $data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
	}
	
	// here starts the test
	public function start_test ($coaching_id=0, $member_id=0, $test_id=0) {
	
		$this->load->helper('text');
		$this->load->helper('html');
		$this->test_verification ($coaching_id, $member_id, $test_id);

		$test = $this->tests_model->view_tests ($test_id);
		$test_duration = ($test['time_hour'] * 60 * 60) + ($test['time_min'] * 60);
		
		if($coaching_id==0){
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
		$data['user'] = $this->users_model->get_user ($member_id);
		
		/* PREPARE TEST */
		$all_questions = array ();
		$attempted_questions = array ();
		$remaining_questions = array ();
		
		// Settings for the first time test starts 

		// All test questions
		$all_questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);
		/* If randomize ALL questions
		if ($test['randomize_all_questions'] == 1) {
			shuffle ($all_questions);
		}
		
		*/
		if (! empty ($all_questions)) {
			$data['total_questions'] = count ($all_questions);
		} else {
			$data['total_questions'] = 0;			
		}
		$confirm_div = $data['total_questions'] + 1;
		$data['confirm_div'] = ($confirm_div);
		/* Perpare an array in form of subject->question_group->question */
		$collect = array ();
		if ( ! empty ($all_questions)) {					
			foreach ($all_questions as $row) {
				$qid = $row['question_id'];
				// get details
				$details = $this->qb_model->getQuestionDetails ($qid);
				$parent_id = $details['parent_id'];
				
				// Chapter ID
				$chapter_id = $details['chapter_id'];
				
				$chapter = $this->common_model->node_details ($chapter_id, SYS_TREE_TYPE_QB);
				$subject_id = $chapter['parent_id'];
				
				$collect[$subject_id][$parent_id][] = $qid;
			}
		} else {
			redirect ('student/tests/test_error/'.$coaching_id.'/'.$member_id.'/'.$test_id.'/'.TEST_ERROR_NO_QUESTION);
		}
		
		// save current attempt log
		$now = time ();
		//$attempt_id = 0;
		$attempt_id = $this->tests_model->save_attempt ($coaching_id, $test_id, $member_id, $now);
		
		$prepare_questions = array ();			
		$subject_wise = array ();
		$count = 1;
		foreach ( $collect as $subject_id=>$question_group) {
			$subject = $this->common_model->node_details ($subject_id, SYS_TREE_TYPE_QB);
			$subject_wise[$subject_id] = $subject['title'];
			if ( is_array ($question_group)) { 
				$question_group_ids = array_keys ($question_group);
				/* If randomize questions within subjects
				if ($test['randomize_w_subject'] == 1) {
					shuffle ($question_group_ids);
				}
				*/
				foreach ($question_group_ids as $qgids) {
					$prepare_questions[$subject_id][$qgids] = $question_group[$qgids];
				}
			}
		}
		
		
		$data['test'] 					= $test;
		$data['test_id'] 				= $test_id;
		$data['coaching_id'] 			= $coaching_id;
		$data['attempt_id'] 			= $attempt_id;
		$data['member_id'] 				= $member_id;
		$data['all_questions'] 			= $prepare_questions;
		$data['subject_wise'] 			= $subject_wise;
		$data['test_duration'] 			= $test_duration;
		$data['hide_left_sidebar'] 		= true;
		$data['data']	 = $data;
		$data['page_title'] 			= $test['title'];

		$data['script'] = $this->load->view ('tests/scripts/start_test', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/start_test', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}	
	
	
	public function test_submitted ($coaching_id=0, $test_id=0, $member_id=0, $attempt_id=0) {
		
		$data['page_title'] 		= "Test Submitted";

		$data['coaching_id']		= $coaching_id;
		$data['member_id']			= $member_id;
		$data['test_id']			= $test_id;
		$data['attempt_id']		    = $attempt_id;
		$data['bc']					= ['Test Taken'=>'student/tests/tests_taken/'.$coaching_id.'/'.$test_id.'/'.$member_id];

		$enrolment = $this->tests_model->get_enrolment_details ($coaching_id, $test_id, $member_id);
		if ($enrolment['release_result'] == RELEASE_EXAM_NEVER) {
			$this->message->set ('Test submitted successfully. Result will be declared on a later date', 'success', true);
			redirect ('student/tests/tests_taken/'.$coaching_id.'/'.$member_id);
		}

		$data['test_marks'] 		= $this->tests_model->getTestquestionMarks ($coaching_id, $test_id);
		$ob = $this->tests_reports->calculate_obtained_marks ($test_id, $attempt_id, $member_id);
		$data['score'] = $ob;

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/test_submitted', $data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
	}

}