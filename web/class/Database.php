<?php

class GuacaDB {


	private $conn;

 
	function __construct() { 
		$configs = require('./config.php');

		// Create connection
		$this-> conn = new mysqli($configs['DBHost'], $configs['DBUsername'], $configs['DBPassword'], $configs['DBName']);
		// Check connection
		if ($this-> conn->connect_error) {
		  	#die("Connection failed: " . $this -> conn->connect_error);
			return -1;
		}

		
	}
	
	function __destruct() {

		$this -> conn->close();


	}


	function addUserEntity ($user){

		$sql = "INSERT INTO guacamole_entity (name, type) VALUES ('". $user . "','USER');";
		
		if ($this -> conn->query($sql) ==FALSE) {
			$salida = -1;
		}else{
			$salida = $this -> conn->insert_id;
		}

		return $salida;


	}

	function addUser ($userid, $mypassword, $email, $fullname, $role) {

		$error = 0;

		$last = $userid;
		$date = date('Y-m-d h:i:s', time());

		$sql = 'SET @salt = UNHEX(SHA2(UUID(), 256))';
		$this -> conn->query($sql);
		
		
		

		$sql = "INSERT INTO guacamole_user (entity_id, password_date, password_salt, password_hash)
				 VALUES (" . $last .",'". $date."', @salt, UNHEX(SHA2(CONCAT('". $mypassword ."', HEX(@salt)), 256)))";

		//En caso de clave duplicada es que el usuario quiere cambiar la contraseña, pero aún así actulizamos el resto de campos por si ha cambiado su situación o su email:
		$sql = $sql . " ON DUPLICATE KEY UPDATE password_date='". $date . "', password_salt=@salt, password_hash=UNHEX(SHA2(CONCAT('". $mypassword ."', HEX(@salt)), 256))";


		if ($this -> conn->query($sql) ==TRUE) {
			$sql = "UPDATE guacamole_user SET email_address='" . $email .  "', full_name='" . $fullname. "', organizational_role='" . $role. "' WHERE entity_id =" . $last;

			if ($this -> conn->query($sql) ==TRUE) {
				$error = '';
			}else {
				$error = $this -> conn->error;	
			}

		}else {
			$error = $this -> conn->error;	
		}

		
		return $error;


	}

	function userExists ($user) {

		$sql = "select entity_id from guacamole_entity where name='". $user ."'";
		$result = $this -> conn->query($sql);

		
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$salida = $row['entity_id'];
		}else {
		  $salida = -1;
		}

		return $salida;

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
