<?php
	require_once 'core/init.php';

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
				$login = $user->login(Input::get('username'), Input::get('password'));

				if ($login) {
					/* echo "Success"; */
					Redirect::to('cam/cam.php');
					/* Redirect::to('index.php'); */
				} else {
					echo "Login Failed";
				}
			} else {
				foreach ($validation->errors() as $error) {
					echo $error, '<br>';
				}
			}
			return false;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="login.css" />
	<style>
	
	</style>
</head>
<body>
	<form action="" method="post">
		<div class="field">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="" autocomplete="off" placeholder="username">
		</div>

		<div class="field">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" autocomplete="off" placeholder="password">
		</div>
		
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Log in">

	</form>
</body>
</html>