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
        $this->connection = new PDO("mysql:host=" .$this->host . ";dbname=" .$this->dbname, $this->username, $this->password); //Crea un objeto PDO (PHP Data Object) para la conexión a la base de datos. El objeto conteine tres parámetros: el DNS (Domain Name System) que especifica el la ubicación y nombre de la base de datos, el nombre de usuario y la contraseña. 
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
?>