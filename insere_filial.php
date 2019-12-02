<?php
	include("conexao.php");
	include("verificacao.php");
	
	$endereco = $_POST["endereco"];
	$estado = $_POST["estado"];
	$telefone = $_POST["telefone"];
	$cidade = $_POST["cidade"];
	$nome = $_POST["nome"];
	
	$insercao = "INSERT INTO filial VALUES ('NULL', 
	'$endereco',
	'$estado',
	'$telefone',
	'$cidade',
	'$nome')";

	// mysql_error($conexao)
	
	mysqli_query($conexao,$insercao)
		or die("0" . mysqli_error($conexao));
		
	echo "1";
?>