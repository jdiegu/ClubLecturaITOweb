
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
    }else{
      $sOpe = $_POST["txtOpe"];
      $id = $_POST["txtClave"];
    }
    $idLibro= $_POST["id_libro"];
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
      <input type="number" name="paginas_leidas" id="paginas_leidas" value="<?php echo $oAvance->getPaginasLeidas() ?>" required>

      <label for="paginas_totales">Paginas Totales:</label>
      <input type="number" name="paginas_totales" id="paginas_totales" value="<?php echo $oAvance->getPaginasTotales() ?>" required>

      <label for="comentario">Comentario:</label>
      <textarea id="comentario" name="comentario" rows="3"><?php echo $oAvance->getComentario() ?></textarea>
      <br>

      <?php
      if ($bEditar) {
        echo '<button class="btn-form" type="submit" id="agregarBtn">Editar Avance</button>';
      } else {
        echo '<button class="btn-form" type="submit" id="agregarBtn">Agregar Avance</button>';
      }
      ?>

    </form>
    <button class="btn-form" onclick="window.location.href='mis-libros.php'">Cancelar</button>

  </section>

</main>

<?php include "footer.php" ?>