<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $conexion = new mysqli("localhost", "root", "", "cooperativa");
  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

  // Reemplazar con $_SESSION['id'] si ya usás sesiones
  $id_socio = 1;
  $tipo = $_POST['tipo'];
  $fecha = $_POST['fecha'];
  $monto = $_POST['monto'];
  $descripcion = $_POST['descripcion'];

  $sql = "INSERT INTO comprobantes (id_socio, tipo, fecha, monto, descripcion)
          VALUES (?, ?, ?, ?, ?)";
  $stmt = $conexion->prepare($sql);
  $stmt->bind_param("issds", $id_socio, $tipo, $fecha, $monto, $descripcion);

  if ($stmt->execute()) {
    echo "<p style='color:green;'>✅ Comprobante registrado correctamente.</p>";
  } else {
    echo "<p style='color:red;'>❌ Error al registrar el comprobante: " . $stmt->error . "</p>";
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
  <title>Registrar Comprobante</title>
  <link rel="stylesheet" href="style.css">
  <style>
    label { font-weight: 600; display: block; margin-top: 1rem; }
    input, select, textarea { width: 100%; padding: 0.5rem; border-radius: 8px; border: 1px solid #ccc; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Registrar Comprobante</h1>
    <form method="POST" action="registrar_comprobante.php">
      <label for="tipo">Tipo de comprobante:</label>
      <select name="tipo" required>
        <option value="">Seleccionar</option>
        <option value="Aporte Inicial">Aporte Inicial</option>
        <option value="Cuota Mensual">Cuota Mensual</option>
        <option value="Otro">Otro</option>
      </select>

      <label for="fecha">Fecha:</label>
      <input type="date" name="fecha" required>

      <label for="monto">Monto:</label>
      <input type="number" name="monto" step="0.01" required>

      <label for="descripcion">Descripción (opcional):</label>
      <textarea name="descripcion" rows="3"></textarea>

      <br><br>
      <button type="submit">Guardar comprobante</button>
    </form>

    <br>
    <a href="inicio.php">⬅ Volver al inicio</a>
  </div>
</body>
</html>
