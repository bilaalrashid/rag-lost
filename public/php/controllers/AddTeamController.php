<?php

class AddTeamController {
	
	public function main() {
		return null;
	}

	public function post() {
		$upload_directory =  __DIR__ . "/../../img/uploads";
		$original_team_image_name = FileUploadController::validate_single_image('team_image', $upload_directory);

		$team_name = $_POST["team_name"];
		$members = $_POST["members"];
		$description = $_POST["description"];
		$donate_url = $_POST["donate_url"];

		if (!empty($team_name) && !empty($donate_url) && !empty($original_team_image_name)) {
			$cropped_image = TeamImageController::cropTeamImage($upload_directory, $original_team_image_name);
			$pin_url = '';
			$team_color = '';

			$store = new TeamStore();
			$store->addTeam($team_name, $members ?: '', $description ?: '', $donate_url, $pin_url, "/img/uploads/" . $cropped_image, $team_color);

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
