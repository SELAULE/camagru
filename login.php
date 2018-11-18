<?php
	require_once 'core/init.php';
	$user = new User();

	// if ($user->data()->group == 1) {
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array('required' => true),
				'password' => array('required' => true)
			));
			if ($validation->passed()) {
				$user = new User();

				$remember = (Input::get('remember') === 'on') ? true : false;
				$login = $user->login(Input::get('username'), Input::get('password'), $remember);

				if ($login) {
					/*Redirect::to('cam/cam.php');*/
					 Redirect::to('index.php'); 
				} else {
					echo "Invalid login";
				}
			} else {
				foreach ($validation->errors() as $error) {
					echo $error, '<br>';
				}
			}
			return false;
		}
	}
// } else {
// 	echo '<script language="javascript">';
// 	echo 'alert("Check email for activation code")';
// 	echo '</script>';
// }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
	<link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
	<style>
		body{
			background-color: #ddd;
		}
		h2{
			font-family: 'Tangerine', serif;
			font-size: 68px;
			text-shadow: 4px 4px 4px #aaa;
			text-align: center;
		}
		.form{
			margin: auto;
			margin-top: 40px;
			width: 40%;
			border: 0.5px solid black;
			padding: 10px;
			text-align: center;
		}
		input[type=text] {
		width: 70%;
		padding: 12px 20px;
		margin: 8px 0;
		box-sizing: border-box;
		}
		input[type=password], #remember {
		width: 70%;
		padding: 12px 20px;
		margin: 8px 0;
		box-sizing: border-box;
		}
		#button{
			background-color: #165882;
			border: none;
			color: white;
			padding: 5px 7px;
			margin-top: 5px;
			text-align: center;
			width: 15vw;
			border-radius: 5px;
			font-size: 20px;
		}
		.header{
			background: #4BB4B8;
		}
		#logout{
			float: right;
		}
	</style>
</head>
<body>
	<header class="header">
		<div id="logo">
			<h2>Camagru</h2>
		</div>
	</header>
	<div class="form">
	<form action="" method="post">
		<div class="field">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="" autocomplete="off" placeholder="username">
		</div>
		<div class="field">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" autocomplete="off" placeholder="password">
		</div>
		<div class="field">
			<label>
				<input type="checkbox" name="remember" id="remember">Remember me
			</label>
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Log in" id="button">

	</form>
	</div>
</body>
</html>