<?php

	include("verificacao.php");
	include("menu.php");
	include("conexao.php");

	if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1)
	{
?>
		<script>
		var id = null;
		var filtro = null;
			
		$(function(){
			paginacao(0);
			
			// PAGINAÇÃO
			function paginacao(p){
				$.ajax({
					url: 'json_listar_funcionario.php',
					type: 'POST',
					data: {pg: p, nome_filtro: filtro},
					success: function(matriz){
						console.log(matriz);
						$("#tb_funcionario").html("");
						
						for(i=0;i<matriz.length;i++){
							linha = "<tr>";
							linha += "<td class = 'id_funcionario'>" + matriz[i].id_funcionario + "</td>";
							linha += "<td class = 'funcao'>" + matriz[i].funcoes + "</td>";
							linha += "<td class = 'nome'>" + matriz[i].nome + "</td>";
							linha += "<td class = 'filial'>" + matriz[i].filial + "</td>";
							linha += "<td><button type = 'button' id = 'funcionario_alterar' class = 'alterar' value ='" + matriz[i].id_funcionario + "'>Alterar</button></td>";
							linha += "</tr>";
							
							$("#tb_funcionario").append(linha);	
						}
					}			
				});	
			}
			
			// FILTRAR
			$("#filtrar").click(function(){
				$.ajax({
					url:"paginacao_listar_funcionario.php",
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
					url: "carrega_funcionario_alterar.php",
					type: "post",
					data: {id: id},
					success: function(vetor){
						$("input[name='id_funcionario']").val(vetor.id_funcionario);
						$("select[name='cod_funcao']").val(vetor.cod_funcao);
						$("input[name='nome']").val(vetor.nome);
						$("select[name='cod_filial']").val(vetor.cod_filial);
						
						$(".cadastrar").attr("class","alteracao");
						$(".alteracao").val("Alterar funcionario");
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
					url: "insere_funcionario.php",
					type: "post",
					data: {
							id_funcionario:$("input[name='id_funcionario']").val(),	
							cod_funcao:$("select[name='cod_funcao']").val(),	
							nome:$("input[name='nome']").val(),
							cod_filial:$("select[name='cod_filial']").val()
					},
					success: function(data){
						if(data=='1'){
							$("input[name='id_funcionario']").val("");
							$("select[name='cod_funcao']").val("");
							$("input[name='nome']").val("");
							$("select[name='cod_filial']").val("");
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
					url: "altera_funcionario.php",
					type: "post",
					data: {
							id: id, 
							id_funcionario:$("input[name='id_funcionario']").val(),	
							cod_funcao:$("select[name='cod_funcao']").val(),	
							nome:$("input[name='nome']").val(),
							cod_filial:$("select[name='cod_filial']").val()
					},
					success: function(data){
						if(data==1){
							paginacao(0);
							$("input[name='id_funcionario']").val("");
							$("select[name='cod_funcao']").val("");
							$("input[name='nome']").val("");
							$("selcet[name='cod_filial']").val("");
							$(".alteracao").attr("class","cadastrar");
							$(".cadastrar").val("Cadastrar");
						}else {
							console.log(data);
						}
					}
				});
			});
				
			/////////////////////////// INLINE CPF /////////////////////////////
				$(document).on("click",".id_funcionario",function(){
					td = $(this);
					id_funcionario = td.html();
					td.html("<input type = 'text' id = 'id_funcionario_alterar' value = '" + id_funcionario + "' />");
					td.attr("class","alterar_id_funcionario");
					$("#id_funcionario_alterar").focus();
				});
							
				$(document).on("blur",".alterar_id_funcionario",function(){
					td = $(this);
					id_linha = $(this).closest("td").attr("value");
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'funcionario', 
								coluna: 'id_funcionario',
								valor: $("#id_funcionario_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							id_funcionario = $("#id_funcionario").val();
							td.html(id_funcionario);
							td.attr("class","id_funcionario");
						}
					});
				});
				
			///////////////////////////INLINE FUNCAO /////////////////////////////
				$(document).on("click",".funcao",function(){
					td = $(this);
					funcao = td.html();
					
					select = "<select id='cod_funcao_alterar'>";
					select += $("select[name='cod_funcao']").html();
					select += "</select>";
					
					td.html(select);
					valor = $("option:contains('"+funcao+"')").val();
					$("#cod_funcao_alterar").val(valor);
					$("#cod_funcao_alterar").focus();
					
					td.attr("class","alterar_funcao");
				});
							
				$(document).on("blur",".alterar_funcao",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'funcionario', 
								coluna: 'cod_funcao',
								valor: $("#cod_funcao_alterar").val(),
								id: id_linha
						},
						success: function(data){
							console.log(data);
							cod_funcao = $("#cod_funcao_alterar").val();
							funcao = $("#cod_funcao_alterar").find("option[value='" + cod_funcao + "']").html();
							td.html(funcao);
							td.attr("class","funcao");
						}
					});
				});
				
			///////////////////////////INLINE FILIAL /////////////////////////////
				$(document).on("click",".filial",function(){
					td = $(this);
					filial = td.html();
					
					select = "<select id='cod_filial_alterar'>";
					select += $("select[name='cod_filial']").html();
					select += "</select>";
					
					td.html(select);
					valor = $("option:contains('"+filial+"')").val();
					$("#cod_filial_alterar").val(valor);
					$("#cod_filial_alterar").focus();
					
					td.attr("class","alterar_filial");
				});
							
				$(document).on("blur",".alterar_filial",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'funcionario', 
								coluna: 'cod_filial',
								valor: $("#cod_filial_alterar").val(),
								id: id_linha
						},
						success: function(data){
							console.log(data);
							cod_filial = $("#cod_filial_alterar").val();
							filial = $("#cod_filial_alterar").find("option[value='" + cod_filial + "']").html();
							td.html(filial);
							td.attr("class","filial");
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
								tabela: 'funcionario', 
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
			<br />
			<div class='container-fluid' align='center'>
				<fieldset>
				<legend><h2>FUNCIONÁRIO</h2></legend>
				
				<div class='form-row'>

					<div class='form-group col-md-12'>
						Nome: <input class='form-control' type = 'text' name = 'nome' placeholder = "Insira o nome do funcionario..." /><br/><br/>
					</div>
					<div class='form-group col-md-12'>
						CPF: <input class='form-control' type = 'number' name = 'id_funcionario' placeholder = "Insira o cpf do funcionario..." /><br/><br/>
					</div>
					<div class='form-group col-md-6'>
						Função: <select class='form-control' name = 'cod_funcao'>
						<option>:: Função </option>
							
							<?php
								$consulta_funcao = "SELECT * FROM funcoes";
								$resultado_funcao = mysqli_query($conexao,$consulta_funcao) or die ("ERRO");
								
								while($linha=mysqli_fetch_assoc($resultado_funcao)){
								echo '<option value = "'. $linha["id_funcoes"] .'">'.$linha["descricao"] .'</option>';
								}
							?>
							</select>
					</div>
					<div class='form-group col-md-6'>
						Filial: <select class='form-control' name = 'cod_filial'>
							<option>:: Filial </option>
							
							<?php
								$consulta_funcionario = "SELECT * FROM filial";
								$resultado_filial = mysqli_query($conexao,$consulta_funcionario) or die ("ERRO");
							
								while($linha=mysqli_fetch_assoc($resultado_filial)){
								echo '<option value = "'. $linha["id_filial"] .'">'.$linha["nome"] .'</option>';
								}
				
							?>
						</select>
					</div>
				</div>
				<br />
				<input type = 'button' value = 'Cadastrar' class = "cadastrar"/>
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
			
			<table border = "1">
				<thead>
					<tr>
						<th> CPF </th>
						<th> Função </th>
						<th> Nome </th>
						<th> Filial </th>
						<th> Ação </th>
					</tr>
				</thead>
				<tbody id = "tb_funcionario"></tbody>
				<br />
			</table>
			<br />
			<div id="paginacao">
			<?php
				include("paginacao_listar_funcionario.php");
			?>
			</div>
		</div>
	</div>
	</body>
</html>