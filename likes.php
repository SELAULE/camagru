
<?php
    require_once 'core/init.php';

    $db = DB::getInstance();
    $user = new User();
    // var_dump($_POST);
    // var_dump($_POST);
if ($user->isLoggedIn()) {
    $qu = 'INSERT INTO likes (img_id,likers_id,like_status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE like_status=IF(like_status=1, 0, 1)';
    $db->query($qu, array("img_id" => $_POST["img_id"],
        "likers_id" => $user->data()->user_id, 1));

    if ($user->data()->notify === "1") {
        $to = $user->data()->e_mail;
        $subject = "Someone Liked your profile";
        $message = $user->data()->username."Liked your picture";
        $headers = 'From:noreply@camagru.com' . "\r\n"; 
        mail($to, $subject, $message, $headers);
        
    }
} else {
    Redirect::to('login.php');
}
            //    echo "email sent";
?>