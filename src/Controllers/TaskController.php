<?php
namespace App\Controllers;

use App\Configs\Database;
use App\Controller;

class TaskController extends Controller
{
    public function show($error = null, $success = null)
    {
        $connect = new Database();
        $connect = $connect->connect();
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM TASK WHERE USERNAME=?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'is_done' => $row['is_done'],
                'created_at' => $row['created_at'],
                'updated_at'=> $row['updated_at'],
            ];
        }
        $this->render('index', ['tasks' => $tasks, 'error' => $error, 'success' => $success]);
        $connect->close();
    }
    public function store()
    {
        if (empty ($_POST['title'])) {
            $this->show("Title is required");
            die;
        }
        try {
            $connect = new Database();
            $connect = $connect->connect();
            $username = $_SESSION['username'];
            $title = $_POST['title'];
            $description = $_POST['description'] ?? null;
            $sql = "INSERT INTO TASK (USERNAME, TITLE, DESCRIPTION) VALUES (?, ?, ?)";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("sss", $username, $title, $description);
            $stmt->execute();
            $this->show(null, "Task '$title' created successfully");
        } catch (\ErrorException $e) {
            $this->show($e);
            die;
        }
    }
    public function destroy()
    {
        if (!isset ($_POST['id'])) {
            $this->show("Task ID is required");
            die;
        }
        try {
            $connect = new Database();
            $connect = $connect->connect();
            $id = $_POST['id'];
            $username = $_SESSION['username'];
            $sql = "DELETE FROM TASK WHERE ID=? AND USERNAME=?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("is", $id, $username);
            $stmt->execute();
            $this->show(null, "Task $id deleted successfully");
            die;
        } catch (\ErrorException $e) {
            $this->show($e);
            die;
        }
    }
    public function update()
    {
        if (!isset ($_POST['is_done'])) {
            $this->show("Task status is required");
            die;
        }
        if (!isset ($_POST['id'])) {
            $this->show("Task ID is required");
            die;
        }
        try {
            $username = $_SESSION['username'];
            $is_done = $_POST['is_done'];
            $id = $_POST['id'];
            $connect = new Database();
            $connect = $connect->connect();
            $sql = "UPDATE TASK SET IS_DONE=? WHERE ID=? AND USERNAME=?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("iis", $is_done, $id, $username);
            $stmt->execute();
            $this->show(null, "Task $id updated successfully");
        } catch (\ErrorException $e) {
            $this->show($e);
            die;
        }
    }
    public function index()
    {
        session_start();
        if (empty ($_SESSION['username'])) {
            header("location: signin");
            die;
        }
        if (isset ($_POST['action'])) {
            switch ($_POST['action']) {
                case 'store':
                    $this->store();
                    break;
                case 'destroy':
                    $this->destroy();
                    break;
                case 'update':
                    $this->update();
                    break;
                default:
                    $this->show();
            }
        } else {
            $this->show();
        }
    }
}