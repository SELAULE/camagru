<?php
    require_once 'core/init.php';

    $db = DB::getInstance();
    $user = new User(escape(Input::get('username')));

 

    if (isset($_GET['email']) && !empty('email') AND isset($_GET['token']) && !empty('token')) {

        $email =  $_GET['email'];
        $token = $_GET['token'];

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
