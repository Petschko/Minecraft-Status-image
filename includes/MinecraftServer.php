<?php
/**
 * Author: Peter Dragicevic [peter-91@hotmail.de]
 * Authors-Website: http://petschko.org/
 * Date: 24.09.2016
 * Time: 16:21
 * Update: -
 * Version: 0.0.1
 *
 * Notes: -
 */

class MinecraftServer {
	/**
	 * @var bool $online - Status of the MC-Server false = offline | true = online
	 */
	private $online = false;

	/**
	 * @var string $name - Name of the MC-Server
	 */
	private $name;

	/**
	 * @var string $address - IP/Hostname of the MC-Server
	 */
	private $address;

	/**
	 * @var int $port - Port of the MC-Server
	 */
	private $port;

	/**
	 * @var null|string $motd - Message of the Day of the MC-Server or null for none
	 */
	private $motd = null;

	/**
	 * @var null|int $maxPlayer - Maximum allowed Player on the MC-Server
	 */
	private $maxPlayer = null;

	/**
	 * @var int $player - Current online Player
	 */
	private $player = 0;

	/**
	 * @var Server $serverDB - Server Database Object
	 */
	private $serverDB;

	/**
	 * MinecraftServer constructor. todo param doc
	 *
	 * @param string $name
	 * @param string $address
	 * @param int $port
	 */
	public function __construct($name, $address, $port) {
		$this->setName($name);
		$this->setAddress($address);
		$this->setPort($port);

		// todo check if server object exists
	}

	/**
	 * Clears Memory
	 */
	public function __destruct() {
		unset($this->online);
		unset($this->name);
		unset($this->address);
		unset($this->port);
		unset($this->motd);
		unset($this->maxPlayer);
		unset($this->player);
	}

	/**
	 * @return boolean
	 */
	public function isOnline() {
		return $this->online;
	}

	/**
	 * @param boolean $online
	 */
	private function setOnline($online) {
		$this->online = $online;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	private function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param string $address
	 */
	private function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * @return int
	 */
	public function getPort() {
		return $this->port;
	}

	/**
	 * @param int $port
	 */
	private function setPort($port) {
		$this->port = $port;
	}

	/**
	 * @return null|string
	 */
	public function getMotd() {
		return $this->motd;
	}

	/**
	 * @param null|string $motd
	 */
	private function setMotd($motd) {
		$this->motd = $motd;
	}

	/**
	 * @return int|null
	 */
	public function getMaxPlayer() {
		return $this->maxPlayer;
	}

	/**
	 * @param int|null $maxPlayer
	 */
	private function setMaxPlayer($maxPlayer) {
		$this->maxPlayer = $maxPlayer;
	}

	/**
	 * @return int
	 */
	public function getPlayer() {
		return $this->player;
	}

	/**
	 * @param int $player
	 */
	private function setPlayer($player) {
		$this->player = $player;
	}
}
