<?php
class Database
{
    private $host = 'localhost';
    private $dbname = 'cooperativa';
    private $username = 'root';
    private $password = '';
    public $connection;
   
    private function __construct()
    {
        $this->connection = null;
        $this->connection = new PDO("mysql:host=" .$this->host . ";dbname=", $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
?>