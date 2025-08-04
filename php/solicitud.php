<?php
//Esta API se utilizará para cuando una solicitud sea aprobada o rechazada

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Cooperativa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['solicitud']) && $_POST['ID']) { // Verifica que haya datos cargados desde el backoffice. La función isset sirve para definir si una variable fue cargada y no es NULL. 
        $solicitud = $_POST['solicitud']; // Extrae el valor de la solicitud
        $ID = (int)$_POST['ID']; // Extrae el ID de la solicitud. Es importante convertirlo a entero para evitar inyecciones SQL :)

        switch ($solicitud) {
            case "aprobada":
                // Actualizar el estado de la solicitud a 'Aprobada'
                $sql_actualizar = "UPDATE SOLICITUD SET Estado_Solicitud = 'Aprobada' WHERE ID_Solicitud = ?";
                $stmt = $conexion->prepare($sql_actualizar); // Utiliza una sentencia preparada para evitar inyecciones SQL
                $stmt->bind_param("i", $ID);
                $stmt->execute();

                // Extraer datos de la solicitud aprobada
                $sql_extraer = "SELECT * FROM SOLICITUD WHERE ID_Solicitud = ?";
                $stmt = $conexion->prepare($sql_extraer);
                $stmt->bind_param("i", $ID);
                $stmt->execute();
                $resultado = $stmt->get_result(); // Se obtiene el esultado de la consulta como un objeto sql
                $fila_solicitud = $resultado->fetch_assoc(); // Se convierte el resultado en un array asociativo
                $ci = $fila_solicitud["CI"];
                $nombre = $fila_solicitud["Nombre"];
                $apellido = $fila_solicitud["Apellido"];
                $email = $fila_solicitud["Email"];
                $telefonos_string = $fila_solicitud["Nro_Telefono"];


                // Insertar en la tabla SOCIO y PERSONA
                $sql_insertar_persona = "INSERT INTO PERSONA (CI, Nombre, Apellido, Email) VALUES (?, ?, ?, ?)"; // Hay que analizar como se va a asignar la vivienda
                $stmt = $conexion->prepare($sql_insertar_persona);
                $stmt->bind_param("isss", $ci, $nombre, $apellido, $email);
                $stmt->execute();

                $sql_insertar_socio = "INSERT INTO SOCIO (CI) VALUES (?)";
                $stmt = $conexion->prepare($sql_insertar_socio);
                $stmt->bind_param("i", $ci);
                $stmt->execute();

                // Insertar los datos en la tabla TELEFONO
                $id_socio = $conexion->insert_id; // Obtiene el ID del último socio insertado
                $telefonos = explode(',', $telefonos_string); //Tranforma en array los números de teléfono si hay más de uno separados por coma
                foreach ($telefonos as $telefono) {
                    $sql_insertar_telefono = "INSERT INTO TELEFONO (Nro_Telefono, ID_Socio) VALUES (?, ?)";
                    $stmt = $conexion->prepare($sql_insertar_telefono);
                    $stmt->bind_param("si", $telefono, $id_socio);
                    $stmt->execute();
                }

                mail($email, "Solicitud Aprobada", "Su solicitud para asociarse a COVIBUCEO ha sido aprobada. Ingrese al siguiente link para crear su contraseña: "); // Envía un email al usuario notificándole la aprobación y un link de acceso único para que pueda crear su contraseña.

                header("Location: ../backoffice/index.php"); // Redirige al backoffice después de aprobar
                break;

            case "rechazada":
                // Actualizar el estado de la solicitud a 'Rechazada'
                $sql_actualizar = "UPDATE SOLICITUD SET Estado_Solicitud = 'Rechazada' WHERE ID_Solicitud = ?";
                $stmt = $conexion->prepare($sql_actualizar);
                $stmt->bind_param("i", $ID);
                $stmt->execute();

                $sql_extraer = "SELECT Email FROM SOLICITUD WHERE ID_Solicitud = ?";
                $stmt = $conexion->prepare($sql_extraer);
                $stmt->bind_param("i", $ID);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $fila_solicitud = $resultado->fetch_assoc(); // Se convierte el resultado en un array asociativo
                $email = $fila_solicitud["Email"]; // Extrae el email de la solicitud rechazada

                mail($email, "Solicitud Rechazada", "Lamentamos informarle que su solicitud para asociarse a COVIBUCEO fue denegada"); // Envía un email al usuario notificándole que su solicitud fue rechazada.

                header("Location: ../backoffice/index.php"); // Redirige al backoffice después de rechazar
                break;

            default:
                echo "Solicitud no válida.";
        }
    }

} else {
    echo "Método de solicitud no válido.";
}

?>