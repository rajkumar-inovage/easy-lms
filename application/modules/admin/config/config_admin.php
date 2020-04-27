<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin'] = TRUE;

define ('INCLUDE_PATH', 			    'admin/layout/');

// Default User Roles
defined('USER_ROLE_SUPER_ADMIN') or define ('USER_ROLE_SUPER_ADMIN', 			1);
defined('USER_ROLE_ADMIN') or define ('USER_ROLE_ADMIN', 					2);
defined('USER_ROLE_TEACHER') or define ('USER_ROLE_TEACHER', 				3);
defined('USER_ROLE_STUDENT') or define ('USER_ROLE_STUDENT', 				4);
defined('USER_ROLE_COACHING_ADMIN') or define ('USER_ROLE_COACHING_ADMIN',			5);
defined('USER_ROLE_PENDING') or define ('USER_ROLE_PENDING', 				7);
defined('USER_ROLE_DISABLED') or define ('USER_ROLE_DISABLED', 				8);


// Default User Status
defined('USER_STATUS_DISABLED') or define ('USER_STATUS_DISABLED', 			0);
defined('USER_STATUS_ENABLED') or define ('USER_STATUS_ENABLED', 				1);
defined('USER_STATUS_UNCONFIRMED') or define ('USER_STATUS_UNCONFIRMED', 			2);
defined('USER_STATUS_ALL') or define ('USER_STATUS_ALL', 					3);

// SYS Parameters
defined('SYS_USER_STATUS') or define ('SYS_USER_STATUS', 					'USER_STATUS');
defined('SYS_STUDENT_LEVELS') or define ('SYS_STUDENT_LEVELS', 				'STUDENT_CATEGORY_LEVEL');
defined('SYS_REF_ID_PREFIX') or define ('SYS_REF_ID_PREFIX', 				'REF_ID_PREFIX');
