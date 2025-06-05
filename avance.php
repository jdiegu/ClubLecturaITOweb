<?php
session_start();
include_once("models/Avance.php");
$oAvance = new Avance();
$bEditar = false;
$sErr = "";
$sOpe = "insertar";
$id = -1;

try {

  if (isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"]) && isset($_POST["txtClave"]) && !empty($_POST["txtClave"])) {
    if ($_POST["txtOpe"] == 'editar') {
      $oAvance->setIdAvance($_POST["txtClave"]);
      $id = $oAvance->getIdAvance();
      $oAvance->buscar();
      $sOpe = $_POST["txtOpe"];
      $bEditar = true;
    } else {
      $sOpe = $_POST["txtOpe"];
      $id = $_POST["txtClave"];
      $oAvance->setIdLibro($id);
      $oAvance->setNumControl($_SESSION["usuario"]);
      $oAvance->buscarAvanceMasReciente();
      $oAvance->setComentario("");

    }
    $idLibro = $_POST["id_libro"];
  }

} catch (\Throwable $th) {
  error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
  $sErr = "Error en base de datos, comunicarse con el administrador";
  echo $sErr;
}

?>

<?php include "header.php" ?>

<main>

  <?php
  if ($bEditar) {
    echo "<h1>Editar Avance</h1>";
  } else {
    echo "<h1>Agregar Avance</h1>";
  }
  ?>

  <section class="formulario">

    <p>Agregue la informacion que se solicita</p>

    <form action="crudAvance.php" method="POST">

      <input name="txtOpe" value="<?php echo $sOpe ?>" type="hidden">
      <input name="txtClave" value="<?php echo $id ?>" type="hidden">
      <input name="idLibro" value="<?php echo $idLibro ?>" type="hidden">

      <label for="paginas_leidas">Paginas Leidas: </label>
      <input type="number" name="paginas_leidas" id="paginas_leidas" value="<?php echo $oAvance->getPaginasLeidas() ?>"
        required>

      <label for="paginas_totales">Paginas Totales:</label>
      <input type="number" name="paginas_totales" id="paginas_totales"
        value="<?php echo $oAvance->getPaginasTotales() ?>" required>

      <label for="comentario">Comentario:</label>
      <textarea id="comentario" name="comentario" rows="3" required><?php echo $oAvance->getComentario() ?></textarea>
      <div id="mensaje"></div>
      <br>

      <?php
      if ($bEditar) {
        echo '<button class="btn-form" type="submit" onclick="return validarAvance();" id="agregarBtn">Editar Avance</button>';

      } else {
        echo '<button class="btn-form" type="submit" onclick="return validarAvance();" id="agregarBtn">Agregar Avance</button>';

      }
      ?>

    </form>
    <?php if ($bEditar) { ?>
      <button class="btn-form" onclick="window.location.href='mis-avances.php?id_libro=<?php echo $idLibro ?>'">Cancelar</button>
    <?php } else { ?>
      <button class="btn-form" onclick="window.location.href='mis-libros.php'">Cancelar</button>
    <?php } ?>
  </section>

</main>
<script src="js/validador.js"></script>

<?php include "footer.php" ?>