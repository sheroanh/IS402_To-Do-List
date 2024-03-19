<?php
      include "connect.php";
      if ((isset($_POST['signup']) && ($_POST['signup'] == "Sign up"))) 
      {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "INSERT INTO USER(username, password) VALUES('$username','$password')";
        if ($connect->query($sql) == true) 
        {
          header("location: signin.php");
          die;
        }
        $connect->close();
      }
  ?>