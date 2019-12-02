<?php
	include("conexao.php");
	include("verificacao.php");
	
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
	$relacao = $_POST["cod_relacao"];
	
	$insercao = "INSERT INTO dinossauro (filo, reino, dominio, ordem, clado, familia, genero, especie, nome, periodo, cod_relacao)
						VALUES ('$filo',
								'$reino',
								'$dominio',
								'$ordem',
								'$clado',
								'$familia',
								'$genero',
								'$especie',
								'$nome',
								'$periodo',
								'$relacao'
								)";
						
	//mysqli_error($conexao)
	mysqli_query($conexao,$insercao)
		or die("0" . mysqli_error($conexao));
		
	echo "1";
?>