<?php

class ConfigStore extends DatabaseController {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Edits the website config in the database.
   * 
   * @param  string  $countdown_start [The time that the countdown should start from]
	 */
	public function editConfig(DateTime $countdown_start) {
		$db = $this->connection;

		$sql = 
    "UPDATE config 
			SET countdown_start = ?";

		$statement = $db->prepare($sql);
		$statement->bind_param("s", $countdown_start);

		$statement->execute();
		$result = $statement->get_result();

		$statement->close();
	}

	/**
	 * Gets the site config
   * 
	 * @return ?Config       [The config for the site]
	 */
	public function getConfig(): ?Config {
		$db = $this->connection;

		$sql = 
    "SELECT * 
      FROM config 
      LIMIT 1";

		$statement = $db->prepare($sql);

		$statement->execute();
		$result = $statement->get_result();

		$team = null;

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			$team = new Team($row["id"], $row["countdown_start"]);
		}

		$statement->close();

		return $team;
	}

}
