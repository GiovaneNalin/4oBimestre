<?php
	
	header ("Content-Type: Application/json");
	
	include("conexao.php");
	
	$id = $_POST["id"];
	
	$sql = "SELECT * FROM setor WHERE id_setor = '$id'";
	
	$resultado = mysqli_query($conexao,$sql) or die ("Erro." . mysqli_query($conexao));
	
	$linha = mysqli_fetch_assoc($resultado);
	
	echo json_encode($linha);
	
?>