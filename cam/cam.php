<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.google.com/" rel="stylesheet" type="text/css">
 	<link rel="stylesheet" type="text/css" media="screen" href="cam.css" />
</head>
<body>
	<div class="nav">
		<h1>Camagru</h1>
	</div>
	<div class="top-con">
		<video id="video">Can't Play</video>
		<button id="photo-but" class="btn btn dark">
			Snap
		</button>
		<select id="photo-fil">
			<option value="none">Normal</option>
			<option value="grayscale(100%)">Grey</option>
			<option value="sepia(100%)">Sepia</option>
			<option value="invert(100%)">Invert</option>
			<option value="hue-rotate(90deg)">Hue</option>
			<option value="blur(10px)">Blur</option>
			<option value="contrast(200%)">Contrast</option>
		</select>
			<button id="clear-but">Clear</button>
			<canvas id="canvas"></canvas>
	</div>
	
	<div class="bottom-con">
		<dir id="photos"></dir>
	</div>
	<script src="cam.js"></script>
</body>
</html>