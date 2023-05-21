<?php

class TeamsApiController {
	
	public function main() {
		// $data = [];

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
		$store = new LocationUpdateStore();
		$locationUpdates = $store->getAllUpdatesForTeam($team->getID());
		$updates = [];
		foreach ($locationUpdates as $update) {
			array_push($updates, array(
				"latitude" => $update->getLatitude(),
				"longitude" => $update->getLongitude(),
				"message" => $update->getUpdateMessage(),
				"timestamp" => $update->getUpdateTimestamp()->format(DateTime::ATOM),
			));
		}

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
