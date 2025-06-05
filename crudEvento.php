<?php
session_start();
include_once("models/Evento.php");
include_once("models/Participacion.php");

if (
  isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
  isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
) {
  $sOpe = $_POST["txtOpe"];
  $sCve = $_POST["txtClave"];

  $oEvento = new Evento();
  $oParti = new Participacion();

  $nResultado = null;
  $sMsg = null;

  try {
    if ($sOpe == 'asistir') {
      echo "hola";
      $oParti->setNumControl($_SESSION["usuario"]);
      $oParti->setIdEvento($sCve);

      $nResultado = $oParti->insertar();
      $sMsg = "Se inserto la participacion con exito";
      echo $sMsg;
    }
    if ($sOpe == 'inasistir') {
      echo "hola";
      $oParti->setIpParticipacion($sCve);

      $nResultado = $oParti->eliminar();
      $sMsg = "Se elimino la participacion con exito";
      echo $sMsg;
    }
    if ($sOpe == 'editar') {
      $sTitulo = $_POST["titulo"];
      $sDescripcion = $_POST["descripcion"];
      $sFecha = $_POST["fecha"];
      $sHora = $_POST["hora"];
      $sLugar = $_POST["lugar"];

      $oEvento->setIdEvento($sCve);
      $oEvento->buscar();
      $oEvento->setNombre($sTitulo);
      $oEvento->setDescripcion($sDescripcion);
      $oEvento->setFecha($sFecha);
      $oEvento->setHorario($sHora);
      $oEvento->setLugar($sLugar);


      $nResultado = $oEvento->modificar();
      $sMsg = "Se edito el evento con exito";
      echo $sMsg;

    }
    if ($sOpe == 'insertar') {
      $sTitulo = $_POST["titulo"];
      $sDescripcion = $_POST["descripcion"];
      $sFecha = $_POST["fecha"];
      $sHora = $_POST["hora"];
      $sLugar = $_POST["lugar"];

      $img = $_FILES["imagen"];

      $nombreImagen = preg_replace('/\s+/', '', $sTitulo);
      $nombreImagen = substr($nombreImagen, 0, 10);
      $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
      $imgNombre = $nombreImagen . '.' . $extension;
      $imagen = 'uploads/' . $imgNombre;

      move_uploaded_file($img['tmp_name'], $imagen);

      $oEvento->setIdEvento($sCve);
      $oEvento->buscar();
      $oEvento->setNombre($sTitulo);
      $oEvento->setDescripcion($sDescripcion);
      $oEvento->setFecha($sFecha);
      $oEvento->setHorario($sHora);
      $oEvento->setLugar($sLugar);
      $oEvento->setImagen($imagen);
      $nResultado = $oEvento->insertar();
      $sMsg = "Se inserto el evento con exito";
      echo $sMsg;

    }
    if ($sOpe == 'eliminar') {

      $oEvento->setIdEvento($sCve);
      $nResultado = $oEvento->eliminar();
      $sMsg = "Se elimino el evento con exito";
      echo $sMsg;

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

header("Location: anuncios.php?msg=" . $sMsg);

?>