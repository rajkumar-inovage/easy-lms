<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['config_coachings'] = '';

defined('COACHING_ID_PREFIX1') or define ('COACHING_ID_PREFIX1', 			'CC');
defined('COACHING_ID_PREFIX2') or define ('COACHING_ID_PREFIX2', 			date ('Y'));
defined('COACHING_ID_INCREMENT') or define ('COACHING_ID_INCREMENT', 		1);
defined('COACHING_ID_PADDING') or define ('COACHING_ID_PADDING', 			4);

defined('FREE_SUBSCRIPTION_PLAN_ID') or define ('FREE_SUBSCRIPTION_PLAN_ID', 	1);

// Coaching Account Status
defined('COACHING_ACCOUNT_ACTIVE') or define ('COACHING_ACCOUNT_ACTIVE', 		1);
defined('COACHING_ACCOUNT_PENDING') or define ('COACHING_ACCOUNT_PENDING', 	2);
defined('COACHING_ACCOUNT_DISABLED') or define ('COACHING_ACCOUNT_DISABLED', 	3);

// Subscription Status
defined('SUBSCRIPTION_STATUS_ACTIVE') or define ('SUBSCRIPTION_STATUS_ACTIVE', 	1);
defined('SUBSCRIPTION_STATUS_PENDING') or define ('SUBSCRIPTION_STATUS_PENDING', 	2);
defined('SUBSCRIPTION_STATUS_PAUSED') or define ('SUBSCRIPTION_STATUS_PAUSED', 	3);
defined('SUBSCRIPTION_STATUS_STOPPED') or define ('SUBSCRIPTION_STATUS_STOPPED', 	4);

// Customer Calling Status
defined('STATUS_SUBMITTED') or define ('STATUS_SUBMITTED', 			1);
defined('STATUS_DISCUSSED') or define ('STATUS_DISCUSSED', 			2);
defined('STATUS_PAYMENT_RELEASED') or define ('STATUS_PAYMENT_RELEASED', 		3);
defined('STATUS_PAYMENT_RECEIVED') or define ('STATUS_PAYMENT_RECEIVED', 		4);
defined('STATUS_APPROVED') or define ('STATUS_APPROVED', 				5);
defined('STATUS_DECLINED') or define ('STATUS_DECLINED', 				6);
defined('STATUS_PENDING') or define ('STATUS_PENDING', 				7);

defined('ATTENDANCE_PRESENT') or define ('ATTENDANCE_PRESENT', 			1);
defined('ATTENDANCE_LEAVE') or define ('ATTENDANCE_LEAVE', 			2);
defined('ATTENDANCE_ABSENT') or define ('ATTENDANCE_ABSENT', 			3);

/*---// TESTS //---*/

defined('SYS_TEST_TYPE') or define ('SYS_TEST_TYPE', 					'TEST_TYPE');
defined('SYS_TEST_MODE') or define ('SYS_TEST_MODE', 					'TEST_MODE');
defined('SYS_TEST_LEVELS') or define ('SYS_TEST_LEVELS', 					'TEST_CATEGORY_LEVEL');

defined('TEST_TYPE_REGULAR') or define ('TEST_TYPE_REGULAR', 				1);
defined('TEST_TYPE_PRACTICE') or define ('TEST_TYPE_PRACTICE',				2);
defined('TEST_TYPE_PUBLIC') or define ('TEST_TYPE_PUBLIC',					3);

defined('TEST_MODE_ONLINE') or define ('TEST_MODE_ONLINE', 					1);
defined('TEST_MODE_OFFLINE') or define ('TEST_MODE_OFFLINE', 				2);

defined('TEST_STATUS_UNPUBLISHED') or define ('TEST_STATUS_UNPUBLISHED', 			0);
defined('TEST_STATUS_PUBLISHED') or define ('TEST_STATUS_PUBLISHED', 			1);

defined('RELEASE_EXAM_NEVER') or define ('RELEASE_EXAM_NEVER', 				1);
defined('RELEASE_EXAM_ONDATE') or define ('RELEASE_EXAM_ONDATE', 				2);
defined('RELEASE_EXAM_IMMEDIATELY') or define ('RELEASE_EXAM_IMMEDIATELY', 		3);
defined('RELEASE_EXAM_ALLMARKED') or define ('RELEASE_EXAM_ALLMARKED', 			4); 
 
defined('TEST_ADDQ_QB') or define ('TEST_ADDQ_QB', 					1);
defined('TEST_ADDQ_CREATE') or define ('TEST_ADDQ_CREATE', 				2);
defined('TEST_ADDQ_UPLOAD') or define ('TEST_ADDQ_UPLOAD', 				3);

defined('TEST_LEVEL_CATEGORY') or define ('TEST_LEVEL_CATEGORY', 				1);
defined('TEST_LEVEL_EXAM') or define ('TEST_LEVEL_EXAM', 					2);
defined('TEST_LEVEL_EXAMTYPE') or define ('TEST_LEVEL_EXAMTYPE', 				3);
defined('TEST_LEVEL_YEAR') or define ('TEST_LEVEL_YEAR', 					4); 

defined('ENROLED_IN_TEST') or define ('ENROLED_IN_TEST', 					1); 
defined('NOT_ENROLED_IN_TEST') or define ('NOT_ENROLED_IN_TEST', 				2);
defined('ARCHIVED_IN_TEST') or define ('ARCHIVED_IN_TEST', 				3); 

defined('TEST_TYPE_ONGOING') or define ('TEST_TYPE_ONGOING', 				1); 
defined('TEST_TYPE_UPCOMING') or define ('TEST_TYPE_UPCOMING', 				2); 
defined('TEST_TYPE_PREVIOUS') or define ('TEST_TYPE_PREVIOUS', 				3); 

defined('SUMMARY_REPORT') or define ('SUMMARY_REPORT', 					1);
defined('BRIEF_REPORT') or define ('BRIEF_REPORT', 					2);
defined('TOPIC_REPORT') or define ('TOPIC_REPORT', 					3);
defined('DIFFICULTY_REPORT') or define ('DIFFICULTY_REPORT', 				4);
defined('CATEGORY_REPORT') or define ('CATEGORY_REPORT', 					5);
defined('DETAIL_REPORT') or define ('DETAIL_REPORT', 					6); 
defined('OVERALL_REPORT') or define ('OVERALL_REPORT', 					7); 

defined('TQ_NOT_ANSWERED') or define ('TQ_NOT_ANSWERED', 					0); 
defined('TQ_WRONG_ANSWERED') or define ('TQ_WRONG_ANSWERED', 				1); 
defined('TQ_CORRECT_ANSWERED') or define ('TQ_CORRECT_ANSWERED', 				2); 

/*---// QB //---*/

/* System Parameters */
defined('SYS_QB_LEVELS') or define ('SYS_QB_LEVELS', 					'QB_LEVEL');
defined('SYS_QUESTION_TYPES') or define ('SYS_QUESTION_TYPES', 				'QUESTION_TYPE');
defined('SYS_QUESTION_CLASSIFICATION') or define ('SYS_QUESTION_CLASSIFICATION', 		'QUESTION_CLASSIFICATION');
defined('SYS_QUESTION_DIFFICULTIES') or define ('SYS_QUESTION_DIFFICULTIES',		'QUESTION_DIFFICULTY');
defined('SYS_QUESTION_CATEGORIES') or define ('SYS_QUESTION_CATEGORIES',			'QUESTION_CATEGORY');

/* Lingual */
defined('SYS_QUESTION_LANGUAGE') or define ('SYS_QUESTION_LANGUAGE',		  		'QUESTION_LANGUAGE'); 
defined('HINDI') or define ('HINDI',		  						2); 
defined('ENGLISH') or define ('ENGLISH',	  						1); 

/* QTYPE = question types: */
defined('QUESTION_MCSC') or define ('QUESTION_MCSC',       				1);
defined('QUESTION_TF') or define ('QUESTION_TF',   	  				2);
defined('QUESTION_LONG') or define ('QUESTION_LONG',  	  				3);
defined('QUESTION_MATCH') or define ('QUESTION_MATCH',      				5);
defined('QUESTION_BLANK') or define ('QUESTION_BLANK',	  				6); 
defined('QUESTION_MCMC') or define ('QUESTION_MCMC',		  				7); 
defined('QB_NUM_ANSWER_CHOICES') or define ('QB_NUM_ANSWER_CHOICES',		  		6); 

// Default User Roles
defined('USER_ROLE_SUPER_ADMIN') or define ('USER_ROLE_SUPER_ADMIN', 			1);
defined('USER_ROLE_ADMIN')		 or define ('USER_ROLE_ADMIN', 					2);
defined('USER_ROLE_TEACHER')	 or define ('USER_ROLE_TEACHER', 				3);
defined('USER_ROLE_STUDENT')	 or define ('USER_ROLE_STUDENT', 				4);
defined('USER_ROLE_COACHING_ADMIN') or define ('USER_ROLE_COACHING_ADMIN', 		5);

/*---// USERS //---*/

// Default User Status
defined('USER_STATUS_DISABLED') or define ('USER_STATUS_DISABLED', 			0);
defined('USER_STATUS_ENABLED') or define ('USER_STATUS_ENABLED', 				1);
defined('USER_STATUS_UNCONFIRMED') or define ('USER_STATUS_UNCONFIRMED', 			2);
defined('USER_STATUS_ALL') or define ('USER_STATUS_ALL', 					3);

// Coaching USer Level
defined('USER_LEVEL_COACHING_ADMIN') or define ('USER_LEVEL_COACHING_ADMIN', 		3);

// SYS Parameters
defined('SYS_USER_STATUS') or define ('SYS_USER_STATUS', 					'USER_STATUS');
defined('SYS_STUDENT_LEVELS') or define ('SYS_STUDENT_LEVELS', 				'STUDENT_CATEGORY_LEVEL');
defined('SYS_REF_ID_PREFIX') or define ('SYS_REF_ID_PREFIX', 				'REF_ID_PREFIX');

defined('USER_ROLE_GROUP_QA_OFFICE') or define ('USER_ROLE_GROUP_QA_OFFICE', 		1);
defined('USER_ROLE_GROUP_DIRECT_MAIN') or define ('USER_ROLE_GROUP_DIRECT_MAIN', 		2);

defined('USER_ROLE_PENDING') or define ('USER_ROLE_PENDING', 				7);
defined('USER_ROLE_DISABLED') or define ('USER_ROLE_DISABLED', 				8);

defined('USER_CAT_DIRECT_MAIN') or define ('USER_CAT_DIRECT_MAIN', 			6);
defined('USER_CAT_QA_OFFICE') or define ('USER_CAT_QA_OFFICE', 				10);