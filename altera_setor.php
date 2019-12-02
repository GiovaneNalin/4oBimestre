<?php
	
	include("conexao.php");
	
	$id = $_POST["id"];
	$descricao = $_POST["descricao"];
	
	$alteracao = "UPDATE setor SET 
				descricao = '$descricao',
				WHERE id_setor = '$id'";

	mysqli_query($conexao,$alteracao)
		or die(mysqli_error($conexao));
	
	echo "1";
	
?>