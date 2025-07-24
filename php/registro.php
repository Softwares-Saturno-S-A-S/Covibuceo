<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Cooperativa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['name'];
$apellido = $_POST['surname'];
$ci = $_POST['ci'];
$telefono = $_POST['tel'];
$email = $_POST['email'];
$clavePlano = $_POST['password'];
$claveHasheada = password_hash($clavePlano, PASSWORD_DEFAULT);

// Verificar si ya existe ese email o cédula
$sql_verificar = "SELECT * FROM PERSONA WHERE Email = ? OR CI = ?";
$stmt = $conexion->prepare($sql_verificar);
$stmt->bind_param("ss", $email, $ci);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Usuario ya existe → redirigir con error
    header("Location: index.php?error=existe");
    exit;
} else {
    $sql_insertar = "INSERT INTO SOLICITUD (CI, Password_hash, Nombre, Apellido, Email, Nro_Telefono, Fecha_Solicitud) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql_insertar);
    $stmt->bind_param("ibsssis", $nombre, $email, $claveHasheada, $nombre, $apellido, $telefono, date("d/m/Y H:i"));

    $tabla = "SELECT * FROM SOLICITUD";
    $res = $conexion->query($tabla);
    echo $res;
    if ($stmt->execute()) {
        // Registro exitoso → redirigir al login
        header("Location: index.php?registro=exito");
        exit;
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
}

// Insertar nuevo usuario
$sql_insertar = "INSERT INTO SOCIO (nombre, , clave) VALUES (?, ?, ?)";
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
