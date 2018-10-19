<?php
	require_once 'core/init.php';

	$user = DB::getInstance()->get('user', array('username', '=', 'alex'));

	if ($user->count()) {
		echo "No user";
	} else {
		echo "Okay";
	}
?>