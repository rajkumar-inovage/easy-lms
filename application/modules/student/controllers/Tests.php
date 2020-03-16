<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends MX_Controller {

    public function __construct () {
<<<<<<< HEAD
=======
		$modules = array ('tests', 'qb');
>>>>>>> eadc9a36944e23862708622d9a6aeca402ea609b
		$config = ['config_student'];
	    $models = ['coaching/tests_model' ,'coaching/qb_model', 'coaching/tests_reports', 'coaching/users_model'];
		$this->common_model->autoload_resources ($config, $models);
	}
    

    public function index ($coaching_id=0, $member_id=0) {
		$this->browse_tests ($coaching_id, $member_id);
	}
	
    public function browse_tests ($coaching_id=0, $member_id=0) {
		$data['page_title'] 	= "Browse Tests";
		if($coaching_id==0){
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
		$role_id 				= $this->session->userdata ('role_id');
		
		$category_id			= 0;
		$type 					= 0;
        $data['coaching_id'] = $coaching_id;
		$data['member_id'] 		= $member_id;		
		$data['type'] 			= $type;		
		$data['category_id'] 	= $category_id;		
		$data['ongoing_tests'] 	= $this->tests_model->get_enrolled_test($coaching_id, $member_id);

		$data['upcoming_tests'] 	= $this->tests_model->get_enrolled_test($coaching_id, $member_id, TEST_TYPE_REGULAR, TEST_TYPE_UPCOMING);

		$data['tests'] 	= $this->tests_model->get_all_tests ($coaching_id, $category_id, $type, 0);
		
		/* --==// Sidebar //==-- */ 
		//$data['sidebar']		= $this->load->view ('ajax/browse_tests', $data, true);

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
	public function take_test ($coaching_id=0, $member_id=0, $category_id=0, $test_id=0, $page="") {
		redirect ('student/tests/test_instructions/'.$coaching_id.'/'.$member_id.'/'.$category_id.'/'.$test_id.'/'.$page);
	}
	
	public function test_instructions ($coaching_id=0, $member_id=0, $category_id=0, $test_id=0, $nav="") {
		$test = $this->tests_model->view_tests ($test_id);		
		if($coaching_id==0){
            $coaching_id = $this->session->userdata ('coaching_id');
        }
        if($member_id==0){
            $member_id = $this->session->userdata ('member_id');
        }
		$data['user'] = $this->users_model->get_user ($member_id);
		
		$node_details = $this->common_model->node_details ($category_id, SYS_TREE_TYPE_TEST);
		$data['parent_id'] = $node_details['parent_id'];
		
		$page = str_replace (':', '/', $nav);

		//$data['page_stats'] = $this->tests_model->page_stats ($member_id);
		
		$data['page_title'] = "Important instructions";
		$data['test_id'] 	= $test_id;
		$data['page'] 		= $page;
		$data['category_id'] = $category_id;
		$data['test'] 		= $test;
		$data['coaching_id'] 	= $coaching_id;
		$data['member_id'] 	= $member_id;
		
		/* --==// Sidebar //==-- */ 
		//$data['sidebar']		= $this->load->view ('ajax/test_instructions', $data, true);
		$data['bc']			= array ('Dashboard'=>'frontend/tests/index');
		//$data['script'] = $this->load->view ('tests/scripts/test_instructions', $data, true);
		$this->load->view(INCLUDE_PATH  . 'header', $data);
		$this->load->view('tests/test_instructions',$data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
		
	}
	
	public function test_verification ($coaching_id=0, $category_id=0, $test_id=0) {
		
		/* Check for valid test session */
		# Test window cannot be refreshed/reloaded. This will disable/lock the current test.
		# Next test attempt cannot be taken before expiry of current test.
		
		$test = $this->tests_model->view_tests ($test_id);
		$member_id = $this->session->userdata ('member_id');
		
		// test attempt
		$attempt = $this->tests_model->check_attempt ($coaching_id, $test_id, $member_id);
		// not for tests with unlimited attempts
		if ( $test['num_takes'] > 0) {
			if ( $attempt > $test['num_takes'] ) {
				redirect ('frontend/tests/test_error/'.$category_id.'/'.$test_id.'/'.TEST_ERROR_MAX_ATTEMPT_REACHED);
			} 
		}		
		
		// Recently Taken?
		// Check if this test has been recently taken (within test duration time)
		$last_attempt = $this->tests_model->check_session ($coaching_id, $test_id, $member_id);
		$now = time ();
		$test_duration = ($test['time_hour'] * 60 * 60) + ($test['time_min'] * 60);
		$next_attempt = $last_attempt + $test_duration;
		if ( $next_attempt >  $now) {
			$time_remaining = $next_attempt - $now;
			//redirect ('tests/frontend/test_error/'.$category_id.'/'.$test_id.'/'.TEST_ERROR_RECENTLY_TAKEN.'/'.$time_remaining);
		}
		
	}
	
	
	// here starts the test
	public function start_test ($coaching_id=0, $member_id=0, $category_id, $test_id) {
	
		$this->load->helper('text');
		$this->load->helper('html');	
		$this->test_verification ($coaching_id, $category_id, $test_id);
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
		$data['total_questions'] = count ($all_questions);
		$confirm_div = $data['total_questions'] + 1;
		$data['confirm_div'] = count ($confirm_div);
		/* Perpare an array in form of subject->question_group->question */
		$collect = array ();
		if ( ! empty ($all_questions)) {					
			foreach ($all_questions as $qid) {
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
			//redirect ('frontend/tests/test_error/'.$category_id.'/'.$test_id.'/1');
		}
		
		// save current attempt log
		$now = time ();
		$attempt_id = 0;
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
		$data['category_id'] 			= $category_id;
		$data['attempt_id'] 			= $attempt_id;
		$data['member_id'] 				= $member_id;
		$data['all_questions'] 			= $prepare_questions;
		$data['subject_wise'] 			= $subject_wise;
		$data['test_duration'] 			= $test_duration;
		$data['hide_left_sidebar'] 		= true;
		$data['data']	 = $data;
		$data['page_title'] 			= 'Test: '.$test['title'];
		//$data['sub_title'] 				= $test['max_marks'];

		/* --==// Header Script //==-- */ 
		$data['script_header'] = array(THEME_PATH.'assets/js/countdown.min.js');
		/* --==// Sidebar //==-- */ 
		//$data['sidebar'] = $this->load->view ('tests/ajax/start_test', $data, true);
		$data['script'] = $this->load->view ('tests/scripts/start_test', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/start_test', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);


	} 
	
	
	public function test_error ($category_id=0, $test_id=0, $error=0, $time_remaining=0) {
		$data['page_title'] = "Error";
		/* $error explained
			1 = Maximum attempt reached
			2 = Next attempt after X minutes
			3 = Invalid URL access of test
		*/
		
		
		$data['error']				= $error;
		$data['test_id']			= $test_id;
		$data['time_remaining']		= $time_remaining;
		$data['category_id']		= $category_id;
		$data['no_header'] 			= true;
		$data['hide_headerbar']		= true;
		
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('test_error',$data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
	}
	
	public function test_submitted ($coaching_id=0, $member_id=0, $category_id=0, $test_id=0, $attempt_id=0) {

		$data['page_title'] = "Test Submitted";
		/* $error explained
			1 = Maximum attempt reached
			2 = Next attempt after X minutes
			3 = Invalid URL access of test
		*/
		
		$data['coaching_id']		= $coaching_id;
		$data['member_id']			= $member_id;
		$data['test_id']			= $test_id;
		$data['category_id']		= $category_id;
		$data['hide_left_sidebar'] 	= true;
		
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/test_submitted',$data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
	}
	
	
}