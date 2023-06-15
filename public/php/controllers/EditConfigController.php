<?php

class EditConfigController {
	
	public function main() {
    $store = new ConfigStore();
    $config = $store->getConfig();
		return $config;
	}

	public function post() {
    $countdown_start = date_create_immutable_from_format("Y-m-d*H:i", $_POST["countdown_start"]);
    $start_location_latitude = $_POST["latitude"];
    $start_location_longitude = $_POST["longitude"];
    $donation_total = $_POST["donation_total"];
    $donate_url = '';
    $charity_name = $_POST["charity_name"];

    if (isset($countdown_start) && isset($start_location_latitude) && isset($start_location_longitude) && isset($charity_name)) {
      $store = new ConfigStore();
      $store->editConfig($countdown_start, $start_location_latitude, $start_location_longitude, $donation_total, $donate_url, $charity_name);
      return true;
    }

		return false;
	}

	public function get() {
		return null;
	}

}
