<?php

class LocationUpdateStore extends DatabaseController {

	public function __construct() {
		parent::__construct();
	}

   /**
    * Creates a new location update for a team.
    *
    * @param  float   $latitude          [The updated latitude]
    * @param  float   $longitude         [The update longitude]
    * @param  string  $update_message    [A message to display with the update]
    * @param  int     $team_id           [The ID of the team that is update is for]
    */
	public function addUpdate(float $latitude, float $longitude, string $update_message, int $team_id) {
		$db = $this->connection;

		$sql = 
    "INSERT INTO location_update(latitude, longitude, update_message, update_timestamp, team_id) 
			VALUES (?, ?, ?, NOW(), ?)";

		$statement = $db->prepare($sql);
		$statement->bind_param("ddsi", $latitude, $longitude, $update_message, $team_id);

		$statement->execute();
		$result = $statement->get_result();

		$statement->close();
	}

	/**
	 * Gets all location updates from the database.
   * 
   * @param  int     $team_id  [The ID of the team to get updates for]
	 * @return array             [All teams stored in the database]
	 */
	public function getAllUpdatesForTeam(int $team_id): array {
		$db = $this->connection;

		$sql = 
    "SELECT id 
      FROM location_update
      WHERE team_id = ?";
		
		$statement = $db->prepare($sql);
    $statement->bind_param("i", $team_id);

		$statement->execute();
		$result = $statement->get_result();

		$updates = [];

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$update = $this->getUpdateFromID($row["id"]);

				array_push($updates, $update);
			}
		}

		$statement->close();

		return $updates;
	}

	/**
	 * Returns full location update object from its id
   * 
	 * @param  int    $id       [Location update id]
	 * @return ?LocationUpdate  [Full location update object]
	 */
	public function getUpdateFromID(int $id): ?LocationUpdate {
		$db = $this->connection;

		$sql = 
    "SELECT * 
      FROM location_update 
      WHERE id = ?";

		$statement = $db->prepare($sql);
		$statement->bind_param("i", $id);

		$statement->execute();
		$result = $statement->get_result();

		$update = null;

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			$update = new LocationUpdate($row["id"], $row["latitude"], $row["longitude"], $row["update_message"], date_create_from_format("Y-m-d H:i:s", $row["update_timestamp"]), $row["team_id"]);
		}

		$statement->close();

		return $update;
	}

	/**
	 * Deletes a location update from the database
   * 
	 * @param  int  $id  [Team id]
	 */
	public function deleteUpdate(int $id) {
		$db = $this->connection;

		$sql = 
    "DELETE FROM location_update
			WHERE id = ?";

		$statement = $db->prepare($sql);
		$statement->bind_param("i", $id);

		$statement->execute();
		$result = $statement->get_result();

		$statement->close();
	}

}
