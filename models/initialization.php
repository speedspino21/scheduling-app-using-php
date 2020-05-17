<?php 
//define the path
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'office_appointment');
defined('CONFIG_PATH') ? null : define('CONFIG_PATH', SITE_ROOT.DS.'config');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'models');

// bring in db connection 
require_once(CONFIG_PATH.DS.'database.php');

// bring in the system functions 
require_once(LIB_PATH.DS.'functions.php');

// bring appointments
require_once(LIB_PATH.DS.'appointments.php');