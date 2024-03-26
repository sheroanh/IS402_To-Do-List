<?php
namespace App\Configs;

use Dotenv\Dotenv;
use mysqli;

class Connect
{
    private $server;
    private $username;
    private $password;
    private $dbname;
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->safeLoad();
        $this->server = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->dbname = $_ENV['DB_NAME'];
    }
    public function connect()
    {
        $connect = new mysqli($this->server, $this->username, $this->password, $this->dbname);
        if ($connect->connect_error) {
            die ("Connection failed: " . $connect->connect_error);
        }
        $sql = "SELECT * 
        FROM information_schema.tables
        WHERE table_schema = '$this->dbname' 
            AND table_name = 'user'
        LIMIT 1";
        $result = $connect->query($sql);
        if ($result->num_rows == 0) {
            $this->initializeDatabase($connect);
        }
        return $connect;
    }

    public function initializeDatabase($connect)
    {
        $sql = "CREATE TABLE IF NOT EXISTS user (
            username varchar(50) NOT NULL,
            password varchar(50) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
        $connect->query($sql);
        $sql = "CREATE TABLE IF NOT EXISTS task (
            id int(11) NOT NULL,
            title mediumtext DEFAULT NULL,
            description mediumtext DEFAULT NULL,
            username varchar(50) DEFAULT NULL,
            is_done tinyint(1) NOT NULL DEFAULT 0,
            created_at timestamp NOT NULL DEFAULT current_timestamp(),
            updated_at timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
        $connect->query($sql);
    }
}
