<?php

	function customError($errno, $errstr) {
		echo "<b>Error:</b> [$errno] $errstr";
	}
	set_error_handler("customError");

	$output = "";

	$output .= file_get_contents("template.html");

	echo $output;

	$x = 0;

	echo (1 / $x); 

?>