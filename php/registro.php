<?php

// Conexión a la base de datos

require_once '../backend/config/Database.php';

$conexion = Database::getConnection();

// Obtener datos del formulario
$nombre = $_POST['name'];
$apellido = $_POST['surname'];
$ci = $_POST['ci'];
$telefono = $_POST['tel'];
$email = $_POST['email'];
$clave = $_POST['password'];
$clave_hash = password_hash($clave, PASSWORD_DEFAULT); // Hashear la contraseña

// Verificar si ya existe ese email o cédula
$sql_verificar = "SELECT * FROM SOCIO WHERE Email = ? OR CI = ?";
$stmt = $conexion->prepare($sql_verificar);
$stmt->bind_param("ss", $email, $ci);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Usuario ya existe → redirigir con error
    header("Location: ../Landing Page/registro-form.php?error=existe");
    exit;
} else {
    $sql_insertar = "INSERT INTO SOLICITUD (CI, Nombre, Apellido, Email, Nro_Telefono, Password_hash) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql_insertar);
    $stmt->bind_param("issssb", $ci, $nombre, $apellido, $email, $telefono, $clave_hash);

    if ($stmt->execute()) {
        // Registro exitoso → redirigir al login
        header("Location: ../Landing Page/index_aceptado.php?email=" . urlencode($email));
        exit;
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
}

$stmt->close();
$conexion->close();
?>