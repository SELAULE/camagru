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
					'ascii' => 1,
					'min' => 6
				),
				'Confirm_Password' => array(
					'required' => true,
					'ascii' => 1,
					'matches' => 'password'
				),
				'e_mail' => array(
					'required' => true,
					'unique' => 'users',
					'valid_email' => 1,
					'min' => 2,
					'max' => 50
				),
			)); 
			if ($validation->passed()) {
				$user = new User();
				//$salt = Hash::salt(32);
				try{
				 	$user->create(array(
						'username' => escape(Input::get('username')),
						'password' => Hash::make(escape(Input::get('password'))),
						'salt' => 'salt',
						'e_mail' => escape(Input::get('e_mail')),
						'joined' => date('Y-m-d H:i:s'),
						'group' => 0
					));
					$email = escape(Input::get('e_mail'));

						$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
						$hash = Hash::make(escape(Input::get('password')));
						$username = escape(Input::get('username'));
					if (isset($msg)) {
						echo '<div class="statusmsg">' .$msg. '</div>';
					}

					$token = Token::generate();
					$to = $email;
					$subject = 'Signup / Verify';
					$message = 'Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
					 
					------------------------
					Username: '.escape(Input::get('username')).'
					Password: '.escape(Input::get('password')).'
					------------------------
					 
					Please click this link to activate your account:
					http://127.0.0.1:8080/camagru/verify.php/verify.php?email='.$email.'&token='.$token.'&username='.$username.'';
				
					$headers = 'From:noreply@camagru.com' . "\r\n";
					mail($to, $subject, $message, $headers);
					Session::flash('Home', 'You have successfully registered');
					Redirect::to('login.php');
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
			background-image: url("img/");
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
					<input type="text" name="e_mail" id="e-mail" value="" placeholder="e-mail">
				</div>

				<input type="hidden" name="token" id="name" value="<?php echo Token::generate(); ?>">
				<input type="submit" value="Register" id="reg-butt">
<!-- 				<hr />
				<button href="login.php" id="button">Log in</button> -->
			</form>
		</div>
</body>
</html>