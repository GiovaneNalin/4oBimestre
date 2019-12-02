<?php
	header("Content-Type: Application/json");
	
	include('conexao.php');
	
	$p = $_POST["pg"];
	
	$sql='SELECT id_funcionario, funcao.descricao as funcao, nome, filial.nome as filial FROM funcionario INNER JOIN funcao ON cod_funcao=id_funcao 
	INNER JOIN filial ON cod_filial=id_filial'; 
	
	if(isset($_POST["nome_filtro"])){
		$nome = $_POST["nome_filtro"];
		$sql .= " WHERE nome LIKE '%$nome%'";
	}
	
	$sql.= " LIMIT $p,5";
	
	$resultado = mysqli_query($conexao, $sql) or die("Erro." . mysqli_error($conexao));
				
	while($linha = mysqli_fetch_assoc($resultado)){
		$matriz[] = $linha;
	}
	
	echo json_encode($matriz);
?>