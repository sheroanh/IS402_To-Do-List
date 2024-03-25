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
        $dotenv->load();
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
        return $connect;
    }
}
