<?php
	require_once 'core/init.php';

	$user = new User();

	if (!$user->isLoggedIn()) {
		Redirect::to('index.php');
	}

	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {

			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array (
				'required' => true,
				'min' => 2,
				'max' => 20
				)
			));

			if ($validate->passed()) {
				try {
					$user->update(array(
						'username' => Input::get('username')
					));

						Session::flash('home', 'Succefully updated');
						Redirect::to('index.php');
				} catch (Exception $e) {	
					die($e->getMessage());
				}
			} else {
				foreach ($validation->errors as $error) {
					echo $error, '<br>';
				}
			}
		}
	}
?>

<form action="" method="post">
	<div class="field">
		<label for="username">username</label>
		<input type="text" name="username" value="<?php echo escape($user->data()->username);?>">

		<input type="submit" name="update">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	</div>
</form>