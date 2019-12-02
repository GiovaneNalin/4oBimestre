<?php
	
	include("conexao.php");
	
	$id = $_POST["id"];
	$filo = $_POST["filo"];
	$reino = $_POST["reino"];
	$dominio = $_POST["dominio"];
	$ordem = $_POST["ordem"];
	$clado = $_POST["clado"];
	$familia = $_POST["familia"];
	$genero = $_POST["genero"];
	$especie = $_POST["especie"];
	$nome = $_POST["nome"];
	$periodo = $_POST["periodo"];
	$cod_relacao = $_POST["cod_relacao"];
	
	
	$alteracao = "UPDATE dinossauro SET 
				filo = '$filo',
				reino = '$reino',
				dominio = '$dominio',
				ordem = '$ordem',
				clado = '$clado',
				familia = '$familia',
				genero = '$genero',
				especie = '$especie',
				nome = '$nome',
				periodo = '$periodo',
				cod_relacao = '$cod_relacao'				
				WHERE id_dinossauro = '$id'";

	mysqli_query($conexao,$alteracao)
		or die(mysqli_error($conexao));
	
	echo "1";
	
?>