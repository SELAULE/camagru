<?php
    require_once 'core/init.php';
    $db = DB::getInstance();
    $user = new User();
    // $db->get("gallery");
    // $images = $db->results();
    $fetch = "SELECT * FROM gallery";
    $db->query($fetch);
    $images = $db->results();
    $num_images = $db->count() - 1;

    function getComments($db, $img_id) {
        try {
            $results = "SELECT comment FROM comments WHERE img_id = $img_id";
    
            $db->query($results);
            $row = $db->results();
            $i = 0;
            foreach ($row as $key => $val) {
                echo "<div class='com-box'>";
                echo $row[$i++]->comment. "<br>";
                echo "<form class='delete-com' method='POST' action=''>
                <input type='hidden' name='img_id' value=''>
                </form>";
                echo "</div>";
            }
            }
             catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    for ($i = 0;$num_images >= 0; $i++) {
        $img = $images[$num_images]->img_name;
        $img_id = $images[$num_images]->img_id;
        echo "<div style = 'float :left;'> <form action='comment.php' method='post'><input type='hidden' name='img_id' value=".$img_id."/>".$img_id."<img src='$img' id=".$img_id." style='margin: 5px; margin-bottom: 1px; margin-top: 1px'><br/><i onclick='likes(this)' class='fa fa-thumbs-up'></i><p type='text' id='show'></p>
            <input type='text' name = 'com'placeholder='Comment'></input><input type='submit' name='submiting' value='Post'/>";
        echo "</form> <div id = 'comms'>";
        getComments($db, $img_id);
        echo "</div></div>";
        $num_images--;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="main.js"></script>
    <style>
    body {
        background-color: #ddd;
    }
	.com-box{
        width: 505px;
        padding: 20px;
        margin-bottom: 4px;
        background-color: #fff;
        border-radius: 4px;
    }
    .delete-com{
        position: absolute;
        /* top: 0px; */
        /* right: 0px; */
        float: right;
    }
    .delete-com button{
        width: auto;
        height: 20px;
        background-color: #fff;
        opacity: 0.7;
    }
</style>
</head>
<body>
    
</body>
</html>
