<?php
if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION['SesID'])) {
	session_destroy();
	header("Location: login.php");
	exit;
}
include 'conexao.php';
include 'navbar.php';

$login = $_SESSION['SesID'];
$permissao = $_SESSION['Perm'];
$status = $_SESSION['Status'];

if ($permissao == 2) {
	header("location: erropermissao.php");
}

//if ($row ==3){   

//  header("location: erropermissao.php");
//}

?>

<script>
	//Função para as caixas de data funcionarem corretamente.

	$(document).ready(function() {
		var date_input = $('input[name="dataenvio"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})
</script>
<!doctype html>
<html lang="pt-br">


<head>
	<?php include 'head.php'; ?>


</head>

<body>

	<style>
		tr {
			cursor: hand;
		}
	</style>

	<!-- Page Content  -->

	<div id="content" class="p-4 p-md-5 pt-5">
		<div class="input-group">
			<div class="form-outline">
				<input class="form-control" type="search" placeholder="Pesquisar" name="pesquisar" id="pesquisar">
				<button class="btn btn-outline-success" onclick="searchData()" type="submit">Pesquisar</button>
			</div>
		</div>
		<div class="input-group">
			<div class="table-responsive">
				<table class="table table-bordered" id="tabela">
					<thead>
						<tr>
							<th>Selecionar</th>
							<th>Nº Controle Interno</th>
							<th>Nº SEI</th>
							<th>Observação</th>
							<th>SQL</th>
							<th>Tipo</th>
							<th>Requerimento</th>
							<th>Nº Processo Físico</th>
							<th>Nº Aprova Digital</th>
							<th>Data Protocolo</th>
							<th>Tipo Processo</th>
							<th>Tipo Alvará</th>
							<th>Tipo Alvará</th>
							<th>Tipo Alvará</th>
							<th>Stand de Vendas</th>
							<th>Categoria</th>
							<th>Status</th>
							<th>Desc. Status</th>
							<th>Anterior ao Decreto</th>
						</tr>
					</thead>
					<tbody>
						<?php

						// Receber o número da página
						$pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
						$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

						//Setar a quantidade de itens por página
						$qnt_result_pg = 5;

						//Calcular o início da visualização
						$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

						if (!empty($_GET['search'])) {
							$data = $_GET['search'];
							$buscar_cadastros = "SELECT * FROM inicial WHERE id IN (SELECT controleinterno FROM admissibilidade WHERE parecer = 1) AND id NOT IN (select controleinterno from smul) AND sei LIKE '%$data%' ORDER BY id DESC";
						} else {
							$buscar_cadastros = "SELECT * FROM inicial WHERE id IN (SELECT controleinterno FROM admissibilidade WHERE parecer = 1) AND id NOT IN (select controleinterno from smul) ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
						}

						$query_cadastros = mysqli_query($conn, $buscar_cadastros);
						//Paginação - Somar a quantidade de processos                   


						$result_pg = "SELECT COUNT(id) AS num_result FROM inicial";
						$resultado_pg = mysqli_query($conn, $result_pg);
						$row_pg = mysqli_fetch_assoc($resultado_pg);
						//echo $row_pg['num_result'];
						$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

						//Limitar a quantidade de Links antes e depois
						$max_links = 2;

						while ($receber_cadastros = mysqli_fetch_array($query_cadastros)) {

							$controleinterno = $receber_cadastros['id'];
							$obs = $receber_cadastros['obs'];
							$numsql = $receber_cadastros['numsql'];
							$tipo = $receber_cadastros['tipo'];
							$req = $receber_cadastros['req'];
							$fisico = $receber_cadastros['fisico'];
							$aprovadigital = $receber_cadastros['aprovadigital'];
							$sei = $receber_cadastros['sei'];
							$dataprotocolo = $receber_cadastros['dataprotocolo'];
							$tipoprocesso = $receber_cadastros['tipoprocesso'];
							$tipoalvara1 = $receber_cadastros['tipoalvara1'];
							$tipoalvara2 = $receber_cadastros['tipoalvara2'];
							$tipoalvara3 = $receber_cadastros['tipoalvara3'];
							$stand = $receber_cadastros['stand'];
							$categoria = $receber_cadastros['categoria'];
							$sts = $receber_cadastros['sts'];
							$descstatus = $receber_cadastros['descstatus'];
							$decreto = $receber_cadastros['decreto'];
						?>
							<tr>
								<td><a class='btn btn-info btn-xs copiar'><span class="glyphicon glyphicon-edit"></span> Selecionar</a></td>
								<td class="ci" scope="row"><?php echo $controleinterno ?></td>
								<td class="sei"><?php echo $sei ?></td>
								<td><?php echo $obs ?></td>
								<td><?php echo $numsql ?></td>
								<td><?php echo $tipo ?></td>
								<td><?php echo $req ?></td>
								<td><?php echo $fisico ?></td>
								<td><?php echo $aprovadigital ?></td>
								<td><?php echo $dataprotocolo ?></td>
								<td><?php echo $tipoprocesso ?></td>
								<td><?php echo $tipoalvara1 ?></td>
								<td><?php echo $tipoalvara2 ?></td>
								<td><?php echo $tipoalvara3 ?></td>
								<td><?php echo $stand ?></td>
								<td><?php echo $categoria ?></td>
								<td><?php echo $status ?></td>
								<td><?php echo $descstatus ?></td>
								<td><?php echo $decreto ?></td>
								<script>
									$(function() {
										$('.copiar').click(function(event) {
											var copyValue =
												// inicia seletor jQuery com o objeto clicado (no caso o elemento <a class="copiar">)
												$(event.target)
												// closest (https://api.jquery.com/closest/) retorna o seletor no tr da linha clicada 
												.closest("tr")
												// procura a <td> com a class target-copy
												.find("td.ci")
												// obtem o text no conteúdo do elemento <td>
												.text()
												// remove possiveis espaços no incio e fim da string
												.trim();

											// seleciona o input com id desejado
											$('#controleinterno')
												// seta o valor copiado para o input id=senha
												.val(copyValue);
										});
									});
									$(function() {
										$('.copiar').click(function(event) {
											var copyValue =
												// inicia seletor jQuery com o objeto clicado (no caso o elemento <a class="copiar">)
												$(event.target)
												// closest (https://api.jquery.com/closest/) retorna o seletor no tr da linha clicada 
												.closest("tr")
												// procura a <td> com a class target-copy
												.find("td.sei")
												// obtem o text no conteúdo do elemento <td>
												.text()
												// remove possiveis espaços no incio e fim da string
												.trim();

											// seleciona o input com id desejado
											$('#sei')
												// seta o valor copiado para o input id=senha
												.val(copyValue);
										});
									});
								</script>



							</tr>

						<?php }; ?>
					</tbody>
				</table>

			</div>
			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<li class="page-item"><a class="page-link" href="cadastrosmul.php?pagina=1">Primeira</a></li>

					<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo "<li class='page-item'><a class='page-link' href='cadastrosmul.php?pagina=$pag_ant'>$pag_ant</a></li>";
						}
					} ?>

					<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

					<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'><a class='page-link' href='cadastrosmul.php?pagina=$pag_dep'>$pag_dep</a></li>";
						}
					}


					echo "<li class='page-item'><a class='page-link' href='cadastrosmul.php?pagina=$quantidade_pg'>Última</a></li>";

					echo '</ul>';
					echo '</nav>';



					?>
		</div>
		<h4 class="mb-3">Cadastro SMUL</h4>
		<hr class="mb-4">
		<form class="need-validation" no validade method="POST" action="addsmul.php" autocomplete="off" name="frm" onsubmit=" return verificarControleInterno();">
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="controleinterno" class="form-label">Nº de Controle Interno:</label>
					<input type="text" class="form-control" id="controleinterno" name="controleinterno" required="required" readonly>
				</div>
				<div class="col-md-6 mb-3">
					<label for="ci" class="form-label">Nº SEI:</label>
					<input type="text" class="form-control" id="sei" name="sei" required="required" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="coordenadoria" class="form-label">Coordenadoria responsável:</label>
					<select class="form-select" aria-label="Default select example" name="coordenadoria" id="Coordenadoria">
						<option selected></option>
						<option>COMIN</option>
						<option>PARHIS</option>
						<option>RESID</option>
						<option>SERVIN</option>
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="divisao" class="form-label">Divisão responsável:</label>
					<select class="form-select" aria-label="Default select example" name="divisao" id="divisao">
						<option selected></option>
						<option>DRPM</option>
						<option>DRGP</option>
						<option>DRU</option>
						<option>DCIMP</option>
						<option>DCIGP</option>
						<option>DSIMP</option>
						<option>DSIGP</option>
						<option>DHIS</option>
						<option>DHMP</option>
						<option>DPS</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="tec" class="form-label">Técnico da Coordenadoria responsável:</label>
					<input type="text" class="form-control" id="tec" name="tec" required="required">
				</div>
				<div class="col-md-6 mb-3">
					<label for="sub" class="form-label">Subprefeitura:</label>
					<select class="form-select" aria-label="Default select example" name="subprefeitura" id="subprefeitura">
						<option selected></option>
						<option value="1">Aricanduva/Formosa/Carrão</option>
						<option value="2">Butantã</option>
						<option value="3">Campo Limpo</option>
						<option value="4">Capela do Socorro</option>
						<option value="5">Cidade Ademar</option>
						<option value="6">Cidade Tiradentes</option>
						<option value="7">Ermelino Matarazzo</option>
						<option value="8">Freguesia/Brasilândia</option>
						<option value="9">Guaianases</option>
						<option value="10">Ipiranga</option>
						<option value="11">Itaim Paulista</option>
						<option value="12">Jabaquara</option>
						<option value="13">Jaçanã/Tremembé</option>
						<option value="14">Lajeado</option>
						<option value="15">Lapa</option>
						<option value="16">M'Boi Mirim</option>
						<option value="17">Mooca</option>
						<option value="18">Parelheiros</option>
						<option value="19">Penha</option>
						<option value="20">Perus</option>
						<option value="21">Pinheiros</option>
						<option value="22">Pirituba/Jaraguá</option>
						<option value="23">Santana/Tucuruvi</option>
						<option value="24">Santo Amaro</option>
						<option value="25">São Mateus</option>
						<option value="26">São Miguel</option>
						<option value="27">Sé</option>
						<option value="28">Tatuapé</option>
						<option value="29">Vila Formosa</option>
						<option value="30">Vila Maria/Vila Guilherme</option>
						<option value="31">Vila Mariana</option>
						<option value="32">Vila Prudente/Sapopemba</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="tec2" class="form-label">Técnico da Coordenadoria após redistribuição:</label>
					<input type="text" class="form-control" id="tec2" name="tec2" required="required">
				</div>
				<div class="col-md-6 mb-3">
					<label for="dataenvio" class="form-label">Data de envio do processo para a Coordenadoria:</label>
					<input type="text" class="form-control" id="dataenvio" name="dataenvio" required="required">
				</div>
			</div>
			<button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
		</form>
	</div>
	<script>
		function verificarControleInterno() {
			var input = document.getElementsByName("controleinterno")[0];

			if (input.value === "") {
				alert("Selecione o processo na tabela acima");
				return false;
			} else {
				return true;
			}
		}
	
		var search = document.getElementById('pesquisar');

		search.addEventListener("keydown", function(event) {
			if (event.key === "Enter") {
				searchData();
			}
		});

		function searchData() {
			window.location = 'cadastrosmul.php?search=' + search.value;
		}
	</script>
</body>

</html>