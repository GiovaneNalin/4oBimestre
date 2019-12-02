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
					url: 'json_listar_relacao.php',
					type: 'POST',
					data: {pg: p, nome_filtro: filtro},
					success: function(matriz){
						$("#tb_relacao").html("");
						
						for(i=0;i<matriz.length;i++){
							linha = "<tr>";
							linha += "<td class = 'setor'>" + matriz[i].setor + "</td>";
							linha += "<td class = 'filial'>" + matriz[i].filial + "</td>";
							linha += "<td><button type = 'button' id = 'relacao_alterar' class = 'alterar' value ='" + matriz[i].id_relacao + "'>Alterar</button></td>";
							linha += "</tr>";
							
							$("#tb_relacao").append(linha);	
						}
					}			
				});	
			}
			
			// FILTRAR
			$("#filtrar").click(function(){
				$.ajax({
					url:"paginacao_listar_relacao.php",
					type:"post",
					data:{
							nome_filtro: $("input[name='nome_filtro']").val()
					},
					success: function(d){
						console.log(d);
						filtro = $("input[name='nome_filtro']").val();
						paginacao(0);
						
						
					}
				});
			});
			
			$(document).on("click",".alterar",function(){
				id = $(this).attr("value");
				$.ajax({
					url: "carrega_relacao_alterar.php",
					type: "post",
					data: {id: id},
					success: function(vetor){
						$("select[name='cod_setor']").val(vetor.cod_setor);
						$("select[name='cod_filial']").val(vetor.cod_filial);
						
						$(".cadastrar").attr("class","alteracao");
						$(".alteracao").val("Alterar Relacao");
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
					url: "insere_relacao.php",
					type: "post",
					data: {
							cod_setor:$("select[name='cod_setor']").val(),	
							cod_filial:$("select[name='cod_filial']").val(),	
					},
					success: function(data){
						if(data=='1'){
							$("#resultado").html("Relacao cadastrado!");
							$("select[name='cod_setor']").val("");
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
						url: "altera_relacao.php",
						type: "post",
						data: {
								id: id, 
								cod_setor:$("select[name='cod_setor']").val(), 
								cod_filial:$("select[name='cod_filial']").val()
						},
						success: function(data){
							if(data==1){
								$("#resultado").html("Alteração efetuada!");
								paginacao(0);
								$("select[name='cod_setor']").val("");
								$("select[name='cod_filial']").val("");
								$(".alteracao").attr("class","cadastrar");
								$(".cadastrar").val("Cadastrar");
							}else {
								console.log(data);
							}
						}
					});
				});
				
			///////////////////////////INLINE SETOR /////////////////////////////
				$(document).on("click",".setor",function(){
					td = $(this);
					setor = td.html();
					
					select = "<select id='setor_alterar'>";
					select += $("select[name='cod_setor']").html();
					select += "</select>";
					
					td.html(select);
					valor = $("option:contains('"+setor+"')").val();
					$("#setor_alterar").val(valor);
					$("#setor_alterar").focus();
					
					td.attr("class","alterar_setor");
				});
							
				$(document).on("blur",".alterar_setor",function(){
					td = $(this)
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'relacao', 
								coluna: 'cod_setor',
								valor: $("#setor_alterar").val(),
								id: id_linha
						},
						success: function(data){
							console.log(data);
							cod_setor = $("#setor_alterar").val();
							setor = $("#setor_alterar").find("option[value='" + cod_setor + "']").html();
							td.html(setor);
							td.attr("class","setor");
						}
					});
				});
				
				///////////////////////////INLINE FILIAL /////////////////////////////
				$(document).on("click",".filial",function(){
					td = $(this);
					filial = td.html();
					
					select = "<select id='filial_alterar'>";
					select += $("select[name='cod_filial']").html();
					select += "</select>";
					
					td.html(select);
					valor = $("option:contains('"+filial+"')").val();
					$("#filial_alterar").val(valor);
					$("#filial_alterar").focus();
					
					td.attr("class","alterar_filial");
				});
							
				$(document).on("blur",".alterar_filial",function(){
					td = $(this)
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'relacao', 
								coluna: 'cod_filial',
								valor: $("#filial_alterar").val(),
								id: id_linha
						},
						success: function(data){
							console.log(data);
							cod_filial = $("#filial_alterar").val();
							filial = $("#filial_alterar").find("option[value='" + cod_filial + "']").html();
							td.html(filial);
							td.attr("class","filial");
						}
					});
				});
		});
		
	</script>
	<?php
			
			
			
			
	?>
	<div class='container-fluid' align='center'>
		<fieldset>
			<legend><h2>RELAÇÃO</h2></legend>
				<div class='form-row'>
				
				<div class='form-group col-md-6'>
				Setor: <select class='form-control' name = 'cod_setor'>
					<option>::selecione um setor </option>";
					<?php
						$consulta_setor = "SELECT * FROM setor";
						$resultado_setor = mysqli_query($conexao,$consulta_setor) or die ("ERRO");
					
						while($linha=mysqli_fetch_assoc($resultado_setor)){
							echo '<option value = "'. $linha["id_setor"] .'">'.$linha["descricao"] .'</option>';
						}
					?>
					
				</select>
				</div>
				<div class='form-group col-md-6'>
				Filial: <select class='form-control' name = 'cod_filial'>
					<option>::selecione uma filial </option>
					<?php
						$consulta_filial = "SELECT * FROM filial";
						$resultado_filial = mysqli_query($conexao,$consulta_filial) or die ("ERRO");
					
						while($linha=mysqli_fetch_assoc($resultado_filial)){
							echo '<option value = "'. $linha["id_filial"] .'">'.$linha["nome"] .'</option>';
						}

					?>
				</select>
				</div>
					<br/><br/>
				</div>
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
		
	<br />
	<div class='container-fluid' align='center'>
		<div>
			<form name='fltro'>
				<input type ='text' name='nome_filtro' placeholder='filtrar por filial...' />
				
				<button type='button' id='filtrar'> Filtrar </button>
			</form>
			<br />
			
			<table border = "1">
				<thead>
					<tr>
						<th> Setor </th>
						<th> Filial </th>
						<th> Ação </th>
					</tr>
				</thead>
				<tbody id = "tb_relacao"></tbody>
				<br />
			</table>
			<br />
			<div id="paginacao">
			<?php
				include("paginacao_listar_relacao.php");
			?>
			</div>
		</div>
	</div>
</body>
</html>