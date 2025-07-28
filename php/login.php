<?php

//Esta API sirve para que el usurio inicie sesión a su cuenta, verifica si la combinación de los datos ingresados en el formulario de inicio sesión, email y contraseña, exiten en la tabla "PERSONA"
//En caso de existir la API redigirá al usuario al sistema interno de la cooperativa, con todas las funcionalidades que este puede realizar 

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "Cooperativa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$emailIngresado = $_POST['email'];
$claveIngresada = $_POST['password'];

// Buscar usuario por email
$sql = "SELECT Password_hash FROM PERSONA WHERE Email = ?"; //El signo de interogación sirve para indicar que se va a utilizar un parámetro en la consulta
$stmt = $conexion->prepare($sql); //La base de datos prepara la consulta sql
$stmt->bind_param("s", $emailIngresado); //Se ingresan el o los paramentros necesarios, en este caso un solo string, represnetado por la letra "s"
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) { //Condicón que se haya encontrado una y solo una fila que coincide con el email ingresado
    $fila = $resultado->fetch_assoc(); 
    $claveGuardada = $fila['Password_hash'];

    if (password_verify($claveIngresada, $claveGuardada)) { //Verifica que la clave ingresada y la que existe en la base de datos sean iguales
        $persona = $fila; //Si las claves coinciden se almacena l afila en una avriable persona para iniciar sesión
        
        session_start();
            $_SESSION['ID'] = $persona['ID']; //Ingresar el id en la sesión
            $_SESSION['Nombre'] = $persona['Nombre']; //Ingresar el nombre en la sesión (opcional)

        header("Location: inicio.php"); //Dirige a la página de inicio
        exit;
    } else {
        // Contraseña incorrecta
        header("Location: ../Landing Page/inicio_sesion.php?error=invalido");
        exit;
    }
} else {
    // Usuario no encontrado
    header("Location: ../Landing Page/inicio_sesion.php?error=invalido");
    exit;
}

$stmt->close();
$conexion->close();
?>