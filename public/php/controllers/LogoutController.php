<?php

class LogoutController {
	
	/**
	 * Destroys session and redirects to login page
	 * @return null
	 */
	public function main() {
		session_destroy();

		$host = $_SERVER["HTTP_HOST"];
		header("Location: http://{$host}/admin/login");
		exit();
	}

	public function post() {
		return null;
	}

	public function get() {
		return null;
	}

}