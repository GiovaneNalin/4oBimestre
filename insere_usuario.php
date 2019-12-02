<!DOCTYPE html>
<html lang = "pt-BR">
	<head>
		<meta charset = "UTF-8" />
		<title></title>
		<link rel="stylesheet" href="estilos.css"/>
	</head>
	<body>
<?php
	include("menu.php");
	
	include("conexao.php");
	
	$id_usuario = $_POST["id_usuario"];
	$nome = $_POST["nome"];
	$sexo = $_POST["sexo"];
	$data_nascimento = $_POST["data_nascimento"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$permissao = $_POST["permissao"];
	
	$insercao = "INSERT INTO filial 
						VALUES ('$id_usuario',
								'$nome',
								'$sexo',
								'$data_nascimento',
								'$email',
								'$senha',
								'0'						
								)";
						
	//mysqli_error($conexao)
	mysqli_query($conexao, $insercao)
		or die("0");
		
	echo 1;

	
?>
	<body>
</html>