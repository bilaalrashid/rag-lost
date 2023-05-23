<?php

class EditAdvancedTeamController {
	
	public function main() {
    if (!empty($_GET["id"])) {
      $id = $_GET["id"];
      $store = new TeamStore();
      $team = $store->getTeamFromID($id);
      return $team;
    }

		return null;
	}

	public function post() {
    return null;
	}

	public function get() {
		return null;
	}

}
