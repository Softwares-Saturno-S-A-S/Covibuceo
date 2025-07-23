<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "cooperativa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$emailIngresado = $_POST['email'];
$claveIngresada = $_POST['clave'];

// Buscar usuario por email
$sql = "SELECT clave FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $emailIngresado); //"s" representa el tipo de datos por el que se filtra. En este caso "string"
$stmt->execute();
$resultado = $stmt->get_result();

session_start();
$_SESSION['id'] = $usuario['id']; // o lo que corresponda
$_SESSION['nombre'] = $usuario['nombre']; // si querés mostrar el nombre luego
header("Location: inicio.php");
exit;

if ($resultado->num_rows === 1) { //Condicón que se haya encontrado una y solo una fila que coincide con el email ingresado
    $fila = $resultado->fetch_assoc();
    $claveGuardada = $fila['clave'];

    if (password_verify($claveIngresada, $claveGuardada)) { //Verifica que la clave ingresada y la que existe en la base de datops sean iguales 
        header("Location: inicio.php"); //Dirige a la página de inicio
        exit;
    } else {
        // Contraseña incorrecta
        header("Location: index.php?error=invalido");
        exit;
    }
} else {
    // Usuario no encontrado
    header("Location: index.php?error=invalido");
    exit;
}

$stmt->close();
$conexion->close();
?>