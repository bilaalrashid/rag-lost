<?php

class LoginController {
	
	public function main() {
		return null;
	}

	/**
	 * Authenticate username and password login details
	 * @return boolean [Correct credentials status]
	 */
	public function post() {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
      $authentication = new AuthenticationController();
      $shouldAllowLogin = $authentication->shouldAllowLogin($_POST["username"], $_POST["password"]);

      if ($shouldAllowLogin) {
        SessionController::setIsLoggedIn(true);

        $host = $_SERVER["HTTP_HOST"];
        header("Location: http://{$host}/admin/");
        exit();

        return true;
      }
		}

		return false;
	}

	public function get() {
		return null;
	}

}
