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

<body class="bodyIndex">

  <header class="header">
    <h1>Club de lectura ITO</h1>
  </header>

  <section class="layout">
    <main class="main">
      <div>
        <h1>Bienvenido al club de lectura </h1>
        <p>📖 Descubre el placer de leer en compañía.</p>

        <p>Únete a una comunidad apasionada por los libros, donde cada página abre la puerta a nuevas ideas,
          conversaciones significativas y amistades duraderas.</p>
        <p>Cada mes exploramos una nueva obra y compartimos nuestras impresiones en un espacio lleno de respeto y
          entusiasmo por la lectura. </p>

        <!-- #Opciones -->
        <div>
          <h3>¡No importa si eres un lector ávido o si estás comenzando tu viaje literario, todos son bienvenidos!</h3>
          <p>"Leer es soñar con los ojos abiertos." — Anónimo</p>
          <ul class="btn-index">
            <?php
            session_start();
            if (isset($_SESSION["usuario"])) { ?>
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
            <?php } else { ?>

              <li><a href="login.php">Iniciar Sesion</a></li>
              <li><a href="registrar.php">Registrarse</a></li>

            <?php } ?>
          </ul>

          <ul class="btn-index">
            <li>
              <a href="video.php">Video tutorial</a>
            </li>
          </ul>

          <!-- Calendario -->
          <h2>Calendario de actividades</h2>
          <p>Calendario de actividades por mes del club de lectura</p>

          <?php
          include_once("models/Evento.php");

          $oEven = new Evento();
          $arrFecha = $oEven->buscarTodos();

          echo "<script>
          const datosFechas =" . json_encode(array_map(function ($f) {
            return ['fecha' => $f->getFecha(), 'mensaje' => $f->getNombre(), 'id' => $f->getIdEvento()];
          }, $arrFecha)) . "; </script>";
          echo '<script src="js/calendario.js"></script>';
          echo "<script>const fechas = eventos(datosFechas);</script>";
          ?>

          <section id="calendario">
            <section id="head">
              <button>&leftarrow;</button>
              <div><label>Mes</label>&nbsp;-&nbsp;<label>Año</label></div>
              <button>&rightarrow;</button>
            </section>
            <section id="month">
              <table>
                <tbody id="cambio">
                  <tr id="dias">
                    <th>
                      <p>Domingo</p>
                    </th>
                    <th>
                      <p>Lunes</p>
                    </th>
                    <th>
                      <p>Martes</p>
                    </th>
                    <th>
                      <p>Miercoles</p>
                    </th>
                    <th>
                      <p>Jueves</p>
                    </th>
                    <th>
                      <p>Viernes</p>
                    </th>
                    <th>
                      <p>Sabado</p>
                    </th>
                  </tr>
                  <tr id="semana-1">
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                  </tr>
                  <tr id="semana-2">
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                  </tr>
                  <tr id="semana-3">
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                  </tr>
                  <tr id="semana-4">
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                  </tr>
                  <tr id="semana-5">
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                  </tr>
                  <tr id="semana-6">
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                    <td>
                      <div></div>
                      <div></div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </section>
          </section>

        </div>
    </main>
  </section>

  <script src="js/index.js"></script>
  <script src="js/script.js"></script>
  <?php $redi = "index.php"; ?>
  <?php include_once("footer.php") ?>