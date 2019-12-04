<?php
	
	include("conexao.php");
	
	$id = $_POST["id"];
	$id_funcionario = $_POST["id_funcionario"];
	$cod_funcao = $_POST["cod_funcao"];
	$nome = $_POST["nome"];
	$cod_filial = $_POST["cod_filial"];
	
	$alteracao = "UPDATE funcionario SET 
				id_funcionario = '$id_funcionario',
				cod_funcao = '$cod_funcao',
				nome = '$nome',
				cod_filial = '$cod_filial'
				WHERE id_funcionario = '$id'";

	mysqli_query($conexao,$alteracao)
		or die(mysqli_error($conexao));
	
	echo "1";
	
?>