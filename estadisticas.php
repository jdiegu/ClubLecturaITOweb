<?php
session_start();

include_once("models/Estadisticas.php");
$oEstads = new Estadisticas();

try {
  $arrEventos = $oEstads->partiEvento();
  $arrMsgs = $oEstads->msgLibro();
} catch (\Throwable $th) {
  error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
  $sErr = "Error en base de datos, comunicarse con el administrador";
}

?>

<?php include "header.php" ?>

<main>
  <h1>Estadísticas</h1>

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
            <td><?= htmlspecialchars($evento[0]) ?></td> <!-- Nombre del evento -->
            <td><?= $evento[1] ?></td> <!-- Total de participantes -->
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </section>

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
            <td><?= htmlspecialchars($mensaje[0]) ?></td> <!-- Nombre del libro -->
            <td><?= $mensaje[1] ?></td> <!-- Total de mensajes -->
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </section>


</main>

<?php $redi = "estadisticas.php"; ?>
<?php include "footer.php" ?>