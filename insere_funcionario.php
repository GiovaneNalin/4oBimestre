<?php
	
	include("conexao.php");
	include("verificacao.php");
	
	$nome = $_POST["nome"];
	$id_funcionario = $_POST["id_funcionario"];
	$funcao = $_POST["cod_funcao"];
	$filial = $_POST["cod_filial"];
	
	$insercao =
		"INSERT INTO funcionario VALUES ('$id_funcionario', '$funcao', '$nome', '$filial')";
			
	// mysql_error($conexao)

	mysqli_query($conexao,$insercao)
		or die("0" . mysqli_error($conexao));
		
	echo "1";
?>