<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tests_model extends CI_Model {	

	public function __construct() {
		parent::__construct();
	} 
	
	
	/* Test Plan Categories */
	public function test_categories ($coaching_id=0, $plan_id=0, $status='-1') {
		if ($status > '-1') {
			$this->db->where ('status', $status);
		}
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('plan_id', $plan_id);
		$sql = $this->db->get ('coaching_test_categories');
		return $sql->result_array ();
	}

	public function get_category ($category_id=0) {
		$this->db->where ('id', $category_id);
		$sql = $this->db->get ('coaching_test_categories');
		return $sql->row_array ();
	}

	//=========== Model for list tests =======================
	public function get_latest_tests ($limit=5) {
		$this->db->where ('coaching_id', $coaching_id);
		
		$this->db->where ('finalized', 1);
		$this->db->order_by ('creation_date', 'DESC');
		if ($limit > 0)	
			$this->db->limit ($limit);
		$query = $this->db->get ("coaching_tests");
		if ($query->num_rows() > 0)	{
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	//=========== Model for list tests =======================
	public function get_all_tests ($coaching_id=0, $category_id=0, $type=0) {
		
		if ( $type > 0 ) {
			$this->db->where ('test_type', $type);			
		}
		if ( $category_id > 0 ) {
			$this->db->where ('category_id', $category_id);
		}
		
		$this->db->where ('finalized', 1);
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->order_by ('creation_date', 'DESC');
		
		$query = $this->db->get ("coaching_tests");
		$results = $query->result_array();		
		$data = [];
		if (! empty ($results))	{
			foreach ($results as $row) {
                $questions = $this->getTestQuestions ($coaching_id, $row['test_id']);
                $testMarks = $this->getTestQuestionMarks ($coaching_id, $row['test_id']);

                if (! empty ($questions)) {
                    $num_test_questions = count ($questions);
                } else {
                    $num_test_questions = 0;
                }

                $row['test_marks'] = $testMarks;
                $row['num_test_questions'] = $num_test_questions;

                $data[] = $row;
			}
		}
		return $data;
	}

	
	//=========== Model for list tests =======================
	public function list_test ($category_id=0, $type=0, $finalized=0) {
		
		if ($type > 0) {
			$this->db->where ('test_type', $type);
		}
		if ($category_id > 0) {
			$this->db->where ('category_id', $category_id);
		}
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->order_by ('creation_date', 'DESC');
		$this->db->where ('finalized', $finalized);
		$query = $this->db->get ("coaching_tests");
		if ($query->num_rows() > 0)	{
			// prepare the array with key value to be displayed
			foreach ($query->result_array() as $row) {
				$results[ $row['test_id'] ] = $row;
			}
			return $results;
		} else {
			return false;
		}
	}
	
	//=========== Model for search tests =======================
	public function search_tests ($coaching_id=0) {
		
		$status = $this->input->post ('search_status');
		$type = $this->input->post ('search_type');
		$search = $this->input->post ('search_text');
				
		if ($search != '') {
			$this->db->like ('title', $search, 'both');
		}
		if ($status > '-1') {
			$this->db->where ('finalized', $status);			
		}
		$this->db->where ('coaching_id', $coaching_id);
		$query = $this->db->get ("coaching_tests");
		return $query->result_array();
	}
	
	
	
	//=========== Browsw All Tests =======================
	public function browse_tests ($category_id=0, $type=TEST_TYPE_PRACTICE) {
		//$this->db->where ('finalized', 1);
		$this->db->where ('test_type', $type);
		if ( ! empty ($category_id) ) {
			$this->db->where_in ('category_id', $category_id);			
		}
		$query = $this->db->get ("coaching_tests");
		if ($query->num_rows() > 0)	{
			// prepare the array with key value to be displayed
			foreach ($query->result_array() as $row) {
				$results[ $row['test_id'] ] = $row;
			}
			return $results;
		} else {
			return false;
		}
	}

	//=========== Model for View a details of test =====================
	public function view_tests ($tid) {
		//$this->db->where ('coaching_id', $coaching_id);		
		$this->db->where ('test_id', $tid);
		$query = $this->db->get ('coaching_tests');
		if ($query->num_rows() > 0)	{
			// prepare the array with key value to be displayed
			$results = $query->row_array();
			return $results;
		} else {
			return false;
		}
	}
	
	
	
	// Get tests in which a user is enroled
	public function enroled_in_tests ($member_id=0) {
		$q = $this->db->get_where ("coaching_test_enrolments", array ("member_id"=>$member_id));
		if ($q->num_rows () > 0 ) {
			return $q->result_array();
		} else {
			return false;
		}
	}	

	
	// returns an array of questions added in to a test
	public function getTestQuestions ($coaching_id=0, $test_id=0, $parent_id=0) {
		$this->db->select('CQ.*');
		$this->db->from('coaching_test_questions CTQ');
		$this->db->join('coaching_questions CQ', 'CTQ.question_id=CQ.question_id');
		$this->db->where ('CTQ.coaching_id', $coaching_id);
		$this->db->where ('CTQ.test_id', $test_id);
		if ($parent_id > 0) {
			$this->db->where ('CQ.parent_id', $parent_id);
		}
		$query = $this->db->get ();
		return $query->result_array();
	}	
	
	
	// gives total marks of the added questions in a test
	public function getTestQuestionMarks ($coaching_id=0, $test_id=0) {
		$marks = 0;
		$data = [];
		$questions = $this->getTestQuestions ($coaching_id, $test_id);
		//print_r ($questions);
		if ( ! empty ($questions) ) {
			foreach ($questions as $row) {
				$data[] = $row['question_id'];
			}
			$this->db->select_sum ('marks');
			$this->db->where ('coaching_id', $coaching_id);
			$this->db->where_in( 'question_id', $data);
			$query = $this->db->get( 'coaching_questions');
			$result = $query->row_array ();
			$marks = $result['marks'];		
		}

		return $marks;
	}

	// gives time of added questions 
	public function getTestQuestionTime( $coaching_id, $questions ) {
		$this->db->select_sum('time');
		$this->db->where_in( 'question_id', $questions);
		$this->db->where ('coaching_id', $coaching_id);
		$query = $this->db->get( 'coaching_questions');
		foreach ( $query->result() as $row ) {
			return $row->time;
		}
	}	
	
	

	// get all enroled users in a test
	public function get_enrolment_details ($coaching_id=0, $test_id=0, $member_id=0) {
		$this->db->where ('coaching_id', $coaching_id);
		$this->db->where ('test_id', $test_id);
		$this->db->where ('member_id', $member_id);
		$query = $this->db->get ('coaching_test_enrolments');
		return $query->row_array();			
	}
	
	
	
	public function get_parent_question($qid) {
		$this->db->select("parent_id");
		$this->db->where("question_id", $qid);
		$this->db->where ('coaching_id', $coaching_id);
		
		$query = $this->db->get('coaching_questions');
		if($query->num_rows()>0){
			$results = $query->row_array();
			return $results['parent_id'];
		} else {
			return false;
		}
	}
	
	public function all_question_group ($test_id) {
		$this->db->where("test_id", $test_id);
		$this->db->where ('coaching_id', $coaching_id);
		
		$query = $this->db->get("coaching_test_questions");
		if ($query->num_rows() > 0) {
			$results = $query->result_array();
			return $results;
		} else {
			return false;
		}
			
	}
	
	// returns an array of questions added in to the test
	public function test_category_name ($subject_id) {
		$test_subject = $this->test_subject_details ($subject_id);
		$subject = $test_subject['title'];
		$test_category = $this->get_test_categories ($test_subject['parent_id']);
		$category = $test_category['title'];
		$result = array ('category'=>$category, 'subject'=>$subject);
		return $result;
	}

	public function get_monthly_test ($year, $month) {

		// Last day of given month
		$str_start = $year . '-' . $month . '-01';		
		$last_day = date ('t', strtotime ($str_start));
		
		$plan_start_date = mktime (0,0,0, $month, 1, $year);
		$plan_end_date   = mktime (0,0,0, $month, $last_day, $year);
		
		//$this->db->where ('start_date >=', $plan_start_date);
		//$this->db->where ('end_date <=', $plan_end_date);	
	
		$this->db->group_by ('start_date');
		$sql = $this->db->get ('coaching_test_enrolments');
		if ($sql->num_rows () > 0 ) {
			return $sql->result_array ();
		} else {
			return false;
		}
	}
	
	// tests taken within range

	//=========== Model for list tests =======================
	public function get_enroled_tests ($coaching_id=0, $member_id=0, $test_type=TEST_TYPE_REGULAR) {
		$this->db->select ('T.*, TE.start_date, TE.end_date, TE.attempts, TE.release_result');
		$this->db->from ('coaching_tests T');
		$this->db->join ('coaching_test_enrolments TE', 'T.test_id=TE.test_id');
		$this->db->where ('T.finalized', 1);
		$this->db->where ('T.test_type', $test_type);
		$this->db->where ('T.coaching_id', $coaching_id);
		$this->db->where ('TE.member_id', $member_id);
		$this->db->order_by ('TE.start_date', 'DESC');
		$sql = $this->db->get ();
		return $sql->result_array ();
	}

	
	// Model for get details of enrolled member(Such as Date & Time)	
	public function user_enroled_in_tests ($member_id, $test_type=0, $filter=0) {
		$time = time ();
		if ($filter == TEST_TYPE_ONGOING) {
			$this->db->where ('start_date <=', $time); 
			$this->db->where ('end_date >', $time);
		} else if ($filter == TEST_TYPE_UPCOMING) {
			$this->db->where ('start_date >', $time);
			$this->db->where ('end_date >', $time);
		} else if ($filter == TEST_TYPE_PREVIOUS) {
			$this->db->where ('start_date <', $time);
			$this->db->where ('end_date <', $time);
		}
		$this->db->where (array ('member_id'=>$member_id));
		$query = $this->db->get_where ("coaching_test_enrolments");
		if ($query->num_rows () > 0 ) {
			return  $query->result_array();			
		} else {
			return false;
		}
	}

	//check number of attempts of a test
	public function check_attempt ($coaching_id, $tid, $member_id) {
		$this->db->where ("test_id", $tid);
		$this->db->where ("member_id", $member_id);
		$this->db->where ('coaching_id', $coaching_id);
		
		$this->db->from ("coaching_test_attempts");		
		return $this->db->count_all_results ();
	}
	
	//check for valid test session
	public function check_session ($coaching_id, $tid, $member_id) {
		$this->db->select_max ("loggedon");
		$this->db->where ("test_id", $tid);
		$this->db->where ("member_id", $member_id);
		$this->db->where ('coaching_id', $coaching_id);
		
		$sql = $this->db->get ("coaching_test_attempts");		
		
		if ($sql->num_rows () > 0) {
			$result = $sql->row();
			return $result->loggedon;
		} else {
			return 0;
		}
	}
	
	//insert the time stamp when student starts for test
	public function	save_attempt ($coaching_id, $tid, $member_id, $time){
		$data = array(
					   'test_id' 	=> $tid ,
					   'member_id' 	=> $member_id,
					   'loggedon'	=>	$time,
					   'coaching_id'	=>	$coaching_id,
					   'plan_id'	=>	intval ($this->session->userdata ('plan_id')),
					   'obtained'	=>	0
					);
		$this->db->insert('coaching_test_attempts', $data);		
		return $this->db->insert_id();
	}
	
	
	//model for get how many attempts done by a student.
	public function get_attempts ($member_id, $tid) {
		$this->db->where ("test_id", $tid);
		$this->db->order_by ("loggedon", 'DESC');
		$this->db->where ("member_id", $member_id);		
		$sql = $this->db->get ("coaching_test_attempts");
		if ($sql->num_rows () > 0 ) {
			return $sql->result_array ();
		} else {
			return false;
		}
	}

	//All tests taken by a user
	public function test_taken_by_member ($member_id=0, $attempt=0) {
		$this->db->select ('T.*, TA.loggedon, TA.id AS attempt_id');
		$this->db->from ('coaching_test_attempts TA');
		$this->db->join ('coaching_tests T', 'T.test_id=TA.test_id');
		$this->db->where ('TA.member_id', $member_id);
		$this->db->order_by ('TA.loggedon', 'DESC');
		$this->db->group_by ('TA.test_id');
		$sql = $this->db->get ();
		if ($sql->num_rows () > 0 ) {
			return $sql->result_array ();
		} else {
			return false;
		}
	}
	
	//Insert the answer of a student given by a specific student
	public function insert_answers ($member_id, $test_id, $qid, $answer) {
		$question = $this->qb_model->getQuestionDetails ($qid);
		$type = $question['type'];
		$data = array(
					   'attempt_id' => $this->input->post('attempt_id'),
					   'test_id' 	=> $test_id ,
					   'question_id'=> $qid,
					   'member_id' 	=> $member_id
					);
		//save answer for Question type Multiple choice single correct			
		if($type == QUESTION_MCSC) {
			for($i=1; $i<=6; $i++){
				if($i == $answer){
					$data['answer_'.$i] = $answer;	
				}	
			}
		}
		//save answer for Question type Long answers
		if($type == QUESTION_LONG) {
			$data['answer_1'] = $answer;	
		}
		//save answer for Question type Multiple choice multi correct
		if( $type == QUESTION_MCMC ) {
			for($i=1; $i<=6; $i++) {
				if( isset ($answer[$i]) ) {
					$data['answer_'.$i] = $answer[$i];
				}
			}
		}
		//save answer for Question type True False
		if($type == QUESTION_TF){
			$data['answer_1'] = $answer;	
		}
		//save answer for Question type MATCH THE FOLLOWING
		if($type == QUESTION_MATCH) {
			for ($i=1; $i<=6; $i++) {
				$data['answer_'.$i] = $answer[$i];	
			}			
		}
		
		$this->db->insert('coaching_test_answers', $data); 
	}	
}