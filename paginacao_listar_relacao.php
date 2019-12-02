<?php 
	include("conexao.php");
	
	$sql = "SELECT COUNT(*) as quantidade_relacao FROM relacao";
	
	if(!empty($_POST)){
		$nome = $_POST["nome_filtro"];
		$sql.= " WHERE cod_filial LIKE '%$nome%'";
	}
	
	$resultado = mysqli_query($conexao, $sql) or die ("Erro." . mysqli_query($conexao));
	
	$linha = mysqli_fetch_assoc($resultado);
	
	$quantidade_relacao = $linha["quantidade_relacao"];
	
	$quantidade_pagina = (int) ($quantidade_relacao / 5);
	
	if($quantidade_relacao%5!=0){
		$quantidade_pagina++;
	}
	
	for($i=1;$i<=$quantidade_pagina;$i++){
		echo " <button type = 'button' class='pg' value = '$i'>$i</button> ";
	}
?>