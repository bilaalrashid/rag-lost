<?php

class AdminController {
	
	public function main() {
		$store = new TeamStore();
		$teams = $store->getAllTeams();
		return $teams;
	}

	public function post() {
		return null;
	}

	public function get() {
		return null;
	}

}
