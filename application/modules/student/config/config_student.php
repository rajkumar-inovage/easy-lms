<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['student'] = TRUE;

define ('THEME_PATH', 						'themes/student/');
/* System Parameters */
define ('SYS_QB_LEVELS', 					'QB_LEVEL');
define ('SYS_QUESTION_TYPES', 				'QUESTION_TYPE');
define ('SYS_QUESTION_CLASSIFICATION', 		'QUESTION_CLASSIFICATION');
define ('SYS_QUESTION_DIFFICULTIES',		'QUESTION_DIFFICULTY');
define ('SYS_QUESTION_CATEGORIES',			'QUESTION_CATEGORY');

define ('SYS_TEST_TYPE', 					'TEST_TYPE');
define ('SYS_TEST_MODE', 					'TEST_MODE');
define ('SYS_TEST_LEVELS', 					'TEST_CATEGORY_LEVEL');

define ('TEST_TYPE_REGULAR', 				1);
define ('TEST_TYPE_PRACTICE',				2);
define ('TEST_TYPE_PUBLIC',					3);

define ('TEST_TYPE_ONGOING', 				1); 
define ('TEST_TYPE_UPCOMING', 				2); 
define ('TEST_TYPE_PREVIOUS', 				3); 

define ('SUMMARY_REPORT', 					1);
define ('BRIEF_REPORT', 					2);
define ('TOPIC_REPORT', 					3);
define ('DIFFICULTY_REPORT', 				4);
define ('CATEGORY_REPORT', 					5);
define ('DETAIL_REPORT', 					6); 
define ('OVERALL_REPORT', 					7); 

define ('TQ_NOT_ANSWERED', 					0); 
define ('TQ_WRONG_ANSWERED', 				1); 
define ('TQ_CORRECT_ANSWERED', 				2); 

define ('TEST_ERROR_MAX_ATTEMPT_REACHED', 		1);
define ('TEST_ERROR_RECENTLY_TAKEN',			2);
define ('TEST_ERROR_OFFLINE_TEST',				3);
define ('TEST_ERROR_UNPUBLISHED', 				4);
define ('TEST_ERROR_NO_QUESTION',				5);

/* QTYPE = question types: */
define ('QUESTION_MCSC',       				1);
define ('QUESTION_TF',   	  				2);
define ('QUESTION_LONG',  	  				3);
define ('QUESTION_MATCH',      				5);
define ('QUESTION_BLANK',	  				6); 
define ('QUESTION_MCMC',		  			7); 
define ('QB_NUM_ANSWER_CHOICES',		  	6); 