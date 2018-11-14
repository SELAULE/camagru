<style>
    .fa {
	font-size: 30px;
	cursor: pointer;
	user-select: none;
}
    .fa:hover {
    color: darkblue;
    }
</style>

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
    $db = DB::getInstance();
    $db->get("gallery", array('user_id', '=', $user->data()->user_id));
    $images = $db->results();
    $num_images = $db->count() - 1;

    for ($i = 0;$num_images >= 0; $i++) {
        $img = $images[$num_images]->img_name;
        $img_id = $images[$num_images]->img_id;
        echo "<div style = 'float :left;'> <form action='comment.php' method='post'><input type='hidden' name='img_id' value=".$img_id."/><img src='$img' style='margin: 5px; margin-bottom: 1px; margin-top: 1px'><br/><i onclick='likes(this)' class='fa fa-thumbs-up'></i><p type='text' id='show'></p>
            <input type='text' name = 'com'placeholder='Comment'></input><input type='submit' name='submiting' value='Post'u/></form>
        </div>";
        $num_images--;
    }
 }
?>