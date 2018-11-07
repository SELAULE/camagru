<?php
/* 
require_once 'core/init.php';
 */
$target_dir = "../Gallery/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

}

if (file_exists($target_file)) {
    echo "File already exists.";
    $uploadOk = 0;
}

/* if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "File too large";
    $uploadOk = 0;
} */

if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Unknown Filetype";
    $uploadOk = 0;
}

if ($uploadOk == 0){
    echo "Error uploading image";
} else {
    if (move_uploaded_file ($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Successfully Uploaded " . basename($_FILES["fileToUpload"]["name"]);
        echo "<script type='text/javascript'>alert('$target_file');</script>";
    } else {
        echo " Error uploading image";
    }
}
?>