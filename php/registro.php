<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "cooperativa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$clavePlano = $_POST['clave'];
$claveHasheada = password_hash($clavePlano, PASSWORD_DEFAULT);

// Verificar si ya existe ese email o nombre
$sql_verificar = "SELECT id FROM usuarios WHERE email = ? OR nombre = ?";
$stmt = $conexion->prepare($sql_verificar);
$stmt->bind_param("ss", $email, $nombre);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Usuario ya existe → redirigir con error
    header("Location: registro_form.php?error=existe");
    exit;
}

// Insertar nuevo usuario
$sql_insertar = "INSERT INTO usuarios (nombre, email, clave) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql_insertar);
$stmt->bind_param("sss", $nombre, $email, $claveHasheada);

if ($stmt->execute()) {
    // Registro exitoso → redirigir al login
    header("Location: index.php?registro=exito");
    exit;
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
