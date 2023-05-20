<?php

class ConfigStore extends DatabaseController {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Edits the website config in the database.
   * 
   * @param  string  $countdown_start           [The time that the countdown should start from]
	 * @param  float   $start_location_latitude   [The latitude of the start location]
	 * @param  float   $start_location_longitude  [The longitude of the start location]
	 * @param  float   $donation_total            [The total amount of money raised]
	 * @param  string  $donate_url                [The URL of the donation page]
	 */
	public function editConfig(DateTime $countdown_start, float $start_location_latitude, float $start_location_longitude, float $donation_total, string $donate_url) {
		$db = $this->connection;

		$sql = 
    "UPDATE config 
			SET countdown_start = ?, start_location_latitude = ?, start_location_longitude = ?, donation_total = ?, donate_url = ?";

		$statement = $db->prepare($sql);
		$statement->bind_param("sddds", $countdown_start, $start_location_latitude, $start_location_longitude, $donation_total, $donate_url);

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

			$team = new Team($row["id"], $row["countdown_start"], $row["start_location_latitude"], $row["start_location_longitude"], $row["donation_total"], $row["donate_url"]);
		}

		$statement->close();

		return $team;
	}

}
