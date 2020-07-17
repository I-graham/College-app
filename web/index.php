<?php

	function customError($errno, $errstr) {
		echo "<b>Error:</b> [$errno] $errstr";
	}

	function main {
		$output = "";

		$output .= file_get_contents("../templates/template.html");

		return $output;
	}
  
	set_error_handler("customError");
	echo main();

?>