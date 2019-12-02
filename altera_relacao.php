<?php
	
	include("conexao.php");
	
	$id = $_POST["id"];
	$cod_setor = $_POST["cod_setor"];
	$cod_filial = $_POST["cod_filial"];
	
	$alteracao = "UPDATE relacao SET 
				cod_setor = '$cod_setor',
				cod_filial = '$cod_filial'
				WHERE id_relacao = '$id'";

	mysqli_query($conexao,$alteracao)
		or die(mysqli_error($conexao));
	
	echo "1";	
?>