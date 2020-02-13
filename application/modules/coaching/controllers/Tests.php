<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tests extends MX_Controller {
	
    var $toolbar_buttons = []; 

	public function __construct () {
	    // Load Config and Model files required throughout Users sub-module
	    $config = ['admin/config_admin', 'coaching/config_coaching'];
	    $models = ['admin/coachings_model', 'coaching/subscription_model', 'coaching/tests_model', 'coaching/test_plans_model', 'coaching/qb_model', 'coaching/users_model'];

	    $this->common_model->autoload_resources ($config, $models);
	    
        $cid = $this->uri->segment (4);
        $this->toolbar_buttons['<i class="fa fa-puzzle-piece"></i> All Tests']= 'coaching/tests/index/'.$cid;
        $this->toolbar_buttons['<i class="fa fa-plus-circle"></i> New Test']= 'coaching/tests/create_test/'.$cid;
        $this->toolbar_buttons['<i class="fa fa-list"></i> Test Categories']= 'coaching/tests/categories/'.$cid;
        
        // Security step to prevent unauthorized access through url
        if ($this->session->userdata ('is_admin') == TRUE) {
        } else {
            if ($this->session->userdata ('coaching_id') <> $cid) {
                //$this->message->set ('Direct url access not allowed', 'danger', true);
                //redirect ('coaching/home/dashboard');
            }
        }
	}
	
	// Categories
	public function categories ($coaching_id=0) {
		/* Breadcrumbs */ 
		$data['bc'] = array ('Dashboard'=>'coaching/tests/index/'.$coaching_id);

		$data['page_title'] = 'Tests';
		$data['sub_title'] = 'Test Categories';
		$data['coaching_id'] = $coaching_id;
		
		$data['categories'] = $this->tests_model->test_categories ($coaching_id);

		$this->load->view(INCLUDE_PATH  . 'header', $data);
		$this->load->view('tests/categories', $data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);
	    
	}
	
	// Create/Edit Category
	public function add_category ($category_id=0) {
		/* Breadcrumbs */ 
		$data['bc'] = array ('Categories'=>'coaching/tests/categories');
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['page_title'] = 'Tests';
		$data['page_title'] = 'Test Categories';
		$data['category_id'] = $category_id;
		$data['category'] = $this->tests_model->get_category ($category_id);

		//$data['script'] = $this->load->view(SCRIPT_PATH  . 'plans/create_category', $data, true);
		$this->load->view(INCLUDE_PATH  . 'header', $data);
		$this->load->view('tests/create_category', $data);
		$this->load->view(INCLUDE_PATH  . 'footer', $data);	    
	}
	
	public function index ($coaching_id=0, $category_id=0, $type=0) { 

		$data['coaching_id'] = $coaching_id;
		$data['category_id'] = $category_id;
		$data['type'] 		 = $type;
		$data['page_title']  = 'Tests';
		$data['sub_title']   = 'All Tests';
		
		$data['member_id'] = $member_id = $this->session->userdata ('member_id');
		$data['categories'] = $this->tests_model->test_categories ($coaching_id);

		
		/*---=== Back Link ===---*/
		$data['bc'] = array ('Coaching Dashboard'=>'coaching/home/dashboard/'.$coaching_id);

		/*---=== Coaching Tests ===---*/
		$data['tests'] = $tests = $this->tests_model->get_all_tests ($coaching_id, $category_id, $type);
		$data['plans'] = $this->test_plans_model->coaching_test_plans ($coaching_id);
		
		if ( ! empty ($tests)) {
			$count_tests = count ($tests);
		} else {
			$count_tests = 0;
		}
		$data['count_tests'] = $count_tests;
		
		/* --==// Toolbar //==-- */
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		
		$data['script'] = $this->load->view ('tests/scripts/index', $data, true);
		$this->load->view ( INCLUDE_PATH  . 'header', $data);
		$this->load->view ( 'tests/index', $data);
		$this->load->view ( INCLUDE_PATH  . 'footer', $data);	
	}

	public function edit($coaching_id=0, $category_id=0, $test_id=0) {
		$this->create ($coaching_id, $category_id, $test_id);
	}
	/* CREATE TEST
		Function to create new test.
	*/
	public function create_test ($coaching_id=0, $category_id=0, $test_id=0) {
		
		$data['coaching_id'] 	= $coaching_id;
		$data['category_id'] 	= $category_id;
		$data['test_id'] 	 	= $test_id;		
		
		/* Back Link */
		if($test_id>0){
			$data['bc'] = array ('Back'=>'coaching/tests/manage/'.$coaching_id.'/'.$category_id.'/'.$test_id);
		}else{
			$data['bc'] = array ('Back'=>'coaching/tests/index/'.$coaching_id);
		}
		
		$data['categories'] = $this->tests_model->test_categories ($coaching_id);
		$data['results'] = $this->tests_model->view_tests ($test_id);
		if ($test_id > 0) {
			$data['page_title'] = 'Edit Test: ' . $data['results']['title'];
		} else {
			$data['page_title'] = 'Create Test';
		}

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/create_test', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	
	
	public function manage ($coaching_id=0, $category_id=0, $test_id=0) {
		
		$data['row'] 	= $test = $this->tests_model->view_tests ($test_id);
		if ($test['finalized']) {
		}
		
		$data['page_title'] = 'Manage Test';
		$data['sub_title']  = $test['title'];
		$data['test_id'] 	 = $test_id;
		$data['category_id'] = $category_id;
		$data['coaching_id'] = $coaching_id;
		
		/* Breadcrumbs */
		$data['bc'] = array ('Tests'=>'coaching/tests/index/'.$coaching_id);
		
		$questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);
		$testMarks = $this->tests_model->getTestQuestionMarks ($coaching_id, $test_id, $questions);

		/* Toolbar Buttons */
		$data['toolbar_buttons'] = $this->toolbar_buttons;
		$data['toolbar_buttons'][] = ['Manage'=>'coaching/tests/manage/'.$coaching_id.'/'.$category_id.'/'.$test_id];

		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/manage_test', $data);		
		$this->load->view(INCLUDE_PATH . 'footer', $data);

	}
	
	
	/* Preview Test
	// 
	*/
	public function preview_test ($coaching_id=0, $category_id=0, $test_id=0, $offset='' ) {

		$data['test'] = $test = $this->tests_model->view_tests ($test_id);

		$data['coaching_id'] = $coaching_id;
		$data['category_id'] = $category_id;
		$data['test_id'] = $test_id;
		
		$questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);
		$num_questions = count($questions);

		$questionTime = $this->tests_model->getTestQuestionTime ($coaching_id, $questions);
		$result = array ();
		if ( ! empty($questions)) {
			foreach ($questions as $id) {
				$row = $this->qb_model->getQuestionDetails ($id);
				$parent_id = $row['parent_id'];
				$parent_row = $this->qb_model->getQuestionDetails ($parent_id);
				$result[$parent_id]['parent'] = $parent_row;
				$result[$parent_id]['questions'][$id] = $row;
			}
		}
		$data['results'] = $result;
		$data['questionTimeSeconds'] = $questionTime;
		$data['questionTime'] = date("H:i", mktime(0,0, $questionTime,0,0,0));

		/* --==// Back Link //==-- */
		$data['bc'] = array ('Manage Test'=>'coaching/tests/manage/'.$coaching_id.'/'.$category_id.'/'.$test_id);
		
		/* --==// Sidebar //==-- */ 
		$data['sidebar']		= $this->load->view ('tests/inc/manage_test', $data, true);
		$data['page_title'] = 'Preview Test'; 
		$data['sub_title']  = $test['title'];
		
		/* --==// Toolbar //==-- */ 
		$param = array ($category_id, $test_id);
		//$data['toolbar'] = $this->common_model->generate_toolbar ($param);
		$data['toolbar_buttons'] = array (
				'<i class="fa fa-plus"></i> Add Section'=>'coaching/tests/question_group_create/'.$coaching_id.'/'.$category_id.'/'.$test_id,
				'<i class="fa fa-eye"></i> Preview Test'=>'coaching/tests/preview_test/'.$coaching_id.'/'.$category_id.'/'.$test_id,
				);

		/* --==// Pagination Settings //==-- 
		$this->load->library ('pagination');
		$config = $this->config->item ('pagination');
		$config['base_url'] = site_url ('coaching/tests/preview_test/'.$category_id.'/'.$test_id.'/'.$lesson_id);
		$config['total_rows'] = $num_questions;
		$this->pagination->initialize($config);
		*/
		$data['script'] = $this->load->view ('tests/scripts/preview_test', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);		
		$this->load->view('tests/preview_test', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);	
		
	}	
	/*---=== ENROLMENT ===---*/
	public function enrolments ($coaching_id=0, $category_id=0, $test_id=0, $role_id=0, $class_id=0, $type=ENROLED_IN_TEST, $batch_id=0, $status='-1') {
		
		$data['page_title'] 	= 'Enrolments';
		$data['coaching_id'] 	= $coaching_id;
		$data['category_id'] 	= $category_id;
		$data['test_id'] 		= $test_id;
		$data['role_id'] 		= $role_id;
		$data['class_id'] 		= $class_id;
		$data['batch_id'] 		= $batch_id;
		$data['status'] 		= $status;
		$data['type'] 			= $type;
		/* Breadcrumbs */
		$data['bc'] = array ('Manage '=>'coaching/tests/manage/'.$coaching_id.'/'.$category_id.'/'.$test_id);		
		
		/*
		if ($batch_id > 0) {
			$batch_users 		= $this->users_model->batch_users ($batch_id);
			$results = array ();
			if ( ! empty ($batch_users)) {
				foreach ($batch_users  as $row) {
					$member_id = $row['member_id'];
					$results[] = $this->users_model->get_user ($member_id);
				}
			}
		} else {
			$results 	= $this->users_model->get_users ($class_id, $role_id);
		}
		*/
		
		// Count not enroled users
		$not_enroled 	= $this->tests_model->get_users_not_in_test ($coaching_id, $test_id, $role_id, $class_id,$category_id, $batch_id, $status);

		// Count not enroled users
		if ($not_enroled > 0) 
			$num_not_enroled = count ($not_enroled);
		else
			$num_not_enroled = 0;
		
		// Count enroled users
		$enroled 		= $this->tests_model->get_users_in_test ($coaching_id, $test_id, $role_id, $class_id,$category_id, $batch_id, $status);
		// Count enroled users
		if ($enroled > 0) 
			$num_enroled = count ($enroled);
		else 
			$num_enroled = 0;
		
		// Count archived users
		$archived 		= $this->tests_model->get_archived_students ($coaching_id, $test_id, $role_id, $class_id,$category_id, $batch_id, $status);
		// Count archived users
		if ($archived > 0) 
			$num_archived = count ($archived);
		else 
			$num_archived = 0;
		

		$data['num_archived'] = $num_archived;
		$data['num_enroled']  = $num_enroled;
		$data['num_not_enroled'] = $num_not_enroled;
		
		if ($type == NOT_ENROLED_IN_TEST) {
			$results = $not_enroled;
		} else if ($type == ARCHIVED_IN_TEST) {
			$results = $archived;
		} else {
			$results = $enroled;
		}
		
		/*
		if ($batch_id > 0) {
			$results = array ();
			$batch_users 		= $this->users_model->batch_users ($batch_id);
			if ( ! empty ($batch_users)) {
				foreach ($batch_users  as $row) {
					$member_id  = $row['member_id'];
					if (is_array ($enroled)) {
						if ( ! in_array ($member_id, $enroled)) {
							$results[] = $member_id;
						}
					} else {
						$results[] = $member_id;	
					}
				}
			} else {
				$results = $batch_users;
			}
		}
		*/
		
		$data['results'] = $results;
		$data['test'] 	= $this->tests_model->view_tests ($test_id);
		
		
		if ($coaching_id > 0) {
			$role_lvl 		 	= USER_LEVEL_COACHING_ADMIN;			
		} else {
			$role_lvl 		 	= $this->session->userdata ('role_lvl');	
		}
		$admin 				= FALSE;
		$data['roles']	 		= $this->users_model->get_user_roles ($admin, $role_lvl);
		$data['batches']	 	= $this->users_model->get_member_batches ();
		$data['user_status']	= $this->common_model->get_sys_parameters (SYS_USER_STATUS);
		
		$data['data']			= $data;
		
		$data['script'] = $this->load->view ('tests/scripts/enrolments', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/enrolments', $data); 
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	
	public function question_group_edit($coaching_id=0, $category_id=0, $test_id=0, $question_id=0){
		$this->question_group_create($coaching_id, $category_id, $test_id, $question_id);
	}

	// Create new question group
	/* CREATE QUESTION GROUP
		Function to create question group
	*/	
	public function question_group_create ($coaching_id=0, $category_id=0, $test_id=0, $question_id=0) {
		
		$data['page_title'] 	= 'Create/Edit Section';
		$data['coaching_id'] 	= $coaching_id;
		$data['category_id'] 	= $category_id;
		$data['question_id'] 	= $question_id;
		$data['test_id'] 		= $test_id;
		//$data['script'] 		= $this->load->view (SCRIPT_PATH . 'tinymce', $data, TRUE);

		$data['test'] = $test = $this->tests_model->view_tests ($test_id);

		$questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);		
		$testMarks = $this->tests_model->getTestQuestionMarks ($coaching_id, $test_id, $questions);
		
		/* Breadcrumbs */
		$data['bc'] = array ('Questions'=>'coaching/tests/preview_test/'.$coaching_id.'/'.$category_id.'/'.$test_id);

		// All Question Types
		$data['question_types'] = $this->common_model->get_sys_parameters (SYS_QUESTION_TYPES);
		
		$data['questions'] = $this->qb_model->get_heading_questions ($coaching_id, $category_id);

		// Get Question Details
		$result = $this->qb_model->getQuestionDetails ($question_id);
		
		// Selected Question Type
		if ($question_id > 0) {
			$data['question_type'] = $this->common_model->sys_parameter_name (SYS_QUESTION_TYPES, $result['type']);
		}
		$data['result'] = $result;
		
		$data['script'] 	= $this->load->view ('tests/scripts/question_group_create', $data, true);
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/question_group_create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
    }
	
	public function question_edit ($coaching_id=0, $category_id=0, $test_id=0, $parent_id=0, $question_id=0, $lang_id=0) {
		$this->question_create($coaching_id, $category_id, $test_id, $parent_id, $question_id, $lang_id);
	}
	/* function for Create/Edit question */
	public function question_create ($coaching_id=0, $category_id=0, $test_id=0, $parent_id=0, $question_id=0, $lang_id=0) {
		
		/* --==// Toolbar Menus //==-- */
		$data['lang_id']	=	$lang_id;
		$data['coaching_id'] 	= $coaching_id;
		$data['classifications'] = $this->common_model->get_sys_parameters (SYS_QUESTION_CLASSIFICATION);			
		$data['question_types'] = $this->common_model->get_sys_parameters (SYS_QUESTION_TYPES);
		$data['test'] = $test = $this->tests_model->view_tests ($test_id);
		$questions 			= $this->qb_model->get_sub_questions (0, $parent_id);
		//$questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);
		$testMarks = $this->tests_model->getTestQuestionMarks ($coaching_id, $test_id, $questions);

		/* Back Link */
		$data['bc'] = array ('Question Group'=>'coaching/tests/question_group_edit/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$parent_id);

		$data['toolbar_buttons'] = array ('<i class="fa fa-plus"></i> Actions'=>array (
				'Add Questions'=>'coaching/tests/question_group_create/'.$category_id.'/'.$test_id,
				'Preview Test'=>'coaching/tests/preview_test/'.$category_id.'/'.$test_id,
				));

		/* Page Related Statistics */

		$data['category_id']	= $category_id;
		$data['parent_id'] 		= $parent_id;
		$data['question_id']	= $question_id;
		$data['test_id']		= $test_id;
		$data['question_group'] = $this->qb_model->getQuestionDetails ($parent_id);
		$data['result'] 		= $this->qb_model->getQuestionDetails ($question_id);
		$data['questions'] 		= $questions;
		$data['question_categories']   = $this->common_model->get_sys_parameters (SYS_QUESTION_CATEGORIES);
		$data['question_difficulties'] = $this->common_model->get_sys_parameters (SYS_QUESTION_DIFFICULTIES);
		$data['page_title'] = 'Add/Edit Question';
		/* --==// Sidebar //==-- */ 
		$data['sidebar']	= $this->load->view ('tests/inc/manage_test', $data, true);
		$data['script'] 	= $this->load->view ('tests/scripts/question_create', $data, true);
		
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/question_create', $data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	// end create edit question	

	
	/* VIEW TEST
		Function to view test.
	*/
	public function view_test ($category_id, $test_id, $member_id=0, $backlink="") {
		
		$data['page_title'] = 'Test Details';
		$data['category_id'] = $category_id;
		$data['test_id'] = $test_id;
		$data['results'] = $this->tests_model->view_tests ($test_id);		
		
		/* Module Buttons */
		$data['crumb_buttons'] = '';
		
		/* Page Related Toolbar Buttons */
		$toolbar_buttons = array ();
		if ($category_id > 0) {
			$toolbar_buttons = array ( 
					'buttons'=>array ( 
						anchor ('coaching/tests/create/'.$category_id, '<i class="fa fa-plus"></i> New Test' )
					));
		}

		/* Back Link */
		if ($backlink == "") {
			$data['bc'] = array ('Back'=>'coaching/tests/index/'.$category_id);
			$data['toolbar_buttons'] = $toolbar_buttons;
		} else {
			$uri = explode (':', $backlink);
			$link = implode ('/', $uri);
			$data['bc'] = array ('Back'=>'coaching/tests/'.$link);
			$data['toolbar_buttons'] = array ();
		}
		
		/* Page Related Statistics */
		//$page_stats = $this->qb_model->page_stats ('index', $lesson_id);		
		
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/test_details',$data);
		$this->load->view(INCLUDE_PATH . 'footer', $data);
	}
	
	
	
	public function select_method ($category_id=0, $test_id=0) {
		
		$test = $this->tests_model->view_tests ($test_id);
		$data['category_id'] 	= $category_id;
		$data['test_id'] 		= $test_id;
		$data['test'] 			= $test;
		$method 				= $test['method'];
		
		/* Back Link */
		$data['bc'] = array ('Back'=>'coaching/tests/index/'.$category_id);
		
		/* Page Related Toolbar Buttons */
		$data['toolbar_buttons'] = array ();
		if ($category_id > 0) {
			$data['toolbar_buttons'] = array ( 
					'buttons'=>array ( 
						anchor ('coaching/tests/create/'.$category_id, '<i class="fa fa-plus"></i> New Test' )
					));
		}

		/* Page Related Statistics */
		//$page_stats = $this->qb_model->page_stats ('index', $lesson_id);		

		if ($test['finalized'] == 1 ) {
			redirect ( 'coaching/tests/preview_test/'.$category_id.'/'.$test_id);
		} else {
			if ($method == TEST_ADDQ_QB) {
				//redirect('coaching/tests/add_test_questions/'.$category_id.'/'.$test_id);
				redirect('coaching/tests/question_group_create/'.$category_id.'/'.$test_id);
			} elseif ($method == TEST_ADDQ_CREATE) {
				redirect('coaching/tests/question_group_create/'.$category_id.'/'.$test_id);
			} elseif ($method == TEST_ADDQ_UPLOAD) {
				redirect('coaching/tests/upload_test_questions/'.$category_id.'/'.$test_id);
			} else {
				$data['page_title'] = 'Select Method To Add Questions';
				$this->load->view (INCLUDE_PATH . 'header', $data);
				$this->load->view ('tests/select_methods', $data);
				$this->load->view (INCLUDE_PATH . 'footer', $data);
			}
		}
	}
	
	
	
	// Function to list all question of the selected lessons
	public function add_test_questions ( $category_id=0, $test_id=0, $lesson_id=0, $cat_ids=0, $diff_ids=0, $exclude=0) {
		
		//$num_questions = $this->main_m->count_all_questions ();
		$num_questions = 0;		
		
		$results 		= $this->qb_model->getQuestions ($lesson_id, $cat_ids, $diff_ids, $exclude);
		$questions		= $this->tests_model->getTestQuestions ($test_id);		
		$testMarks 		= $this->tests_model->getTestQuestionMarks ($test_id, $questions);
		$test 			= $this->tests_model->view_tests ($test_id);
		$top_level 		= $this->common_model->top_node (SYS_QB_LEVELS);
		$level 			= $this->common_model->node_details ($lesson_id, SYS_TREE_TYPE_QB);
		
		if ( ! empty ($questions)) {
			$num_questions = count ($questions);
		}
		
		$data['toolbar_buttons'][] =  anchor('coaching/tests/preview_test/'.$category_id.'/'.$test_id.'/'.$lesson_id, 'Preview Test'); 
		if ($test['finalized'] == 0 && $testMarks['marks'] > 0) {  
			$data['toolbar_buttons'][] = '<a href="javascript:void(0)" onclick="javascript:show_confirm ( \'Finalize test at '.$testMarks['marks'].' marks?\', \''.site_url('coaching/tests/finalise_test/'.$category_id.'/'.$test_id).'\')" ><i class="fa fa-star"></i>Publish Test</a>';
		} else if ($test['finalized'] == 1 ) { 
			$data['toolbar_buttons'][] = '<a href="javascript:void(0)" onclick="javascript:show_confirm ( \'Un-Finalize test?\', \''.site_url('coaching/tests/unfinalise_test/'.$category_id.'/'.$test_id).'\' )" ><i class="fa fa-star-o"></i> Un-Publish Test</a>';
		}
		$data['toolbar_buttons'][] =  anchor ('coaching/tests/reset_test/'.$category_id.'/'.$test_id.'/'.$lesson_id, '<i class="fa fa-reorder"></i> Reset Test', array ('id'=>'reset_test') ); 
		$data['toolbar_buttons'][] = anchor_popup ('coaching/tests/print_test/'.$category_id.'/'.$test_id, '<i class="fa fa-print"></i> Print', array( 'height'=>'800', 'width'=>1024)); 
		
		/* Back Link */
		$data['bc'] = array ('Back'=>'coaching/tests/manage/'.$category_id.'/'.$test_id);
		
		/* Page Related Toolbar Buttons */
		$data['toolbar_buttons'] = array ();
		$data['toolbar_buttons'] = array ( 
				'buttons'=>array ( 
					anchor ('coaching/tests/preview_test/'.$category_id.'/'.$test_id.'/'.$lesson_id, '<i class="fa fa-search"></i> Preview' ),
				));

		/* Page Related Statistics */
		$data['page_title'] = $test['title'];
		$page_stats['subpage_title']  = $this->common_model->get_node_name ($category_id, SYS_TREE_TYPE_TEST);
		$page_stats['pst1']  = 'Duration'; 
		$page_stats['psf1']  = $test['time_min'] . ' mins';
		$page_stats['pst2']  = 'Test Marks';
		$page_stats['psf2']  = $testMarks['marks'];
		$page_stats['pst3']  = 'Passing';
		$page_stats['psf3']  = $test['pass_marks'] . '%';
		$page_stats['pst4']  = 'Questions';
		$page_stats['psf4']  = count ($questions);
		$data['page_stats']  = $page_stats;
		
		// sidebar
		$data['show_sidebar'] = true;
		$data['sidebar_content'] = $this->common_model->prepare_tree (SYS_TREE_TYPE_QB, TREE_MODE_CHECKABLE, $lesson_id);

		$data['category_id'] 		= $category_id;
		$data['test_id'] 			= $test_id;
		$data['lesson_id'] 			= $lesson_id;
		$data['cat_ids'] 			= $cat_ids;
		$data['diff_ids'] 			= $diff_ids;
		$data['exclude'] 			= $exclude;
		$data['top_level'] 			= $top_level;
		$data['level'] 				= $level;
		$data['test_det'] 			= $test;
		$data['results'] 			= $results;
		$data['num_questions'] 		= $num_questions;
		$data['data'] 				= $data;
		
		$this->load->view (INCLUDE_PATH . 'header', $data);
		$this->load->view ('tests/add_questions', $data);
		$this->load->view (INCLUDE_PATH . 'footer', $data);	
	}
	
	
	
	/* 
	// Upload Test Questions
	*/
	public function upload_test_questions ( $coaching_id=0, $category_id=0, $test_id=0, $lesson_id=0) {
		
		$data['row'] 		= $test = $this->tests_model->view_tests ($test_id);
		
		$data['page_title'] = $test['title'];
		/*
		$page_stats['subpage_title']  = $this->common_model->get_node_name ($category_id, SYS_TREE_TYPE_TEST);
		$page_stats['pst1']  = 'Duration';
		$page_stats['psf1']  = $test['time_min'] . ' mins';
		$page_stats['pst2']  = 'Test Marks';
		$page_stats['psf2']  = $test['max_marks'];
		$page_stats['pst3']  = 'Passing';
		$page_stats['psf3']  = $test['pass_marks'] . '%';
		$data['page_stats']  = $page_stats;
		*/

		$data['test_id'] 	 = $test_id;
		$data['category_id'] = $category_id; 		
		
		/* Breadcrumbs */
		$data['bc'] = array ('Manage Test'=>'coaching/tests/manage/'.$category_id.'/'.$test_id);
		
		$questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);
		$testMarks = $this->tests_model->getTestQuestionMarks ($coaching_id, $test_id, $questions);

		/* Toolbar Buttons * /
		$data['toolbar_buttons'] = array ( anchor ('settings/admin/tree_categories/0/'.TREE_TYPE_TEST, '<i class="fa fa-line-chart"></i> Test Categories') );
		
		
		/* toolbar buttons * /
		$toolbar_buttons = array ();
		if ($test['finalized'] == 0) {
			$toolbar_buttons[] = anchor('coaching/tests/select_method/'.$category_id.'/'.$test_id, '<i class="fa fa-plus"></i> Add questions'); 

			$toolbar_buttons[] = '<a href="javascript:void(0)" onclick="javascript:show_confirm ( \'Publish test at '.$testMarks['marks'].' marks?\', \''.site_url('coaching/tests/finalise_test/'.$category_id.'/'.$test_id).'\')" ><i class="fa fa-star"></i> Publish Test</a>';

			$toolbar_buttons[] = '<a href="javascript:void(0)" onclick="javascript:show_confirm ( \'This will remove all questions added in test.\', \''.site_url('coaching/tests/reset_test/'.$category_id.'/'.$test_id).'\')"  ><i class="fa fa-reorder"></i> Reset Test</a>';
			
			$data['toolbar_backlink'] = anchor ('coaching/tests/select_method/'.$category_id.'/'.$test_id, 'Back');
			
		} else { 
			$data['toolbar_backlink'] = anchor ('coaching/tests/index/'.$test_id, 'Back');
			$toolbar_buttons[] = '<a href="javascript:void(0)" onclick="javascript:show_confirm ( \'This test will not be available to users if it is Un-Published. Un-Publish this test?\', \''.site_url('coaching/tests/unfinalise_test/'.$category_id.'/'.$test_id).'\' )" ><i class="fa fa-star-o"></i> Unpublish Test</a>';
		}
		
		$toolbar_buttons[] = anchor_popup ('coaching/tests/print_test/'.$category_id.'/'.$test_id, '<i class="fa fa-print"></i> Print', array( 'height'=>'800', 'width'=>1024)); 
		
		//-- toolbar buttons
		$data['toolbar_buttons'] = $toolbar_buttons;
		/ * */
		
		$data['category_id'] 		= $category_id;
		$data['test_id'] 			= $test_id;
		$data['lesson_id'] 			= $lesson_id;
		
		$data['script'] = $this->load->view ('tests/scripts/upload_questions', $data, true);
		$this->load->view (INCLUDE_PATH . 'header', $data);
		$this->load->view ('tests/upload_questions', $data);
		$this->load->view (INCLUDE_PATH . 'footer', $data);	
	}

	/* Print Test
	*/
	public function print_test ($coaching_id=0, $category_id=0, $test_id=0, $print=true ) { 

		$data['test'] = $test = $this->tests_model->view_tests ($test_id);

		$data['coaching_id'] = $coaching_id;
		$data['category_id'] = $category_id;
		$data['test_id'] = $test_id;
		
		$questions = $this->tests_model->getTestQuestions ($coaching_id, $test_id);
		$num_questions = count($questions);

		$questionTime = $this->tests_model->getTestQuestionTime ($coaching_id, $questions);
		$result = array ();
		$answers = array ();
		if ( ! empty($questions)) {
			foreach ($questions as $id) {
				$row = $this->qb_model->getQuestionDetails ($id);
				$parent_id = $row['parent_id'];
				$parent_row = $this->qb_model->getQuestionDetails ($parent_id);
				$result[$parent_id]['parent'] = $parent_row;
				$result[$parent_id]['questions'][$id] = $row;
				// Correct Answer
				for ($i=1; $i<=6; $i++) {
					if ($row['answer_'.$i] > 0) {
						$answers[$id] = $row['choice_'.$i];
					}
				}
			}
		}
		
		if ( ! empty($questions)) {
    		$count = 1;
    		$answer_content = '';
    		$answer_content .= '<p style="page-break-before: always"></p>';
    		//$answer_content .= '<h4 class="margin-none">'.$data['coaching_name'].'</h4>';
    		$answer_content .= '<strong>'.$data['test']['title'].'</strong>';
    		$answer_content .= '<hr>';
    		$answer_content .= '<h4>Answer Sheet</h4>';
			$answer_content .= '<ol>';
			foreach ($questions as $id) {
				$answer_content .= '<li>';
					$answer_content .= $answers[$id];
				/*
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
				*/
				$answer_content .= '</li>';
			}
			$answer_content .= '</ol>';
		}

		$data['results'] 		= $result;
		$data['answer_content'] = $answer_content;
		$data['questionTimeSeconds'] = $questionTime;
		$data['questionTime'] = date("H:i", mktime(0,0, $questionTime,0,0,0));		
		
		$data['print'] = true;
		
		$this->load->view(INCLUDE_PATH . 'noheader', $data);
		$this->load->view('tests/print_test', $data);
		$this->load->view(INCLUDE_PATH . 'nofooter', $data);
	}
	
	
	public function answer_sheet ($category_id=0, $test_id ) { 
		$data['category_id'] 	= $category_id;
		$data['test_id'] 		= $test_id;
		
		$data['test'] = $this->tests_model->view_tests ($test_id);

		$questions = $this->tests_model->getTestQuestions ($test_id);		
		$questionTime = $this->tests_model->getTestQuestionTime ($questions);
		
		$data['results'] = $questions;
		$data['questionTimeSeconds'] = $questionTime;
		$data['questionTime'] = date("H:i", mktime(0,0,$questionTime,0,0,0));		
		$data['no_header'] = true;
		$data['page_title'] 	= $data['test']['title'];
		$data['subpage_title'] 	= 'Marks:'.$data['test']['max_marks'];
		
		$this->load->view(INCLUDE_PATH . 'header', $data);
		$this->load->view('tests/answer_sheet', $data);
	}
	
	
}