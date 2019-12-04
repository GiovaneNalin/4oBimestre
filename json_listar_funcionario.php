<?php
	header("Content-Type: Application/json");
	
	include('conexao.php');
	
	$p = $_POST["pg"];
	
	$sql='SELECT id_funcionario, funcoes.descricao as funcoes, funcionario.nome as nome, filial.nome as filial FROM funcionario INNER JOIN funcoes ON cod_funcao=id_funcoes
	INNER JOIN filial ON cod_filial=id_filial'; 
	
	if(isset($_POST["nome_filtro"])){
		$nome = $_POST["nome_filtro"];
		$sql .= " WHERE funcionario.nome LIKE '%$nome%'";
	}
	
	$sql.= " LIMIT $p,5";
	
	$resultado = mysqli_query($conexao, $sql) or die("Erro." . mysqli_error($conexao));
				
	while($linha = mysqli_fetch_assoc($resultado)){
		$matriz[] = $linha;
	}
	
	echo json_encode($matriz);
?>