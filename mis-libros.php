<?php

session_start();
$id = $_SESSION["usuario"];
include_once("models/Libro.php");

$oLibro = new Libro();

try {
  $arrLibros = $oLibro->misLibros($id);
} catch (\Throwable $th) {
  error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
  $sErr = "Error en base de datos, comunicarse con el administrador";
}

?>

<?php include "header.php" ?>

<main>
  <h1>Mis Libros</h1>

  <ul class="galeria">
    <?php if ($arrLibros != null) {
      foreach ($arrLibros as $oLib) {
        ?>
        <li id="<?php echo $oLib->getIdLibro() ?>">
          <a>
            <center>
              <div class="portada">
                <img src="<?php echo $oLib->getPortada() ?>">
              </div>
            </center>
            <div>
              <h3><?php echo $oLib->getNombre() ?></h3>
            </div>

            <div class="info">
              <p>
                <?php echo $oLib->getDescripcion() ?>
              </p>
              <form action="foro.php" method="GET" name="form">
                <input name="id_libro" value="<?php echo $oLib->getIdLibro() ?>" type="hidden">
                <input name="txtOpe" type="hidden">
                <input name="txtClave" type="hidden" value="<?php echo $oLib->getIdLibro() ?>">

                <button onclick="form.method = 'POST';form.action='avance.php'; txtOpe.value='insertar' ">Registrar Avance</button>
                <button onclick="form.action='mis-avances.php'">Ver Avances</button>
                <button>Foro</button>
              </form>
            </div>
          </a>
        </li>

        <?php
      }//foreach
    }
    ?>

  </ul>


</main>
<?php $redi = "mis-avances.php" ?>
<?php include "footer.php" ?>