<?php
session_start();

if (!isset($_SESSION["usuario"])) {
  header("Location: index.php?msg=Debes iniciar sesion antes");
}

include_once("models/Evento.php");
include_once("models/Participacion.php");

$oEven = new Evento();
$oParti = new Participacion();

try {
  $arrEvens = $oEven->buscarTodos();
} catch (\Throwable $th) {
  error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
  $sErr = "Error en base de datos, comunicarse con el administrador";
}

$nTipoUser = $_SESSION["tipo"];
?>

<?php include "header.php" ?>

<main>
  <h1>Anuncios</h1>

  <form action="agregar-anuncio.php" method="POST">
    <input name="txtOpe" type="hidden">
    <input name="txtClave" type="hidden">

    <?php if ($nTipoUser == 1) { ?>
      <center>
        <button class="btn-agregar" onclick="txtOpe.value='insertar'; txtClave.value=-1">Agregar nuevo anuncio</button>
      </center>
    <?php } ?>


    <section class="coleccion">
      <?php if ($arrEvens != null) {
        foreach ($arrEvens as $oEvento) {
          ?>

          <article class="item" id="<?php echo $oEvento->getIdEvento() ?>">
            <img class="img-item" src="<?php echo $oEvento->getImagen() ?>">
            <div class="info-item">
              <h3><?php echo $oEvento->getNombre() ?></h3>
              <p><strong>Descripci&oacute;n: </strong><?php echo $oEvento->getDescripcion() ?></p>
              <p><strong>Lugar: </strong><?php echo $oEvento->getLugar() ?></p>
              <p><strong>Hora: </strong><?php echo $oEvento->getHorario() ?></p>
              <p><strong>Fecha: </strong><?php echo $oEvento->getFecha() ?></p>
            </div>

            <ul class="botones-item">
              <?php if ($nTipoUser == 1) { ?>
                <li>
                  <button
                    onclick="txtClave.value =<?php echo $oEvento->getIdEvento() ?>; txtOpe.value ='editar' ">Editar</button>
                </li>
                <li>
                  <button type="button"
                    onclick="popup('¿Seguro que quieres eliminar este anuncio?' , '<?php echo $oEvento->getNombre() ?>', '<?php echo $oEvento->getDescripcion() ?>', '<?php echo $oEvento->getFecha() ?>', '<?php echo $oEvento->getHorario() ?>' , 'crudEvento.php' , '<?php echo $oEvento->getIdEvento() ?>', 'eliminar', 'null', 'Eliminar', 'null');">Eliminar</button>
                </li>
              <?php } else { ?>
                <li>
                  <?php
                  $oParti->setIdEvento($oEvento->getIdEvento());
                  $oParti->setNumControl($_SESSION["usuario"]);
                  if (!$oParti->buscar()) { ?>
                    <button type="button"
                      onclick="popup('Participar en este evento' , '<?php echo $oEvento->getNombre() ?>', '<?php echo $oEvento->getDescripcion() ?>', '<?php echo $oEvento->getLugar() ?>', '<?php echo $oEvento->getFecha() ?>' , 'crudEvento.php' , '<?php echo $oEvento->getIdEvento() ?>', 'asistir', 'null', 'Aceptar', 'Cancelar');">Asistencia</button>
                  <?php } else { ?>
                    <button type="button"
                      onclick="popup('Cancelar participar en este evento' , '<?php echo $oEvento->getNombre() ?>', '<?php echo $oEvento->getDescripcion() ?>', '<?php echo $oEvento->getLugar() ?>', '<?php echo $oEvento->getFecha() ?>' , 'crudEvento.php' , '<?php echo $oParti->getIdParticipacion() ?>', 'inasistir', 'null', 'Aceptar', 'Cancelar');">Cancelar
                      Asistencia</button>
                  <?php } ?>
                </li>
              <?php } ?>
            </ul>
          </article>

          <?php
        }//foreach
      }
      ?>
    </section>
  </form>
</main>

<?php $redi = "anuncios.php"; ?>

<?php include "footer.php" ?>