<?php
session_start();

include_once("models/Estadisticas.php");
include_once("models/Usuario.php");
include_once("models/Libro.php");
$oEstads = new Estadisticas();

try {
  $arrEventos = $oEstads->partiEvento();
  $arrMsgs = $oEstads->msgLibro();
  $arrLectores = $oEstads->usuariosLeyendoPorLibro();

  $oUser = new Usuario();
  $arrUser = $oUser->obtenerTodos();

  $oLibro = new Libro();
  $arrLibros = $oLibro->buscarTodos();

} catch (\Throwable $th) {
  error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
  $sErr = "Error en base de datos, comunicarse con el administrador";
}

?>

<?php include "header.php" ?>

<main>
  <h1>Estadísticas</h1>

  <section class="adminAvances">
    <h2>Buscar avances por usuario</h2>
    <form action="mis-avances.php" method="POST">
      <select name="user">
        <option value="">-- Selecciona un usuario --</option>
        <?php
        foreach ($arrUser as $usuario) {
          $numControl = $usuario->getNumControl();
          $nombreCompleto = $usuario->getNombreCompleto();
          echo "<option value=" . $numControl . ">" . $numControl . " - " . $nombreCompleto . "</option>";
        }
        ?>
      </select>

      <select name="libro">
        <option value="">-- Selecciona un Libro --</option>
        <?php
        foreach ($arrLibros as $libro) {
          $idLibro = $libro->getIdLibro();
          $nombreCompleto = $libro->getNombre();
          echo "<option value=" . $idLibro . ">" . $nombreCompleto . "</option>";
        }
        ?>
      </select>
      <button class="btn-form">Ver avances</button>
    </form>
  </section>

  <br>
  <hr>

  <section>
    <h2>Lectores por Libro</h2>
    <table class="estads" border="1" cellpadding="5" cellspacing="0">
      <thead>
        <tr>
          <th>Libro</th>
          <th>Total de Usuarios</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($arrLectores as $libro): ?>
          <tr>
            <td><?= htmlspecialchars($libro[0]) ?></td>
            <td><?= $libro[1] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
  <br>
  <hr>
  <section>
    <h2>Participación por Evento</h2>
    <table class="estads" border="1" cellpadding="5" cellspacing="0">
      <thead>
        <tr>
          <th>Evento</th>
          <th>Total de Participantes</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($arrEventos as $evento): ?>
          <tr>
            <td><?= htmlspecialchars($evento[0]) ?></td>
            <td><?= $evento[1] ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </section>
  <br>
  <hr>
  <section>
    <h2>Mensajes por Libro</h2>
    <table class="estads" border="1" cellpadding="5" cellspacing="0">
      <thead>
        <tr>
          <th>Libro</th>
          <th>Total de Mensajes</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($arrMsgs as $mensaje): ?>
          <tr>
            <td><?= htmlspecialchars($mensaje[0]) ?></td>
            <td><?= $mensaje[1] ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </section>


</main>

<?php $redi = "estadisticas.php"; ?>
<?php include "footer.php" ?>