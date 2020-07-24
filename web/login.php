<?php

function signup() {

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