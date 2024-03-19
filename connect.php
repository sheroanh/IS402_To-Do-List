<?php
    $server = "localhost";
    $username = "root";
    $password = "091203";
    $dbname = "todolist";

    $connect = new mysqli($server, $username, $password, $dbname);
    if($connect->errno !== 0)
    {
        die("Error: Could not connect to the database. An error ".$connect->errno."occured.");
    }
?>