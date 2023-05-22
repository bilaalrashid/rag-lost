<?php

class AddLocationUpdateController {
	
	public function main() {
		return null;
	}

	public function post() {
		$team_id = $_GET["teamID"];
		$latitude = $_POST["latitude"];
		$longitude = $_POST["longitude"];
		$update_message = $_POST["update_message"];

		if (!empty($team_id) && !empty($latitude) && !empty($longitude)) {
			$reverseGeocode = CoordinateUtils::reverseGeocode($latitude, $longitude);
			$location_name = $reverseGeocode["address"]["city"] ?: $reverseGeocode["address"]["city_district"] ?: $reverseGeocode["address"]["village"] ?: $reverseGeocode["address"]["county"] ?: $reverseGeocode["address"]["state"];

			$store = new LocationUpdateStore();
			$store->addUpdate($latitude, $longitude, $update_message ?: '', $location_name ?: '', $team_id);

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
