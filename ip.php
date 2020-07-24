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

	$ip = $_SERVER['REMOTE_ADDR'];
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	echo $details->city;

	$prep = $con->prepare("INSERT INTO ip VALUES (?)");

	$prep->bindParam(1, $_SERVER["REMOTE_ADDR"]);

	$prep->execute();

?>
