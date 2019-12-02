<?php
	
	include("conexao.php");
	
	$id = $_POST["id"];
	$endereco = $_POST["endereco"];
	$estado = $_POST["estado"];
	$telefone = $_POST["telefone"];
	$cidade = $_POST["cidade"];
	$nome = $_POST["nome"];
	
	$alteracao = "UPDATE filial SET 
				endereco = '$endereco',
				estado = '$estado',
				telefone = '$telefone',
				cidade = '$cidade',
				nome = '$nome'
				WHERE id_filial = '$id'";

	mysqli_query($conexao,$alteracao)
		or die(mysqli_error($conexao));
	
	echo "1";
	
?>