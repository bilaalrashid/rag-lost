<?php

class TrackerHoldingController {
	
	public function main() {
		$store = new ConfigStore();
		$config = $store->getConfig();

    $now = new DateTimeImmutable();
    $countdown_start = $config->getCountdownStart();
    if ($now > $countdown_start) {
      $host = $_SERVER["HTTP_HOST"];
      header("Location: http://{$host}/");
      exit();
    }

		return $config;
	}

	public function post() {
		return null;
	}

	public function get() {
		return null;
	}

}
