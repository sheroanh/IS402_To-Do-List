<?php 
namespace App\Controllers;
use App\Configs\Connect;
use App\Controller;

class LoginController extends Controller {
    public function index() {
        $this->render('authentication', ['action' => 'signin']);
    }
    
    public function show(){
        $connect = new Connect();
        $connect = $connect->connect();
        if (empty($_POST['username']) || empty($_POST['password'])) {
            header("location: signup");
            die;
        }
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM USER WHERE USERNAME=? AND PASSWORD=?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row["username"];
            session_start();
            $_SESSION['username'] = $username;
            header("location: /");
        } else {
            $this->render('authentication', ['error' => 'Invalid username or password', 'action' => 'signin', 'username' => $username]);
        }
        $connect->close();
    }

    public function logout() {
        session_start();
        session_destroy();
        header("location: /signin");
    }
}