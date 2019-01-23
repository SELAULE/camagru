<?php 


require_once 'core/init.php';

    $user = new User();
    

if (!$user->isLoggedIn()) {
		Redirect::to('index.php');
	}

	else if (isset($_POST['notify'])) {
		notify();
	} else if (isset($_POST['mypostname'])) {
		checknotify();
	}


	function notify() {
	global $user;
	// if ()
    $user->update(array(
        'notify' => input::get('notify'),
    ));
    echo "Update successful";
}

function checknotify() {
    global $user;
    echo $user->data()->notify;
}

?>


<style>
    .fa {
        font-size: 30px;
        cursor: pointer;
        user-select: none;
    }

    .fa:hover {
    color: darkblue;
    }
	a {
		text-decoration: none !important;
    }
</style>

    <script src="js/sidebar.js"></script>
    <script src="js/notify.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
	<button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
    <a href="newpic.php" class="w3-bar-item w3-button">New pic</a>
  <a href="update.php" class="w3-bar-item w3-button">Update info</a>
  <a href="notify.php" class="w3-bar-item w3-button">Notifications</a>
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
</body>

<div class="login_box1">
        <p class='current'>Enable notifications</p>
        <input type='checkbox' id='chbx' name='chbx' >
		<p id="userres" class="message"></p>
</div>