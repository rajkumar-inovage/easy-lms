<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

$config['config_course'] = '';

defined('COURSE_STATUS_INACTIVE') or define('COURSE_STATUS_INACTIVE', 0);
defined('COURSE_STATUS_ACTIVE') or define('COURSE_STATUS_ACTIVE', 1);
defined('COURSE_STATUS_TRASH') or define('COURSE_STATUS_TRASH', 2);

defined('CATEGORY_STATUS_INACTIVE') or define('CATEGORY_STATUS_INACTIVE', 0);
defined('CATEGORY_STATUS_ACTIVE') or define('CATEGORY_STATUS_ACTIVE', 1);
defined('CATEGORY_STATUS_TRASH') or define('CATEGORY_STATUS_TRASH', 2);

//defined('INCLUDE_PATH') or define('INCLUDE_PATH', 'coaching/layout/');