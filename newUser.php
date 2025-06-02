<?php

include_once("models/Usuario.php");


$oUsuario = new Usuario();
$sCoreoIns = "";
$sNumControl = "";
$sNombre = "";
$sAPpaterno = "";
$sAPmaterno = "";
$sContrasena = "";
$sConfirmar = "";
$sMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sCoreoIns = $_POST["txtCorreo"];
    $sNumControl = $_POST["intControl"];
    $sNombre = $_POST["txtNombre"];
    $sAPpaterno = $_POST["txtPaterno"];
    $sAPmaterno = $_POST["txtMaterno"];
    $sContrasena = $_POST["txtContrasena"];
    $sConfirmar = $_POST["txtConfirmar"];

    $img = $_FILES["imagen"];

    if ($sContrasena === $sConfirmar) {
        $oUsuario->setCorreo($sCoreoIns);
        $oUsuario->setNumControl($sNumControl);
        $oUsuario->setNombre($sNombre);
        $oUsuario->setApPaterno($sAPpaterno);
        $oUsuario->setApMaterno($sAPmaterno);
        $oUsuario->setContrasena($sContrasena);
        $oUsuario->setTipo(2); // tipo 2 = usuario normal

        $nombreImagen = preg_replace('/\s+/', '', $sNumControl);
        $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
        $imgNombre = "u". $nombreImagen . '.' . $extension;
        $imagen = 'uploads/' . $imgNombre;

        if (move_uploaded_file($img['tmp_name'], $imagen)){
            $oUsuario->setImagen($imagen);
        }

        try {
            if ($oUsuario->insertar()) {
                $sMsg = "Registro exitoso";
            } else {
                $sMsg = "Error en el proceso, comunícate con un administrador";
            }
        } catch (Exception $e) {
            error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
            $sMsg = "Error al acceder a la base de datos";
        }
    } else {
        $sMsg = "Las contraseñas no coinciden.";
    }
}

header("Location: index.php?msg=" . $sMsg);
?>