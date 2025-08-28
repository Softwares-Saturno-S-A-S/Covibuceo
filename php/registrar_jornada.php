<<<<<<< HEAD
<?php
// Guardado de jornada (cuando se envía el formulario)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $conexion = new mysqli("localhost", "root", "", "cooperativa");
  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

  $id_socio = $_POST['id_socio'];
  $fecha = $_POST['fecha'];
  $horas = $_POST['horas'];
  $descripcion = $_POST['descripcion'];
  $motivo = $_POST['motivo'];

  $sql = "INSERT INTO jornadas (id_socio, fecha, horas_cumplidas, descripcion, motivo)
          VALUES (?, ?, ?, ?, ?)";
  $stmt = $conexion->prepare($sql);
  $stmt->bind_param("isiss", $id_socio, $fecha, $horas, $descripcion, $motivo);

  if ($stmt->execute()) {
    echo "<p style='color:green;'>✅ Jornada registrada correctamente.</p>";
  } else {
    echo "<p style='color:red;'>❌ Error al registrar la jornada: " . $stmt->error . "</p>";
  }

  $stmt->close();
  $conexion->close();
}
?>

<!-- Formulario HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Jornada Laboral</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Registrar Jornada Laboral</h1>
    <form action="registrar_jornada.php" method="POST">
      <input type="hidden" name="id_socio" value="1" /> <!-- Por ahora, socio fijo -->

      <label>Fecha:</label>
      <input type="date" name="fecha" required />

      <label>Horas cumplidas:</label>
      <input type="number" name="horas" min="1" required />

      <label>Descripción:</label>
      <textarea name="descripcion" required></textarea>

      <label>Motivo (opcional):</label>
      <textarea name="motivo"></textarea>

      <button type="submit">Registrar Jornada</button>
    </form>
    <br />
    <a href="inicio.php">⬅ Volver al inicio</a>
  </div>
</body>
</html>
=======
<?php
// Guardado de jornada (cuando se envía el formulario)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $conexion = new mysqli("localhost", "root", "", "cooperativa");
  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

  $id_socio = $_POST['id_socio'];
  $fecha = $_POST['fecha'];
  $horas = $_POST['horas'];
  $descripcion = $_POST['descripcion'];
  $motivo = $_POST['motivo'];

  $sql = "INSERT INTO jornadas (id_socio, fecha, horas_cumplidas, descripcion, motivo)
          VALUES (?, ?, ?, ?, ?)";
  $stmt = $conexion->prepare($sql);
  $stmt->bind_param("isiss", $id_socio, $fecha, $horas, $descripcion, $motivo);

  if ($stmt->execute()) {
    echo "<p style='color:green;'>✅ Jornada registrada correctamente.</p>";
  } else {
    echo "<p style='color:red;'>❌ Error al registrar la jornada: " . $stmt->error . "</p>";
  }

  $stmt->close();
  $conexion->close();
}
?>

<!-- Formulario HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Jornada Laboral</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Registrar Jornada Laboral</h1>
    <form action="registrar_jornada.php" method="POST">
      <input type="hidden" name="id_socio" value="1" /> <!-- Por ahora, socio fijo -->

      <label>Fecha:</label>
      <input type="date" name="fecha" required />

      <label>Horas cumplidas:</label>
      <input type="number" name="horas" min="1" required />

      <label>Descripción:</label>
      <textarea name="descripcion" required></textarea>

      <label>Motivo (opcional):</label>
      <textarea name="motivo"></textarea>

      <button type="submit">Registrar Jornada</button>
    </form>
    <br />
    <a href="inicio.php">⬅ Volver al inicio</a>
  </div>
</body>
</html>
>>>>>>> 26e67ee8c406f0e825dbff20562a44f9544a7778
