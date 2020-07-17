<?php

/*	function customError($errno, $errstr) {
		echo "<b>Error:</b> [$errno] $errstr";
	}
	set_error_handler("customError");
*/
	function main {
		$output = "";

		$output .= file_get_contents("../templates/template.html");

		return $output;
	}
  
	echo main();

?>