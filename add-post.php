<?php

require 'dbconn.php';

$title = htmlspecialchars($_POST['title']);
$tagsArray = explode(',', $_POST['tagsField']);
$content = htmlspecialchars($_POST['contentField']);
$accountID = 1; //placeholder, this needs to be changed once users are implemented
$date = date("Y-m-d");

$sql = "INSERT INTO POST
        (accountID, postTitle, postContent, postDATE) 
        VALUES 
        ($accountID, '$title', '$content', '$date');";

if ( $response = $conn->query($sql)) {
    $conn->close();
    header('Location: ./index.php');
}

// TODO, need to iterate tags to: 
// 1. add them into the tag table if they are not duplicates and 
// 2. insert each one into the hastag DB
