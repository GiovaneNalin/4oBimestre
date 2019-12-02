<?php
	include("conexao.php");
	
	$usuario = $_POST["usuario"];
	$senha = $_POST["senha"];
	
	$consulta = "SELECT * FROM usuario WHERE email = '$usuario' AND senha = '$senha'";
	$resultado = mysqli_query($conexao,$consulta) or die("Usuário e/ou senha incorreto!");
	
	
	if(mysqli_num_rows($resultado)==1){
		
		session_start();
		$linha = mysqli_fetch_assoc($resultado);
		$_SESSION["autorizado"]=$linha["id_usuario"];
		$_SESSION["permissao"]=$linha["permissao"];
		header("location: index.php");
	}else{
		header("location: login.php?erro=1");
	}
	
	
	
?>