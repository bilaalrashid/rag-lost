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

		if (empty($id)) {
			return false;
		}

		$id = $_GET["id"];
		$store = new TeamStore();
		$team = $store->getTeamFromID($id);

		$team_name = $_POST["team_name"];
		$members = $_POST["members"];
		$description = $_POST["description"];
		$charity_name = $_POST["charity_name"];
		$donate_url = $_POST["donate_url"];

		if (empty($team_name) || empty($charity_name) || empty($donate_url)) {
			return false;
		}

		$team_image_url = $team->getTeamImageURL();
		$team_color = $_POST["team_color"];
		$pin_url = $team->getPinURL();

		$upload_directory =  __DIR__ . "/../../img/uploads";
		$original_team_image_name = FileUploadController::validate_single_image('team_image', $upload_directory);
		if (!empty($original_team_image_name) || $team_color != $team->getTeamColor()) {
			$cropped_image = TeamImageController::cropTeamImage($upload_directory, $original_team_image_name ?: basename($team->getTeamImageURL()));

			if (!empty($cropped_image)) {
				$pin_image = TeamImageController::createPinImage($upload_directory, $cropped_image, $team_color);

				if (!empty($pin_image)) {
					$team_image_url = "/img/uploads/" . $cropped_image;
					$pin_url = "/img/uploads/" . $pin_image;
				}
			}
		}

		$store = new TeamStore();
		$store->editTeam($id, $team_name, $members ?: '', $description ?: '', $charity_name, $donate_url, $pin_url, $team_image_url, $team_color);

		if ($team_image_url != $team->getTeamImageURL()) {
			unlink($upload_directory . "/" . basename($team->getTeamImageURL()));
		}

		if ($pin_url != $team->getPinURL()) {
			unlink($upload_directory . "/" . basename($team->getPinURL()));
		}
 
		$host = $_SERVER["HTTP_HOST"];
		header("Location: http://{$host}/admin/");
		exit();

		return true;
	}

	public function get() {
		return null;
	}

}
