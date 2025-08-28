<<<<<<< HEAD
<?php
$conexion = new mysqli("localhost", "root", "", "cooperativa");
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Por ahora usamos ID fijo, más adelante: $_SESSION['id']
session_start();
$id_socio = $_SESSION['id'];

$sql = "SELECT bloque, calle, numero, observaciones
        FROM unidades_habitacionales
        WHERE id_socio = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_socio);
$stmt->execute();
$resultado = $stmt->get_result();

$unidad = $resultado->fetch_assoc();

$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Unidad Habitacional</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .info-box {
      background: #f9f9f9;
      border: 1px solid #ccc;
      padding: 1rem;
      border-radius: 10px;
      margin-top: 2rem;
    }
    .info-box h2 {
      color: #004080;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Unidad Habitacional</h1>

    <?php if ($unidad): ?>
      <div class="info-box">
        <h2>Ubicación</h2>
        <p><strong>Bloque:</strong> <?= $unidad['bloque'] ?></p>
        <p><strong>Calle:</strong> <?= $unidad['calle'] ?></p>
        <p><strong>Número:</strong> <?= $unidad['numero'] ?></p>
        <p><strong>Observaciones:</strong> <?= $unidad['observaciones'] ?></p>
      </div>
    <?php else: ?>
      <p style="color:red;">❌ No se encontró una unidad asignada.</p>
    <?php endif; ?>

    <br>
    <a href="inicio.php">⬅ Volver al inicio</a>
  </div>
</body>
</html>
=======
<?php
$conexion = new mysqli("localhost", "root", "", "cooperativa");
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Por ahora usamos ID fijo, más adelante: $_SESSION['id']
session_start();
$id_socio = $_SESSION['id'];

$sql = "SELECT bloque, calle, numero, observaciones
        FROM unidades_habitacionales
        WHERE id_socio = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_socio);
$stmt->execute();
$resultado = $stmt->get_result();

$unidad = $resultado->fetch_assoc();

$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Unidad Habitacional</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .info-box {
      background: #f9f9f9;
      border: 1px solid #ccc;
      padding: 1rem;
      border-radius: 10px;
      margin-top: 2rem;
    }
    .info-box h2 {
      color: #004080;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Unidad Habitacional</h1>

    <?php if ($unidad): ?>
      <div class="info-box">
        <h2>Ubicación</h2>
        <p><strong>Bloque:</strong> <?= $unidad['bloque'] ?></p>
        <p><strong>Calle:</strong> <?= $unidad['calle'] ?></p>
        <p><strong>Número:</strong> <?= $unidad['numero'] ?></p>
        <p><strong>Observaciones:</strong> <?= $unidad['observaciones'] ?></p>
      </div>
    <?php else: ?>
      <p style="color:red;">❌ No se encontró una unidad asignada.</p>
    <?php endif; ?>

    <br>
    <a href="inicio.php">⬅ Volver al inicio</a>
  </div>
</body>
</html>
>>>>>>> 26e67ee8c406f0e825dbff20562a44f9544a7778
