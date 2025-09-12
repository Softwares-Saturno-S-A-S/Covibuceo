<?php
class Database
{
    // Establecer las variables de conexión a la base de datos desde variables de entorno y proveer valores por defecto
    private $host = $_ENV['DB_HOST'] ?? 'localhost';
    private $dbname = $_ENV['DB_NAME'] ?? 'default';
    private $username = $_ENV['DB_USER'] ?? 'root';
    private $password = $_ENV['DB_PASSWORD'] ?? '';

    private $connection = null;
   
    public function getConnection() {
         if ($this->connection === null) {
            try {
                $this->connection = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password
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