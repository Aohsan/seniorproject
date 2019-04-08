<?php
	$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$db);
	if (mysqli_connect_error($connect)) {
		echo 'Failed to connect';
	}
	mysqli_set_charset($connect,"utf8")
?>