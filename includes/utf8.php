<?php
/**
 * Author: Peter Dragicevic [peter-91@hotmail.de]
 * Authors-Website: http://petschko.org/
 * Date: 12.04.2016
 * Time: 22:29
 * Update: -
 * Version: 0.0.1
 * @package Petschkos Framework
 *
 * Notes: Procedural Code that managed all of the UTF-8 Stuff and data escape
 */

// Include MultiByte functions
require_once('mbFunctions.php');

// Check if multi byte functions are installed
checkMultiByteFunctions();

// Set Header/Encoding
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');

// Escape and Convert Data
$_GET = escapeData($_GET);
$_POST = escapeData($_POST);
$_SERVER = escapeData($_SERVER);
$_REQUEST = escapeData($_REQUEST);
$_FILES = escapeData($_FILES);
$_COOKIE = escapeData($_COOKIE);

