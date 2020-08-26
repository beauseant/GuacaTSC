<?php
	session_start();
	session_destroy();
	// Redirect to the login page:
	$infoData = require('./info_config.php');

	header('Location: ' . $infoData['guacamoleUrl']);
?>