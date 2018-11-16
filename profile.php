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
        width: 490px;
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

function getComments($db) {
    // $com_id = intval($_POST['comment_id']);
    try {
        $com_id = intval($_POST['comment_id']);
        $results = "SELECT * FROM comments WHERE img_id = 15";
        $db->get("comments", array('img_id', '=', 2));
        // $db->query_2($results, array("img_id" => 15));
        $row = $db->results();
        $i=0;
        foreach ($row as $key => $val) {
            // echo "<div class='com-box'>";
            echo $row[$i++]->comment . "<br>";
            /* echo "<form class='delete-com' method='POST' action='".delete_com($db)."'>
            <input type='hidden' name='img_id' value=''>
            <button>Delete</button>
            </form>"; */
            echo "</div>";
        }
        }
         catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}
?>

    <h3><?php echo escape($data->username); ?></h3>
    <?php
    $db = DB::getInstance();
    $db->get("gallery", array('user_id', '=', $user->data()->user_id));
    $images = $db->results();
    $num_images = $db->count() - 1;

    for ($i = 0;$num_images >= 0; $i++) {
        $img = $images[$num_images]->img_name;
        $img_id = $images[$num_images]->img_id;
        echo "<div style = 'float :left;'> <form action='comment.php' method='post'><input type='hidden' name='img_id' value=".$img_id."/>".$img_id."<img src='$img' style='margin: 5px; margin-bottom: 1px; margin-top: 1px'><br/><i onclick='likes(this)' class='fa fa-thumbs-up'></i><p type='text' id='show'></p>
            <input type='text' name = 'com'placeholder='Comment'></input><input type='submit' name='submiting' value='Post'u/></form>
            </div>";
        //echo getComments($db);
        $num_images--;
        //getComments($db);
    }
        // getComments($db);
?>

<script>
    function likes(x) {
	var	likes = 1;
		x.classList.toggle("fa-thumbs-down");
		document.getElementById('show').innerHTML=likes;
		likes = likes + 1;
		document.getElementById('show').submit();
	}
</script>