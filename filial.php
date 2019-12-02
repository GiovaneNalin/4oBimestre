<?php
	include("verificacao.php");
	include("menu.php");
	include("conexao.php");

	echo "<div class=' pt-4 pl-2 pr-2'>";	
	
	if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
	?>
		<script>
		var id = null;
		var filtro = null;
			
		$(function(){
			paginacao(0);
			
			// PAGINAÇÃO
			function paginacao(p){
				$.ajax({
					url: 'json_listar_filial.php',
					type: 'POST',
					data: {pg: p, nome_filtro: filtro},
					success: function(matriz){
						$("#tb_filial").html("");
						
						for(i=0;i<matriz.length;i++){
							linha = "<tr>";
							linha += "<td class = 'endereco'>" + matriz[i].endereco + "</td>";
							linha += "<td class = 'estado'>" + matriz[i].estado + "</td>";
							linha += "<td class = 'telefone'>" + matriz[i].telefone + "</td>";
							linha += "<td class = 'cidade'>" + matriz[i].cidade + "</td>";
							linha += "<td class = 'nome'>" + matriz[i].nome + "</td>";
							linha += "<td><button type = 'button' id = 'nome_alterar' class = 'alterar' value ='" + matriz[i].id_filial + "'>Alterar</button></td>";
							linha += "</tr>";
							
							$("#tb_filial").append(linha);	
						}
					}			
				});	
			}
			
			// FILTRAR
			$("#filtrar").click(function(){
				$.ajax({
					url:"paginacao_listar_filial.php",
					type:"post",
					data:{
							nome_filtro: $("input[name='nome_filtro']").val()
					},
					success: function(d){
						console.log(d);
						filtro = $("input[name='nome_filtro']").val()
						paginacao(0);
						
					}
				});
			});
			
			$(document).on("click",".alterar",function(){
				id = $(this).attr("value");
				$.ajax({
					url: "carrega_filial_alterar.php",
					type: "post",
					data: {id: id},
					success: function(vetor){
						console.log(vetor);
						$("input[name='endereco']").val(vetor.endereco);
						$("input[name='estado']").val(vetor.estado);
						$("input[name='telefone']").val(vetor.telefone);
						$("input[name='cidade']").val(vetor.cidade);
						$("input[name='nome']").val(vetor.nome);
						
						$(".cadastrar").attr("class","alteracao");
						$(".alteracao").val("Alterar filial");
					}
				});
			});
			
			$(document).on("click",".pg", function(){
				p = $(this).val();
				p = (p-1)*5;
				paginacao(p);
			});
			
			
			
			// INSERIR
			$(document).on("click",".cadastrar",function(){
				$.ajax({ 
					url: "insere_filial.php",
					type: "post",
					data: {
							endereco:$("input[name='endereco']").val(),	
							estado:$("input[name='estado']").val(),	
							telefone:$("input[name='telefone']").val(),	
							cidade:$("input[name='cidade']").val(),	
							nome:$("input[name='nome']").val()	
					},
					success: function(data){
						if(data=='1'){
							$("input[name='endereco']").val("");	
							$("input[name='estado']").val("");
							$("input[name='telefone']").val("");	
							$("input[name='cidade']").val("");	
							$("input[name='nome']").val("");
							paginacao(0);
						}else {
							console.log(data);
						}
					}
				});
			});
			
			// ALTERAR			
			$(document).on("click",".alteracao",function(){
				$.ajax({ 
					url: "altera_filial.php",
					type: "post",
					data: {
							id: id, 
							endereco:$("input[name='endereco']").val(),	
							estado:$("input[name='estado']").val(),	
							telefone:$("input[name='telefone']").val(),	
							cidade:$("input[name='cidade']").val(),	
							nome:$("input[name='nome']").val()
					},
					success: function(data){
						if(data==1){
							paginacao(0);
							$("input[name='endereco']").val("");	
							$("input[name='estado']").val("");
							$("input[name='telefone']").val("");	
							$("input[name='cidade']").val("");	
							$("input[name='nome']").val("");
							$(".alteracao").attr("class","cadastrar");
							$(".cadastrar").val("Cadastrar");
						}else {
							console.log(data);
						}
					}
				});
			});
				
			///////////////////////////INLINE ENDERECO /////////////////////////////
				$(document).on("click",".endereco",function(){
					td = $(this);
					endereco = td.html();
					td.html("<input type = 'text' id = 'endereco_alterar' value = '" + endereco + "' />");
					td.attr("class","endereco_alterar");
					$("#endereco_alterar").focus();
				});
							
				$(document).on("blur",".endereco_alterar",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'filial', 
								coluna: 'endereco',
								valor: $("#endereco_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							endereco = $("#endereco_alterar").val();
							td.html(endereco);
							td.attr("class","endereco");
						}
					});
				});
				
			///////////////////////////INLINE ESTADO /////////////////////////////
				$(document).on("click",".estado",function(){
					td = $(this);
					estado = td.html();
					td.html("<input type = 'text' id = 'estado_alterar' value = '" + estado + "' />");
					td.attr("class","estado_alterar");
					$("#estado_alterar").focus();
				});
							
				$(document).on("blur",".estado_alterar",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'filial', 
								coluna: 'estado',
								valor: $("#estado_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							estado = $("#estado_alterar").val();
							td.html(estado);
							td.attr("class","estado");
						}
					});
				});
				
			///////////////////////////INLINE TELEFONE /////////////////////////////
				$(document).on("click",".telefone",function(){
					td = $(this);
					telefone = td.html();
					td.html("<input type = 'text' id = 'telefone_alterar' value = '" + telefone + "' />");
					td.attr("class","telefone_alterar");
					$("#telefone_alterar").focus();
				});
							
				$(document).on("blur",".telefone_alterar",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'filial', 
								coluna: 'telefone',
								valor: $("#telefone_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							telefone = $("#telefone_alterar").val();
							td.html(telefone);
							td.attr("class","telefone");
						}
					});
				});
				
			///////////////////////////INLINE CIDADE /////////////////////////////
				$(document).on("click",".cidade",function(){
					td = $(this);
					cidade = td.html();
					td.html("<input type = 'text' id = 'cidade_alterar' value = '" + cidade + "' />");
					td.attr("class","cidade_alterar");
					$("#cidade_alterar").focus();
				});
							
				$(document).on("blur",".cidade_alterar",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'filial', 
								coluna: 'cidade',
								valor: $("#cidade_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							cidade = $("#cidade_alterar").val();
							td.html(cidade);
							td.attr("class","cidade");
						}
					});
				});
				
			///////////////////////////INLINE NOME /////////////////////////////
				$(document).on("click",".nome",function(){
					td = $(this);
					nome = td.html();
					td.html("<input type = 'text' id = 'nome_alterar' value = '" + nome + "' />");
					td.attr("class","nome_alterar");
					$("#nome_alterar").focus();
				});
							
				$(document).on("blur",".nome_alterar",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'filial', 
								coluna: 'nome',
								valor: $("#nome_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							nome = $("#nome_alterar").val();
							td.html(nome);
							td.attr("class","nome");
						}
					});
				});
		});
		</script>
		
	<div class='container-fluid' align='center'>
		<fieldset>
			<legend><h2>FILIAL</h2></legend>
			<form>
				<div class='form-row'>
					<div class='form-group col-md-12'>
						Nome: <input class='form-control' type='text' name='nome' placeholder='Insira o nome da filial...' /><br /><br />
					</div>
					<div class='form-group col-md-6'>
						Endereco: <input class='form-control' type='text' name='endereco' placeholder='Insira o endereco da filial...' /><br /><br />
					</div>
					<div class='form-group col-md-6'>
						Estado: <input class='form-control' type='text' name='estado' placeholder='Insira o estado da filial...' /><br /><br />
					</div>
					<div class='form-group col-md-6'>
						Telefone: <input class='form-control' type='number' name='telefone' placeholder='Insira o telefone da filial...' /><br /><br />
					</div>
					<div class='form-group col-md-6'>
						Cidade :<input class='form-control' type='text' name='cidade' placeholder='Insira a cidade da filial...' /><br /><br />
					</div>
				</div>
				
				<input type = "button" class = "cadastrar" value = "Cadastrar" />
			</form>
		</fieldset>
	</div>
	<br /><br />
	<?php
	}
	else{
		header("Location: login.php");
	}
	?>
	<div class='container-fluid' align='center'>
	<div>
			<form name='fltro'>
				<input type ='text' name='nome_filtro' placeholder='filtrar por nome...' />
				
				<button type='button' id='filtrar'> Filtrar </button>
			</form>
			<br />
		<table border = "1">
			<thead>
				<tr>
					<th> Endereço </th>
					<th> Estado </th>
					<th> Telefone </th>
					<th> Cidade </th>
					<th> Nome </th>
					<th> Ação </th>
				</tr>
			</thead>
			<tbody id = "tb_filial"></tbody>
		</table>
	</div>
	<br />
	<?php
		include("paginacao_listar_filial.php");
	?>
	</div>
</body>
</html>