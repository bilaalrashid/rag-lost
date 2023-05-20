<?php

spl_autoload_register(function ($class) {
	$folders = ["controllers", "helpers", "models", "stores"];

	foreach ($folders as $dir) {
		$file = get_include_path() . "{$dir}/{$class}.php";

		if (file_exists($file)) {
			require_once $file;
		}
	}
});
