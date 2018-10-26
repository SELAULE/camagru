<?php
	require_once 'core/init.php';

	if (Input::exists()) {
			if (Token::check(Input::get('token'))) {
			$validate = new validate();
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
				'name' => array(
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
						'name' => Input::get('name'),
						'joined' => date('Y-m-d H:i:s'),
						'group' => 1 
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
</head>
<body>
	<form action="" method="post">
		<div class="field">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="" autocomplete="off" placeholder="email address">
		</div>

		<div class="field">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="password">
		</div>

		<div class="Confirm Password">
			<label for="Confirm_Password">Confirm Password</label>
			<input type="password" name="Confirm_Password" id="Confirm_Password" value="" placeholder="confirm_password">
		</div>

		<div class="field">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="" placeholder="name">
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Register">

	</form>
</body>
</html>