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

      // Delete pin and team images associated with this team to prevent clogging up disk space
      $team = $team_store->getTeamFromID($id);
      $upload_directory =  __DIR__ . "/../.." . Constants::imageUploadDirectory;
      unlink($upload_directory . "/" . basename($team->getTeamImageURL()));
      unlink($upload_directory . "/" . basename($team->getPinURL()));

      // Finally, delete the main team object
      $team_store->deleteTeam($id);

      $host = $_SERVER["HTTP_HOST"];
      header("Location: http://{$host}/admin");
      exit();
    }

    return false;
	}

	public function get() {
		return null;
	}

}
