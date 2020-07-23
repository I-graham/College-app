<!--Super Secret Page that no one can see and that'll be deleted later.-->


<?php
	
	function customError($errno, $errstr) {
		echo "<b>Error:</b> [$errno] $errstr";
	}
	set_error_handler("customError");

	$output = "";
	
	$output .= file_get_contents("sql.html");
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
		if ($_REQUEST["pass"] == "foobar") {
			
			$db = parse_url(getenv("DATABASE_URL"));
			
			$pdo = new PDO("pgsql:" . sprintf(
				"host=%s;port=%s;user=%s;password=%s;dbname=%s",
				$db["host"],
				$db["port"],
				$db["user"],
				$db["pass"],
				ltrim($db["path"], "/")
			));

			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$command = $_REQUEST["command"];
			
			str_replace("OUTPUT", $pdo->exec($command), $output);	
			
		}
	} else {
		str_replace("OUTPUT", "", $output);
	}
	echo $output;
?>