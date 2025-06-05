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
    <nav>
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="biblioteca.php">Biblioteca</a></li>
        <li><a href="anuncios.php">Anuncios</a></li>
        <?php
        if ($_SESSION["tipo"] == 2) {
          echo '<li><a href="mis-libros.php">Mis libros</a></li>';
        }
        ?>

        <?php
        if ($_SESSION["tipo"] == 1) {
          echo '<li><a href="estadisticas.php">Estadisticas</a></li>';
        }
        ?>
        <li><a href="perfil.php">Perfil</a></li>
      </ul>
    </nav>
  </header>