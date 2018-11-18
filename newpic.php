<?php
 	require_once 'core/init.php';
	$db = DB::getInstance();
	$user = new User();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>New Pic</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" /> -->
	<link rel="stylesheet" type="text/css" media="screen" href="css/pic.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="js/pic.js"></script>
</head>
<body>
	<div class="navbar">
			<ul>
				<li class="left"><a href="index.php">Home</a></li>
				<li class="left"><a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></li>                    
				<li class="left"><a href="newpic.php">NewPic</a></li>
				<li class="right"><a href="logout.php">Log out</a></li>
			</ul>
	</div>
	<img class="logo" src="images/site_images/logo.png" alt="logo">
	<div class="main_container">
		<div class="top_container">
			<div id="overlay" class="overlay">
				<img class="text" height='100px' width='100px' id="emoji1" name="emoji1" onclick="off()">
				<img onclick="off2()" class="text" height='100px' width='100px' id="emoji2" name="emoji2"  >
			</div>
			<div class="video">
				<video id='video'>Stream not available...</video>
			</div>
			<div class="emo_list">
			<img id="e1" src="img/Face_With_Rolling_Eyes_Emoji_large.png" height='50px' width='50px' style="margin: 17px">
			<img id="e2" src="img/Fist_Hand_Emoji.png" height='50px' width='50px' style="margin: 17px">
			<img id="e3" src="img/Ghost_Emoji_large.png" height='50px' width='50px' style="margin: 17px">
			<img id="e4" src="img/Poop_Emoji_7b204f05-eec6-4496-91b1-351acc03d2c7_large.png" height='50px' width='50px' style="margin: 17px">
			<img id="e5" src="img/Very_Mad_Emoji_large.png" height='50px' width='50px' style="margin: 17px">
			<img id="e6" src="img/smile.png" height='50px' width='50px' style="margin: 17px">
			<br>
		</div>
			<button id="photo_button" class="button">Take Photo</button>
			<canvas id="canvas2"></canvas>
			<form action="cam/upload.php" method="post" enctype="multipart/form-data">
			<p>Select image to upload: </p>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
			<button id="save_photo" class="button">Save</button>
			<canvas id="canvas"></canvas>
		</div>
		

		<div class="thumb_nail">
			<?php
				$db = DB::getInstance();
				$db->get("gallery", array('user_id', '=', $user->data()->user_id));
				$images = $db->results();
				$num_images = $db->count() - 1;

				for ($i = 0; $i < 3 && $num_images >= 0; $i++) {
					$img = $images[$num_images]->img_name;
					$img_id = $images[$num_images]->img_id;
					echo "<div style = 'float :left;'> <form action='comment.php' method='post'><input type='hidden' name='img_id' value=".$img_id."/><img src='$img' style='margin: 5px; margin-bottom: 1px; margin-top: 1px'><br/><i onclick='likes(this)' class='fa fa-thumbs-up'></i><p type='text' id='show'></p>
						<input type='text' name = 'com'placeholder='Comment'></input><input type='submit' name='submiting' value='Post'u/></form>
					</div>";
					$num_images--;
				}
			?>
		</div>
	</div>
</body>

<script>
	function likes(x) {
	var	likes = 1;
		x.classList.toggle("fa-thumbs-down");
		document.getElementById('show').innerHTML=likes;
		likes = likes + 1;
		document.getElementById('show').submit();
	}
	function off() {
		document.getElementById("emoji1").style.visibility = "hidden";
		document.getElementById("emoji1").removeAttribute('src');

	}
	function off2() {
		document.getElementById("emoji2").style.visibility = "hidden";
		document.getElementById("emoji2").removeAttribute('src');
	}

	emo1 = document.getElementById("e1");
	emo2 = document.getElementById("e2");
	emo3 = document.getElementById("e3");
	emo4 = document.getElementById("e4");
	emo5 = document.getElementById("e5");
	emo6 = document.getElementById("e6");
	
	emo1.addEventListener("click", function(){switchsrc(emo1);}, false);
	emo2.addEventListener("click", function(){switchsrc(emo2);}, false);
	emo3.addEventListener("click", function(){switchsrc(emo3);}, false);
	emo4.addEventListener("click", function(){switchsrc(emo4);}, false);
	emo5.addEventListener("click", function(){switchsrc(emo5);}, false);
	emo6.addEventListener("click", function(){switchsrc(emo6);}, false);

	function switchsrc(emonew)
	{
		// var canvas = document.getElementById('canvas'),
		// cont = canvascanvas1.getContext('2d');
		document.getElementById("emoji1").style.visibility = "visible";
		if (document.getElementById("emoji1").hasAttribute("src")) {
			document.getElementById("emoji2").style.visibility = "visible";
			var emoswitch = document.getElementById("emoji2");
		}
		else {
			var emoswitch = document.getElementById("emoji1");
		}
		var ovl = document.getElementById("overlay");
		switch (emonew.id)
		{
			case "e1" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "10px";
				emoswitch.style.left = "10px";
				//cont.drawImage(emoswitch,0,0,100,100);
				break;
			case "e2" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "10px";
				emoswitch.style.left = "200px";
				//cont.drawImage(emoswitch,0,0,100,100);
				break;
			case "e3" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "10px";
				emoswitch.style.left = "400px";
				// cont.drawImage(emoswitch,0,0,100,100);
				break;
			case "e4" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "100px";
				emoswitch.style.left = "10px";
				// cont.drawImage(emoswitch,0,0,100,100);
				break;
			case "e5" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "100px";
				emoswitch.style.left = "200px";
				// cont.drawImage(emoswitch,0,0,100,100);
				break;
			case "e6" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "100px";
				emoswitch.style.left = "400px";
				// cont.drawImage(emoswitch,0,0,100,100);
				break;
		}
	} 
</script>
</html>
