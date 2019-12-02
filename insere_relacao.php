<?php
	include("conexao.php");
	include("verificacao.php");
	
	$cod_setor = $_POST["cod_setor"];
	$cod_filial = $_POST["cod_filial"];
	
	$insercao =
		"INSERT INTO relacao VALUES ('NULL', '$cod_setor','$cod_filial')";
			
	// mysql_error($conexao)
	
	mysqli_query($conexao,$insercao)
		or die("0" . mysqli_error($conexao));
		
	echo 1;
?>