<?php
function checknotify()
{
    global $user;

    echo $user->data()->notify;
}

function notify() {
    global $user;
    $user->update(array(
        'notify' => input::get('notify'),
    ));
    echo "Update successful";
}

?>