<?php 
	
	$db = parse_url(getenv("DATABASE_URL"));

	$con = new PDO("pgsql:" . sprintf(
		"host=%s;port=%s;user=%s;password=%s;dbname=%s",
		$db["host"],
		$db["port"],
		$db["user"],
		$db["pass"],
		ltrim($db["path"], "/")
	));

	$location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
	print_r($location)

	$prep = $con->prepare("INSERT INTO ip VALUES (?)");

	$prep->bindParam(1, $_SERVER["REMOTE_ADDR"]);

	$prep->execute();

?>
