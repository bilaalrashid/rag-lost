<?php

/**
 * Manages the current session
 */
class SessionController {

	/**
	 * Gets the current login status
	 * @return boolean [Login status]
	 */
	public static function isLoggedIn(): bool {
		if (!empty($_SESSION["auth"])) {
			return $_SESSION["auth"];
		} else {
			return false;
		}			
	}

}
