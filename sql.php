<?php
	
	function customError($errno, $errstr) {
		echo "<b>Error:</b> [$errno] $errstr";
	}
	set_error_handler("customError");

	$output = "";
	
	$output .= file_get_contents("sql.html");
	
	echo $output;

	exit(200);

/*	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$db = parse_url(getenv("DATABASE_URL"));
	
		$pdo = new PDO("pgsql:" . sprintf(
			"host=%s;port=%s;user=%s;password=%s;dbname=%s",
			$db["host"],
			$db["port"],
			$db["user"],
			$db["pass"],
			ltrim($db["path"], "/")
		));

		if ($_REQUEST["pass"] == "foobar") {

			$command = $_REQUEST["command"]
	
			str_replace("OUTPUT", $pdo->exec($command), $output);

		}
	}*/

?>