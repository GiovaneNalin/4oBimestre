<?php
	include("conexao.php");
	include("verificacao.php");
	
	$descricao = $_POST["descricao"];
	
	$insercao = "INSERT INTO setor VALUES ('NULL', '$descricao')";
	
	mysqli_query($conexao,$insercao)
		or die("0" . mysqli_error($conexao));
		
	echo "1";
?>