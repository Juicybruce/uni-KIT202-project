<?php

session_start();
require 'dbconn.php';

$title = $conn->real_escape_string(htmlspecialchars($_POST['title']));
$tagsArray = explode(',', $_POST['tagsField']);
$content = $conn->real_escape_string(htmlspecialchars($_POST['contentField']));
$accountID = $_SESSION['id'];
$date = date("Y-m-d");

$insertPostSQL = "INSERT INTO POST
        (accountID, postTitle, postContent, postDATE) 
        VALUES 
        ($accountID, '$title', '$content', '$date');";

$selectSQL = "SELECT * FROM TAG";



if ($response = $conn->query($selectSQL)) {
    $conn->query($insertPostSQL);
    $postIDLast = $conn->insert_id;
    foreach($tagsArray as $tag) {
        $found = false;  
        $insertTagSQL = "INSERT INTO TAG
                (tagName)
                VALUES
                ('$tag');"; 
        $tagID;
        $selectTagSQL = "SELECT tagID FROM TAG WHERE tagName = '$tag'";
        while($row = $response->fetch_assoc()) {
            if($row['tagName'] === $tag) {
                $found = true;
            }
        }
        if(!$found)
        {
            $conn->query($insertTagSQL);
            $tagID = $conn->insert_id;
        }
        else
        {
            $responseTag = $conn->query($selectTagSQL);
            $rowTag = $responseTag->fetch_assoc();
            $tagID = $rowTag['tagID'];
        }
        $insertHasTagSQL = "INSERT INTO HASTAGS 
                    (postID, tagID)
                    VALUES
                    ('$postIDLast','$tagID');";
        $conn->query($insertHasTagSQL);
    }
    

    $conn->close();
    header('Location: ./index.php');
}