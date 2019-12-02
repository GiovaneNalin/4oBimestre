<?php
	include("conexao.php");
	include("verificacao.php");
	
	$descricao = $_POST["descricao"];
	
	$insercao = "INSERT INTO funcoes VALUES ('NULL', '$descricao')";
			
	// mysql_error($conexao)
	
	mysqli_query($conexao,$insercao)
		or die("0");
		
	echo 1;
?>