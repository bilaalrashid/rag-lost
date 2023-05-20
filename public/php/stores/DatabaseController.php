<?php

require_once "__connect.php";

abstract class DatabaseController {

	protected $connection;

	public function __construct() {
		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
		if ($this->connection->connect_errno) {
			echo "Failed to connect to MySQL: " . $connection->connect_error;
		}
	}

	public function __destruct() {
		$this->connection->close();
	}

}
