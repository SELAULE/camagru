<?php
    require_once 'core/init.php';
    $db = DB::getInstance();
    $user = new User();

    $email =  $user->data()->e_mail;

    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)){
        $msg = 'The email you have entered is invalid, please try again.';
    } else{
        $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
        $hash = $user->data()->password;
    }
    if (isset($msg)) {
        echo '<div class="statusmsg">' .$msg. '</div>';
    }

    $to = $email;
    $subject = 'Signup / Verify';
    $message = 'Thanks for signing up!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
     
    ------------------------
    Username: '.$user->data()->username.'
    And Password.
    ------------------------
     
    Please click this link to activate your account:
    http://127.0.0.1:4000/camagru/verify.php/verify.php?email='.$email.'&hash='.$hash.' ';

    $headers = 'From:noreply@camagru.com' . "\r\n";
    mail($to, $subject, $message, $headers);

    if (isset($_GET['email']) && !empty('email') AND isset($_GET['hash']) && !empty('hash')) {
        // Validate
        // $hash = $user->data()->password;
        // $email =  $user->data()->e_mail;
        $hash = $_GET['hash'];
        $email =  $_GET['email'];
        // echo $hash;
        // echo $email;

    //     $sql = "SELECT e_mail, password, group FROM users WHERE e_mail='".$email."' AND password='".$hash."' AND group='0'";
    //     $match = $db->query($sql, array(
    //         'e_mail' => $email,
    //         'password' => $hash,
    //         'group' => '0'
    //     ));
        if ((strcmp($email, $user->data()->e_mail) == 0) && (strcmp($hash, $user->data()->password) == 0))
        $db->update_group('users', $user->data()->user_id, array('group' => 1));
    } else {
        // echo 'Nope';
    }
?>
