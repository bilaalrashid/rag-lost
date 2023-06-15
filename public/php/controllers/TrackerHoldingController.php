<?php

class TrackerHoldingController {
	
	public function main() {
		$store = new ConfigStore();
		$config = $store->getConfig();

		// Fix SUSU server using BST instead of GMT
    $now = (new DateTimeImmutable())->modify('+1 hour');
    $countdown_start = $config->getCountdownStart();
    if ($now > $countdown_start) {
      $host = $_SERVER["HTTP_HOST"];
      header("Location: http://{$host}/");
      exit();

      return null;
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
