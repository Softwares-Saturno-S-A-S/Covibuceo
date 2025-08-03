<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVIBUCEO - Home Administración</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        button {
            margin-left: 25px;
        }
    </style>
</head>

<body>
    <header>
        <a href="index.html"><img src="../img/Logo Cooperativa (3).svg" alt="Logo COVIBUCEO"></a>
        <ul>
            <li><a href="index.html">Solicitudes</a></li>
            <li><a href="pagos.html">Pagos</a></li>
            <li><a href="jornadas.html">Jornadas Laborales</a></li>
            <li><a href="actividad.html">Actividad Usuarios</a></li>
        </ul>
    </header>
    <main>
        <?php

        // Conectar a la base de datos
        $conexion = new mysqli("localhost", "root", "", "Cooperativa");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $consulta = "SELECT * FROM SOLICITUD WHERE Estado = 'Pendiente' ORDER BY Fecha_Solicitud"; // Selecciona todas las solicitudes pendientes y las ordena por fecha de solicitud
        $resultado = $conexion->query($consulta); // Se establece una variable que guarda el resultado de la consulta

        echo "<section class='solicitudes-pendientes'>"; // Se crea una sección para las solicitudes pendiente

        if ($resultado->num_rows > 0) { // Verifica si hay resultados
            // Se ejecuta el siguiente código por cada fila que exista en el resultado de la consulta
            while ($tupla = $resultado->fetch_assoc()) { // Convierte cada fila del resultado en un array asociativo
                // Cambiar el formato de la fecha para la visualización
                $fecha_no_format = $tupla["Fecha_Solicitud"]; 
                $fecha = date("d/m/Y H:i", strtotime($fecha_no_format)); // La función "strototime()" convierte la cadena de fecha a un numero entero, el cual puede ser interpretado correctamente por la función "date()"
                // Se construye el HTML para cada tupla
                echo "<div class='solicitud'>";
                echo "<p class='p1'>" . $fecha . "</p>"; // Muestra la fecha de solicitud. htmlspecialchars se usa para codificar carácteres especiales que tienen una función específica en HTML, y transformarlos en texto. Evitando problemas de seguridad al mostrar datos.
                echo "<div class='sub-1'>";
                echo "<p>" . htmlspecialchars($tupla["Nombre"]) . " " . htmlspecialchars($tupla["Apellido"]) ." ha solicitado asociarse a la cooperativa</p>";
                echo "<form class='no-styles' action='../php/solicitud.php' method='POST'>"; // Se crea un formulario para aceptar o rechazar la solicitud
                echo "<button type='submit' name='aceptar' class='button-size-green'>Aceptar</button>"; // Botón para aceptar la solicitud
                echo "<button type='submit' name='rechazar' class='button-size-red'>Rechazar</button>"; // Botón para rechazar la solicitud
                echo "</form>";
                echo "</div>"; // Cierra el div de sub-1
                echo "</div>"; // Cierra el div de solicitud
            }
        } else {
            echo "<p>No hay solicitudes pendientes.</p>"; // Mensaje si no hay solicitudes pendientes
        }

        echo "</section>"; // Cierra la sección de solicitudes pendientes

        $conexion->close(); // Cierra la conexión a la base de datos
        ?>

    </main>
</body>

</html>