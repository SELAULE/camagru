<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
    body{
        background-color: #ddd;
    }
</style>

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
				'e_mail' => array (
				'required' => true,
				'min' => 2,
				'max' => 20
				)
			));

			if ($validate->passed()) {
				try {
					$user->update(array(
						'e_mail' => Input::get('e_mail')
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
		<label for="e_mail">e_mail</label>
		<input type="text" name="e_mail" value="<?php echo escape($user->data()->e_mail);?>">

		<input type="submit" name="update" value="Update">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	</div>
</form>