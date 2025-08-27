<?php
    require_once 'Database.php'; // Llama el archivo con la conexión a la base de datos

    class Socio {
        private $conn;
        private $table_name = "SOCIO";

        public function __construct() { // Constructor que inicializa la conexión a la base de datos
        $this->conn = Database::getConnection();
    }
        public function add($input){
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE CI = ? OR Email = ?"); // Consulta para verificar si ese usuario ya existe
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
            $data['nombre'], 
            $data['apellido'], 
            $data['ci'], 
            $data['email'], 
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);

            if ($insert) { // Si la inserción fue exitosa
                return [
                    'status' => 201,
                    'mensaje' => 'Usuario creado exitosamente'
                ];
            }
        }
        }
    }
?>