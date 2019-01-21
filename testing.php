<?php 

	require_once ('core/init.php');

	$db = DB::getInstance();
	$user = new User();

	echo Token::generate();

 ?>