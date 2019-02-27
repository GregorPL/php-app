<?php
	$db_user = 'root';
	$db_host = 'localhost';
	$db_name = 'loginsystem';
	$db_pass = '';

	$conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	if (!$conn) {
		echo "Error ".mysqli_connect_errno();
	}