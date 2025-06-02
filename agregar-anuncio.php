
<?php
session_start();
include_once("models/Evento.php");
$oEvento = new Evento();
$bEditar = false;
$sErr = "";
$sOpe = "insertar";
$id = -1;
try {

  if (isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"]) && isset($_POST["txtClave"]) && !empty($_POST["txtClave"])) {
    if ($_POST["txtOpe"] == 'editar') {
      $oEvento->setIdEvento($_POST["txtClave"]);
      $id = $oEvento->getIdEvento();
      $oEvento->buscar();
      $bEditar = true;
      $sOpe = $_POST["txtOpe"];
    }
  }

} catch (\Throwable $th) {
  error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
  $sErr = "Error en base de datos, comunicarse con el administrador";
}

?>
<?php include "header.php" ?>

<main>

  <?php
  if ($bEditar) {
    echo "<h1>Editar Evento</h1>";
  } else {
    echo "<h1>Agregar Evento</h1>";
  }
  ?>

  <section class="formulario">

    <p>Agregue la informacion que se solicita</p>

    <form action="crudEvento.php" method="POST" enctype="multipart/form-data">

      <input name="txtOpe" value="<?php echo $sOpe ?>" type="hidden">
      <input name="txtClave" value="<?php echo $id ?>" type="hidden">

      <label for="titulo">Titulo del anuncio: </label>
      <input type="text" name="titulo" id="titulo" value="<?php echo $oEvento->getNombre() ?>" required>

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion" rows="3"><?php echo $oEvento->getDescripcion() ?></textarea>

      <label>Fecha: </label>
      <input type="date" name="fecha" value="<?php echo $oEvento->getFecha() ?>" required>

      <label>Hora: </label>
      <input type="time" name="hora" value="<?php echo $oEvento->getHorario() ?>" required>

      <label for="lugar">Lugar: </label>
      <input type="text" name="lugar" value="<?php echo $oEvento->getLugar() ?>" required>

      <?php if (!$bEditar) { ?>
        <label>Imagen del anuncio:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" required>
      <?php } ?>

      <br>

      <?php
      if ($bEditar) {
        echo '<button class="btn-form" type="submit" id="agregarBtn">Editar Anuncio</button>';
      } else {
        echo '<button class="btn-form" type="submit" id="agregarBtn">Agregar Anuncio</button>';
      }
      ?>

    </form>
    <button class="btn-form" onclick="window.location.href='anuncios.php'">Cancelar</button>

  </section>

</main>

<?php include "footer.php" ?>