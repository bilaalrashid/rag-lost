<?php

class DeleteTeamController {
	
	public function main() {
		return null;
	}

	public function post() {
    $id = $_POST["id"];

    if (!empty($id)) {
      $location_update_store = new LocationUpdateStore();
      $all_updates = $location_update_store->getAllUpdatesForTeam($id);

      // Delete all location updates associated with this team to prevent consistency issues in the database
      foreach ($all_updates as $update) {
        $location_update_store->deleteUpdate($update->getID());
      }

      $team_store = new TeamStore();
      $team_store->deleteTeam($id);

      $host = $_SERVER["HTTP_HOST"];
      header("Location: http://{$host}/admin");
      exit();

      return true;
    }

    return false;
	}

	public function get() {
		return null;
	}

}
