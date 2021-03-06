<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
    body{
        background-color: #ddd;
    }
    .fa {
	font-size: 30px;
	cursor: pointer;
	user-select: none;
}
    .fa:hover {
    color: darkblue;
    }
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

<?php
require_once 'core/init.php';
$db = DB::getinstance();

if (!$username = Input::get('user')) {
    Redirect::to('index.php');
} 
  else {
    $user = new User($username);   
     if (!$user->exists()) {
        echo $user->exists();
        Redirect::to('404.php');
    } else {
        $data = $user->data();
    }
  }

  function delete_com($db) {
    if (isset($_POST['comment'])) {
        $com_id = $_POST['comment_id'];
        $sql = "DELETE FROM `comments` WHERE `comments`.`comment_id` = 53";
    }
}

function getComments($db, $img_id) {
    try {
        $results = "SELECT comment FROM comments WHERE img_id = $img_id";

        $db->query($results);
        $row = $db->results();
        $i=0;
        foreach ($row as $key => $val) {
            echo "<div class='com-box'>";
            echo $row[$i++]->comment. "<br>";
            echo "<form class='delete-com' method='POST' action='".delete_com($db)."'>
            <input type='hidden' name='img_id' value=''>
            </form>";
            echo "</div>";
        }
        }
         catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

function getLikes($db, $img_id) {
    try {
        $db->get('likes', array ('img_id', '=', $img_id));
        $result = $db->results();
        $likes = $db->count();
        // var_dump ($likes);
        return $likes;
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}
?>
<body>
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
	<button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
    <a href="newpic.php" class="w3-bar-item w3-button">New pic</a>
    <a href="gallery.php" class="w3-bar-item w3-button">Gallery</a>
  <a href="update.php" class="w3-bar-item w3-button">Update info</a>
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
    <?php
    $db = DB::getInstance();
    $db->get("gallery", array('user_id', '=', $user->data()->user_id));
    $images = $db->results();
    $num_images = $db->count() - 1;

    for ($i = 0;$num_images >= 0; $i++) {
        $img = $images[$num_images]->img_name;
        $img_id = $images[$num_images]->img_id;
        //echo '<script>alert('.$img_id.')</script>';
        echo "<div style = 'float :left;'> <form action='comment.php' method='post'><input type='hidden' name='img_id' value=".$img_id."/><img src='$img' id=".$img_id." style='margin: 5px; margin-bottom: 1px; margin-top: 1px'><br/>
        <i data-imgid=".$img_id." onclick='likes(this)' class='fa fa-thumbs-up'></i><p type='text' id='show'></p>
            <input type='text' name = 'com'placeholder='Comment'></input> <input type='submit' name='submiting' value='Post'/> <input type='submit' name='delete' value='Delete'/>";
        echo "</form> <div id = 'comms'>";
        echo getLikes($db, $img_id);
        getComments($db, $img_id);
        echo "</div></div>";
        $num_images--;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile</title>
    <style>
    .fa {
        font-size: 30px;
        cursor: pointer;
        user-select: none;
    }

    .fa:hover {
        color: darkblue;
    }
    </style>
</head>
<body>
    
</body>
</html>
<script src="js/sidebar.js"></script>
<script src="js/ajax.js"></script>

<!-- <script>
   function likes(x) {
	var	likes = 1;
		x.classList.toggle("fa-thumbs-down");
		document.getElementById('show').innerHTML=likes;
        likes = likes + 1;
		document.getElementById('show').submit();
	}
</script> -->