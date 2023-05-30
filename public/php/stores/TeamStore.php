<?php

class TeamStore extends DatabaseController {

	public function __construct() {
		parent::__construct();
	}

   /**
    * Creates a new team.
    *
    * @param  string  $team_name       [The name of the team]
    * @param  string  $members         [A summary of all the team members]
    * @param  string  $description     [A description of the team]
    * @param  string  $donate_url      [The URL to donate directly to the team]
    * @param  string  $pin_url         [The URL of the pin to display on the map for the team]
		* @param  string  $team_image_url  [The URL of the team image]
		* @param  string  $team_color      [The color of the team]
    */
	public function addTeam($team_name, $members, $description, $donate_url, $pin_url, $team_image_url, $team_color) {
		$db = $this->connection;

		$sql = 
    "INSERT INTO team(team_name, members, team_description, donate_url, pin_url, team_image_url, team_color) 
			VALUES (?, ?, ?, ?, ?, ?, ?)";

		$statement = $db->prepare($sql);
		$statement->bind_param("sssssss", $team_name, $members, $description, $donate_url, $pin_url, $team_image_url, $team_color);

		$statement->execute();
		$result = $statement->get_result();

		$statement->close();
	}

	/**
	 * Gets all teams from the database.
   * 
	 * @return array       [All teams stored in the database]
	 */
	public function getAllTeams() {
		$db = $this->connection;

		$sql = 
    "SELECT id 
      FROM team";
		
		$statement = $db->prepare($sql);

		$statement->execute();
		$result = $statement->get_result();

		$teams = [];

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$team = $this->getTeamFromID($row["id"]);

				array_push($teams, $team);
			}
		}

		$statement->close();

		return $teams;
	}

	/**
	 * Edits an team in the database.
   * 
   * @param  int     $id              [The id of the team]
   * @param  string  $team_name       [The name of the team]
   * @param  string  $members         [A summary of all the team members]
   * @param  string  $description     [A description of the team]
   * @param  string  $donate_url      [The URL to donate directly to the team]
   * @param  string  $pin_url         [The URL of the pin to display on the map for the team]
	 * @param  string  $team_image_url  [The URL of the team image]
	 * @param  string  $team_color      [The color of the team]
	 */
	public function editTeam($id, $team_name, $members, $description, $donate_url, $pin_url, $team_image_url, $team_color) {
		$db = $this->connection;

		$sql = 
    "UPDATE team 
			SET team_name = ?, members = ?, team_description = ?, donate_url = ?, pin_url = ?, team_image_url = ?, team_color = ?
			WHERE id = ?";

		$statement = $db->prepare($sql);
		$statement->bind_param("sssssssi", $team_name, $members, $description, $donate_url, $pin_url, $team_image_url, $team_color, $id);

		$statement->execute();
		$result = $statement->get_result();

		$statement->close();
	}

	/**
	 * Returns full team object from its id
   * 
	 * @param  int    $id [Team id]
	 * @return ?Team      [Full team object]
	 */
	public function getTeamFromID($id) {
		$db = $this->connection;

		$sql = 
    "SELECT * 
      FROM team 
      WHERE id = ?";

		$statement = $db->prepare($sql);
		$statement->bind_param("i", $id);

		$statement->execute();
		$result = $statement->get_result();

		$team = null;

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			$team = new Team($row["id"], $row["team_name"], $row["members"], $row["team_description"], $row["donate_url"], $row["pin_url"], $row["team_image_url"], $row["team_color"]);
		}

		$statement->close();

		return $team;
	}

	/**
	 * Deletes a team from the database
   * 
	 * @param  int  $id  [Team id]
	 */
	public function deleteTeam($id) {
		$db = $this->connection;

		$sql = 
    "DELETE FROM team
			WHERE id = ?";

		$statement = $db->prepare($sql);
		$statement->bind_param("i", $id);

		$statement->execute();
		$result = $statement->get_result();

		$statement->close();
	}

}
