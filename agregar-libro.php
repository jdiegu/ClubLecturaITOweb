<?php
session_start();
include_once("models/Libro.php");
$oLibro = new Libro();
$bEditar = false;
$sErr = "";
try {

  if (isset($_POST["opera"]) && !empty($_POST["opera"]) && isset($_POST["id_libro"]) && !empty($_POST["id_libro"])) {
    $sOpe = $_POST["opera"];
    $id = $_POST["id_libro"];
    if ($_POST["opera"] == 'editar') {
      $oLibro->setIdLibro($_POST["id_libro"]);
      $id = $oLibro->getIdLibro();
      $oLibro->buscar();
      $bEditar = true;
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
    echo "<h1>Editar Libro</h1>";
  } else {
    echo "<h1>Agregar Libros</h1>";
  }
  ?>


  <section class="formulario">
    <p>Agregue la informacion que se solicita</p>

    <form action="crudLibros.php" method="POST" enctype="multipart/form-data">

      <input name="txtOpe" value="<?php echo $sOpe ?>" type="hidden">
      <input name="txtClave" value="<?php echo $id ?>" type="hidden">

      <label for="titulo">Titulo del libro: </label>
      <input type="text" name="titulo" id="titulo" value="<?php echo $oLibro->getNombre() ?>" required>

      <label for="autor">Autor:</label>
      <input type="text" name="autor" value="<?php echo $oLibro->getAutor() ?>" required>

      <label for="descripcion">Descripci&oacute;n:</label>
      <textarea id="descripcion" name="descripcion" rows="3"><?php echo $oLibro->getDescripcion() ?></textarea>

      <label for="genero">Genero:</label>
      <input type="text" name="genero" value="<?php echo $oLibro->getGenero() ?>" required>

      <?php if (!$bEditar) { ?>
        <label>Portada del libro:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" required>
      <?php } ?>

      <br>

      <?php
      if ($bEditar) {
        echo '<button class="btn-form" type="submit" id="agregarBtn">Editar libro</button>';
      } else {
        echo '<button class="btn-form" type="submit" id="agregarBtn">Agregar libro</button>';
      }
      ?>

    </form>
    <button class="btn-form" onclick="window.location.href='biblioteca.php'">Cancelar</button>

  </section>

</main>

<!--<script src="js/previsual-img.js"></script>-->
<?php include "footer.php" ?>