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

	$existent = $con->prepare("SELECT * FROM login_info WHERE email=?;");

	$existent->bindParam(1, $_POST["email"]);

	$existent->execute();

	echo $existent->rowCount();

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
} else if ($_SERVER["REQUEST_METHOD"] == "GET"){

	if (isset($_GET["type"]) && $_GET["type"] == "signup") {
		echo file_get_contents("login.html");
		exit();
	}

}

echo file_get_contents("login.html");

?>