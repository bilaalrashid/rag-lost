<?php

class ConfigApiController {
	
	public function main() {
		$store = new ConfigStore();
		$config = $store->getConfig();

		$data = array(
      "countdown_start" => $config->getCountdownStart()->format(DateTime::ATOM),
      "start_location" => array(
        "latitude" => $config->getStartLocationLatitude(),
        "longitude" => $config->getStartLocationLongitude(),
      ),
      "end_location" => array(
        "latitude" => Constants::finish_latitude,
        "longitude" => Constants::finish_longitude,
      ),
      "donation_total" => $config->getDonationTotal(),
      "donate_url" => $config->getDonateURL(),
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
