<?php

	function customError($errno, $errstr) {
		echo "<b>Error:</b> [$errno] $errstr";
	}

	function main {
		return file_get_contents("../templates/template.html")
	}
  
	set_error_handler("customError");
	echo main();

?>