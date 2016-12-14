<?php
/**
 * Author: Peter Dragicevic [peter-91@hotmail.de]
 * Authors-Website: http://petschko.org/
 * Date: 06.09.2016
 * Time: 22:33
 * Update: -
 * Version: 0.0.1
 *
 * Notes: -
 */

(defined('BASE_DIR')) ? die('Const BASE_DIR is already defined...') : define('BASE_DIR', dirname(__FILE__));
(defined('DS')) ? die('Const DS is already defined...') : define('DS', DIRECTORY_SEPARATOR);
(defined('INCLUDE_DIR')) ? die('Const INCLUDE_DIR is already defined...') : define('INCLUDE_DIR', BASE_DIR . DS . 'mc_status_includes');

// Setup error_error reporting
if(! file_exists(BASE_DIR . DS . "__DEBUG__"))
	error_reporting(0); // Turn off ALL error reporting while live
else
	error_reporting(E_ALL);

// Construct the Image
require_once(INCLUDE_DIR . DS . 'framework.php');
