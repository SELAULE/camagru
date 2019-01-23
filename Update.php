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

// 	else if (isset($_POST['notify'])) {
// 		notify();
// 	} else if (isset($_POST['mypostname'])) {
// 		checknotify();
// 	}

// 	function checknotify() {
//     echo $user->data()->notify;
// }
// 	function notify() {
// 	global $user;
// 	// if ()
//     $user->update(array(
//         'notify' => input::get('notify'),
//     ));
//     echo "Update successful";
// }
	

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
						'username' => Input::get('username')
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