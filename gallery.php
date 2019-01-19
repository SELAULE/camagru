<?php
    require_once 'core/init.php';
    $db = DB::getInstance();
    $user = new User();
    // $db->get("gallery");
    // $images = $db->results();
    $fetch = "SELECT * FROM gallery";
    $db->query($fetch);
    $images = $db->results();
    $num_images = $db->count() - 1;

    function getComments($db, $img_id) {
        try {
            $results = "SELECT comment FROM comments WHERE img_id = $img_id";
    
            $db->query($results);
            $row = $db->results();
            $i = 0;
            foreach ($row as $key => $val) {
                echo "<div class='com-box'>";
                echo $row[$i++]->comment. "<br>";
                echo "<form class='delete-com' method='POST' action=''>
                <input type='hidden' name='img_id' value=''>
                </form>";
                echo "</div>";
            }
            } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    ?>
    <body>
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
	<button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
    <a href="newpic.php" class="w3-bar-item w3-button">New pic</a>
  <a href="update.php" class="w3-bar-item w3-button">Update info</a>
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
    for ($i = 0;$num_images >= 0; $i++) {
        $img = $images[$num_images]->img_name;
        $img_id = $images[$num_images]->img_id;
        // $sql = "SELECT * FROM likes WHERE img = {$img_id} ";
        // $query = $db->query($sql);
        // $result = $db->results();
        
        echo "<div style = 'float :left;'>
            <form action='comment.php' method='post'>
            <input type='hidden' name='img_id' value=".$img_id."/>
            <img src='$img' id=".$img_id." style='margin: 5px; margin-bottom: 1px; margin-top: 1px'>
            
            <br/><i data-imgid=".$img_id." onclick='likes(this)' class='fa fa-thumbs-up'></i>
            <p type='text' id='show'></p>
            <input type='text' name = 'com'placeholder='Comment'></input>
            <input type='submit' name='submiting' value='Post'/>";
        echo "</form> <div id = 'comms'>";
        getComments($db, $img_id);
        echo "</div></div>";
        $num_images--;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/ajax.js"></script>
    <script src="js/sidebar.js"></script>
    <style>
    body {
        background-color: #ddd;
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
        height: 10px;
        background-color: #fff;
        opacity: 0.7;
    }
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
</head>

</html>
<script>
   /* function likes(x) {
	var	likes = 1;
		x.classList.toggle("fa-thumbs-down");
		document.getElementById('show').innerHTML=likes;
		likes = likes + 1;
		document.getElementById('show').submit();
	} */
</script>
