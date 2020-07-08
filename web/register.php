<?php

	require './class/Database.php';

	// We need to use sessions, so you should always start sessions using the below code.
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		header('Location: index.php');
		exit;
	}
	//en caso de forzar con javascript el no aceptar las condiciones se le saca fuera:
	if ($_POST['agree']<>'on'){
		header('Location: index.php');
		exit;		
	}

	$db = new GuacaDB ();

	$user = "hola";
	$password = "adios";

	$resultado = $db -> addUser ($user , $password);

	print $resultado;

?>