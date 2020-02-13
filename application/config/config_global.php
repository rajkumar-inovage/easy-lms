<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['global'] = TRUE;

$config['general']['site_title']		= 'IndiaTests Coaching';
$config['general']['home_url']			= 'https://indiatests.in';
$config['general']['contact_email']		= 'contact@indiatests.in';
$config['general']['max_file_size']		= 52428800;
$config['general']['gst_slab']		    = 18;

$config['upload_dir']					= 'contents/';
$config['temp_dir']						= 'contents/temp/';
$config['sys_dir']						= 'contents/system/';
$config['system_logo']					= 'contents/system/system_logo.png';
$config['profile_picture_path']			= 'contents/profile_images/';

define ('INCLUDE_PATH', 			    'layout/templates/');
define ('SCRIPT_PATH', 				    'layout/scripts/');
define ('THEME_PATH', 					'themes/default/');

define ('COMPANY_NAME', 				'Inovexia Software Services Pvt Ltd');
define ('COMPANY_URL', 					'https://inovexiasoftware.com');

/* MENU TYPES */
$config['MENU_TYPES']['MAIN_MENU']      = 1;

// TREE CATEGORIES
define ('SYS_TREE_TYPE_QB', 			'TREE_TYPE_QB');
define ('SYS_TREE_TYPE_TEST', 			'TREE_TYPE_TEST');
define ('SYS_TREE_TYPE_STUDENT', 		'TREE_TYPE_STUDENT');
define ('SYS_TREE_TYPE_LESSON', 		'TREE_TYPE_LESSON');

// TREE TYPES
define ('TREE_TYPE_QB', 						1);
define ('TREE_TYPE_TEST', 						2);
define ('TREE_TYPE_STUDENT',			 		3);

define ('RECORDS_PER_PAGE',			 	20);