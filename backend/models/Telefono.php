<?php
    require_once '../config/Database.php'; // Llama el archivo con la conexión a la base de datos

    class Telefono {
        private $conn;
        private $table_name = "TELEFONO";

        public function __construct() { // Constructor que inicializa la conexión a la base de datos
            $database = new Database();
            $this->conn = $database->getConnection();
    }

    public function add($socio_id, $telefono_string) {
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
}
    }
}

?>