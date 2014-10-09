<?php
	# Database information
	$server = "localhost";
	$user = "frozen_frozen";
	$password = "frozen";

	$con = mysql_pconnect($server, $user, $password) or die("Could not connect: " . mysql_error());
	mysql_select_db("frozen_frozenflower");
?>
