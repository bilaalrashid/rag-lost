<?php

class TrackerController {
	
	public function main() {
		$store = new ConfigStore();
		$config = $store->getConfig();
		return $config;
	}

	public function post() {
		return null;
	}

	public function get() {
		return null;
	}

}
