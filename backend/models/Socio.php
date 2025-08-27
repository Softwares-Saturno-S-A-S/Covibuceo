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
            $input['nombre'], 
            $input['apellido'], 
            $input['ci'], 
            $input['email'], 
            password_hash($input['password'], PASSWORD_DEFAULT)
        ]);

        // Insertar los teléfonos aparte
        $socio_id = $this->conn->lastInsertId(); // Obtiene el ID del socio recién insertado

        $this->insertarTelefonos($socio_id, $input['telefono']);

        private function insertarTelefonos($socio_id, $telefono_string) {
        $telefonos = array_map('trim', explode(',', $telefono_string)); // Convierte la cadena en un array separando cada indice por comas y eliminando espacios en blanco
    
        $sql = "INSERT INTO TELEFONO (ID_Socio, Nro_Telefono) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
    
    foreach ($telefonos as $telefono) { // Recorre el array e inserta cada teléfono
        if (!empty($telefono)) {
            $stmt->execute([
                $socio_id,
                $telefono
            ]);
        }

            if ($insert) { // Si la inserción fue exitosa
                return [
                    'status' => 201,
                    'mensaje' => '<h2>Solicitud Enviada</h2>
                    <p class="p-left spaced">Le informamos que su solicitud para asociarse a <b>COVIBUCEO</b> fue enviada con éxito. Usted recibirá un correo electrónico a: ' . '<div class="link">' . $insert.['email'] . '</div>' . ' cuando gestionemos el estado de su solicitud.</p>
                    <p class="p-left spaced">En caso de aprobar su solicitud le enviaremos los datos para realizar su aporte inicial, y la cuota mensual de su vivienda más los gastos comunes.</p>
                    <button class="button-longsize light-green">Aceptar</button>'
                ];
            }
        }
        }
    }
}
    }
?>