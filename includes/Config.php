<?php
/**
 * Author: Peter Dragicevic [peter-91@hotmail.de]
 * Authors-Website: http://petschko.org/
 * Date: 06.09.2016
 * Time: 22:18
 * Update: -
 * Version: 0.0.1
 *
 * Notes: File contains the Config Class
 */

/**
 * Class Config
 */
class Config {
	/**
	 * Server Information
	 */
	const SERVER_ADDRESS = '127.0.0.1';					// IP or Host-Name of the MC-Server
	const SERVER_PORT = 25565;							// Port of the MC-Server (Default: 25565)
	const IS_VANILLA = true;							// Is the Server a Mod-Server (false) or Vanilla (true | Default: true)

	/**
	 * Options for Server-Check
	 */
	const TIMEOUT = 1.5;								// Sec for Timeout (Default: 1.5)
	const PAUSE_BETWEEN_CHECKS = 300;					// Minimum Pause between Checks
	const ENABLE_CHECK = true;							// Enable/Disable check (Default: true)

	/**
	 * Display Options
	 */
	const HIDE_SERVER_ADDRESS = false;					// Show SERVER_ADDRESS (Default: false)
	const HIDE_ADDRESS_TEXT = 'IP/Host is hidden';		// If HIDE_SERVER_ADDRESS is true, show this Text instead of the Address
	const SHOW_CREATOR = true;							// Support me and display my Name (true) if you don't want to show it set this to (false | Default: true)

	/**
	 * Database Options
	 */
	const ENABLE_DB_USE = true;						// Enable Database use (Default: true)

	// If you use SQLite you can ignore this Section (sqlite is used by default)
	const DB_ADDRESS = '127.0.0.1';						// MySQL Database Host/IP-Address
	const DB_PORT = 3306;								// MySQL Database Port (Default: 3306)
	const DB_USER = 'root';								// MySQL Database User
	const DB_PASSWORD = 'root';							// MySQL Database User Password
	const DB_NAME = 'database';							// MySQL Database Name

	/**
	 * Advanced Database Options
	 */
	const DB_TYPE = 'sqlite';							// Select the Database typ (mysql, sqlite, ...) (Default: sqlite)
	const DB_SQLITE_FILE = INCLUDE_DIR . DS . 'status.sqlite3';			// (ONLY SQLite!) Database-File (Default: status.sqlite3)
	const DB_SQLITE_MEMORY = false;					// (ONLY SQLite!) Creates a SQLite-Memory Database (Not recommend | Default: false)
	const DB_CHARSET = 'utf8';							// Database Charset (Default: utf8)
	const DB_CHARSET_COLLATION = 'utf8mb4_unicode_ci';	// Database Charset collation (Default: utf8mb4_unicode_ci)
	const DB_TABLE_PREFIX = '';							// Database Table-Prefix for all Tables (Default: none)
}
