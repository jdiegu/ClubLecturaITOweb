<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Club" />
    <meta name="keywords" content="Clud de lectura del TECNM" />
    <title>Club de lectura - ITO</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="shortcut icon" href="media/logo1.png" />
</head>

<body>

    <header class="header">
        <h1>Club de lectura ITO</h1>
    </header>

    <main class="loginMain">
        <section class="loginSection">
            <div class="form login">
                <header class="hLogin">Iniciar Sesion</header>
                <form action="sesion.php" method="POST">
                    <input name="nControl" type="text" placeholder="Numero de control" required />
                    <input name="contrasena" type="password" placeholder="Contraseña" required />
                    <button type="submit" class="btn-form">Iniciar sesi&oacute;n</button>
                    <button class="btn-form" onclick="window.location.href='index.php'" type="button">Cancelar</button>
                </form>
            </div>
        </section>
    </main>

    <script src="js/popup.js"></script>

    <?php
    $redi = "login.php";
    if (isset($_REQUEST["msg"])) {
        $sMsg = $_REQUEST["msg"] ?? "";
        echo '<script>popupMsg("' . $sMsg . '","' . $redi . '")</script>';
    }
    ?>

</body>

</html>