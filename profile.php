<?php
require_once 'core/init.php';

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
     ?>

    <h3><?php echo escape($data->username); ?></h3>
    <?php
 } 

?>