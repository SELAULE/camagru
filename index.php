<?php
	require_once 'core/init.php';

	if (Session::exists('home')) {
		echo '<p>' . Session::flash('home') . '</p>';
	}
	$user = new User();
	if ($user->isLoggedIn()) {
?>
	<p>Welcome <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username) ?></a></p>

	<ul>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="update.php">Update info</a></li>
		<li><a href="changepassword.php">Update password</a></li>
	</ul>
<?php
	} else {
		echo '<p> You need to <a href="login.php">log in</a> or <a href="Register.php">register</a> </p>';
	}
?>