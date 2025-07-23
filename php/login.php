<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "cooperativa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$emailIngresado = $_POST['email'];
$claveIngresada = $_POST['password'];

// Buscar usuario por email
$sql = "SELECT Password_hash FROM PEROSNA WHERE Email = ?"; //El signo de interogación sirve para indicar que se va a utilizar un parámetro en la consulta
$stmt = $conexion->prepare($sql); //La base de datos prepara la consulta sql
$stmt->bind_param("s", $emailIngresado); //Se ingresan el o los paramentros necesarios, en este caso un solo string, represnetado por la letra "s"
$stmt->execute();
$resultado = $stmt->get_result();

session_start();
$_SESSION['id'] = $usuario['id']; // o lo que corresponda
$_SESSION['nombre'] = $usuario['nombre']; // si querés mostrar el nombre luego
header("Location: inicio.php");
exit;

if ($resultado->num_rows === 1) { //Condicón que se haya encontrado una y solo una fila que coincide con el email ingresado
    $fila = $resultado->fetch_assoc(); //Convierte la fila en un array asociativo, es decir con una clave "string". Creo qu epuede ser omitido
    $claveGuardada = $fila['Password_hash'];

    if (password_verify($claveIngresada, $claveGuardada)) { //Verifica que la clave ingresada y la que existe en la base de datos sean iguales 
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