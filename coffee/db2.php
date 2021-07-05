<?php

$mysqli = new mysqli("localhost", "project", "wawasan", "Shopping");

if ($mysqli->connect_errno){
    printf("Unable to connect to the database:<br /> %s", $mysqli->connect_error);
    exit();
}

$query = "INSERT INTO Customer VALUES 
(NULL, 'Yusree Karlie', 'fireace.yk@gmail.com', 'wafieqah', '7 Elfindale, Diepriver')";
$result = $mysqli->query($query, MYSQLI_STORE_RESULT);
if(!$result){
    echo($mysqli->error);
    exit();
}

?>