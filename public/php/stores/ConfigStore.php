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
	 * @param  string  $charity_name              [The name of the charity fundraising for]
	 */
	public function editConfig($countdown_start, $start_location_latitude, $start_location_longitude, $donation_total, $donate_url, $charity_name) {
		$db = $this->connection;

		$sql = 
    "UPDATE config 
			SET countdown_start = ?, start_location_latitude = ?, start_location_longitude = ?, donation_total = ?, donate_url = ?, charity_name = ?";

		$statement = $db->prepare($sql);
		$formatted_countdown_start = $countdown_start->format("Y-m-d H:i:s");
		$statement->bind_param("sdddss", $formatted_countdown_start, $start_location_latitude, $start_location_longitude, $donation_total, $donate_url, $charity_name);

		$statement->execute();
		$result = $statement->get_result();

		$statement->close();
	}

	/**
	 * Gets the site config
   * 
	 * @return ?Config       [The config for the site]
	 */
	public function getConfig() {
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

			$config = new Config(date_create_immutable_from_format("Y-m-d H:i:s", $row["countdown_start"]), $row["start_location_latitude"], $row["start_location_longitude"], $row["donation_total"], $row["donate_url"], $row["charity_name"]);
		}

		$statement->close();

		return $config;
	}

}
