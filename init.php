<?php
	include 'Config/setup.php';

	try {
		$conn = "mysql:host=$server_name;dbname=$db_name";
		$connct = new PDO($conn, $user_name, $password);
		$connct->setAttribute(PDO::ATR_ERRMODE, PDO::ERR_MODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed :" .$e->getMessage();
	}
?>