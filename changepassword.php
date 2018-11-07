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
				'current_password' => array(
					'required' => true,
					/* 'matches' => Input::get('password'), */
					'min' => 6
				),
				'new_password' => array(
					'required' => true,
					'min' => 6
				),
				'Confirm_new_Password' => array(
					'required' => true,
					'min' => 6,
					'matches' => 'new_password'
				)
			));
			if ($validate->passed()) {
				if(hash::make(Input::get('current_password')) !== $user->data()->password)
				{
					echo "Incorrect current password";
				}
			}else {
				foreach ($validation->errors() as $error) {
					echo $error, '<br>';
			}
		}
	}
}
?>

<form action="" method="post">
	<div class="current_password">
		<label for="current_password">current_password</label>
			<input type="password" name="current_password" id="current_password" value="" autocomplete="off" placeholder="current_password">
	</div>

	<div class="new_password">
		<label for="new_password">new_password</label> 
			<input type="password" name="new_password" id="new_password" placeholder="new_password">
	</div>

	<div class="Confirm_new_Password">
		<label for="Confirm_new_Password">Confirm_new_Password</label>
			<input type="password" name="Confirm_new_Password" id="Confirm_new_Password" value="" placeholder="Confirm_new_Password">
	</div>

	<input type="submit" name="Change">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
</form>