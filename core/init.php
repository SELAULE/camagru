<?php
session_start();

$GLOBALS['config'] = array(
	'mysql' => array (
		'host' => 'localhost',
		'username' => 'root',
		'password' => 'root101',
		'db' => 'camagru'
	),
	'remember' => array (
		'cookie_name' => 'hash',
		'cookie_exp' => '604800'
	),
	'session' => array (
		'session_name' => 'user'
	)
);

spl_autoload_register (function ($class) {
	require_once 'classes/' . $class . '.php';
});

	require_once 'functions/sanitaze.php';
?>