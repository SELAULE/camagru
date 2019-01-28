<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- <link rel="javascript" href="js/notify.js">
<script src="js/notify.js"> </script> -->
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
				'username' => array (
				'required' => true,
				'min' => 2,
				'unique' => 'users',
				'max' => 20
				)
			));

			if ($validation->passed()) {
				try {
					$user->update(array(
						'username' => escape(Input::get('username'))
					));
					Session::flash('home', 'Succefully updated');
					Redirect::to('index.php');
				} catch (Exception $e) {
					die($e->getMessage());
				}
			} else {
				// var_dump($validation->errors);
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
  <a href="notify.php" class="w3-bar-item w3-button">Notification</a>
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
		<label for="username">username</label>
		<input type="text" name="username" value="<?php echo escape($user->data()->username);?>">
	
		<input type="submit" name="update" value="Update">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	</div>
</form>
<!-- <div class="login_box1">
        <p class='current'>Enable notifications</p>
        <input type='checkbox' id='chbx' name='chbx' >
		<p id="userres" class="message"></p>
</div> -->



<script src="js/sidebar.js"></script>
