<?php 
	include("conexao.php");
	
	$sql = "SELECT COUNT(*) as quantidade_filial FROM filial";
	
	if(!empty($_POST)){
		$nome = $_POST["nome_filtro"];
		$sql.= " WHERE nome LIKE '%$nome%'";
	}
	
	$resultado = mysqli_query($conexao, $sql) or die ("Erro." . mysqli_query($conexao));
	
	$linha = mysqli_fetch_assoc($resultado);
	
	$quantidade_filial = $linha["quantidade_filial"];
	
	$quantidade_pagina = (int) ($quantidade_filial / 5);
	
	if($quantidade_filial%5!=0){
		$quantidade_pagina++;
	}
	
	for($i=1;$i<=$quantidade_pagina;$i++){
		echo " <button type = 'button' class='pg' value = '$i'>$i</button> ";
	}
?>