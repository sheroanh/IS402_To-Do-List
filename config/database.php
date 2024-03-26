<?php
namespace App\Configs;

use Dotenv\Dotenv;
use mysqli;

class Database
{
    private $server;
    private $username;
    private $password;
    private $dbname;

    private $sqlStatements = [
        "CREATE TABLE IF NOT EXISTS user (
            username varchar(50) NOT NULL,
            password varchar(50) DEFAULT NULL,
            PRIMARY KEY (username)
          )",
        "CREATE TABLE IF NOT EXISTS task (
            id int(11) NOT NULL AUTO_INCREMENT,
            title mediumtext DEFAULT NULL,
            description mediumtext DEFAULT NULL,
            username varchar(50) DEFAULT NULL,
            is_done tinyint(1) NOT NULL DEFAULT 0,
            created_at timestamp NOT NULL DEFAULT current_timestamp(),
            updated_at timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
            PRIMARY KEY (id)
          )",
        "ALTER TABLE task
          ADD CONSTRAINT task_ibfk_1 FOREIGN KEY (username) REFERENCES user (username)"
    ];

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
            AND (table_name = 'user' or table_name = 'task')";
        $result = $connect->query($sql);
        if ($result->num_rows != 2) {
            $this->initializeDatabase($connect);
        }
        return $connect;
    }

    public function initializeDatabase(mysqli $connect)
    {
        foreach ($this->sqlStatements as $sql) {
            $connect->query($sql);
        }
    }
}
