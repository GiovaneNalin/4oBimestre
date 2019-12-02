<!DOCTYPE html>
	<head> 
		<html lang = "pt-BR"/>
		<meta charset = "utf-8"/>
		<script src = "jquery-3.4.1.min.js"></script>
		<script src = "cadastrar_usuario.js"></script>
	</head>
	<body>
	<?php
			include ("menu.php");
	?>
	<div class='container-fluid' align='center'>
	<fieldset>
	<legend><h2>CADASTRE-SE</h2></legend>
	<form method = "post" action = "insere_usuario.php">
	<div class='form-row'>
	
	<div class='form-group col-md-6'>
		CPF: <input class='form-control' type = "number" name = "id_usuario" placeholder = "Digite o CPF..."/><br />
	</div>
	<div class='form-group col-md-6'>
		Nome: <input class='form-control' type = "text" name = "nome" placeholder = "Digite o nome..."/><br />
	</div>
	<div class='form-group col-md-6'>
		E-mail: <input class='form-control' type = "email" name = "email" placeholder = "Digite o email..."/><br />
	</div>
	<div class='form-group col-md-3'>
		Data Nascimento: <input class='form-control' type = "date" name = "data_nasc"/><br />
	</div>
	<div class='form-check form-check-inline col-md-2'>
		Sexo:<input class='form-check-input' type = "radio" name = "sexo" value = "M"/> Masculino <input class='form-check-input' type = "radio" name = "sexo" value = "F"/> Feminino<br />
	</div>
	<div class='form-group col-md-12'>
		Senha: <input class='form-control' type="password" name="senha" placeholder="Insira a senha..." />
	</div>
	</div>
		<br /><br />
		<input type="button" id="btn" value="Enviar" />
	</div>
	</form>
	
	</fieldset>	<br />
	
	</body>
</html>