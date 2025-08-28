<<<<<<< HEAD
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro - Softwares Saturno</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Crear cuenta</h1>
    <p>Registrate para formar parte de la cooperativa</p>

    <?php
      if (isset($_GET['error']) && $_GET['error'] == 'existe') {
          echo '<p style="color: red;"> El nombre o correo ya está registrado.</p>';
          header("Location: index.html");
      }
    ?>

    <form action="registro.php" method="POST">
      <input type="text" name="nombre" placeholder="Nombre completo" required />
      <input type="email" name="email" placeholder="Correo electrónico" required />
      <input type="password" name="clave" placeholder="Crear contraseña" required />
      <button type="submit">Registrarse</button>
    </form>

    <div class="register-link">
      ¿Ya tenés cuenta? <a href="index.php">Volver a iniciar sesión</a>
    </div>
  </div>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro - Softwares Saturno</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Crear cuenta</h1>
    <p>Registrate para formar parte de la cooperativa</p>

    <?php
      if (isset($_GET['error']) && $_GET['error'] == 'existe') {
          echo '<p style="color: red;"> El nombre o correo ya está registrado.</p>';
          header("Location: index.html");
      }
    ?>

    <form action="registro.php" method="POST">
      <input type="text" name="nombre" placeholder="Nombre completo" required />
      <input type="email" name="email" placeholder="Correo electrónico" required />
      <input type="password" name="clave" placeholder="Crear contraseña" required />
      <button type="submit">Registrarse</button>
    </form>

    <div class="register-link">
      ¿Ya tenés cuenta? <a href="index.php">Volver a iniciar sesión</a>
    </div>
  </div>
</body>
</html>
>>>>>>> 26e67ee8c406f0e825dbff20562a44f9544a7778
