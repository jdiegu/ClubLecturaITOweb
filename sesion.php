<?php

include_once("models\Usuario.php");
session_start();
$sNcontrol = "";
$sPwd = "";
$sMsg = "";

$oUsu = new Usuario();
if (
  isset($_POST["nControl"]) && !empty($_POST["nControl"]) &&
  isset($_POST["contrasena"]) && !empty($_POST["contrasena"])
) {
  $sNcontrol = $_POST["nControl"];
  $sPwd = $_POST["contrasena"];
  $oUsu->setNumControl($sNcontrol);
  $oUsu->setContrasena($sPwd);
  try {
    if ($oUsu->buscarCvePwd()) {
      $_SESSION["usuario"] = $oUsu->getNumControl();
      $_SESSION["tipo"] = $oUsu->getTipo();
      $sMsg = "¡Bienvenido!";
      header("Location: index.php?msg=" . $sMsg);
    } else {
      $sMsg = "Usuario desconocido";
      header("Location: login.php?msg=" . $sMsg);
    }
  } catch (Exception $e) {
    error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
    $sMsg = "Error al acceder a la base de datos";
    header("Location: login.php?msg=" . $sMsg);
  }
} else {
  $sMsg = "Faltan datos";
  header("Location: login.php?msg=" . $sMsg);
}

?>