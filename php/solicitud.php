<?php
//Esta API se utilizará para cuando una solicitud sea aprobada o rechazada

//El backoffice debe contener estas lineas:

//Si se oprimió el botón "aceptar"
//$id = $tupla['ID_Solicitud'] -> Para seleccionar el ID de esa tupla con ese botón
//header("Location: solicitud.php?solicitud=aprobada?ID=" . $id"); ->Para redirigir a la página de solicitude el id del socio aceptado

//Si se oprimió el botón "rechazar"
//header("Location: solicitud.php?solicitud=rechazada");


// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Cooperativa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['solicitud']) && $_GET['solicitud'] == 'aprobada') {
    
    // Extraer datos de la solicitud aprobada
    
    $ID = $_GET["ID"];
    $sql_extraer = "SELECT * FROM SOLICITUD WHERE ID = $ID";
    $fila_solicitud = $conexion->query($sql_extraer);
    $fila_solicitud = $fila_solicitud->fetch_assoc();
    $ci = $fila_solicitud["CI"];
    $password = $fila_solicitud["Password_hash"];
    $nombre = $fila_solicitud["Nombre"];
    $apellido = $fila_solicitud["Apellido"];
    $email = $fila_solicitud["Email"];
    $telefono = $fila_solicitud["Nro_Telefono"];

    // Insertar los datos en la tabla PERSONA
    
    $sql_insertar_persona = "INSERT INTO PERSONA (CI, Nombre, Apellido, Email, ID_Unidad_Habitacional, Password_hash) VALUES ($ci, $nombre, $apellido, $email, 1, $password)"; // Hay que analizar como se va a asignar la vivienda
    $stmt = $conexion->prepare($sql_insertar_socio);
    $stmt->execute();

    // Insertar los datos en la tabla SOCIO

    $sql_insertar_socio = "INSERT INTO SOCIO (CI) VALUES ($ci)";
    $stmt = $conexion->prepare($sql_insertar_socio);
    $stmt->execute();

    $id_socio = $conexion->lastInsertId();

    // Insertar los datos en la tabla TELEFONO

    $sql_insertar_telefono = "INSERT INTO TELEFONO (Nro_Telefono, ID_Socio) VALUES ($telefono, $id_socio)";
    $stmt = $conexion->prepare($sql_insertar_telefono);
    $stmt->execute();

}



?>