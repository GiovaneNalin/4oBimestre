<!DOCTYPE html>
<html lang = "pt-BR">
	<head>
		<meta charset = "UTF-8" />
		<title></title>
	</head>
	<body>
	<?php
			include ("menu.php");
	?>
	<div class='container-fluid' align='center'>
		<fieldset>
		<legend><h2>LOGIN</h2></legend>
		<form method = "post" action = "validacao.php">
		<div class='form-row'>
			
			<?php
				if(isset($_GET["erro"])){
					echo "<h3>Usuário e/ou senha inválidos!</h3>";
				}
			?>
			<div class='form-group col-md-12'>
			Email: <input class='form-control' type = "email" name = "usuario" placeholder = "email..."/>
			</div>
			<div class='form-group col-md-12'>
			Senha: <input class='form-control' type = "password" name = "senha" placeholder = "senha..."/>
			</div>
			</div>
			<button>Enviar</button>
		</div>
		</form>
		</fieldset>

	</body>
</html>