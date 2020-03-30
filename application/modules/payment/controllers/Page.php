<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Page extends MX_Controller {

	var $autoload = array ();

	public function __construct () {
		/*
		$modules = array ('tests');
		$this->autoload = $this->common_model->autoload_resources ($modules);
		*/
		$this->load->config ('config_payment');
		$this->load->model ('payment_model');
		$this->payment_model->model_check();
	}
	public function _n( $single, $plural, $number) {
	    if ( intval($number) === 1 )
        	return $single;
        else
        	return $plural;
	}
	public function checkout () {
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$config = $this->config->item ('payment');
			$action = '';
			$formError = 0;
			$hash = '';
			$posted = array();
			$next_step = 5;
			/*
			if(!empty($_POST)) {
			    //print_r($_POST);
				foreach($_POST as $key => $value) {    
			    	$posted[$key] = $value; 
				}
			}
			*/
			if(empty($posted['txnid'])) {
				// Generate random transaction id
				$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			} else {
				$txnid = $posted['txnid'];
			}
			$duration = sprintf( $this->_n( '%s month', '%s months', $_POST['plan_duration'] ), $_POST['plan_duration'] );
			$posted['key'] = PAYUMONEY_MERCHANT_KEY;
			$posted['txnid'] = $txnid;
			$posted['amount'] = $_POST['tammount'];
			$posted['firstname'] = $_POST['owner_name'];
			$posted['email'] = $_POST['email'];
			$posted['phone'] = $_POST['contact'];
			$posted['productinfo'] = $_POST['productinfo'] . ' Plan for ' . $duration;
			$posted['surl'] = $config['success_url'];
			$posted['furl'] = $config['failure_url'];
			//udf1 => coaching_id
			$posted['udf1'] = $_POST['coaching_id'];
			//udf2 = plan_id
			$posted['udf2'] = $_POST['plan_id'];
			$posted['service_provider'] = $config['service_provider'];
			// Hash Sequence
			$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
			if (empty($posted['hash']) && sizeof($posted) > 0) {
				if (empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) || empty($posted['service_provider'])) {
					$formError = 1;
				} else {
					$hashVarsSeq = explode('|', $hashSequence);
					$hash_string = '';
					foreach($hashVarsSeq as $hash_var) {
						$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
						$hash_string .= '|';
					}
					$hash_string .= PAYUMONEY_MERCHANT_SALT;
					$hash = strtolower(hash('sha512', $hash_string));
					$action = PAYUMONEY_BASE_URL.'/_payment';
				}
			}
			$posted['hash'] = $hash;
			$data = array(
				'action' => $action,
				'config' => $config,
				'posted' => $posted,
				'formError' => $formError
			);
			$this->load->view ('checkout', $data);
    	} else {
    		$this->output->set_content_type("application/json");
    		$this->output->set_output(json_encode(array('status'=>false, 'error'=>"<p><strong>Request Method is invalid:</strong> Either you are trying to access this module dirctly or bypassing the Payment process</p>" )));
    	}
	}
	public function success () {
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$received = array();
			if(!empty($_POST)) {
				foreach($_POST as $key => $value) {
					if($key == 'udf1'){
						$key = 'coaching_id';
					}
					if($key == 'udf2'){
						$key = 'plan_id';
					}
					if($key == 'firstname'){
						$owner_name = explode(' ', $value);
						$received['firstname'] = $owner_name[0];
						$received['lastname'] = $owner_name[1];
						continue;
					}
					if($key == 'lastname'){
						continue;
					}
			    	$received[$key] = $value; 
				}
			}
			$data['status'] 		= $status 		= $_POST["status"];
			$data['firstname'] 		= $firstname	= $_POST["firstname"];
			$data['amount'] 		= $amount		= $_POST["amount"];
			$data['txnid'] 			= $txnid		= $_POST["txnid"];
			$data['posted_hash'] 	= $posted_hash	= $_POST["hash"];
			$data['key'] 			= $key			= $_POST["key"];
			$data['productinfo'] 	= $productinfo	= $_POST["productinfo"];
			$data['email'] 			= $email		= $_POST["email"];
			$data['udf1'] 			= $udf1			= $_POST["udf1"];
			$data['udf2'] 			= $udf2			= $_POST["udf2"];
			$data['salt'] 			= $salt			= PAYUMONEY_MERCHANT_SALT;
			$data['received'] 		= $received;
			// Salt should be same Post Request 
			If (isset($_POST["additionalCharges"])) {
				$additionalCharges	=	$_POST["additionalCharges"];
				$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			} else {
				$keyString = "$key|$txnid|$amount|$productinfo|$firstname|$email|$udf1|$udf2||||||||";
				$keyArray 	  		= 	explode("|",$keyString);
				$reverseKeyArray 	= 	array_reverse($keyArray);
				$reverseKeyString	=	implode("|",$reverseKeyArray);
				$CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
			}
			if ($CalcHashString == $posted_hash) {
				$payment_id = $this->payment_model->save_payment_detail($received);
			}
			$data['action'] = site_url('coaching/subscription_actions/change_plan/'.$received['coaching_id'].'/'.$received['plan_id']);
			$data['hash'] = $CalcHashString;
			$data['payment_id'] = $payment_id;
			$this->load->view ('success', $data);
		} else {
    		$this->output->set_content_type("application/json");
    		$this->output->set_output(json_encode(array('status'=>false, 'error'=>"<p><strong>Request Method is invalid:</strong> Either you are trying to access this module dirctly or bypassing the Payment process</p>" )));
    	}
	}
	public function failure () {
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$received = array();
			if(!empty($_POST)) {
				foreach($_POST as $key => $value) {
					if($key == 'udf1'){
						$key = 'coaching_id';
					}
					if($key == 'udf2'){
						$key = 'plan_id';
					}
					if($key == 'firstname'){
						$owner_name = explode(' ', $value);
						$received['firstname'] = $owner_name[0];
						$received['lastname'] = $owner_name[1];
						continue;
					}
					if($key == 'lastname'){
						continue;
					}
			    	$received[$key] = $value; 
				}
			}
			$data['status'] 		= $status 		= $_POST["status"];
			$data['firstname'] 		= $firstname	= $_POST["firstname"];
			$data['amount'] 		= $amount		= $_POST["amount"];
			$data['txnid'] 			= $txnid		= $_POST["txnid"];
			$data['posted_hash'] 	= $posted_hash	= $_POST["hash"];
			$data['key'] 			= $key			= $_POST["key"];
			$data['productinfo'] 	= $productinfo	= $_POST["productinfo"];
			$data['email'] 			= $email		= $_POST["email"];
			$data['udf1'] 			= $udf1			= $_POST["udf1"];
			$data['udf2'] 			= $udf2			= $_POST["udf2"];
			$data['salt'] 			= $salt			= PAYUMONEY_MERCHANT_SALT;
			$data['received'] 		= $received;
			// Salt should be same Post Request 
			If (isset($_POST["additionalCharges"])) {
				$additionalCharges	=	$_POST["additionalCharges"];
				$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			} else {
				$keyString = "$key|$txnid|$amount|$productinfo|$firstname|$email|$udf1|$udf2||||||||";
				$keyArray 	  		= 	explode("|",$keyString);
				$reverseKeyArray 	= 	array_reverse($keyArray);
				$reverseKeyString	=	implode("|",$reverseKeyArray);
				$CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
			}
			if ($CalcHashString == $posted_hash) {
				$payment_id = $this->payment_model->save_payment_detail($received);
			}
			$data['action'] = site_url('coachings/admin/select_plan/'.$received['coaching_id'].'/'.$received['plan_id']);
			$data['hash'] = $CalcHashString;
			$data['payment_id'] = $payment_id;
			$this->load->view ('failure', $data);
		} else {
    		$this->output->set_content_type("application/json");
    		$this->output->set_output(json_encode(array('status'=>false, 'error'=>"<p><strong>Request Method is invalid:</strong> Either you are trying to access this module dirctly or bypassing the Payment process</p>" )));
    	}
	}
}