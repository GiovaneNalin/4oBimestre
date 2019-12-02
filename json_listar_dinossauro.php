<?php
	header("Content-Type: Application/json");
	
	$p = $_POST["p"];
	
	include('conexao.php');
	
	$sql='SELECT id_dinossauro, filo, reino, dominio, ordem, clado, familia, genero, especie, nome, periodo, cod_relacao 
		FROM dinossauro 
		INNER JOIN relacao ON dinossauro.cod_relacao = relacao.id_relacao';
	
	if(isset($_POST["nome_filtro"])){
		$nome = $_POST["nome_filtro"];
		$sql .= " WHERE nome LIKE '%$nome%'";
	}
	
	$sql .= " LIMIT $p,5";
	
	$resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
				
	while($linha = mysqli_fetch_assoc($resultado)){
		$matriz[] = $linha;
	}
	
	echo json_encode($matriz);
?>