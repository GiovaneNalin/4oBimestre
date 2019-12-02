<?php
	session_start();
	if(!isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
		echo "você não esta autorizado a visualizar esta página.</br>";
		echo "faça <a href = 'form_login.php'>Login</a>";
		echo "</body><html>";
		die();
	}
?>