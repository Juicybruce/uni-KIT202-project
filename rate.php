<?php

session_start();

require "./dbconn.php";

$previousPage = $_GET["previous"];
$id = $_GET["id"];
$accountID = $_SESSION['id']; //Change when get accounts working

$previousPage =  "https://$_SERVER[HTTP_HOST]$previousPage";

echo $previousPage.' ';

$insertSQL = "INSERT INTO RATES (accountID, postID) VALUES ($accountID, $id);";

$selectSQL = "SELECT * FROM RATES;";

if ($response = $conn->query($selectSQL)) {
    $found = false;
    while($row = $response->fetch_assoc()) {
        echo 'acc '.$row['accountID'].' post '.$row['postID'].' ';
        if($row['accountID'] == $accountID && $row['postID'] == $id)
        {
            echo 'test';
            $found = true;
        }
    }
    if(!$found)
    {
        $conn->query($insertSQL);
    }
}

$conn->close();
header('Location: '.$previousPage);
exit;