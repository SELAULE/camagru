<?php
    require_once 'core/init.php';

    $db = DB::getInstance();
    $user = new User(escape(Input::get('username')));

 

    if (isset($_GET['email']) && !empty('email') AND isset($_GET['token']) && !empty('token')) {
        // Validate
        // $hash = $user->data()->password;
        // $email =  $user->data()->e_mail;
        // $hash = $_GET['hash'];
        $email =  $_GET['email'];
        $token = $_GET['token'];
        // echo $token."\n";
        // echo $hash;
        // echo $email;

    //     $sql = "SELECT e_mail, password, group FROM users WHERE e_mail='".$email."' AND password='".$hash."' AND group='0'";
    //     $match = $db->query($sql, array(
    //         'e_mail' => $email,
    //         'password' => $hash,
    //         'group' => '0'
    //     ));
        if ((strcmp($email, $user->data()->e_mail) == 0) && (Token::check($token)) == 0) {
            $db->update_group('users', $user->data()->user_id, array('group' => 1));
            header('location:login.php');
        } else {
            echo "Invalid token";
        }
    } else {
        // echo 'Nope';
    }
?>
