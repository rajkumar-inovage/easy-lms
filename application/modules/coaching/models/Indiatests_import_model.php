<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Indiatests_import_model extends CI_Model {	

	public function __construct() {
		parent::__construct();
	} 
	
	/*-----=====  ITS TEST PLANS =====-----*/
	public function test_plan_categories () {
		// Connect to ITS database
		$its_db = $this->load->database ('its', true);
		
		// Run query
		$its_db->select ('TPC.*');
		$its_db->from ('test_plan_categories TPC');
		$its_db->where ('TPC.status', 1);
		$sql = $its_db->get ();
		return $sql->result_array ();
	}

	public function its_test_plan_cat_exists ($id=0) {
		$this->db->where ('TPC.master_id', $id);
		$sql = $this->db->get ('test_plan_categories TPC');
		return $sql->row_array ();
	}

	public function its_import_category ($category_id=0) {
	    // Connect to ITS database
		$its_db = $this->load->database ('its', true);
		
		// Get test plan categories (ITS)
		$its_db->select ('TPC.*');
		$its_db->from ('test_plan_categories TPC');
		$its_db->where ('TPC.status', 1);
		$its_db->where ('TPC.id', $category_id);
		$sql = $its_db->get ();
        $row = $sql->row_array ();
        
		// Copy Plan categories (If master id not exists)
		$this->db->where ('master_id', $category_id);
		$sql = $this->db->get ('test_plan_categories');
		if ($sql->num_rows () == 0 ) {
			$cat['id']  =  NULL;
			$cat['master_id'] = $row['id'];
			$cat['title'] = $row['title'];
			$cat['description'] = $row['description'];
			$cat['plan_details'] = $row['plan_details'];
			$cat['status'] = 0;
			$cat['creation_date'] = time();
			$cat['created_by'] = intval($this->session->userdata('member_id'));
			$sql = $this->db->insert ('test_plan_categories', $cat);
			$category_id = $this->db->insert_id ();			
		} else {
			exit;
			// Below script will not run if master_id is already present 
		}
        
		// Get all plans in this category (ITS)
		$its_db->select ('TP.*');
		$its_db->from ('test_plans TP');
		$its_db->where ('TP.status', 1);
		$its_db->where ('TP.category_id', $row['id']);
		$sql = $its_db->get ();
        $result = $sql->result_array ();
			
		if (! empty ($result)) {
			foreach ($result as $row) {
				// Insert Plans
				$plan['plan_id']  =  NULL;
				$plan['category_id'] = $category_id;
				$plan['master_id'] = $row['plan_id'];
				$plan['title'] = $row['title'];
				$plan['description'] = $row['description'];
				$plan['amount'] = $row['amount'];
				$plan['status'] = 0;
				$plan['creation_date'] = time();
				$plan['created_by'] = intval($this->session->userdata('member_id'));
				$this->db->insert ('test_plans', $plan);
				$plan_id = $this->db->insert_id ();
				
				// Get all tests (ITS) in this plan 
				$its_db->select ('T.*, TC.id as cat_id, TC.title as cat_title, TC.parent_id as cat_parent_id');
				$its_db->from ('tests T, test_categories TC, tests_in_plan TIP');
				$its_db->where ('T.test_id=TIP.test_id');
				$its_db->where ('TC.id=T.category_id');
				$its_db->where ('TIP.plan_id', $plan_id);
				$sql_tip = $its_db->get ();
				$tests_in_plan = $sql_tip->result_array ();
				
				if (! empty ($tests_in_plan)) {
					foreach ($tests_in_plan as $tip) {
						$test_id = $tip['test_id'];
						
						// Get Test Categories With Parent
						// $new_test_cat_id = $this->copy_parent ($tip['cat_id']);
						// Insert test categories
						$this->db->where ('master_id', $tip['cat_id']);
						$q = $this->db->get ('tests_categories');
						if ($q->num_rows () == 0) {
							$test_cat_data['id'] = NULL;
							$test_cat_data['title'] = $tip['cat_title'];
							$test_cat_data['parent_id'] = 0;
							$test_cat_data['master_id'] = $tip['cat_id'];
							$test_cat_data['level'] = 4;
							$test_cat_data['status'] = 1;
							$test_cat_data['creation_date'] = time ();
							$test_cat_data['created_by'] = intval ($this->session->userdata('member_id'));
							$this->db->insert ('tests_categories', $test_cat_data);
							$new_test_cat_id = $this->db->insert_id ();							
						} else {
							$row = $q->row_array ();
							$new_test_cat_id = $row['id'];
						}

						// Insert tests
						unset ($tip['cat_id'], $tip['cat_title'], $tip['cat_parent_id']);
						$test_data = $tip;
						$test_data['test_id'] = NULL;
						$test_data['category_id'] = $new_test_cat_id;
						$test_data['master_id'] = $test_id;
						$this->db->insert ('tests', $test_data);
						$new_test_id = $this->db->insert_id ();
						
						// Insert tests in plan
						$tip_data['plan_id'] = $plan_id;
						$tip_data['test_id'] = $new_test_id;
						$tip_data['creation_date'] = time ();
						$tip_data['created_by'] = intval($this->session->userdata('member_id'));
						$this->db->insert ('tests_in_plan', $tip_data);
						
						// Get all questions in test (ITS)
						$its_db->select ('Q.*');
						$its_db->from ('questions Q');
						$its_db->join ('tests_questions TQ', 'TQ.question_id=Q.question_id');
						$its_db->where ('TQ.test_id', $test_id);
						$sql_tq = $its_db->get ();
						$test_questions = $sql_tq->result_array ();
						$qp_parent = [];
						if (! empty ($test_questions)) {
							foreach ($test_questions as $tq) {
								// Get question parent
								$its_db->where ('question_id', $tq['parent_id']);
								$sql_qp = $its_db->get ('questions');
								$row_qp = $sql_qp->row_array ();
								$parent_id = $this->insert_parent_question ($row_qp);
								
								// Insert questions
								$q_data = $tq;
								$q_data['question_id'] = NULL;
								$q_data['parent_id'] = $parent_id;
								$q_data['master_id'] = $tq['question_id'];
								$q_data['creation_date'] = time();
								$q_data['created_by'] = intval($this->session->userdata('member_id'));
								$this->db->insert ('questions', $q_data);
								$new_question_id = $this->db->insert_id ();
								
								// Insert Test Questions
								$tq_data['test_id'] = $new_test_id;
								$tq_data['question_id'] = $new_question_id;
								$this->db->insert ('test_questions', $tq_data);
							}
						}
					}
				}
					
			}
		}
	}

}