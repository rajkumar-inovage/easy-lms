<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Indiatests_model extends CI_Model {	

	public function __construct() {
		parent::__construct();
	}
	
	/*-----=====  ITS TEST PLANS =====-----*/
	public function test_plan_categories () {

		// Connect to ITS database
		$its_db = $this->load->database ('its', true);
		
		// Run query
		$its_db->select ('TPC.*');
		$its_db->from ('coaching_test_plan_categories TPC');
		$its_db->where ('TPC.status', 1);
		$sql = $its_db->get ();
		return $sql->result_array ();
	}

	public function test_plan_cat_exists ($id=0) {
		$its_db->where ('TPC.master_id', $id);
		$sql = $its_db->get ('coaching_test_plan_categories TPC');
		return $sql->row_array ();
	}

	/*-----===== Test Plans =====-----*/
	public function test_plans ($category_id=0, $status='', $amount='-1') {
		
		// Connect to ITS database
		$its_db = $this->load->database ('its', true);

		$its_db->select ('TP.*, TPC.id, TPC.title AS cat_title');
		$its_db->from ('coaching_test_plans TP');
		$its_db->join ('coaching_test_plan_categories TPC', 'TP.category_id=TPC.id', 'left');
		if ($category_id > 0) {
			$its_db->where ('TP.category_id', $category_id);
		}
		if ($status != '') {
			$its_db->where ('TP.status', $status);
		}
		if ($amount == 0) {
			$its_db->where ('TP.amount', $amount);
		} else if ($amount > 0) {
			$its_db->where ('TP.amount >', $amount);
		}
		
		$its_db->order_by ('TP.creation_date', 'DESC');
		$sql = $its_db->get ();
		// echo $its_db->last_query ();
		//exit;
		if ($sql->num_rows () > 0 ) {
			$result = $sql->result_array ();
		} else {
			$result = false;
		}
		
		return $result;
	}

	public function tests_in_plan ($plan_id=0, $category_id=0) {

		// Connect to ITS database
		$its_db = $this->load->database ('its', true);

		$prefix = $its_db->dbprefix;
  		$query = 'SELECT T.* FROM '.$prefix.'tests T INNER JOIN '.$prefix.'tests_in_plan TIP ON T.test_id=TIP.test_id WHERE TIP.plan_id='.$plan_id;
		$sql = $its_db->query ($query);
		$result = $sql->result_array ();
		return $result;
	}


	public function buy_plan ($coaching_id=0, $plan_id=0) {
		$data['coaching_id'] = $coaching_id;
		$data['plan_id'] = $plan_id;
		$plan = $this->get_test_plan ($plan_id);
		$sql = $this->db->get_where ('coaching_test_plans', $data);
		if ($sql->num_rows () == 0) {
			$data['plan_name'] = $plan['title'];
			$data['created_by'] = $this->session->userdata ('member_id');
			$data['created_on'] = time ();
			$this->db->insert ('coaching_test_plans', $data);
		}
	}

	public function get_test_plan ($plan_id=0) {
		// Connect to ITS database
		$its_db = $this->load->database ('its', true);
		$its_db->select ('TP.title');
		$its_db->from ('coaching_test_plans TP');
		$its_db->where ('TP.plan_id', $plan_id);
		$sql = $its_db->get ();
        $row = $sql->row_array ();
        return $row;
	}

	public function import_tests ($coaching_id=0, $course_id=0) {
	    // Connect to ITS database
		$its_db = $this->load->database ('its', true);  
		
		$tests = $this->input->post ('tests');
		if (! empty ($tests)) {
			foreach ($tests as $test_id) {
				// Get all details of each test
				$its_db->select ('T.*');
				$its_db->from ('tests T');
				$its_db->where ('T.test_id='.$test_id);
				$sql = $its_db->get ();
				$row = $sql->row_array ();

				// Get all questions in this test
				$its_db->select ('Q.*');
				$its_db->from ('tests_questions TQ');
				$its_db->join ('questions Q', 'TQ.question_id=Q.question_id');
				$its_db->where ('TQ.test_id', $test_id);
				$sql_tq = $its_db->get ();
				$questions = $sql_tq->result_array ();

				// Prepare to copy
				$data = [];
				$data['coaching_id'] 		= $coaching_id;
				$data['course_id'] 			= $course_id;
				$data['unique_test_id'] 	= $row['unique_test_id'];
				$data['title'] 				= $row['title'];
				$data['test_type'] 			= TEST_TYPE_PRACTICE;
				$data['random_questions'] 	= $row['random_questions'];
				$data['time_min'] 			= $row['time_min'];
				$data['max_marks'] 			= $row['max_marks'];
				$data['pass_marks'] 		= $row['pass_marks'];
				$data['negative_marking'] 	= $row['negative_marking'];
				$data['instructions'] 		= $row['instructions'];
				$data['test_mode'] 			= $row['test_mode'];
				$data['finalized'] 			= $row['finalized'];
				$data['difficulty_level'] 	= $row['difficulty_level'];
				$data['created_by'] 		= $this->session->userdata ('member_id');
				$data['creation_date'] 		= time ();

				// Check if test already exists
				$this->db->where ('coaching_id', $coaching_id);
				$this->db->where ('course_id', $course_id);
				$this->db->where ('unique_test_id', $row['unique_test_id']);
				$query = $this->db->get ('coaching_tests');
				if ($query->num_rows () == 0) {
					/* Copy test in local table */
					$this->db->insert ('coaching_tests', $data);
					$new_test_id = $this->db->insert_id ();

					// Prepare to copy questions
					$q_data = [];
					if (! empty ($questions)) {
						foreach ($questions as $q) {
							// Copy questions
							unset ($q['category_id']);
							$q['question_id'] = NULL;
							$q['coaching_id'] = $coaching_id;
							$q['course_id'] = $course_id;
							$q_data = $q;
							$this->db->insert ('coaching_questions', $q_data);
							$question_id = $this->db->insert_id ();

							// Copy test question
							$ta = [];
							$ta['coaching_id'] = $coaching_id;
							$ta['test_id'] = $new_test_id;
							$ta['question_id'] = $question_id;
							$this->db->insert ('coaching_test_questions', $ta);
						}
					}

				}
			}
		}
		
	}


	/*==================// LESSON //========================*/
	public function lesson_plan_categories () {

		// Connect to ITS database
		$its_db = $this->load->database ('its', true);
		
		// Run query
		$its_db->select ('TPC.*');
		$its_db->from ('coaching_lesson_plan_categories TPC');
		$its_db->where ('TPC.status', 1);
		$sql = $its_db->get ();
		return $sql->result_array ();
	}

	public function lesson_plan_cat_exists ($id=0) {
		$its_db->where ('TPC.master_id', $id);
		$sql = $its_db->get ('coaching_lesson_plan_categories TPC');
		return $sql->row_array ();
	}

	/*-----===== Test Plans =====-----*/
	public function lesson_plans ($category_id=0, $status='', $amount='-1') {
		
		// Connect to ITS database
		$its_db = $this->load->database ('its', true);

		$its_db->select ('TP.*, TPC.id, TPC.title AS cat_title');
		$its_db->from ('coaching_lesson_plans TP');
		$its_db->join ('coaching_lesson_plan_categories TPC', 'TP.category_id=TPC.id', 'left');
		if ($category_id > 0) {
			$its_db->where ('TP.category_id', $category_id);
		}
		if ($status != '') {
			$its_db->where ('TP.status', $status);
		}
		if ($amount == 0) {
			$its_db->where ('TP.amount', $amount);
		} else if ($amount > 0) {
			$its_db->where ('TP.amount >', $amount);
		}
		
		$its_db->order_by ('TP.creation_date', 'DESC');
		$sql = $its_db->get ();
		// echo $its_db->last_query ();
		//exit;
		if ($sql->num_rows () > 0 ) {
			$result = $sql->result_array ();
		} else {
			$result = false;
		}
		
		return $result;
	}

	public function lessons_in_plan ($plan_id=0, $category_id=0) {

		// Connect to ITS database
		$its_db = $this->load->database ('its', true);

		$prefix = $its_db->dbprefix;
  		$query = 'SELECT T.* FROM '.$prefix.'lessons T INNER JOIN '.$prefix.'coaching_lessons_in_plan TIP ON T.lesson_id=TIP.lesson_id WHERE TIP.plan_id='.$plan_id;
		$sql = $its_db->query ($query);
		return $sql->result_array ();
	}


	public function buy_lesson_plan ($coaching_id=0, $plan_id=0) {
		$data['coaching_id'] = $coaching_id;
		$data['plan_id'] = $plan_id;
		$plan = $this->get_lesson_plan ($plan_id);
		$sql = $this->db->get_where ('coaching_lesson_plans', $data);
		if ($sql->num_rows () == 0) {
			$data['plan_name'] = $plan['title'];
			$data['created_by'] = $this->session->userdata ('member_id');
			$data['created_on'] = time ();
			$this->db->insert ('coaching_lesson_plans', $data);
		}
	}

	public function get_lesson_plan ($plan_id=0) {
		// Connect to ITS database
		$its_db = $this->load->database ('its', true);
		$its_db->select ('TP.title');
		$its_db->from ('coaching_lesson_plans TP');
		$its_db->where ('TP.plan_id', $plan_id);
		$sql = $its_db->get ();
        $row = $sql->row_array ();
        return $row;
	}

	public function import_lessons ($coaching_id=0, $course_id=0) {
	    // Connect to ITS database
		$its_db = $this->load->database ('its', true);  
		
		$lessons = $this->input->post ('lessons');
		if (! empty ($lessons)) {
			foreach ($lessons as $lesson_id) {
				// Get all details of each lesson
				$its_db->select ('T.*');
				$its_db->from ('lessons T');
				$its_db->where ('T.lesson_id='.$lesson_id);
				$sql = $its_db->get ();
				$row = $sql->row_array ();

				// Copy lesson locally
				unset ($row['category_id']);
				$row['lesson_id'] 		= NULL;
				$row['coaching_id'] 	= $coaching_id;
				$row['course_id'] 		= $course_id;
				$row['created_on'] 		= time ();
				$row['created_by'] 		= $this->session->userdata ('member_id');
				$data = $row;

				// Check if lesson already exists
				$this->db->where ('coaching_id', $coaching_id);
				$this->db->where ('course_id', $course_id);
				$this->db->where ('lesson_key', $row['lesson_key']);
				$query = $this->db->get ('coaching_course_lessons');
				if ($query->num_rows () == 0) {
					$this->db->insert ('coaching_course_lessons', $data);
					$new_lesson_id = $this->db->insert_id ();

					// Get all pages in this lesson
					$its_db->select ('LP.*');
					$its_db->from ('lesson_pages LP');
					$its_db->where ('LP.lesson_id', $lesson_id);
					$sql_tq = $its_db->get ();
					$pages = $sql_tq->result_array ();

					// Copy pages locally
					if  (! empty ($pages)) {
						foreach ($pages as $page) {
							unset ($page['category_id']);
							$page_id 				= $page['page_id'];
							$page['page_id'] 		= NULL;
							$page['coaching_id'] 	= $coaching_id;
							$page['course_id'] 		= $course_id;
							$page['lesson_id'] 		= $new_lesson_id;
							$page['created_on'] 	= time ();
							$page['created_by'] 	= $this->session->userdata ('member_id');
							$this->db->insert ('coaching_course_lesson_pages', $page);
							$new_page_id = $this->db->insert_id ();

							// Get all attachments
							$its_db->select ('LP.*');
							$its_db->from ('lesson_attachments LP');
							$its_db->where ('LP.att_id', $page_id);
							$sql_tq = $its_db->get ();
							$atts = $sql_tq->result_array ();

							if  (! empty ($atts)) {
								foreach ($atts as $att) {
									unset ($att['category_id']);
									$att_id 				= $att['att_id'];
									$att['att_id'] 			= NULL;
									$att['coaching_id'] 	= $coaching_id;
									$att['course_id'] 		= $course_id;
									$att['lesson_id'] 		= $new_lesson_id;
									$att['page_id'] 		= $new_page_id;
									$att['created_on'] 		= time ();
									$att['created_by'] 		= $this->session->userdata ('member_id');
									$this->db->insert ('coaching_course_lesson_pages', $att);
								}
							}

						}
					}

				} 

			}
		}
		
	}

}