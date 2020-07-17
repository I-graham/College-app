<?php

	function customError($errno, $errstr) {
		echo "<b>Error:</b> [$errno] $errstr";
	}

	function main {
		$output = "";

		$output .= file_get_contents("../templates/template.html");

		echo $output;
	}
  
	set_error_handler("customError");

	main();

?>