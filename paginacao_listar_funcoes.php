<?php 
	include("conexao.php");
	
	$sql = "SELECT COUNT(*) as quantidade_funcoes FROM funcoes";
	
	if(!empty($_POST)){
		$nome = $_POST["nome_filtro"];
		$sql.= " WHERE descricao LIKE '%$nome%'";
	}
	
	$resultado = mysqli_query($conexao, $sql) or die ("Erro." . mysqli_query($conexao));
	
	$linha = mysqli_fetch_assoc($resultado);
	
	$quantidade_funcoes = $linha["quantidade_funcoes"];
	
	$quantidade_pagina = (int) ($quantidade_funcoes/5);
	
	if($quantidade_funcoes%5!=0){
		$quantidade_pagina++;
	}
	
	for($i=1;$i<=$quantidade_pagina;$i++){
		echo " <button type = 'button' class='pg' value = '$i'>$i</button> ";
	}
?>