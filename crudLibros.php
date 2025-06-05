<?php
session_start();
$id = $_SESSION["usuario"];

include_once("models/Libro.php");
include_once("models/Avance.php");

if (
  isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
  isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
) {
  $sOpe = $_POST["txtOpe"];
  $sCve = $_POST["txtClave"];

  $oLibro = new Libro();
  $oAvance = new Avance();

  $nResultado = null;
  $sMsg = "";

  try {
    if ($sOpe == 'leer') {
      $oAvance->setNumControl($id);
      $oAvance->setIdLibro($sCve);
      $oAvance->setComentario("Comencé a leer este libro");
      $oAvance->setPaginasLeidas(0);
      $oAvance->setPaginasTotales(0);

      $nResultado = $oAvance->insertar();
      $sMsg = "Se inserto el avance con exito";
      echo $sMsg;
      header("Location: mis-libros.php?msg=" . $sMsg);
    }
    if ($sOpe == 'editar') {
      $sTitulo = $_POST["titulo"];
      $sAutor = $_POST["autor"];
      $sDescripcion = $_POST["descripcion"];
      $sGenero = $_POST["genero"];

      $oLibro->setIdLibro($sCve);
      $oLibro->buscar();
      $oLibro->setNombre($sTitulo);
      $oLibro->setAutor($sAutor);
      $oLibro->setDescripcion($sDescripcion);
      $oLibro->setGenero($sGenero);
      $nResultado = $oLibro->actualizar();
      $sMsg = "Se edito el libro con exito";
      echo $sMsg;
    }
    if ($sOpe == 'insertar') {
      $sTitulo = $_POST["titulo"];
      $sAutor = $_POST["autor"];
      $sDescripcion = $_POST["descripcion"];
      $sGenero = $_POST["genero"];

      $img = $_FILES["imagen"];

      $nombreImagen = preg_replace('/\s+/', '', $sTitulo);
      $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
      $imagen = $nombreImagen . '.' . $extension;
      $portada = 'uploads/' . $imagen;

      move_uploaded_file($img['tmp_name'], $portada);

      $oLibro->setNombre($sTitulo);
      $oLibro->setAutor($sAutor);
      $oLibro->setDescripcion($sDescripcion);
      $oLibro->setGenero($sGenero);
      $oLibro->setPortada($portada);
      $nResultado = $oLibro->insertar();
      $sMsg = "Se inserto el libro con exito";
      echo $sMsg;
    }
    if ($sOpe == 'eliminar') {

      $oLibro->setIdLibro($sCve);
      $nResultado = $oLibro->eliminar();
      $sMsg = "Se elimino el libro con exito";
      echo $sMsg;
    }

    if ($nResultado != 1) {
      $sMsg = "Error en bd";
    }
  } catch (Exception $e) {
    error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
    $sMsg = "Error en base de datos, comunicarse con el administrador";
  }
} else {
  $sMsg = "Faltan datos";
}
header("Location: biblioteca.php?msg=" . $sMsg);
?>