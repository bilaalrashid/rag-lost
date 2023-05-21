<?php

class EditTeamController {
	
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
    $id = $_GET["id"];
		$team_name = $_POST["team_name"];
		$members = $_POST["members"];
		$description = $_POST["description"];
		$donate_url = $_POST["donate_url"];
		$pin_url = $_POST["pin_url"];
		$team_image_url = $_POST["team_image_url"];
		$team_color = $_POST["team_color"];

		if (!empty($id) && !empty($team_name) && !empty($donate_url)) {
			$store = new TeamStore();
			$store->editTeam($id, $team_name, $members ?: '', $description ?: '', $donate_url, $pin_url ?: '', $team_image_url ?: '', $team_color ?: '');

			$host = $_SERVER["HTTP_HOST"];
			header("Location: http://{$host}/admin/");
			exit();

			return true;
		}

		return false;
	}

	public function get() {
		return null;
	}

}
