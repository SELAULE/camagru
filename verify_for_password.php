<?php
    require_once 'core/init.php';

    $db = DB::getInstance();
    $user = new User();

    echo "<div class='e-mail'><form>
    <label for='e-mail'>E-mail address</label>
    <input type='text' name='e_mail' id='e-mail' value='' placeholder='e-mail'>
    <input type='submit' value='Send' id='reg-butt'>
</form></div>";
    $email =  Input::get('e_mail');

    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)){
        $msg = 'The email you have entered is invalid, please try again.';
    } else{
        $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
        //$hash = $user->data()->password;
    }
    if (isset($msg)) {
        echo '<div class="statusmsg">' .$msg. '</div>';
    }

    $to = $email;
    $subject = 'Change password';
    $message = "Click the link below to change your password, and can therefore enjoy the fun times.
    ------------------------
    Username: Your username
    Password: Your new password.
    ------------------------
     
    Please click this link to change your password:
    http://127.0.0.1:8080/camagru/changepassword.php/changepassword.php?email=".$email;

    $headers = 'From:noreply@camagru.com' . "\r\n";
    mail($to, $subject, $message, $headers);

    if (isset($_GET['email']) && !empty('email')/*  AND isset($_GET['hash']) && !empty('hash') */) {
        // Validate
        // $hash = $user->data()->password;
        // $email =  $user->data()->e_mail;
        //$hash = $_GET['hash'];
        $email =  $_GET['email'];
        // echo $hash;
        // echo $email;

    //     $sql = "SELECT e_mail, password, group FROM users WHERE e_mail='".$email."' AND password='".$hash."' AND group='0'";
    //     $match = $db->query($sql, array(
    //         'e_mail' => $email,
    //         'password' => $hash,
    //         'group' => '0'
    //     ));
        if ((strcmp($email, $user->data()->e_mail) == 0)/*  && (strcmp($hash, $user->data()->password) == 0) */)
        $db->update_group('users', $user->data()->user_id, array('group' => 1));
    } else {
        // echo 'Nope';
    }