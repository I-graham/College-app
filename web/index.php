<?php

	function customError($errno, $errstr) {
		echo "<b>Error:</b> [$errno] $errstr";
	}
	set_error_handler("customError");

	$output = "";

	$output .= file_get_contents("template.html");

	echo $output;

	$db = parse_url(getenv("DATABASE_URL"));

	$pdo = new PDO("pgsql:" . sprintf(
		"host=%s;port=%s;user=%s;password=%s;dbname=%s",
		$db["host"],
		$db["port"],
		$db["user"],
		$db["pas"],
		ltrim($db["path"], "/")
	));

	print_r($pdo->errorInfo());

?>