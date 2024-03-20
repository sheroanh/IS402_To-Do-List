<?php
session_start();
include "connect.php";
if ((isset($_POST['signin']) && ($_POST['signin'] == "Sign in"))) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM USER WHERE USERNAME='$username' AND PASSWORD='$password'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("location: index.php");
        die;
    } else
        echo "<p style='text-align: center'>Invalid username or password</p>";
    $connect->close();
}

if ((isset($_POST['signup']) && ($_POST['signup'] == "Sign up")))
{
    header("location: signup.php");
    die;
}