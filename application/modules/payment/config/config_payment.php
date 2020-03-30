<?php
$config['payment'] = array();
define ('PAYUMONEY_MERCHANT_KEY', 		'rZrEul4Y');
define ('PAYUMONEY_MERCHANT_SALT', 		'4y3o5XBdjm');
define ('PAYUMONEY_BASE_URL', 			'https://sandboxsecure.payu.in');	// For Sandbox Mode
//define ('PAYUMONEY_BASE_URL', 			'https://secure.payu.in');			// For Production Mode

$config['payment']['service_provider'] = "payu_paisa";
$config['payment']['success_url'] = site_url('payment/page/success');
$config['payment']['failure_url'] = site_url('payment/page/failure');