<?php

class DeleteLocationUpdateController {
	
	public function main() {
		return null;
	}

	public function post() {
    $id = $_POST["id"];
    $team_id = $_POST["team_id"];

    if (!empty($id) && !empty($team_id)) {
      $store = new LocationUpdateStore();
      $store->deleteUpdate($id);

      $host = $_SERVER["HTTP_HOST"];
      header("Location: http://{$host}/admin/location-update/view/?teamID={$team_id}");
      exit();
    }

    return false;
	}

	public function get() {
		return null;
	}

}
