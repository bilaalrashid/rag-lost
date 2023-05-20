<?php

class AddTeamController {
	
	public function main() {
		return null;
	}

	public function post() {
		$team_name = $_POST["team_name"];
		$members = $_POST["members"];
		$description = $_POST["description"];
		$donate_url = $_POST["donate_url"];
		$pin_url = '';
		$team_image_url = $_POST["team_image_url"];
		$team_color = '';

		if (!empty($team_name) && !empty($donate_url)) {
			$store = new TeamStore();
			$store->addTeam($team_name, $members ?: '', $description ?: '', $pin_url, $donate_url, $team_image_url ?: '', $team_color);

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
