<?php

class TeamStore extends DatabaseController {

	public function __construct() {
		parent::__construct();
	}

   /**
    * Creates a new team.
    *
    * @param  string  $team_name    [The name of the team]
    * @param  string  $members      [A summary of all the team members]
    * @param  string  $description  [A description of the team]
    * @param  string  $donate_url   [The URL to donate directly to the team]
    * @param  string  $pin_url      [The URL of the pin to display on the map for the team]
    */
	public function createTeam(string $team_name, string $members, string $description, string $donate_url, string $pin_url) {
		$db = $this->connection;

		$sql = 
    "INSERT INTO team(team_name, members, description, donate_url, pin_url) 
			VALUES (?, ?, ?, ?, ?)";

		$statement = $db->prepare($sql);
		$statement->bind_param("sssss", $team_name, $members, $description, $donate_url, $pin_url);

		$statement->execute();
		$result = $statement->get_result();

		$statement->close();
	}

	/**
	 * Gets all teams from the database.
   * 
	 * @return array       [All teams stored in the database]
	 */
	public function getAllTeams(): array {
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
   * @param  int     $id           [The id of the team]
   * @param  string  $team_name    [The name of the team]
   * @param  string  $members      [A summary of all the team members]
   * @param  string  $description  [A description of the team]
   * @param  string  $donate_url   [The URL to donate directly to the team]
   * @param  string  $pin_url      [The URL of the pin to display on the map for the team]
	 */
	public function editTeam(int $id, string $team_name, string $members, string $description, string $donate_url, string $pin_url) {
		$db = $this->connection;

		$sql = 
    "UPDATE team 
			SET team_name = ?, members = ?, description = ?, donate_url = ?, pin_url = ?
			WHERE id = ?";

		$statement = $db->prepare($sql);
		$statement->bind_param("sssssi", $team_name, $members, $description, $donate_url, $pin_url, $id);

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
	public function getTeamFromID(int $id): ?Team {
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

			$team = new Team($row["id"], $row["team_name"], $row["members"], $row["description"], $row["donate_url"], $row["pin_url"]);
		}

		$statement->close();

		return $team;
	}

	/**
	 * Deletes a team from the database
   * 
	 * @param  int  $id  [Team id]
	 */
	public function deleteTeam(int $id) {
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
