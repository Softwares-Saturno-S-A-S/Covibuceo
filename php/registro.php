<?php

//Esta API sirve para guardar los datos que son ingresados por el usuario en el formulario de registro, en una tabla de la base de datos llamada "SOLICITUD"
//Una vez que el admin apruebe una solicitud, los datos correspondientes a esa tupla, serán enviados a las tablas que guardan los datos de los socio, siendo estas "SOCIO", "PERSONA" y "TELEFONO"

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
    header("Location: ../Landing Page/index.php?error=existe");
    exit;
} else {
    $sql_insertar = "INSERT INTO SOLICITUD (CI, Password_hash, Nombre, Apellido, Email, Nro_Telefono) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql_insertar);
    $stmt->bind_param("ibsssi", $ci, $claveHasheada, $nombre, $apellido, $email, $telefono);

    if ($stmt->execute()) {
        // Registro exitoso → redirigir al login
        header("Location: ../Landing Page/index.php?registro=exito");
        exit;
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
}

$stmt->close();
$conexion->close();
?>