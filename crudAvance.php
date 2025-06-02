<?php
session_start();
$id = $_SESSION["usuario"];
include_once("models/Avance.php");

if (
  isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
  isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
) {
  $sOpe = $_POST["txtOpe"];
  $sCve = $_POST["txtClave"];
  $idLibro= $_POST["idLibro"];

  $oAvance = new Avance();

  $nResultado = -1;
  $sMsg = null;

  try {
    if ($sOpe == 'editar') {

      $nPLeidas = $_POST["paginas_leidas"];
      $nPTotales = $_POST["paginas_totales"];
      $sComentario = $_POST["comentario"];

      $oAvance->setIdAvance($sCve);
      $oAvance->buscar();

      $oAvance->setPaginasLeidas($nPLeidas);
      $oAvance->setPaginasTotales($nPTotales);
      $oAvance->setComentario($sComentario);


      $nResultado = $oAvance->modificar();
      $sMsg = "Se edito el avance con exito";
      echo $sMsg;
      header("Location: mis-avances.php?id_libro=" . $idLibro . "&msg=" . $sMsg);

    }
    if ($sOpe == 'insertar') {
      echo "entre";
      $nPLeidas = $_POST["paginas_leidas"];
      $nPTotales = $_POST["paginas_totales"];
      $sComentario = $_POST["comentario"];

      $oAvance->setNumControl($id);
      $oAvance->setIdLibro($sCve);
      $oAvance->setPaginasLeidas($nPLeidas);
      $oAvance->setPaginasTotales($nPTotales);
      $oAvance->setComentario($sComentario);

      $nResultado = $oAvance->insertar();
      $sMsg = "Se ingreso el avance con exito ";
      echo $sMsg;
      header("Location: mis-avances.php?id_libro=" . $idLibro . "&msg=" . $sMsg);

    }
    if ($sOpe == 'eliminar') {

      $oAvance->setIdAvance($sCve);
      $nResultado = $oAvance->eliminar();
      $sMsg = "Se elimino el avance con exito";
      echo $sMsg;

      header("Location: mis-avances.php?id_libro=" . $idLibro . "&msg=" . $sMsg);
    }
    if ($nResultado != 1) {
      $sMsg = "Error en bd";
      echo $sMsg;
    }
  } catch (Exception $e) {
    error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
    $sMsg = "Error en base de datos, comunicarse con el administrador";
    echo $sMsg;
  }
} else {
  $sMsg = "Faltan datos";
  if (!isset($_POST["txtOpe"]) or empty($_POST["txtOpe"])) {
    $sMsg = $sMsg . " operacion ";
  }
  if (!isset($_POST["txtClave"]) or empty($_POST["txtClave"])) {
    $sMsg = $sMsg . " clave ";
  }
}


?>