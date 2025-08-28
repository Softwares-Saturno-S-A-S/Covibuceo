<?php
    require_once 'Database.php'; // Llama el archivo con la conexión a la base de datos

    class Socio {
        private $conn;
        private $table_name = "SOCIO";

        public function __construct() { // Constructor que inicializa la conexión a la base de datos
        $this->conn = Database::getConnection();
    }
        public function add($input){
<<<<<<< HEAD
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE CI = ? OR Email = ? AND Estado_Socio = 'Aprobado'"); // Consulta para verificar si ese usuario ya existe
=======
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE CI = ? OR Email = ?"); // Consulta para verificar si ese usuario ya existe
>>>>>>> 26e67ee8c406f0e825dbff20562a44f9544a7778
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
<<<<<<< HEAD
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
        $resultado = $telefono->add($socio_id, $input['telefono']);

            if ($insert) { // Si la inserción fue exitosa devuelve el status 201 y un mensaje de éxito
                return [
                    'status' => 201,
                    'mensaje' => '<h2>Solicitud Enviada</h2>
                    <p class="p-left spaced">Le informamos que su solicitud para asociarse a <b>COVIBUCEO</b> fue enviada con éxito. Usted recibirá un correo electrónico a: ' . '<div class="link">' . $input['email'] . '</div>' . ' cuando gestionemos el estado de su solicitud.</p>
                    <p class="p-left spaced">En caso de aprobar su solicitud le enviaremos los datos para realizar su aporte inicial, y la cuota mensual de su vivienda más los gastos comunes.</p>
                    <button class="button-longsize light-green">Aceptar</button>'
                ];
            } else { // Si la inserccion no fue exitosa, por error de conexión, devuelve el status 500 y un mensaje de error
                return [
                    'status' => 500,
                    'error' => 'Error al registrar solicitud: ' . $stmt->errorInfo()[2] 
                ];
            }
        }
=======
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
>>>>>>> 26e67ee8c406f0e825dbff20562a44f9544a7778
    }
?>