
<?php
 	require_once 'core/init.php';
	$db = DB::getInstance();
	$user = new User();

	function getComments($db, $img_id) {
		try {
			$results = "SELECT comment FROM comments WHERE img_id = $img_id";
	
			$db->query($results);
			$row = $db->results();
			$i=0;
			foreach ($row as $key => $val) {
				echo "<div class='com-box'>";
				echo $row[$i++]->comment. "<br>";
				// echo "<form class='delete-com' method='POST' action='".delete_com($db)."'>
				// <input type='hidden' name='img_id' value=''>
				// </form>";
				echo "</div>";
			}
			}
			 catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}
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
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
	.com-box{
        width: 505px;
        padding: 20px;
        margin-bottom: 4px;
        background-color: #fff;
        border-radius: 4px;
    }
    .delete-com{
        position: absolute;
        /* top: 0px; */
        /* right: 0px; */
        float: right;
    }
    .delete-com button{
        width: auto;
        height: 20px;
        background-color: #fff;
        opacity: 0.7;
    }
	a {
        text-decoration: none !important;
    }
</style>
	<script src="js/pic.js"></script>
	<script src="js/sidebar.js"></script>
</head>
<body>
	<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
	<button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href="update.php" class="w3-bar-item w3-button">Update info</a>
  <a href="update_email.php" class="w3-bar-item w3-button">Update email</a>
  <a href="gallery.php" class="w3-bar-item w3-button">Gallery</a>
  <a href="changepassword.php" class="w3-bar-item w3-button">Update password</a>
  <a href="logout.php" class="w3-bar-item w3-button">Log out</a>
</div>

<div class="w3-teal">
<h3>Welcome <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username) ?></a></h3>
  <button class="w3-button w3-teal w3-xlarge" onclick="popout()">☰</button>
  <div class="w3-container">
  </div>
</div>
	<!-- <img class="logo" src="images/site_images/logo.png" alt="logo"> -->
	<div class="main_container">
		<div class="top_container">
			<div id="overlay" class="overlay">
				<img class="text" height='100px' width='100px' id="emoji1" name="emoji1" onclick="off()">
				<img onclick="off2()" class="text" height='100px' width='100px' id="emoji2" name="emoji2" >
			</div>
			<div class="video">
				<video id='video'>Stream not available...</video>
				<img id="image" height="375" width="500" class="image" name="image"></img>
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
			<!-- <form action="cam/upload.php" method="post" enctype="multipart/form-data"> -->
			<p>Select image to upload: </p>
        <input type="file" name="fileToUpload" id="uploadspot">
        <button id="fileToUpload" name="fileToUpload">Upload</button>
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
					echo "<div style = 'float :left;'> <form action='comment.php' method='post'><input type='hidden' name='img_id' value=".$img_id."/><img src='$img' style='margin: 5px; margin-bottom: 1px; margin-top: 1px'><br/>";
						echo "</form> <div id = 'comms'>";
						// getComments($db, $img_id);
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
