<?php
    require_once '../models/Socio.php'; // Incluye el modelo Socio

    // Cabezales de configuración
    header("Access-Control-Allow-Origin: *"); // Permite el acceso desde cualquier origen

    $method = $_SERVER['REQUEST_METHOD']; // Obtiene el método de la solicitud HTTP

    switch ($method) { // Switch para los distintos métodos
    case 'POST': // Metodo POST para crear un nuevo socio
        $input = json_decode(file_get_contents('php://input'), true); // Decodifica el JSON recibido en un array asociativo

        $socio = new Socio(); // Crea un objeto Socio
        $resultado = $socio->crear($input); // Llama al método crear del objeto Socio, pasando como pararmetro la decodificación json

        http_response_code($resultado['status']); // Establece el código de respuesta HTTP, llamando al status corespondiente

    // Status   
    if (isset($resultado['error'])) { // Identifica si el status es de error o éxito
        echo json_encode(['error' => $resultado['error']]);
    } else {
        echo json_encode(['mensaje' => $resultado['mensaje']]);
    }
        $nombre = $input['nombre'];
        $apellido = $input['apellido'];
        $ci = $input['ci'];
        $email = $input['email'];
        $telefono = $input['telefono'];
        $password = password_hash($input['password'], PASSWORD_DEFAULT); // Hashea la contraseña

    
        break;
    }
?>