<?php
session_start();
$id = $_SESSION["usuario"];
include_once("models/Mensaje.php");

if (
  isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
  isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
) {
  $sOpe = $_POST["txtOpe"];
  $sCve = $_POST["txtClave"];

  $oMensaje = new Mensaje();

  $nResultado = null;
  $sMsg = null;

  try {

    if ($sOpe == 'insertar') {

      $txtMsg = $_POST["mensaje"];

      $oMensaje->setIdLibro($sCve);
      $oMensaje->setNumControl($id);
      $oMensaje->setMensaje($txtMsg);

      $nResultado = $oMensaje->insertar();
      $sMsg = "Se edito el evento con exito";
      echo $sMsg;
      header("Location: foro.php?id_libro=" . $sCve);
    }
    if ($sOpe == 'eliminar') {
      $idMensaje = $_POST["idMensaje"];
      $oMensaje->setIdMensaje($idMensaje);
      $nResultado = $oMensaje->eliminar();
      $sMsg = "Se elimino el evento con exito";
      echo $sMsg;
      header("Location: foro.php?id_libro=" . $sCve);
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