<?php

class ViewLocationUpdateController {
	
	public function main() {
		return null;
	}

	public function post() {
		return null;
	}

	public function get() {
		$team_id = $_GET["teamID"];

		if (!empty($team_id)) {
			$location_update_store = new LocationUpdateStore();
			$updates = $location_update_store->getAllUpdatesForTeam($team_id);

			$team_store = new TeamStore();
			$team = $team_store->getTeamFromID($team_id);

			return [$team, $updates];
		}

		return false;
	}

}
