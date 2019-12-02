<?php
	include("verificacao.php");
	include("menu.php");
	include("conexao.php");
	
	$consulta_relacao = "SELECT * FROM relacao INNER JOIN filial ON relacao.cod_filial=filial.id_filial INNER JOIN setor ON relacao.cod_setor=setor.id_setor";
	$resultado_relacao = mysqli_query($conexao,$consulta_relacao) or die ("ERRO");
	
	echo "<div class=' pt-4 pl-2 pr-2'>";

	if(isset($_SESSION["autorizado"]) and $_SESSION["permissao"] == 1){
?>	

<script>
		var id=null;
		var filtro=null;
		
		
			$(function(){
				
				paginacao(0);			
					
				//PAGINAÇÂO
				function paginacao(valor){
					$.ajax({
						url: 'json_listar_dinossauro.php',
						type: 'POST',
						data: {p: valor},
						success: function(matriz){
							$("#tb_dinossauro").html("");
							
							for(i=0;i<matriz.length;i++){
								linha = "<tr>";
								linha += "<td class='filo'>" + matriz[i].filo + "</td>";
								linha += "<td class='reino'>" + matriz[i].reino + "</td>";
								linha += "<td class='dominio'>" + matriz[i].dominio + "</td>";
								linha += "<td class='ordem'>" + matriz[i].ordem + "</td>";
								linha += "<td class='clado'>" + matriz[i].clado + "</td>";
								linha += "<td class='familia'>" + matriz[i].familia + "</td>";
								linha += "<td class='genero'>" + matriz[i].genero + "</td>";
								linha += "<td class='especie'>" + matriz[i].especie + "</td>";
								linha += "<td class='nome'>" + matriz[i].nome + "</td>";
								linha += "<td class='periodo'>" + matriz[i].periodo + "</td>";
								linha += "<td class='cod_relacao'>" + matriz[i].cod_relacao + "</td>";
								linha += "<td><button type = 'button' class = 'alterar' value ='" + matriz[i].id_dinossauro + "'>Alterar</button></td>";
								linha += "</tr>";

								$("#tb_dinossauro").append(linha);
							}
						}			
					});	
				}
				
				//FILTRO
				$("#filtrar").click(function(){
					$.ajax({
						url:"paginacao_listar_dinossauro.php",
						type:"post",
						data:{
							nome_filtro: $("input[name='nome_filtro']").val()
						},
						success:  function(d){
							$("#paginacao").html(d);
							filtro = $("input[name='nome_filtro']").val();
							paginacao(0);
						}
					});
				});
			
				$(document).on("click",".pg", function(){
					p = $(this).val();
					p = (p-1)*5;
					paginacao(p);
				});
			//ALTERAR
				$(document).on("click",".alterar",function(){
					id = $(this).attr("value");
					$.ajax({
						url: "carrega_dinossauro_alterar.php",
						type: "post",
						data: {id: id},
						success: function(vetor){								
								$("input[name='filo']").val(vetor.filo);
								$("input[name='reino']").val(vetor.reino);
								$("input[name='dominio']").val(vetor.dominio);
								$("input[name='ordem']").val(vetor.ordem);
								$("input[name='clado']").val(vetor.clado);
								$("input[name='familia']").val(vetor.familia);
								$("input[name='genero']").val(vetor.genero);
								$("input[name='especie']").val(vetor.especie);
								$("input[name='nome']").val(vetor.nome);
								$("input[name='periodo']").val(vetor.periodo);
								$("select[name='cod_relacao']").val(vetor.cod_relacao);
								
								$(".cadastrar").attr("class","alteracao");
								$(".alteracao").val("Alterar dinossauro");					
						}
					});
				});
				
				//INSERE
				$(document).on("click",".cadastrar",function(){
					$.ajax({ 
						url: "insere_dinossauro.php",
						type: "post",
						data: {
							filo:$("input[name='filo']").val(), 
							reino:$("input[name='reino']").val(), 
							dominio:$("input[name='dominio']").val(), 
							ordem:$("input[name='ordem']").val(), 
							clado:$("input[name='clado']").val(), 
							familia:$("input[name='familia']").val(), 
							genero:$("input[name='genero']").val(), 
							especie:$("input[name='especie']").val(), 
							nome:$("input[name='nome']").val(), 
							periodo:$("input[name='periodo']").val(), 
							cod_relacao:$("select[name='cod_relacao']").val()
						},
						success: function(data){
							if(data=='1'){
							$("input[name='filo']").val("");
							$("input[name='reino']").val("");
							$("input[name='dominio']").val("");
							$("input[name='ordem']").val(""); 
							$("input[name='clado']").val("");
							$("input[name='familia']").val("");
							$("input[name='genero']").val("");
							$("input[name='especie']").val("");
							$("input[name='nome']").val("");
							$("input[name='periodo']").val("");
							$("select[name='cod_relacao']").val("");
							paginacao(0);
							}else {
								console.log(data);
							}
						}
					});
				});
				
				//ALTERACAO
				$(document).on("click",".alteracao",function(){
					$.ajax({ 
						url: "altera_dinossauro.php",
						type: "post",
						data: {id: id, filo:$("input[name='filo']").val(), 
							reino:$("input[name='reino']").val(), 
							dominio:$("input[name='dominio']").val(), 
							ordem:$("input[name='ordem']").val(), 
							clado:$("input[name='clado']").val(), 
							familia:$("input[name='familia']").val(), 
							genero:$("input[name='genero']").val(), 
							especie:$("input[name='especie']").val(), 
							nome:$("input[name='nome']").val(), 
							periodo:$("input[name='periodo']").val(), 
							cod_relacao:$("select[name='cod_relacao']").val()},
						success: function(data){
							if(data==1){
								paginacao(0);
								$("input[name='filo']").val("");
								$("input[name='reino']").val("");
								$("input[name='dominio']").val("");
								$("input[name='ordem']").val(""); 
								$("input[name='clado']").val("");
								$("input[name='familia']").val("");
								$("input[name='genero']").val("");
								$("input[name='especie']").val("");
								$("input[name='nome']").val("");
								$("input[name='periodo']").val("");
								$("select[name='cod_relacao']").val("");
								$(".alteracao").attr("class","cadastrar");
								$(".cadastrar").val("Cadastrar");
							}else {
								console.log(data);
							}
						}
					});
				});
				
				//ALTERAÇÃO INLINE
				///////////////////////////INLINE FILO /////////////////////////////
					$(document).on("click",".filo",function(){
					td = $(this);
					filo = td.html();
					td.html("<input type = 'text' id = 'filo_alterar' value = '" + filo + "' />");
					td.attr("class","filo_alterar");
					$("#filo_alterar").focus();
				});
							
				$(document).on("blur",".filo_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'filo',
								valor: $("#filo_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							filo = $("#filo_alterar").val();
							td.html(filo);
							td.attr("class","filo");
						}
					});
				});	

				///////////////////////////INLINE REINO /////////////////////////////
					$(document).on("click",".reino",function(){
					td = $(this);
					reino = td.html();
					td.html("<input type = 'text' id = 'reino_alterar' value = '" + reino + "' />");
					td.attr("class","reino_alterar");
					$("#reino_alterar").focus();
				});
							
				$(document).on("blur",".reino_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'reino',
								valor: $("#reino_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							reino = $("#reino_alterar").val();
							td.html(reino);
							td.attr("class","reino");
						}
					});
				});	

				///////////////////////////INLINE DOMINIO /////////////////////////////
					$(document).on("click",".dominio",function(){
					td = $(this);
					dominio = td.html();
					td.html("<input type = 'text' id = 'dominio_alterar' value = '" + dominio + "' />");
					td.attr("class","dominio_alterar");
					$("#dominio_alterar").focus();
				});
							
				$(document).on("blur",".dominio_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'dominio',
								valor: $("#dominio_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							dominio = $("#dominio_alterar").val();
							td.html(dominio);
							td.attr("class","dominio");
						}
					});
				});
				
				///////////////////////////INLINE ORDEM /////////////////////////////
					$(document).on("click",".ordem",function(){
					td = $(this);
					ordem = td.html();
					td.html("<input type = 'text' id = 'ordem_alterar' value = '" + ordem + "' />");
					td.attr("class","ordem_alterar");
					$("#ordem_alterar").focus();
				});
							
				$(document).on("blur",".ordem_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'ordem',
								valor: $("#ordem_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							ordem = $("#ordem_alterar").val();
							td.html(ordem);
							td.attr("class","ordem");
						}
					});
				});
				
				///////////////////////////INLINE CLADO /////////////////////////////
					$(document).on("click",".clado",function(){
					td = $(this);
					clado = td.html();
					td.html("<input type = 'text' id = 'clado_alterar' value = '" + clado + "' />");
					td.attr("class","clado_alterar");
					$("#clado_alterar").focus();
				});
							
				$(document).on("blur",".clado_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'clado',
								valor: $("#clado_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							clado = $("#clado_alterar").val();
							td.html(clado);
							td.attr("class","clado");
						}
					});
				});
				
				///////////////////////////INLINE FAMILIA /////////////////////////////
					$(document).on("click",".familia",function(){
					td = $(this);
					familia = td.html();
					td.html("<input type = 'text' id = 'familia_alterar' value = '" + familia + "' />");
					td.attr("class","familia_alterar");
					$("#familia_alterar").focus();
				});
							
				$(document).on("blur",".familia_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'familia',
								valor: $("#familia_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							familia = $("#familia_alterar").val();
							td.html(familia);
							td.attr("class","familia");
						}
					});
				});
				
				///////////////////////////INLINE GENERO /////////////////////////////
					$(document).on("click",".genero",function(){
					td = $(this);
					genero = td.html();
					td.html("<input type = 'text' id = 'genero_alterar' value = '" + genero + "' />");
					td.attr("class","genero_alterar");
					$("#genero_alterar").focus();
				});
							
				$(document).on("blur",".genero_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'genero',
								valor: $("#genero_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							genero = $("#genero_alterar").val();
							td.html(genero);
							td.attr("class","genero");
						}
					});
				});
				
				///////////////////////////INLINE ESPECIE /////////////////////////////
					$(document).on("click",".especie",function(){
					td = $(this);
					especie = td.html();
					td.html("<input type = 'text' id = 'especie_alterar' value = '" + especie + "' />");
					td.attr("class","especie_alterar");
					$("#especie_alterar").focus();
				});
							
				$(document).on("blur",".especie_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'especie',
								valor: $("#especie_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							especie = $("#especie_alterar").val();
							td.html(especie);
							td.attr("class","especie");
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
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
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
				
				///////////////////////////INLINE PERIODO /////////////////////////////
					$(document).on("click",".periodo",function(){
					td = $(this);
					periodo = td.html();
					td.html("<input type = 'text' id = 'periodo_alterar' value = '" + periodo + "' />");
					td.attr("class","periodo_alterar");
					$("#periodo_alterar").focus();
				});
							
				$(document).on("blur",".periodo_alterar",function(){
					td = $(this).closest("td");
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'periodo',
								valor: $("#periodo_alterar").val(),
								id: id_linha},
						success: function(data){
							console.log(data);
							periodo = $("#periodo_alterar").val();
							td.html(periodo);
							td.attr("class","periodo");
						}
					});
				});
				
				///////////////////////////INLINE COD_RELACAO /////////////////////////////
					$(document).on("click",".cod_relacao",function(){
					td = $(this);
					cod_relacao = td.html();
					
					select = "<select id='cod_relacao_alterar'>";
					select += $("select[name='cod_relacao']").html();
					select += "</selected>";
					
					td.html(select);
					valor=$("option:contains('"+cod_relacao+"')").val();
					$("#cod_relacao_alterar").val(valor);
					$("#cod_relacao_alterar").focus();
					
					td.attr("class","alterar_cod_relacao");
				});
							
				$(document).on("blur",".alterar_cod_relacao",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val();
					$.ajax({
						url: "altera_inline.php",
						type: "post",
						data: {
								tabela: 'dinossauro', 
								coluna: 'cod_relacao',
								valor: $("#cod_relacao_alterar").val(),
								id: id_linha,
						},
						success: function(data){
							console.log(data);
							cod_relacao = $("#cod_relacao_alterar").val();
							cod_relacao = $("#cod_relacao_alterar").find("option[value='" + cod_relacao + "']").html();
							td.html(cod_relacao);
							td.attr("class","cod_relacao");
						}
					});
				});
			});
		</script>

	<div class='container-fluid' align='center'>
		<fieldset>
		<legend><h2>DINOSSAURO</h2></legend>
		<form method='post' action='insere_dinossauro.php'>
		
		<div class='form-row'>
		
			<div class='form-group col-md-12'>
				Nome :<br /><input class='form-control' type='text' name='nome' placeholder='Insira o nome do dinossauro...'/><br /><br />
			</div>	
			<div class='form-group col-md-6'>	
				Filo :<br /><input class='form-control' type='text' name='filo' placeholder='Insira a filo do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6'>
				Reino :<br /><input class='form-control' type='text' name='reino' placeholder='Insira o reino do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6'>
				Dominio :<br /><input class='form-control' type='text' name='dominio' placeholder='Insira o dominio do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6'>
				Ordem :<br /><input class='form-control' type='text' name='ordem' placeholder='Insira a ordem do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6'>
				Clado :<br /><input class='form-control' type='text' name='clado' placeholder='Insira o clado do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6'>
				Familia :<br /><input class='form-control' type='text' name='familia' placeholder='Insira a familia do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6'>
				Genero :<br /><input class='form-control' type='text' name='genero' placeholder='Insira o genero do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6'>
				Especie :<br /><input class='form-control' type='text' name='especie' placeholder='Insira a especie do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6'>
				Periodo :<br /><input class='form-control' type='text' name='periodo' placeholder='Insira o periodo do dinossauro...'/><br /><br />
			</div>
			<div class='form-group col-md-6' >
				Filial e Setor correspondente: <br /><select class='form-control' name = 'cod_relacao'>
							<option>:: Filial | Setor</option>
							<?php	
							while($linha=mysqli_fetch_assoc($resultado_relacao)){
								echo '<option value = "'. $linha["id_relacao"] .'">'. $linha["nome"]." | ". $linha["descricao"].'</option>';
							}
							?>
							
						</select>
						<br/><br/>
						<br/><br/>
			</div>
		</div>
			<input type = "button" class='cadastrar' value = "Enviar" id = "btn" />
		</form>
		<br />
		<br />
		</fieldset>
	</div>
	<?php 
	
	}
	
	else{
		header("Location: login.php");
	}
		?>
	<div class='container-fluid' align='center'>
	<div>
		<h3>Dinossauros</h3>
		<form name='fltro'>
			<input type ='text' name='nome_filtro' placeholder='filtrar por nome...' />
			
			<button type='button' id='filtrar'> Filtrar </button>
		</form>
		<br />
		<table border = "1">
		<thead>
			<tr>
				<th> Filo </th>
				<th> Reino </th>
				<th> Domínio </th>
				<th> Ordem </th>
				<th> Clado </th>
				<th> Família </th>
				<th> Gênero </th>
				<th> Espécie </th>
				<th> Nome </th>
				<th> Período </th>
				<th> Relação </th>
				<th> Ação </th>
			</tr>
		</thead>
		<tbody id = "tb_dinossauro">
			<div id = "resultado"></div>
		</tbody>
		<br />
		</table>
	</div>
	<div id='paginacao'>
	<?php
		include("paginacao_listar_dinossauro.php");
	?>
	</div>
	</div>
</body>
</html>