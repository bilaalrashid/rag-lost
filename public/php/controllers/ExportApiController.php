<?php

class ExportApiController {
	
	public function main() {
    $zip_name = "rag-lost.zip";

    $zip = new ZipArchive;
    $zip->open($zip_name, ZipArchive::CREATE);

    $zip->addFromString("teams.csv", $this->getTeamsCsv());
    $zip->addFromString("location_updates.csv", $this->getLocationUpdatesCsv());
    $zip->addFromString("config.csv", $this->getConfigCsv());
    $zip->addGlob(".." . Constants::imageUploadDirectory . "/*");

    $zip->close();

    header("Content-Type: application/zip");
    header("Content-disposition: attachment; filename=" . $zip_name);
    header("Content-Length: " . filesize($zip_name));

    echo readfile($zip_name);

    // Bugs in PHP mean we can't use an in-memory file handle, so we have to temporarily write to disk
    unlink($zip_name);

    exit();
	}

	public function post() {
		return null;
	}

	public function get() {
		return null;
	}

  private function getTeamsCsv() {
    $store = new TeamStore();
    $teams = $store->getAllTeams();

    $data = [];
    $data[] = [
      "ID",
      "Team Name",
      "Members",
      "Description",
      "Charity Name",
      "Donate URL",
      "Pin URL",
      "Image URL",
      "Colour"
    ];

    foreach ($teams as $team) {
      $data[] = [
        $team->getID(),
        $team->getTeamName(),
        $team->getMembers(),
        $team->getTeamDescription(),
        $team->getCharityName(),
        $team->getDonateURL(),
        $team->getPinURL(),
        $team->getTeamImageURL(),
        $team->getTeamColor()
      ];
    }

    return $this->convertToCsv($data);
  }

  private function getLocationUpdatesCsv() {
		$config_store = new ConfigStore();
		$config = $config_store->getConfig();

    $team_store = new TeamStore();
    $location_update_store = new LocationUpdateStore();

    $data = [];
    $data[] = [
      "Update ID",
      "Team ID",
      "Team Name",
      "Latitude",
      "Longitude",
      "Distance to Finish (km)",
      "Message",
      "Date",
      "Location Name"
    ];

    $teams = $team_store->getAllTeams();
    foreach ($teams as $team) {
      $updates = $location_update_store->getAllUpdatesForTeam($team->getID());

      $data[] = [
        0,
        $team->getID(),
        $team->getTeamName(),
        $config->getStartLocationLatitude(),
        $config->getStartLocationLongitude(),
        CoordinateUtils::distance($config->getStartLocationLatitude(), $config->getStartLocationLongitude(), Constants::finishLatitude, Constants::finishLongitude, "K"),
        "And they're off!",
        $config->getCountdownStart()->format('c'),
        "Mystery Dropoff"
      ];

      foreach ($updates as $update) {
        $data[] = [
          $update->getID(),
          $team->getID(),
          $team->getTeamName(),
          $update->getLatitude(),
          $update->getLongitude(),
          CoordinateUtils::distance($update->getLatitude(), $update->getLongitude(), Constants::finishLatitude, Constants::finishLongitude, "K"),
          $update->getUpdateMessage(),
          $update->getUpdateTimestamp()->format('c'),
          $update->getLocationName()
        ];
      }
    }

    return $this->convertToCsv($data);
  }

  private function getConfigCsv() {
    $store = new ConfigStore();
    $config = $store->getConfig();

    $data = [];
    $data[] = [
      "Start Date",
      "Start Location Latitude",
      "Start Location Longitude",
      "Donation Total (£)",
      "Donation URL",
      "Charity Name(s)"
    ];

    $data[] = [
      $config->getCountdownStart()->format('c'),
      $config->getStartLocationLatitude(),
      $config->getStartLocationLongitude(),
      $config->getDonationTotal(),
      $config->getDonateUrl(),
      $config->getCharityName()
    ];

    return $this->convertToCsv($data);
  }

  /**
   * Convert a 2D array to a CSV string.
   * @param array $data [The 2D array representing the CSV]
   * @return string [The CSV string]
   */
  private function convertToCsv($data) {
    $fp = fopen("php://memory", "w+");
    foreach ($data as $fields) {
      fputcsv($fp, $fields);
    }

    // Set the pointer back to the start so we can read
    rewind($fp);
    $csv_contents = stream_get_contents($fp);
    fclose($fp);
    
    return $csv_contents;
  }

}
