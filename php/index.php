<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Softwares Saturno</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Softwares Saturno</h1>
    <p>Gestión cooperativa clara, accesible y eficiente</p>

    <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == 'invalido') {
          echo '<p style="color: red;">Correo o contraseña incorrectos.</p>';
        } elseif ($_GET['error'] == 'vacio') {
          echo '<p style="color: red;">Debés completar todos los campos.</p>';
        }
      }
    ?>

    <?php
      if (isset($_GET['registro']) && $_GET['registro'] == 'exito') {
        echo '<p style="color: green;">✅ Registro exitoso. Ahora podés iniciar sesión.</p>';
     }
    ?>


    <form action="login.php" method="GET">
      <input type="email" name="email" placeholder="Correo electrónico" required />
      <input type="password" name="clave" placeholder="Contraseña" required />
      <button type="submit">Iniciar sesión</button>
    </form>

    <div class="register-link">
     <a href="recuperar_clave.php">¿Olvidaste tu contraseña?</a>
    </div>

    <div class="register-link">
      ¿No tenés cuenta? <a href="registro_form.php">Registrate aquí</a>
    </div>
  </div>
</body>
</html>
