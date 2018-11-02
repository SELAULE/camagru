<?php
	require_once 'core/init.php';

	if (Input::exists()) {
			if (Token::check(Input::get('token'))) {
			$validate = new validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min' => 2,
					'max' => 20,
					'unique' => 'users'
				),
				'password' => array(
					'required' => true,
					'min' => 6
				),
				'Confirm_Password' => array(
					'required' => true,
					'matches' => 'password'
				),
				'e-mail' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
				),
			)); 
			if ($validation->passed()) {
				$user = new User();

				//$salt = Hash::salt(32);
				try{
				 	$user->create(array(
						'username' => Input::get('username'),
						'password' => Hash::make(Input::get('password')),
						'salt' => 'salt',
						'e-mail' => Input::get('e-mail'),
						'joined' => date('Y-m-d H:i:s'),
						'group' => 0
					));
					
					Session::flash('Home', 'You have successfully registered');
					Redirect::to('cam/cam.php');
				} catch(Exception $e) {
					die($e->getMessage);
				}
			} else {
				foreach ($validation->errors() as $error) {
					echo $error, '<br>';
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="login.css" />
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
	<style>
		.everything{
			background-image: url("img/R-back-gro.jpg");
			width: auto;
			height: auto;
			repeat: none;
		}
		#form{
			border: 2px black;
		}
		#username{
			border-radius: 5px;
			margin: 3px;
			box-shadow: 5px 5px 5px #aaaaaa;
		}
 		#password{
			border-radius: 5px;
			margin: 3px;
			box-shadow: 5px 5px 5px #aaaaaa;
		}
		#Confirm_Password{
			border-radius: 5px;
			margin: 3px;
			box-shadow: 5px 5px 5px #aaaaaa;
		}
		#e-mail{
			border-radius: 5px;
			margin: 3px;
			box-shadow: 5px 5px 5px #aaaaaa;
	}
	label{
		font-family: 'Playfair Display', serif;
	}
	#reg-butt{
      width: 100px;
      height: 40px;
      border-radius: 30px;
      margin-top: 20px;
      font-size: 18px;
      font-weight: 700;
      color: #344b70;
      outline: none;
      border: none;
      background: rgba(0, 128, 0, 0.9);
      cursor: pointer;
      transition: all .3s;
  
      &:hover{
        background: rgba(0, 128, 0, 1);
      }
	}
	&--bg{
      width: 100%;
      height: 100%;
  
      img{
        width: 100%;
        height: 100%;
      }
    }
	</style>
</head>
<body class="everything">

		<form action="" method="post" id="form">
		<!-- <div class="login--bg">
			<img src="https://www.south-africa-info.co.za/info/businesses/7353/images/bottom_images/15.jpg" alt="">
		</div> -->
			<div class="username">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" value="" autocomplete="off" placeholder="Username">
			</div>

			<div class="password">
				<label for="password">Password</label> 
				<input type="password" name="password" id="password" placeholder="password">
			</div>

			<div class="Confirm_Password">
				<label for="Confirm_Password">Confirm Password</label>
				<input type="password" name="Confirm_Password" id="Confirm_Password" value="" placeholder="confirm_password">
			</div>

			<div class="e-mail">
				<label for="e-mail">Name</label>
				<input type="text" name="e-mail" id="e-mail" value="" placeholder="e-mail">
			</div>

			<input type="hidden" name="token" id="name" value="<?php echo Token::generate(); ?>">
			<input type="submit" value="Register" id="reg-butt">
		</form>
</body>
</html>