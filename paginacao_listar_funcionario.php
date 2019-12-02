<?php
	include("conexao.php");
	
	$sql = "SELECT COUNT(*) as quantidade_funcionario FROM funcionario";
	
	if(!empty($_POST)){
		$nome = $_POST["nome_funcionario"];
		$sql.= " WHERE nome LIKE '%$nome%'";
	}
	
	$resultado = mysqli_query($conexao, $sql) or die ("Erro." . mysqli_query($conexao));
	
	$linha = mysqli_fetch_assoc($resultado);
	
	$quantidade_funcionario = $linha["quantidade_funcionario"];
	
	$quantidade_pagina = (int) ($quantidade_funcionario / 5);
	
	if($quantidade_funcionario%5!=0){
		$quantidade_pagina++;
	}
	
	for($i=1;$i<=$quantidade_pagina;$i++){
		echo " <button type = 'button' class='pg' value = '$i'>$i</button> ";
	}
?>