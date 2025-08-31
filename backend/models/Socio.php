<?php
    require_once '../config/Database.php'; // Llama el archivo con la conexión a la base de datos

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

        public function add($input){
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE (CI = ? OR Email = ?) AND Estado_Socio = 'Aprobado'"); // Consulta para verificar si ese usuario ya existe
            $stmt->execute([ // Ejecuta la consulta con los parámetros proporcionados
            $input['ci'], 
            $input['email']
        ]); 
            $existe = $stmt->fetch(); // Obtiene el resultado de la consulta
        
        if ($existe) { // Si existe el usuario devuelve el status 409 y un mensaje de error
            return [
                'status' => 409,
                'error' => 'La cédula y/o el email ya están registrados'
            ];

        } else { // En caso de no existir crea el usuario 
            $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name .  " (Nombre, Apellido, CI, Email, Password_hash) VALUES (?, ?, ?, ?, ?)");
            $insert = $stmt->execute([
            $input['nombre'], 
            $input['apellido'], 
            $input['ci'], 
            $input['email'], 
            password_hash($input['password'], PASSWORD_DEFAULT)
        ]);

        // Insertar los teléfonos aparte
        $socio_id = $this->conn->lastInsertId(); // Obtiene el ID del socio recién insertado
        $telefonos = $input['telefono'];

        require_once 'Telefono.php'; // Incluye el modelo Telefono

        $telefono = new Telefono();
        $resultado = $telefono->add($socio_id, $telefonos);

            if ($insert) { // Si la inserción fue exitosa devuelve el status 201 y un mensaje de éxito
                return [
                    'status' => 201,
                    'mensaje' => 'Solicitud enviada',
                    'email' => $input['email']
                ];
            } else { // Si la inserccion no fue exitosa, por error de conexión, devuelve el status 500 y un mensaje de error
                return [
                    'status' => 500,
                    'error' => 'Error al registrar solicitud: ' . $stmt->errorInfo()[2] 
                ];
            }
        }
    } 
}
?>