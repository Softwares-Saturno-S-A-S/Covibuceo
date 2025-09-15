<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVIBUCEO - Home Administración</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="icon" href="../img/Logo Cooperativa (3).svg">
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
        <section>
            <h2>Bienvenido al Panel de Administración</h2>
            <h3>Solicitudes Pendientes</h3>
                <div id="solicitudes-pendientes">
                    
                </div>
        </section>
            
        <?php

        // Conectar a la base de datos
        $conexion = new mysqli("localhost", "root", "", "Cooperativa");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $consulta = "SELECT * FROM SOLICITUD WHERE Estado_Solicitud = 'Pendiente' ORDER BY Fecha_Solicitud"; // Selecciona todas las solicitudes pendientes y las ordena por fecha de solicitud
        $resultado = $conexion->query($consulta); // Se establece una variable que guarda el resultado de la consulta

        echo "<section class='solicitudes-pendientes'>"; // Se crea una sección para las solicitudes pendientes
        echo "<h3>Solicitudes Pendientes</h3>"; // Título para la sección de solicitudes pendientes

        if ($resultado->num_rows > 0) { // Verifica si hay resultados
            // Se ejecuta el siguiente código por cada fila que exista en el resultado de la consulta
            while ($tupla = $resultado->fetch_assoc()) { // Convierte cada fila del resultado en un array asociativo
                // Cambiar el formato de la fecha para la visualización
                $fecha_no_format = $tupla["Fecha_Solicitud"]; 
                $fecha = date("d/m/Y H:i", strtotime($fecha_no_format)); // La función "strototime()" convierte la cadena de fecha a un numero entero, el cual puede ser interpretado correctamente por la función "date()"
                // Se construye el HTML para cada tupla
                echo "<div class='solicitud'>";
                echo "<div>";
                echo "<p class='p1'>" . $fecha . "</p>"; // Muestra la fecha de solicitud. htmlspecialchars se usa para codificar carácteres especiales que tienen una función específica en HTML, y transformarlos en texto. Evitando problemas de seguridad al mostrar datos.
                echo "<p>" . htmlspecialchars($tupla["Nombre"]) . " " . htmlspecialchars($tupla["Apellido"]) ." ha solicitado asociarse a la cooperativa</p>";
                echo "</div>";
                echo "<div class='botones'>"; // Se crea un div para las acciones de aceptar o rechazar la solicitud
                echo "<form class='no-styles' action='../php/solicitud.php' method='POST'>"; // Se crea un formulario para aceptar o rechazar la solicitud
                echo "<input type='hidden' name='solicitud' value='aprobada'>"; // Un input de tipo hidden, no se ve, pero tiene un valor asignado, el cual se va a extraer de este formulario en el archivo "solicitud.php"
                echo "<input type='hidden' name='ID' value='" . htmlspecialchars($tupla['ID_Solicitud']) . "'>"; // Guarda el ID de la solicitud
                echo "<button type='submit' class='button-size green'>Aceptar</button>"; // Botón para aceptar la solicitud
                echo "</form>";
                echo "<form class='no-styles' action='../php/solicitud.php' method='POST'";
                echo "<input type='hidden' name='solicitud' value='rechazada'>"; // Un input de tipo hidden, no se ve, pero tiene un valor asignado, el cual se va a extraer de este formulario en el archivo "solicitud.php"
                echo "<input type='hidden' name='ID' value='" . htmlspecialchars($tupla['ID_Solicitud']) . "'>"; // Guarda el ID de la solicitud
                echo "<button type='submit' class='button-size red'>Rechazar</button>"; // Botón para rechazar la solicitud
                echo "</form>";
                echo "</div>";
                echo "</div>"; // Cierra el div de solicitud
            }
        } else {
            echo "<p>No hay solicitudes pendientes</p>"; // Mensaje si no hay solicitudes pendientes
        }

        echo "</section>"; // Cierra la sección de solicitudes pendientes

        $consulta_aprobada = "SELECT * FROM SOLICITUD WHERE Estado_Solicitud = 'Aprobada' ORDER BY Fecha_Solicitud"; // Selecciona todas las solicitudes aprobadas y las ordena por fecha de solicitud
        $resultado_aprobada = $conexion->query($consulta_aprobada); // Se establece una variable que guarda el resultado de la consulta

        echo "<section class='solicitudes-pendientes'>"; // Se crea una sección para las solicitudes aprobadas
        echo "<h3>Solicitudes Aprobadas</h3>"; // Título para la sección de solicitudes aprobadas

        if ($resultado_aprobada->num_rows > 0) { // Verifica si hay resultados
            // Se ejecuta el siguiente código por cada fila que exista en el resultado de la consulta
            while ($tupla = $resultado_aprobada->fetch_assoc()) { // Convierte cada fila del resultado en un array asociativo
                // Cambiar el formato de la fecha para la visualización
                $fecha_no_format = $tupla["Fecha_Solicitud"]; 
                $fecha = date("d/m/Y H:i", strtotime($fecha_no_format)); // La función "strototime()" convierte la cadena de fecha a un numero entero, el cual puede ser interpretado correctamente por la función "date()"
                // Se construye el HTML para cada tupla
                echo "<div class='solicitud'>";
                echo "<div>";
                echo "<p class='p1'>" . $fecha . "</p>"; // Muestra la fecha de solicitud. htmlspecialchars se usa para codificar carácteres especiales que tienen una función específica en HTML, y transformarlos en texto. Evitando problemas de seguridad al mostrar datos.
                echo "<p>" . htmlspecialchars($tupla["Nombre"]) . " " . htmlspecialchars($tupla["Apellido"]) ." fue aceptado/a</p>";
                echo "</div>";
                echo "</div>"; // Cierra el div de solicitud
            }
        } else {
            echo "<p>Todavía no hay solicitude aceptadas</p>"; // Mensaje si no hay solicitudes pendientes
        }

        echo "</section>"; // Cierra la sección de solicitudes aprobadas

        $consulta_rechazada = "SELECT * FROM SOLICITUD WHERE Estado_Solicitud = 'Rechazada' ORDER BY Fecha_Solicitud"; // Selecciona todas las solicitudes rechazadas y las ordena por fecha de solicitud
        $resultado_rechazada = $conexion->query($consulta_rechazada); // Se establece una variable que guarda el resultado de la consulta
        
        echo "<section class='solicitudes-pendientes'>"; // Se crea una sección para las solicitudes rechazadas
        echo "<h3>Solicitudes Rechazadas</h3>"; // Título para la sección de solicitudes rechazadas

        if ($resultado_rechazada->num_rows > 0) { // Verifica si hay resultados
            // Se ejecuta el siguiente código por cada fila que exista en el resultado de la consulta
            while ($tupla = $resultado_rechazada->fetch_assoc()) { // Convierte cada fila del resultado en un array asociativo
                // Cambiar el formato de la fecha para la visualización
                $fecha_no_format = $tupla["Fecha_Solicitud"]; 
                $fecha = date("d/m/Y H:i", strtotime($fecha_no_format)); // La función "strototime()" convierte la cadena de fecha a un numero entero, el cual puede ser interpretado correctamente por la función "date()"
                // Se construye el HTML para cada tupla
                echo "<div class='solicitud'>";
                echo "<div>";
                echo "<p class='p1'>" . $fecha . "</p>"; // Muestra la fecha de solicitud. htmlspecialchars se usa para codificar carácteres especiales que tienen una función específica en HTML, y transformarlos en texto. Evitando problemas de seguridad al mostrar datos.
                echo "<p>" . htmlspecialchars($tupla["Nombre"]) . " " . htmlspecialchars($tupla["Apellido"]) ." fue rechazado/a</p>";
                echo "</div>";
                echo "</div>"; // Cierra el div de solicitud
            }
        } else {
            echo "<p>Todavía no hay solicitudes rechazadas</p>"; // Mensaje si no hay solicitudes pendientes
        }

        $conexion->close(); // Cierra la conexión a la base de datos
        ?>

    </main>
</body>

</html>