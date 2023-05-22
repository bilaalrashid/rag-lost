<?php

class TeamsApiController {
	
	public function main() {
		$store = new TeamStore();
		$teams = $store->getAllTeams();

		$teams_output = [];

		foreach ($teams as $team) {
			array_push($teams_output, $this->formatTeamsData($team));
		}

		$data = array("teams" => $teams_output);

    header("Content-Type: application/json");
    $output_handle = fopen("php://output", "w");
		fwrite($output_handle, json_encode($data));

		return null;
	}

	public function post() {
		return null;
	}

	public function get() {
		return null;
	}

	private function formatTeamsData($team) {
		$config_store = new ConfigStore();
		$config = $config_store->getConfig();

		$location_update_store = new LocationUpdateStore();
		$locationUpdates = $location_update_store->getAllUpdatesForTeam($team->getID());
		$updates = [];

		foreach ($locationUpdates as $update) {
			array_push($updates, array(
				"latitude" => $update->getLatitude(),
				"longitude" => $update->getLongitude(),
				"message" => $update->getUpdateMessage(),
				"distanceKm" => CoordinateUtils::distance($update->getLatitude(), $update->getLongitude(), $config->getStartLocationLatitude(), $config->getStartLocationLongitude(), "K"),
				"locationName" => $update->getLocationName(),
				"timestamp" => $update->getUpdateTimestamp()->format(DateTime::ATOM),
			));
		}

		array_push($updates, array(
			"latitude" => $config->getStartLocationLatitude(),
			"longitude" => $config->getStartLocationLongitude(),
			"message" => "And they're off!",
			"distanceKm" => CoordinateUtils::distance($config->getStartLocationLatitude(), $config->getStartLocationLongitude(), $config->getStartLocationLatitude(), $config->getStartLocationLongitude(), "K"),
			"locationName" => "Mystery Location",
			"timestamp" => $config->getCountdownStart()->format(DateTime::ATOM),
		));

		return array(
			"id" => $team->getID(),
			"name" => $team->getTeamName(),
			"members" => $team->getMembers(),
			"description" => $team->getTeamDescription(),
			"donateUrl" => $team->getDonateURL(),
			"pinUrl" => $team->getPinURL(),
			"teamImageUrl" => $team->getTeamImageURL(),
			"teamColor" => $team->getTeamColor(),
			"updates" => $updates,
		);
	}

}
