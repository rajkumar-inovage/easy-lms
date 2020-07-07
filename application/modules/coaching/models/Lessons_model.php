<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lessons_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		// echo $this->db->last_query();
	}
}