<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - Cooperativa de Viviendas</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1rem;
      margin-top: 2rem;
    }
    .menu button {
      background-color: var(--azul-medio);
      color: white;
      padding: 1rem;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .menu button:hover {
      background-color: var(--azul-oscuro);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>¡Bienvenido a la Cooperativa!</h1>
    <p>Seleccioná una opción para continuar</p>

    <div class="menu">
      <form action="registrar_comprobante.php" method="get">
        <button type="submit">Registrar Comprobante</button>
      </form>
      <form action="unidad_habitacional.php" method="get">
        <button type="submit">Ver Unidad Habitacional</button>
      </form>
      <form action="registrar_jornada.php" method="get">
        <button type="submit">Registrar Jornada Laboral</button>
      </form>
      <form action="ver_jornadas.php" method="get">
        <button type="submit">Ver Jornadas Realizadas</button>
      </form>
      <form action="ver_datos_socio.php" method="get">
        <button type="submit">Ver Datos del Socio</button>
      </form>
      <form action="avance_construccion.php" method="get">
        <button type="submit">Ver Avance de Construcción</button>
      </form>
      <form action="estado_comprobantes.php" method="get">
        <button type="submit">Estado de Comprobantes</button>
      </form>
      <form action="ubicacion_unidad.php" method="get">
        <button type="submit">Ubicación de la Unidad</button>
      </form>
    </div>
  </div>
</body>
</html>
