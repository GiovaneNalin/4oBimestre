<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery-3.4.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	<link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
	</head>
	
	<body>
		<div class = "bg-dark  d-block text-center">
			<img class='img-fluid' width='150'  src = "img/dinofauro.png" >
		</div>
			<div class='container-fluid bg-light row'>
				<div class = "negrito col-3"><a href = "index.php"><span class="oi oi-home"> Home </span></a></div>
					<?php

						if(isset($_SESSION["autorizado"])){
							echo "<div class='col-3'><a href='logout.php'><span class='oi oi-account-logout'> Logout</span></a></div>";
						}else{
							echo "<div class='col-3'><a href='login.php'><span class='oi oi-account-login'> Login</span></a></div>";
							echo "<div class='col-3'><a href='usuario.php'><span class='oi oi-plus'> Cadastrar-se</span></a></div>";
						}				
						echo "<br />";
						echo "</div>";
						
						echo "<div class='row container-fluid bg-light'>";
						if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
							echo "<div class='col-2'><a href='filial.php'><img src='img/filial.png' width='20px;'> Filiais</a></div>";								
						}
			
						if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
							echo "<div class='col-2'><a href='dinossauro.php'><img src='img/dinossauro.png' width='20px;'> Dinossauros</a></div>";								
						}

						if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
							echo "<div class='col-2'><a href='setor.php'><span class='oi oi-grid-two-up'></span> Setores</a></div>";							 
						}
				
						if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
							echo "<div class='col-2'><a href='funcionario.php'><img src='img/funcionario.png' width='20px;'> Funcionários</a></div>";
						}
				
						if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
							echo "<div class='col-2'><a href='relacao.php'><img src='img/relacao.png' width='20px;'> Relações</a></div>";
						}
				
						if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
							echo "<div class='col-2'><a href='funcao.php'><img src='img/funcao.png' width='20px;'> Funções</a></div>";
						}
				?>
				</div>
