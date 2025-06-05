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
            <div class="form signup">
                <h2 class="hLogin">Registrarse</h2>
                <form action="newUser.php" method="POST" enctype="multipart/form-data">
                    <label>Imagen de perfil:</label>
                    <input type="file" name="imagen" id="imagen" accept="image/*" required>
                    <label>Numero de Control:</label>
                    <input name="intControl" type="text" placeholder="Numero de control" required />
                    <label>Correo institucional:</label>
                    <input name="txtCorreo" type="text" placeholder="Correo institucional" required />
                    <label>Apellido paterno:</label>
                    <input name="txtPaterno" type="text" placeholder="Ap paterno" required />
                    <label>Apellido materno:</label>
                    <input name="txtMaterno" type="text" placeholder="Ap materno" required />
                    <label>Nombre:</label>
                    <input name="txtNombre" type="text" placeholder="Nombre" required />
                    <label>Contrase&ntilde;a:</label>
                    <input name="txtContrasena" type="password" placeholder="Contraseña" required />
                    <label>Confirmar Contrase&ntilde;a:</label>
                    <input name="txtConfirmar" type="password" placeholder="Confirmar contraseña" required />
                    <div id="mensaje"> </div>
                    <br>
                    <button class="btn-form" type="submit" onclick="return validaPsw();">Registrarse</button>
                    <button class="btn-form" onclick="window.location.href='index.php'" type="button">Cancelar</button>
                </form>
            </div>
        </section>
    </main>

    <script src="js/validador.js"></script>

    <?php
    if (isset($_REQUEST["msg"])) {
        $sMsg = $_REQUEST["msg"] ?? "";
        echo '<script>popupMsg("' . $sMsg . '" , "newUser.php")</script>';
    }
    ?>

    <?php include_once("footer.php") ?>