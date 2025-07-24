<?php
//Esta API se utilizará para cuando una solicitud sea aprobada o rechazada

//El backoffice debe contener estas lineas:

//Si se oprimió el botón "aceptar"
//$id = $tupla['ID'] -> Para seleccionar el ID de esa tupla con ese botón
//header("Location: solicitud.php?solicitud=aprobada?ID=$id");

//Si se oprimió el botón "rechazar"
//header("Location: solicitud.php?solicitud=rechazada");

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Cooperativa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['solicitud']) && $_GET['solicitud'] == 'aprobada') {
    // Insertar al nuevo socio
    $ID = isset($_GET['registro']);
    $sql_extraer = "SELECT * FROM SOLICITUD WHERE ID = $ID";
    $fila_solicitud = $conexion->query($sql_extraer);
    $nombre = 
    $sql_insertar = "INSERT INTO SOCIO (nombre, , clave) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql_insertar);
    $stmt->bind_param("sss", $nombre, $email, $claveHasheada);
}


if ($stmt->execute()) {
// Registro exitoso → redirigir al login
header("Location: index.php?registro=exito");
exit;
} else {
echo "Error al registrar: " . $stmt->error;
}
?>