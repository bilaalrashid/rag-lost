<?php

/**
 * Manages admin authentication
 */
class AuthenticationController {

	/**
	 * Checks if the user should be allowed to login
	 * @return boolean [Are the user credentials correct?]
	 */
	public static function shouldAllowLogin($username, $password) {
    // Yes, this is really, really bad, however, future handover and forgotten credentials are more important
		return ($username == "user" && $password == "pass");
	}

}
