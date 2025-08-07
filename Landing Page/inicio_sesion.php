<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperativa - Inicio de sesión</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        body{
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
     
        main{
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <header>
        <a href="index.php"><img src="../img/Logo Cooperativa (3).svg" alt="Logo COVIBUCEO"></a>
        <ul>
            <li><a href="index.php">Registrarse</a></li>
        </ul>
    </header>
    <main>
    <form action="../php/login.php" method="POST">
        <h3 class="center">Ingreso a mi cuenta</h3>
        <div>
            <label for="email">Email</label>
            <input name="email" type="text" required>
        </div>
        <div>
            <label for="password">Contraseña</label>
            <div id="password">
                <input type="password" name="password" required>
                <button class="toggle-password" type="button" onclick="cambioContraseña()">v</button> <!-- Se agrega "type=button" para que no se envíe el formulario al hacer click en el botón -->
            </div>
        </div>
            <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'invalido') {
                        echo '<p style="color: red;">Correo o contraseña incorrectos.</p>';
                    } elseif ($_GET['error'] == 'vacio') {
                        echo '<p style="color: red;">Debés completar todos los campos.</p>';
                    }
                }

                if (isset($_GET['registro']) && $_GET['registro'] == 'exito') {
                    echo '<p style="color: green;"> Registro exitoso. Ahora podés iniciar sesión.</p>';
                }   
            ?>
        <div>
            <button class="button-100" type="submit">Iniciar sesión</button>
        </div>
        <div class="right">
            <a href="../php/recuperar_clave.php">¿Olvidaste tu contraseña?</a>
        </div>
    </form>
    </main>
    <footer>
        <p>E-mail: covibuceo@gmail.com.uy</p>
        <p>Teléfono: 099 923 655</p>
        <p>Dirección: Gral. Rivera 4000</p>
    </footer>
</body>

</html>