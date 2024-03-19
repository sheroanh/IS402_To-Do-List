<?php
    session_start();
    include "connect.php";
    $username = $_SESSION['username'];
    $title = $_GET['title'];
    $sql = "DELETE FROM TASK WHERE TITLE='$title' AND USERNAME='$username'";
    $connect->query($sql);
    $connect->close();
    header("Refresh: 0");
?>