<?php
    require_once 'Database.php';
    $connection = Database::getConnection();

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        $nombre = $input['nombre'];
        $apellido = $input['apellido'];
        $ci = $input['ci'];
        $email = $input['email'];
        $telefono = $input['telefono'];
        $password = password_hash($input['password'], PASSWORD_DEFAULT); // Hashea la contraseña
        break;
    }
?>