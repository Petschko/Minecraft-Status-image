<?php
/**
 * Author: Peter Dragicevic [peter-91@hotmail.de]
 * Authors-Website: http://petschko.org/
 * Date: 24.09.2016
 * Time: 17:27
 * Update: -
 * Version: 0.0.1
 *
 * Notes: -
 */

class Server extends BaseDBTableModel {
	public $id;
	public $name;
	public $address;
	public $port;
	public $last_update = null;
	public $last_status = 0;
	public $last_player = 0;
	public $last_max_player = 0;
	public $last_motd;

	/**
	 * Sets the Table-Info
	 */
	protected function setTableInfo() {
		// Set Table Name (Required)
		$this->setTableName(Config::DB_TABLE_PREFIX . 'server');

		// Set Fields (Required)
		$this->setTableFields(array(
			'id',
			'name',
			'address',
			'port',
			'last_update',
			'last_status',
			'last_player',
			'last_max_player',
			'last_motd'
		));

		// Set Primary-Key (Optional - If none don't set it)
		$this->setPrimaryKeyField('id');

		// Set Database-Connection (Very Optional - You can also use the constructor to set it)
		$this->setDb(DB::getConnection(MAIN_DB));
	}
}
