<?php
class Database
{
    private $host = 'localhost';
    private $dbname = 'cooperativa';
    private $username = 'root';
    private $password = '';
    private $connection = null;
   
    public function getConnection() {
         if ($this->connection === null) {
            try {
                $this->connection = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->dbname, 
                    $this->username, 
                    $this->password
                );
            
            $this->connection->exec("set names utf8");

            } catch (PDOException $exception) {
                echo "Error de conexión: " . $exception->getMessage();
            }

        return $this->connection;
        }
    }
    }
?>