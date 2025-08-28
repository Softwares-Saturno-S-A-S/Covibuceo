<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVIBUCEO</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .classic {
            width: 40vw;
            max-width: 1000px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['email'])) {
        $email = htmlspecialchars($_GET['email']);
        echo "<div class='classic'>";
        echo "<h2>Solicitud enviada</h2>";
        echo "<p class='p-left spaced'>Le informamos que su solicitud para asociarse a <b>COVIBUCEO</b> fue enviada con éxito. Usted recibirá un correo electrónico a: <a href='mailto:$email' class='link'>$email</a> cuando gestionemos el estado de su solicitud.</p>";
        echo "<p class='p-left spaced'>En caso de ser asociado a la cooperativa le enviaremos los datos para realizar su aporte inicial, y la cuota mensual de su vivienda más los gastos comunes.</p>"; 
        echo "<button class='button-longsize light-green'>Aceptar</button>";
        echo '</div>';
    } else {
        echo "<p>Error: Ningún correo elctrónico proporcionado.</p>";
    }
?>
</body>

</html>