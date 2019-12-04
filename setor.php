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
					url: 'json_listar_setor.php',
					type: 'POST',
					data: {pg: p, nome_filtro: filtro},
					success: function(matriz){
						$("#tb_setor").html("");
						
						for(i=0;i<matriz.length;i++){
							linha = "<tr>";
							linha += "<td class = 'descricao' value ='" + matriz[i].id_setor + "'>" + matriz[i].descricao + "</td>";
							//linha += "<td><button type = 'button' id = 'descricao_alterar' class = 'alterar' value ='" + matriz[i].id_setor + "'>Alterar</button></td>";
							linha += "</tr>";
							
							$("#tb_setor").append(linha);	
						}
					}			
				});	
			}
			
			// FILTRAR
			$("#filtrar").click(function(){
				$.ajax({
					url:"paginacao_listar_setor.php",
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
			
			$(document).on("click",".pg", function(){
				p = $(this).val();
				p = (p-1)*5;
				paginacao(p);
			});
			
			
			
			// INSERIR
			$(document).on("click",".cadastrar",function(){
				$.ajax({ 
					url: "insere_setor.php",
					type: "post",
					data: {
							descricao:$("input[name='descricao']").val(),	
					},
					success: function(data){
						if(data=='1'){
							$("#resultado").html("Setor cadastrado!");
							$("input[name='descricao']").val("");
							paginacao(0);
						}else {
							console.log(data);
						}
					}
				});
			});
				
			///////////////////////////INLINE DESCRICAO /////////////////////////////
			$(document).on("click",".descricao",function(){
					td = $(this);
					descricao = td.html();
					td.html("<input type = 'text' id = 'descricao_alterar' value = '" + descricao + "' />");
					td.attr("class","descricao_alterar");
					$("#descricao_alterar").focus();
				});
							
				$(document).on("blur",".descricao_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("td").attr("value");
					
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'setor', 
								coluna: 'descricao',
								valor: $("#descricao_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							descricao = $("#descricao_alterar").val();
							td.html(descricao);
							td.attr("class","descricao");
						}
					});
				});
		});
		
		
	</script>
	<br />
	<div class='container-fluid' align='center'>
		<fieldset>
			<legend><h2>SETOR</h2></legend>

			<form>
				<div class='form-row'>
				
					<div class='form-group col-md-12'>
						Descrição: <input class="form-control" type = "text" name = "descricao" placeholder = "Insira o nome do setor..." /><br/><br/>
					</div>
						<br/><br/><br/>
				</div>
				<input type = 'button' class = "cadastrar" value = 'Cadastrar' />
			</form>
			</fieldset>
	</div>
	<br/><br/>	
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
						<th> Descrição </th>
					</tr>
				</thead>
				<tbody id = "tb_setor"></tbody>
				<br />
			</table>
			<br /><br />
		
			<div id="paginacao">
			<?php
				include("paginacao_listar_setor.php");
			?>
			</div>
		</div>
	</div>
</body>
</html>