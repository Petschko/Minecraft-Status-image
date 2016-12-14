<?php
/**
 * Author: Peter Dragicevic [peter-91@hotmail.de]
 * Authors-Website: http://petschko.org/
 * Date: 06.09.2016
 * Time: 22:42
 * Update: -
 * Version: 0.0.1
 *
 * Notes: -
 */

define('MODEL_DIR', INCLUDE_DIR . DS . 'models');
define('MAIN_DB', 'dbConnection');

// Require Files
require_once(INCLUDE_DIR . DS . 'Config.php');
require_once(INCLUDE_DIR . DS . 'functions.php');
require_once(INCLUDE_DIR . DS . 'utf8.php');
require_once(INCLUDE_DIR . DS . 'dao' . DS . 'DB.php');
require_once(INCLUDE_DIR . DS . 'dao' . DS . 'SQLError.php');
require_once(MODEL_DIR . DS . 'BaseDBTableModel.php');

// Create Database Connection
$dsn = Config::DB_TYPE . ':' . (
	(Config::DB_TYPE == 'sqlite') ?
		((Config::DB_SQLITE_MEMORY) ? ':memory:' : Config::DB_SQLITE_FILE) :
		'host=' . Config::DB_ADDRESS . ';port=' . Config::DB_PORT . ';dbname=' . Config::DB_NAME . ';Charset=' . Config::DB_CHARSET
	);

new DB(
	MAIN_DB,
	$dsn,
	(Config::DB_TYPE == 'sqlite') ? null : Config::DB_USER,
	(Config::DB_TYPE == 'sqlite') ? null : Config::DB_PASSWORD,
	(Config::DB_TYPE == 'sqlite') ? null : array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . Config::DB_CHARSET)
);
