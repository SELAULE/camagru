<?php
 	require_once 'core/init.php';
	$db = DB::getInstance();
	$user = new User();
	  
    $user_id = intval($user->data()->user_id);
	$img_id = intval($_POST["img_id"]);
    $comment = escape($_POST["com"]);

	if (!$user->isloggedin()) {
		Redirect::to('index.php');
	}if (isset($_POST["submiting"])) {

     try {$sql = "INSERT INTO `comments`(`user_img_id`, `comment`, `img_id`)"
    . "VALUES($user_id, \'$comment\', $img_id)";
    
    $conn->exec($sql);
    
    echo "New record created successfully";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

?>