<?php
    require_once 'core/init.php';
    $db = DB::getInstance();
    $user = new User();

    echo $user->data()->img_id;
    /* function delete_img ($img_id) {
        $db->delete($user->data()->img_id);
    } */
?>