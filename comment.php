<?php
 	require_once 'core/init.php';
	$db = DB::getInstance();
	$user = new User();
	
    $user_id =  intval($user->data()->user_id);
    $img_id = intval(Input::get('img_id'));
    $comment = escape($_POST['com']);
	if (!$user->isLoggedin()) {
		Redirect::to('index.php');
    }
    
    if (escape(isset($_POST["submiting"])) && !empty($comment)) {
        try {
            $sql = "INSERT INTO `comments`(`user_img_id`, `friend_id`, `comment`, `img_id`) VALUES(?, ?, ?, ?)";
            $db->query($sql, array(
                'user_img_id' => $user_id,
                'friend_id' => $user->data()->user_id,
                'comment' => $comment,
                'img_id' => $img_id));
    
        if ($user->data()->notify === "1") {
            $to = $user->data()->e_mail;
            $subject = "Someone commented on your post";
            $message = $user->data()->username." commented on your picture";
            $headers = 'From:noreply@camagru.com' . "\r\n"; 
            mail($to, $subject, $message, $headers);
        }
    echo "New comment uploaded successfully";
    Redirect::to('profile.php');
    }

    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        }
    }
    if (Input::get('delete')) {
        // echo "IN here";
        //echo '<script>alert('.$img_id.')</script>';
        $sql = "DELETE FROM `gallery` WHERE `img_id` = {$img_id} ";
        $db->query($sql);
         $sql_2 = "DELETE FROM comments WHERE `img_id` = {$img_id} ";
         $query_2 = $db->query($sql_2);
         $sql_3 = "DELETE FROM likes WHERE `img_id` = {$img_id} ";
         $query_3 = $db->query($sql_3);
        // echo "Successful";
         Redirect::to('profile.php?user='. $user->data()->username);
    }
    //    Redirect::to('profile.php');


?>