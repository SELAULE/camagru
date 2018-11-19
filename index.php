<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<?php
	require_once 'core/init.php';

	if (Session::exists('home')) {
		echo '<p>' . Session::flash('home') . '</p>';
	}
	$user = new User();
	if ($user->isLoggedIn()) {
?>	
	<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href="logout.php" class="w3-bar-item w3-button">Log out</a>
  <a href="update.php" class="w3-bar-item w3-button">Update info</a>
  <a href="changepassword.php" class="w3-bar-item w3-button">Update password</a>
</div>

<div class="w3-teal">
<h3>Welcome <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username) ?></a></h3>
  <button class="w3-button w3-teal w3-xlarge" onclick="popout()">☰</button>
  <div class="w3-container">
  </div>
</div>

<?php
	} else {
		echo '<p> You need to <a href="login.php">log in</a> or <a href="Register.php">register</a> </p>';
	}
?>
<script src="js/sidebar.js">
/* 	function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
function close() {
    document.getElementById("mySidebar").style.display = "none";
} */
</script>