<?php
    namespace source\backend\models;
    
    require_once __DIR__ . '/../config/Database.php'; // Llama el archivo con la conexión a la base de datos

    use source\backend\config\Database;

    class Socio {
    // Variables 

        private $conn;
        private $table_name = "SOCIO";

    // Constructor 
    
        public function __construct() { 
            $database = new Database();
            $this->conn = $database->getConnection();
    }

    // Métodos

        public function verify_existente($input) {
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE (CI = ? OR Email = ?) AND Estado_Socio = 'Aprobado'"); // Consulta para verificar si ese usuario ya existe
            $stmt->execute([ // Ejecuta la consulta con los parámetros proporcionados
            $input['ci'], 
            $input['email']
        ]); 
            return $stmt->fetch(); // Obtiene el resultado de la consulta
        }

        public function verify_solicitud($input) {
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE (CI = ? OR Email = ?) AND Estado_Socio = 'Pendiente'"); // Consulta para verificar si ese usuario ya existe
            $stmt->execute([ // Ejecuta la consulta con los parámetros proporcionados
            $input['ci'], 
            $input['email']
        ]); 
            return $stmt->fetch(); // Obtiene el resultado de la consulta
        }
        
        public function add_Socio($input){
            $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name .  " (Nombre, Apellido, CI, Email, Password_hash) VALUES (?, ?, ?, ?, ?)");
            $insert = $stmt->execute([
            $input['nombre'], 
            $input['apellido'], 
            $input['ci'], 
            $input['email'], 
            password_hash($input['password'], PASSWORD_DEFAULT)
        ]);

        // Insertar los teléfonos
        $socio_id = $this->conn->lastInsertId(); // Obtiene el ID del socio recién insertado
        $telefonos = $input['telefono'];

        require_once 'Telefono.php'; // Incluye el modelo Telefono

        $telefono = new Telefono();
        $resultado = $telefono->add($socio_id, $telefonos);
        
        if (!$insert) { 
            return $stmt->errorInfo()[2];
        } else {
            return true; // Si la insercción fue exitosa, devuelve true
        }
    } 
}
?>