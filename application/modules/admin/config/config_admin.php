<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin'] = TRUE;

define ('THEME_PATH', 					'themes/admin/');

define ('SYS_TEST_TYPE', 					'TEST_TYPE');
define ('SYS_TEST_MODE', 					'TEST_MODE');
define ('SYS_TEST_LEVELS', 					'TEST_CATEGORY_LEVEL');

define ('TEST_TYPE_REGULAR', 				1);
define ('TEST_TYPE_PRACTICE',				2);
define ('TEST_TYPE_PUBLIC',					3);

define ('TEST_MODE_ONLINE', 				1);
define ('TEST_MODE_OFFLINE', 				2);

define ('TEST_STATUS_UNPUBLISHED', 			0);
define ('TEST_STATUS_PUBLISHED', 			1);

define ('RELEASE_EXAM_NEVER', 				1);
define ('RELEASE_EXAM_ONDATE', 				2);
define ('RELEASE_EXAM_IMMEDIATELY', 		3);
define ('RELEASE_EXAM_ALLMARKED', 			4); 
 
define ('TEST_ADDQ_QB', 					1);
define ('TEST_ADDQ_CREATE', 				2);
define ('TEST_ADDQ_UPLOAD', 				3);

define ('TEST_LEVEL_CATEGORY', 				1);
define ('TEST_LEVEL_EXAM', 					2);
define ('TEST_LEVEL_EXAMTYPE', 				3);
define ('TEST_LEVEL_YEAR', 					4); 

define ('ENROLED_IN_TEST', 					1); 
define ('NOT_ENROLED_IN_TEST', 				2);
define ('ARCHIVED_IN_TEST', 				3); 

define ('TEST_TYPE_ONGOING', 				1); 
define ('TEST_TYPE_UPCOMING', 				2); 
define ('TEST_TYPE_PREVIOUS', 				3); 
