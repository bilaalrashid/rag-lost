<?php

class ConfigApiController {
	
	public function main() {
		$store = new ConfigStore();
		$config = $store->getConfig();

		$data = array(
      "countdownStart" => $config->getCountdownStart()->format(DateTime::ATOM),
      "startLocation" => array(
        "latitude" => $config->getStartLocationLatitude(),
        "longitude" => $config->getStartLocationLongitude(),
      ),
      "endLocation" => array(
        "latitude" => Constants::finish_latitude,
        "longitude" => Constants::finish_longitude,
      ),
      "donationTotal" => $config->getDonationTotal(),
      "donateUrl" => $config->getDonateURL(),
      "charityName" => $config->getCharityName(),
    );

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

}
