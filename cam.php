<?php
	require_once 'core/init.php';

	if (Session::exists('home')) {
		echo '<p>' . Session::flash('home') . '</p>';
	}
	$user = new User();
	if ($user->isLoggedIn()) {
?>
	<p>Welcome <a href="#"><?php echo escape($user->data()->username) ?></a></p>

	<ul>
		<li><a href="logout.php">Log out</a></li>
	</ul>
<?php
	} else {
		echo '<p> You need to <a href="login.php">log in</a> or <a href="Register.php">register</a> </p>';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
	 <link rel="stylesheet" type="text/css" media="screen" href="cam.css" />
	 <style>
		 h1{
			font-family: 'Tangerine', serif;
			font-size: 48px;
			text-shadow: 4px 4px 4px #aaa;
			text-align: center;
		 }
		 p{
			 color: white;
		 }
	 </style>
</head>
<body>
	<div class="nav">
		<h1 style="color:white" >Camagru</h1>
	</div>
	<div class="top-con">
		<video id="video">Can't Play</video>
		<button id="photo-but" class="btn btn dark">
			Snap
		</button>
		<select id="photo-fil">
			<option value="none">Normal</option>
			<!-- <option src="../img/smile.png">Grey</option> -->
			<option value="sepia(100%)">Sepia</option>
			<option value="invert(100%)">Invert</option>
			<option value="hue-rotate(90deg)">Hue</option>
			<option value="blur(10px)">Blur</option>
			<option value="contrast(200%)">Contrast</option>
		</select>
			<button id="clear-but">Clear</button>
			<canvas id="canvas"></canvas>
			<form action="upload.php" method="post" enctype="multipart/form-data">
			<p>Select image to upload: </p>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form> 
	</div>
	
	<div class="bottom-con">
		<dir id="photos"></dir>
	</div>
	<script src="cam.js"></script>
</body>
</html>