<?php
session_start();
include_once("models/Libro.php");
include_once("models/Usuario.php");
include_once("models/Avance.php");
$oLibro = new Libro();
$oAvance = new Avance();
$oUser = new Usuario();
$arrAvances;
$visual = false;

try {
  if (isset($_GET["id_libro"]) && !empty($_GET["id_libro"])) {
    $oLibro->setIdLibro($_GET["id_libro"]);

    $idUser = $_SESSION["usuario"];

    $id = $oLibro->getIdLibro();
    $oLibro->buscar();

    $oAvance->setIdLibro($id);
    $oAvance->setNumControl($idUser);
    $arrAvances = $oAvance->buscarTodos();

  }

  if ($_SESSION["tipo"] == 1) {
    if (isset($_POST["user"]) && !empty($_POST["user"]) && isset($_POST["libro"]) && !empty($_POST["libro"])) {
      $idUser = $_POST["user"];
      $oLibro->setIdLibro($_POST["libro"]);
      $id = $oLibro->getIdLibro();
      $oLibro->buscar();

      $oAvance->setIdLibro($id);
      $oAvance->setNumControl($idUser);
      $arrAvances = $oAvance->buscarTodos();

      $oUser->setNumControl($idUser);
      $oUser->buscar();

      $visual = true;
    } else {
      $sMsg = "Seleccione un usuario y un libro";
      header("Location: estadisticas.php?msg=" . $sMsg);
    }
  }

} catch (\Throwable $th) {
  error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
  $sErr = "Error en base de datos, comunicarse con el administrador";
}
?>
<?php include_once("header.php"); ?>

<div class="container-foro">


  <div class="foro">

    <div class="mensajes" id="mensajes">

      <form class="formAvance" action="avance.php" method="POST">
        <input name="id_libro" value="<?php echo $id ?>" type="hidden">
        <input name="txtOpe" type="hidden">
        <input name="txtClave" type="hidden">

        <?php if ($arrAvances != null) {
          foreach ($arrAvances as $oAva) {
            ?>

            <div class="mensaje">
              <div class="contenido">
                <div class="nombre"><?php echo $oAva->getFecha() ?></div>
                <div class="texto">
                  <p><strong>Paginas leidas: </strong><?php echo $oAva->getPaginasLeidas() ?> - <strong>Paginas totales:
                    </strong><?php echo $oAva->getPaginasTotales() ?></p>
                  <p><?php echo $oAva->getComentario() ?></p>
                </div>
              </div>
              <?php if ($_SESSION["tipo"] == 2) { ?>
                <div class="acciones">
                  <button
                    onclick="txtOpe.value='editar'; txtClave.value='<?php echo $oAva->getIdAvance() ?>'  ">Editar</button>
                  <button type="button"
                    onclick="popup('Seguro que quieres eliminar este avance' , '<?php echo $oAva->getFecha() ?>', '<?php echo $oAva->getPaginasLeidas() ?>', '<?php echo $oAva->getPaginasTotales() ?>', '<?php echo $oAva->getComentario() ?>' , 'crudAvance.php' , '<?php echo $oAva->getIdAvance() ?>', 'eliminar', 'null', 'Eliminar', '<?php echo $oAva->getIdLibro() ?>');">Borrar</button>
                </div>
              <?php } ?>
            </div>

            <?php
          }//foreach
        }
        ?>

      </form>
    </div>

  </div>

  <div class="sidebar">

    <?php if ($visual) { ?>

      <div>
        <img class="perfil-foro" src="<?php echo $oUser->getImagen() ?>">
      </div>
      <strong><?php echo $oUser->getNombreCompleto() ?></strong>
      <hr>
    <?php } ?>
    <div class="portada-foro">
      <img class="img-foro" src="<?php echo $oLibro->getPortada() ?>" alt="Portada del libro">
    </div>
    <strong><?php echo $oLibro->getNombre() ?></strong>
    <strong><?php echo $oLibro->getAutor() ?></strong>
    <p>
      <?php echo $oLibro->getDescripcion() ?>
    </p>
  </div>
</div>

<?php $redi = "mis-avances.php?id_libro=" . $id ?>
<?php include_once("footer.php"); ?>