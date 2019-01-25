 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

 <style>
 body{
    background-color: #ddd;
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
		input[type=password], #remember {
		width: 70%;
		padding: 12px 20px;
		margin: 8px 0;
		box-sizing: border-box;
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

<?php
	require_once 'core/init.php';

	$user = new User();

	// if (!$user->isLoggedIn()) {
	// 	Redirect::to('index.php');
	// }
	
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
				if(hash::make(Input::get('current_password')) !== $user->data()->password) {
					echo "Incorrect current password";
				} else {
					$user->update(array(
						'password' => Hash::make(Input::get('new_password'))
					));

					Session::flash('home', 'Your password has been changed');
					Redirect::to('login.php');
				}
			}else {
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
  <a href="logout.php" class="w3-bar-item w3-button">Log out</a>
</div>

<div class="w3-teal">
<h3>Welcome <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username) ?></a></h3>
  <button class="w3-button w3-teal w3-xlarge" onclick="popout()">☰</button>
  <div class="w3-container">
  </div>
</div>


<div class="form">
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

	<input type="submit" name="Change" id="button">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
</form>
</div>

<script src="js/sidebar.js"></script>