<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['student'] = TRUE;

define ('THEME_PATH', 					'themes/student/');
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
