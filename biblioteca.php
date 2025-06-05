<?php
session_start();
$nTipoUser = $_SESSION["tipo"];

include_once("models/Libro.php");
include_once("models/Avance.php");

$oLibro = new Libro();
$oAvance = new Avance();

try {
  $arrLibros = $oLibro->buscarTodos();

} catch (\Throwable $th) {
  error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
  $sErr = "Error en base de datos, comunicarse con el administrador";
}



?>

<?php include "header.php" ?>

<main>

  <h1>Biblioteca</h1>

  <form action="agregar-libro.php" method="POST" name="formLibros">
    <input name="opera" type="hidden">
    <input name="id_libro" type="hidden">

    <?php if ($nTipoUser == 1) { ?>
      <center>
        <button class="btn-agregar" onclick="id_libro.value=-1 ; opera.value = 'insertar'">Agregar nuevo libro</button>
      </center>
    <?php } ?>

    <ul class="galeria">
      <?php if ($arrLibros != null) {
        foreach ($arrLibros as $oLib) {
          ?>
          <li>
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
                <p><?php echo $oLib->getDescripcion() ?></p>
                <div>
                  <?php if ($nTipoUser == 1) { ?>
                    <button
                      onclick="id_libro.value =<?php echo $oLib->getIdLibro() ?>; opera.value ='editar' ">Editar</button>
                    <button type="button"
                      onclick="popup('¿Seguro que quieres eliminar este libro?' , '<?php echo $oLib->getNombre() ?>', '<?php echo $oLib->getAutor() ?>', '<?php echo $oLib->getDescripcion() ?>', '<?php echo $oLib->getGenero() ?>' , 'crudLibros.php' , '<?php echo $oLib->getIdLibro() ?>', 'eliminar', 'null', 'Eliminar', 'null');">Eliminar</button>
                  <?php } else { ?>

                    <?php
                    $oAvance->setNumControl($_SESSION["usuario"]);
                    $oAvance->setIdLibro($oLib->getIdLibro());
                    if (!$oAvance->buscarAvanceMasReciente()) {
                      ?>

                      <button type="button"
                        onclick="popup('Empezar a leer este libro' , '<?php echo $oLib->getNombre() ?>','<?php echo $oLib->getAutor() ?>', '<?php echo $oLib->getGenero() ?>', '<?php echo $oLib->getDescripcion() ?>' , 'crudLibros.php' , '<?php echo $oLib->getIdLibro() ?>', 'leer', 'null', 'Aceptar', 'Cancelar');">Leer</button>
                    <?php } else { ?>
                      <button type="button" onclick="window.location.href='mis-libros.php#<?php echo $oLib->getIdLibro() ?>'">Mis libros</button>
                    <?php } ?>


                  <?php } ?>
                  <button
                    onclick="formLibros.method='GET' ;formLibros.action='foro.php'; id_libro.value='<?php echo $oLib->getIdLibro() ?>'">Foro</button>

                </div>
              </div>
            </a>
          </li>

          <?php
        }//foreach
      }
      ?>

    </ul>

</main>

<?php $redi = "biblioteca.php"; ?>
<?php include "footer.php" ?>