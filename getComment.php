<?php
require_once 'core/init.php';
$db = DB::getInstance();
$user = new User();

function getComments() {
    try {
    $sql = "SELECT * FROM comments";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();
    echo $row['com'];
    } catch(PDOException $e) {
        echo $sql . "<br>" .
    }
}
?>