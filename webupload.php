<?php
    require_once "core/init.php";

    $x;
    $y;
    $pos1;
    $pos2;
    $height;
    $width;

    $db = DB::getInstance();
    $user = new user();

    $imgnum = $db->get("gallery",array('user_id', '=', $user->data()->user_id));
    $img_id = $imgnum->count() + 1;
    $user_id = $user->data()->user_id;
    
    $data = explode( ',', $_POST["img64"] );
    $test = base64_decode($data[1]);
    
    file_put_contents("Gallery/user_".$user_id."_image_".$img_id.".png", $test);
    $dest= imagecreatefrompng("Gallery/user_".$user_id."_image_".$img_id.".png");

    if(!empty($_POST["emoji64"]))
    {
        $emo = explode ('camagru/',$_POST["emoji64"]);   
        $src = imagecreatefrompng($emo[1]);
        $width = ImageSx($src);
        $height = ImageSy($src);
        pic_position($emo);
        ImageCopyResampled($dest, $src, $pos2, $pos1, 0, 0, $x, $y, $width, $height);
    }
    
    if(!empty($_POST["emoji64_2"]))
    {
        $emo2 = explode ('camagru/',$_POST["emoji64_2"]);
        $src = imagecreatefrompng($emo2[1]);
        $width = ImageSx($src);
        $height = ImageSy($src);
        pic_position($emo2);
        ImageCopyResampled($dest, $src, $pos2, $pos1, 0, 0, $x, $y, $width, $height);
    }
    
    imagepng($dest, "Gallery/user_".$user_id."_image_".$img_id.".png");

    $db->insert('gallery', array(
        'img_name' => 'Gallery/'."user_".$user_id."_image_".$img_id.'.png',
        'user_id' => $user_id
    ));
    redirect::to("newpic.php"); 

    function pic_position($emo)
    {
        global $x, $y, $width, $height, $pos1, $pos2;

        switch ($emo[1])
        {
            case "images/emojis/emoj_1.png" :
                $pos1 = 10;
                $pos2 = 10;
                $x = $width/5; $y = $height/5;
                break;
            case "images/emojis/emoj_2.png" :
                $pos1 = 10;
                $pos2 = 200;
                $x = $width/5; $y = $height/5;
                break;
            case "images/emojis/emoj_3.png" :
                $pos1 = 10;
                $pos2 = 400;
                $x = $width/5; $y = $height/5;
                break;
            case "images/emojis/emoj_4.png" :
                $pos1 = 100;
                $pos2 = 10;
                $x = $width/5; $y = $height/5;
                break;
            case "images/emojis/emoj_5.png" :
                $pos1 = 100;
                $pos2 = 200;
                $x = $width/5; $y = $height/5;
                break;
            case "images/emojis/emoj_6.png" :
                $pos1 = 100;
                $pos2 = 400;
                $x = $width/4; $y = $height/4;
                break;
        }
    }
?>