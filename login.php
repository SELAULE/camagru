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
				// log in
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

		<input type="submit" value="Log in">
		<!--<input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> -->

	</form>
</body>
</html>