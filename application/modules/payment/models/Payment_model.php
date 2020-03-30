<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment_model extends CI_Model {
	var $table_name;
	public function __construct(){
		$this->load->dbforge();
		parent::__construct();
	}
	public function model_check(){
		$this->table_name = $this->db->dbprefix.'payment_detail';
		if(!($this->db->table_exists($this->table_name))){
			$this->forge_payment_table();
		}
	}
	private function forge_payment_table(){
	    $this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
                'auto_increment' => TRUE
			),
			'coaching_id' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'plan_id' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'txnid' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unique' => TRUE
			),
			'productinfo' => array(
				'type' => 'MEDIUMTEXT'
			),
			'amount' => array(
				'type' => 'FLOAT'
			),
			'firstname' => array(
				'type' => 'VARCHAR',
				'constraint' => '30'
			),
			'lastname' => array(
				'type' => 'VARCHAR',
				'constraint' => '30'
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '50'
			),
			'phone' => array(
				'type' => 'VARCHAR',
				'constraint' => '15'
			),
		));
		$this->dbforge->add_field("`addedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field(array(
			'status' => array(
				'type' => 'VARCHAR',
				'constraint' => '11'
			),
			'unmappedstatus' => array(
				'type' => 'VARCHAR',
				'constraint' => '11'
			),
			'error' => array(
				'type' => 'VARCHAR',
				'constraint' => '10'
			),
			'error_Message' => array(
				'type' => 'MEDIUMTEXT'
			),
		));
		$this->dbforge->add_key('id', TRUE);
	    $attributes = array('ENGINE' => 'InnoDB');
		$this->dbforge->create_table('payment_detail', FALSE, $attributes);
	}
	public function save_payment_detail($received, $payment_id=0){
		$data = array (
			'coaching_id'		=>	$received['coaching_id'],
			'plan_id'			=>	$received['plan_id'],
			'txnid'				=>	$received['payuMoneyId'],
			'addedon'			=>	$received['addedon'],
			'productinfo'		=>	$received['productinfo'],
			'amount'			=>	$received['amount'],
			'firstname'			=>	$received['firstname'],
			'lastname'			=>	$received['lastname'],
			'email'				=>	$received['email'],
			'phone'				=>	$received['phone'],
			'status'			=>	$received['status'],
			'unmappedstatus'	=>	$received['unmappedstatus'],
			'error'				=>	$received['error'],
			'error_Message'		=>	$received['error_Message'],
		);
		$payment = $this->get_payment_detail_by_txnid($received['payuMoneyId']);
		if($payment){
			$this->db->where('txnid', $received['payuMoneyId']);
			$this->db->update('payment_detail', $data);
			$payment_id = $payment['id'];
		}else{
			$this->db->insert('payment_detail', $data);
			$payment_id = $this->db->insert_id();
		}
		return $payment_id;
	}
	public function get_payment_detail($payment_id=0) {
		$this->db->where ('id', $payment_id);
		$this->db->from ('payment_detail');
		$sql = $this->db->get ();
		if  ($sql->num_rows () > 0){
			$result = $sql->row_array();
			return $result;
		}else{
			return false;
		}
	}
	public function get_payment_detail_by_txnid($txnid=0) {
		$this->db->where ('txnid', $txnid);
		$this->db->from ('payment_detail');
		$sql = $this->db->get ();
		if  ($sql->num_rows () > 0){
			$result = $sql->row_array();
			return $result;
		}else{
			return false;
		}
	}
}