
<?php
session_start();

include_once("models/Usuario.php");
$oUser =new Usuario();
$oUser->setNumControl( $_SESSION["usuario"] );
$oUser->buscar();
?>

<?php include "header.php" ?>

<main>
  <h1>Perfil</h1>

  <section>

    <img class="foto-perfil" src="<?php echo $oUser->getImagen()?>">

    <div class="info-user">
      <p>No. Control: <strong><?php echo $oUser->getNumControl() ?></strong></p>
      <p>Nombre: <strong><?php echo $oUser->getNombreCompleto() ?></strong></p>
      <p>Correo: <strong><?php echo $oUser->getCorreo() ?></strong></p>
    </div>

  </section>

  <section class="op-user">
    <button class="btn-form" onclick="window.location.href = 'logout.php'">Cerrar sesion</button>
  </section>

</main>

<?php include "footer.php" ?>