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
				'e_mail' => array(
					'required' => true,
					'unique' => 'users',
					'valid_email' => 1,
					'min' => 2
				// 'min' => 2,
				// 'max' => 20
				)
			));

			if ($validate->passed()) {
				try {
					$user->update(array(
						'e_mail' => escape(Input::get('e_mail'))
					));
					Session::flash('home', 'Succefully updated');
					Redirect::to('index.php');
				} catch (Exception $e) {
					die($e->getMessage());
				}
			} else {
				foreach ($validation->errors() as $error) {
					echo $error, '<br>';
				}
			}
		}
	}
?>

<style>
	a {
		text-decoration: none !important;
    }
</style>
	<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href="newpic.php" class="w3-bar-item w3-button">New pic</a>
  <a href="update.php" class="w3-bar-item w3-button">Update info</a>
  <a href="gallery.php" class="w3-bar-item w3-button">Gallery</a>
  <a href="update_email.php" class="w3-bar-item w3-button">Update email</a>
  <a href="changepassword.php" class="w3-bar-item w3-button">Update password</a>
  <a href="logout.php" class="w3-bar-item w3-button">Log out</a>
</div>

<div class="w3-teal">
<h3>Welcome <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username) ?></a></h3>
  <button class="w3-button w3-teal w3-xlarge" onclick="popout()">☰</button>
  <div class="w3-container">
  </div>
</div>

<form action="" method="post">
	<div class="field">
		<label for="e_mail">e_mail</label>
		<input type="text" name="e_mail" value="<?php echo escape($user->data()->e_mail);?>">

		<input type="submit" name="update" value="Update">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	</div>
</form>

<script src="js/sidebar.js"></script>