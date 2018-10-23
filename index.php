<?php
	require_once 'core/init.php';

	$userInsert = DB::getInstance()->update('users', 3, array(
		'password' => 'newpassword',
		'name' => 'Dale Garret'
	));
?>