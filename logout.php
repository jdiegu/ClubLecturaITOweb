<?php

session_start();
	if (isset($_SESSION["usuario"])){
		session_destroy();
	}
	else
		$sMsg = "Falta establecer el login";

	if ($sMsg == "")
		header("Location: index.php");
	else
		header("Location: index.php?msg=".$sMsg);
	exit();
?>