<?php

class EditLocationUpdateController {
	
	public function main() {
    if (!empty($_GET["id"])) {
      $id = $_GET["id"];
      $store = new LocationUpdateStore();
      $update = $store->getUpdateFromID($id);
      return $update;
    }

		return null;
	}

	public function post() {
		$id = $_GET["id"];
    $team_id = $_GET["teamID"];
		$latitude = $_POST["latitude"];
		$longitude = $_POST["longitude"];
		$update_message = $_POST["update_message"];
    $update_timestamp = date_create_immutable_from_format("Y-m-d*H:i", $_POST["update_timestamp"]);

    if (!empty($id) && !empty($team_id) && !empty($latitude) && !empty($longitude) && !empty($update_timestamp)) {
      $store = new LocationUpdateStore();
      $store->editUpdate($id, $latitude, $longitude, $update_message ?: '', $update_timestamp);

      $host = $_SERVER["HTTP_HOST"];
      header("Location: http://{$host}/admin/location-update/view/?teamID={$team_id}");
      exit();

      return true;
    }

    return false;
	}

	public function get() {
		return null;
	}

}
