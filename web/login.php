<?php

function signup() {
	$db = parse_url(getenv("DATABASE_URL"));
					
	$con = new PDO("pgsql:" . sprintf(
		"host=%s;port=%s;user=%s;password=%s;dbname=%s",
		$db["host"],
		$db["port"],
		$db["user"],
		$db["pass"],
		ltrim($db["path"], "/")
	));

	
}

function login() {
	
}

function redirect() {
	header("Location: index.php");
	exit(200);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	switch($_POST["submit"]) {	
		case "login":
			login();
		case "signup":
			signup();
		default:
			redirect();
	}
} else {
	redirect();
}

?>