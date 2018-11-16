<?php
 	require_once 'core/init.php';
	$db = DB::getInstance();
	$user = new User();
	
    $user_id =  intval($user->data()->user_id);
	$img_id = intval($_POST["img_id"]);
    $comment = $_POST['com'];
	if (!$user->isLoggedin()) {
		Redirect::to('index.php');
	} if (isset($_POST["submiting"]) && !empty($comment)) {
     try {
    $sql = "INSERT INTO `comments`(`user_img_id`, `comment`, `img_id`) VALUES(?, ?, ?)";
    $db->query($sql, array($user_id, $comment, $img_id));
    echo "New comment uploaded successfully";
    }

    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        }
    }

    function delete_com($db) {
        if (isset($_POST['commet'])) {
            $com_id = $_POST['comment_id'];
             $sql = "DELETE FROM `comments` WHERE `comments`.`comment_id` = $com_id";
            //  $db->query($sql, array($com_id));
        }
    }
?>