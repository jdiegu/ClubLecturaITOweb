<footer>
  <p>&copy; Derechos reservados</p>
</footer>


<script src="js/popup.js"></script>

<?php
if (isset($_REQUEST["msg"])) {
  $sMsg = $_REQUEST["msg"] ?? "";
  echo '<script>popupMsg("' . $sMsg . '","'. $redi  .'")</script>';
}
?>
</body>

</html>