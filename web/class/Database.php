<?php

class GuacaDB {


	private $conn;

 
	function __construct() { 
		$this -> configs = require('./config.php');

		$servername = '10.89.0.5';
		$username 	= 'guacamole_user';
		$password 	= 'opCa#._123';
		$dbname 	= 'guacamole_db';

		// Create connection
		$this -> conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

	}
	
	function __destruct() {

		$this -> conn->close();


	}


	function addUser ($user, $mypassword) {

		$error = 0;

		$sql = "INSERT INTO guacamole_entity (name, type) VALUES ('". $user . "','USER');";
		
		if ($this -> conn->query($sql) ==TRUE) {

			$last = $this -> conn->insert_id;
			$date = date('Y-m-d h:i:s', time());

			$sql = 'SET @salt = UNHEX(SHA2(UUID(), 256))';
			$this -> conn->query($sql);
			
			$sql = "INSERT INTO guacamole_user (entity_id, password_date, password_salt, password_hash) VALUES ('" . $last ."','". $date."',@salt, UNHEX(SHA2(CONCAT('". $mypassword ."', HEX(@salt)), 256)))";
			
			if ($this -> conn->query($sql) ==TRUE) {
				$error = 0;
			}else {
				$error = $this -> conn->error;	
			}

		}else {	
			$error = $this -> conn->error;
		}
		
		return $error;


	}
/*	function addUser ($user, $mypassword) {

		//$salt_hex = strtoupper(hash('sha256', $random_string));
		//$hash_hex = hash('sha256', $password . $salt_hex);
		$sql = 'SET @salt = UNHEX(SHA2(UUID(), 256))';

		$error = 0;
		if ($this -> conn->query($sql) === TRUE) {
		  	
			$sql = "INSERT INTO guacamole_entity (name, type) VALUES ('". $user . "','USER')";
		  	echo $sql;			
		  	print ('.....');
		  	if ($this -> conn->query($sql) === TRUE) {
		  		print ('insertar');
				$last = $this -> conn->insert_id;
		  		$sql = "INSERT INTO guacamole_user (entity_id, password_salt, password_hash) VALUES ('" . $last ."',@salt, UNHEX(SHA2(CONCAT('". $mypassword ."', HEX(@salt)), 256)))";
		  		print $sql;
				
				print ('------');
			}else{
				$error = -1;
		  		print ($this -> conn->connect_error);
			}
		} else {
		  $error = -2;
		  print ($this -> conn->connect_error);
		}

		return $error;

	}

*/
}
