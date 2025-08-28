<<<<<<< HEAD
<?php
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new mysqli("localhost", "root", "", "cooperativa");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

   $email = trim($_POST['email']);
$nuevaClave = $_POST['nueva_clave'];

$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    // Usuario encontrado → actualizar contraseña
    $claveHasheada = password_hash($nuevaClave, PASSWORD_DEFAULT);
    $stmt = $conexion->prepare("UPDATE usuarios SET clave = ? WHERE email = ?");
    $stmt->bind_param("ss", $claveHasheada, $email);
    $stmt->execute();

    $mensaje = "✅ Contraseña actualizada correctamente. <a href='index.php'>Iniciar sesión</a>";
} else {
    $mensaje = "❌ El correo ingresado no está registrado.";
}


    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Recuperar Contraseña</h1>

    <?php if (!empty($mensaje)) echo "<p>$mensaje</p>"; ?>

    <form action="recuperar_clave.php" method="POST">
      <input type="email" name="email" placeholder="Tu correo electrónico" required />
      <input type="password" name="nueva_clave" placeholder="Nueva contraseña" required />
      <button type="submit">Cambiar contraseña</button>
    </form>

    <div class="register-link">
      <a href="index.php">⬅ Volver al inicio</a>
    </div>
  </div>
</body>
</html>
=======
<?php
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new mysqli("localhost", "root", "", "cooperativa");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

   $email = trim($_POST['email']);
$nuevaClave = $_POST['nueva_clave'];

$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    // Usuario encontrado → actualizar contraseña
    $claveHasheada = password_hash($nuevaClave, PASSWORD_DEFAULT);
    $stmt = $conexion->prepare("UPDATE usuarios SET clave = ? WHERE email = ?");
    $stmt->bind_param("ss", $claveHasheada, $email);
    $stmt->execute();

    $mensaje = "✅ Contraseña actualizada correctamente. <a href='index.php'>Iniciar sesión</a>";
} else {
    $mensaje = "❌ El correo ingresado no está registrado.";
}


    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Recuperar Contraseña</h1>

    <?php if (!empty($mensaje)) echo "<p>$mensaje</p>"; ?>

    <form action="recuperar_clave.php" method="POST">
      <input type="email" name="email" placeholder="Tu correo electrónico" required />
      <input type="password" name="nueva_clave" placeholder="Nueva contraseña" required />
      <button type="submit">Cambiar contraseña</button>
    </form>

    <div class="register-link">
      <a href="index.php">⬅ Volver al inicio</a>
    </div>
  </div>
</body>
</html>
>>>>>>> 26e67ee8c406f0e825dbff20562a44f9544a7778
