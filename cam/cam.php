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
<body back>
	<div class="nav">
		<h1 style="color:white" ><u>Camagru</u></h1>
	</div>
	<div class="top-con">
		<video id="video">Can't Play</video>
		<button id="photo-but" class="btn btn dark">
			Snap
		</button>
		<!-- <select id="photo-fil"> -->
			<!-- <option value="none">Normal</option> -->
			<!-- <option src="../img/smile.png">Grey</option> -->
			<!-- <option value="sepia(100%)">Sepia</option> -->
			<!-- <option value="invert(100%)">Invert</option> -->
			<!-- <option value="hue-rotate(90deg)">Hue</option> -->
			<!-- <option value="blur(10px)">Blur</option> -->
			<!-- <option value="contrast(200%)">Contrast</option> -->
			<img id="e1" src="../img/Face_With_Rolling_Eyes_Emoji_large.png" height='50px' width='50px' style="margin: 17px">
			<img id="e2" src="../img/Fist_Hand_Emoji.png" height='50px' width='50px' style="margin: 17px">
			<img id="e3" src="../img/Ghost_Emoji_large.png" height='50px' width='50px' style="margin: 17px">
			<img id="e4" src="../img/Poop_Emoji_7b204f05-eec6-4496-91b1-351acc03d2c7_large.png" height='50px' width='50px' style="margin: 17px">
			<img id="e5" src="../img/Very_Mad_Emoji_large.png" height='50px' width='50px' style="margin: 17px">
			<img id="e6" src="../img/smile.png" height='50px' width='50px' style="margin: 17px">
		<!-- </select> -->
			<button id="clear-but">Clear</button>
			<canvas id="canvas"></canvas>
			<form action="upload.php" method="post" enctype="multipart/form-data">
			<p>Select image to upload: </p>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
	</div>
	
	<div class="bottom-con">
		<div id="photos"></div>
	</div>
	<script src="../js/cam.js"></script>
</body>
</html>