<?php
namespace App\Controllers;

use App\Configs\Connect;
use App\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $this->render('authentication', ['action' => 'signup']);
    }

    public function store()
    {
        $connect = new Connect();
        $connect = $connect->connect();
        if (empty ($_POST['username']) || empty ($_POST['password'])) {
            $this->render('authentication', ['error' => 'Username and password are required', 'action' => 'signup', 'username' => $_POST['username'], 'password' => $_POST['password']]);
            die;
        }
        $username = $_POST['username'];
        $sql = "SELECT * FROM USER WHERE USERNAME=?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $this->render('authentication', ['error' => 'Username already exists', 'action' => 'signup', 'username' => $username]);
            die;
        }
        $password = md5($_POST['password']);
        $sql = "INSERT INTO USER (USERNAME, PASSWORD) VALUES (?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $connect->close();
        $this->render('authentication', ['success' => 'User registered successfully', 'action' => 'signup', 'username' => $username]);
    }
}