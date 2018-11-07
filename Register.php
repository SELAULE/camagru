<?php
	require_once 'core/init.php';

	if (Input::exists()) {
			if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min' => 2,
					'max' => 20,
					'unique' => 'users'
				),
				'password' => array(
					'required' => true,
					'min' => 6
				),
				'Confirm_Password' => array(
					'required' => true,
					'matches' => 'password'
				),
				'e-mail' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
				),
			)); 
			if ($validation->passed()) {
				$user = new User();

				//$salt = Hash::salt(32);
				try{
				 	$user->create(array(
						'username' => Input::get('username'),
						'password' => Hash::make(Input::get('password')),
						'salt' => 'salt',
						'e-mail' => Input::get('e-mail'),
						'joined' => date('Y-m-d H:i:s'),
						'group' => 0
					));
					
					Session::flash('Home', 'You have successfully registered');
					Redirect::to('cam/cam.php');
				} catch(Exception $e) {
					die($e->getMessage);
				}
			} else {
				foreach ($validation->errors() as $error) {
					echo $error, '<br>';
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="login.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
	<style>
		body{
			background-image: url("img/")
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
		input[type=password] {
		width: 70%;
		padding: 12px 20px;
		margin: 8px 0;
		box-sizing: border-box;
		}
		#reg-butt{
			background-color: #165882;
			border: none;
			color: white;
			padding: 5px 7px;
			margin-top: 5px;
			margin-bottom: 5px;
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
	</style>
</head>

<body>
	<header class="header">
		<h2>Camagru</h2>
	</header>
		<div class="form">
			<form action="" method="post">
				<div class="username">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="" autocomplete="off" placeholder="Username">
				</div>

				<div class="password">
					<label for="password">Password</label> 
					<input type="password" name="password" id="password" placeholder="password">
				</div>

				<div class="Confirm_Password">
					<label for="Confirm_Password">Confirm Password</label>
					<input type="password" name="Confirm_Password" id="Confirm_Password" value="" placeholder="confirm_password">
				</div>

				<div class="e-mail">
					<label for="e-mail">E-mail address</label>
					<input type="text" name="e-mail" id="e-mail" value="" placeholder="e-mail">
				</div>

				<input type="hidden" name="token" id="name" value="<?php echo Token::generate(); ?>">
				<input type="submit" value="Register" id="reg-butt">
<!-- 				<hr />
				<button href="login.php" id="button">Log in</button> -->
			</form>
		</div>
</body>
</html>