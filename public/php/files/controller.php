<?php

session_start();

$isLoggedIn = SessionController::isLoggedIn();

if ($isLoggedIn != true) {
	$unrestricted = ["/admin/login/", "/api/teams"];

	if (!in_array($_SERVER["REQUEST_URI"], $unrestricted, true)) {
		$host = $_SERVER["HTTP_HOST"];
		header("Location: http://{$host}/admin/login/");
		exit();
	}
}

$controller = new $class();

if (!empty($_POST)) {
	$post = $controller->post();
}

if (!empty($_GET)) {
	$get = $controller->get();
}

$model = $controller->main();
