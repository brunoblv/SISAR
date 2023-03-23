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
		var date_input = $('input[name="datainicio"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datalimite"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datagendada"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datareal"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datapubliparecer"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datalimite2"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="dataagendada2"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datareal2"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datalimite3"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="dataagendada3"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datareal3"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})
	$(document).ready(function() {
		var date_input = $('input[name="datapublidec"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datapublicoord"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="datacumprimento"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})


	$(document).ready(function() {
		var date_input = $('input[name="datacomplementar"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			regional: 'pt-BR'
		})
	})

	$(document).ready(function() {
		var date_input = $('input[name="dataresp"]');
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
							<th>Copiar</th>
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
							$buscar_cadastros = "SELECT * FROM inicial WHERE id IN (SELECT controleinterno FROM admissibilidade WHERE parecer = 1) AND (id IN (SELECT controleinterno FROM smul) OR ID IN (SELECT controleinterno FROM secretarias)) AND sei LIKE '%$data%' ORDER BY id DESC";
						} else {
							$buscar_cadastros = "SELECT * FROM inicial WHERE id IN (SELECT controleinterno FROM admissibilidade WHERE parecer = 1) AND (id IN (SELECT controleinterno FROM smul) OR ID IN (SELECT controleinterno FROM secretarias)) ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
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
								<td><a class='btn btn-info btn-xs copiar'><span class="glyphicon glyphicon-edit"></span>Selecionar</a></td>
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
								<td><a class='btn btn-info btn-xs copiar'><span class="glyphicon glyphicon-edit"></span> Copiar</a></td>
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
					<li class="page-item"><a class="page-link" href="cadastroprimeirainstancia.php?pagina=1">Primeira</a></li>

					<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo "<li class='page-item'><a class='page-link' href='cadastroprimeirainstancia.php?pagina=$pag_ant'>$pag_ant</a></li>";
						}
					} ?>

					<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

					<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'><a class='page-link' href='cadastroprimeirainstancia.php?pagina=$pag_dep'>$pag_dep</a></li>";
						}
					}


					echo "<li class='page-item'><a class='page-link' href='cadastroprimeirainstancia.php?pagina=$quantidade_pg'>Última</a></li>";

					echo '</ul>';
					echo '</nav>';
					?>
		</div>
		<h4 class="mb-3">Primeira Instância</h4>
		<hr class="mb-4">
		<form class="need-validation" no validade method="POST" action="addprimeirainstancia.php" autocomplete="off" name="frm" onsubmit=" return verificarControleInterno();">
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="controleinterno" class="form-label">Nº de Controle Interno:</label>
					<input type="text" class="form-control" id="controleinterno" name="controleinterno" readonly>
				</div>
				<div class="col-md-6 mb-3">
					<label for="sei" class="form-label">Nº SEI:</label>
					<input type="text" class="form-control" id="sei" name="sei" readonly>
				</div>
			</div>
			<h5 class="mb-3">Primeiro GRAPROEM</h5>
			<hr class="mb-4">
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datainicio" class="form-label">Data de início da análise pela coordenadoria:</label>
					<input type="text" class="form-control" id="datainicio" name="datainicio">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datalimite" class="form-label">Data limite para análise pela coordenadoria:</label>
					<input type="text" class="form-control" id="datalimite" name="datalimite">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datagendada" class="form-label">Data agendada da primeira reunião do GRAPROEM:</label>
					<input type="text" class="form-control" id="datagendada" name="datagendada">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datareal" class="form-label">Data da realização do primeiro GRAPROEM:</label>
					<input type="text" class="form-control" id="datareal" name="datareal">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="motivodatadistinta" class="form-label">Motivo da realização do primeiro GRAPROEM ser em data distinta</label>
					<input type="text" class="form-control" id="motivodatadistinta" name="motivodatadistinta">
				</div>
				<div class="col-md-6 mb-3">
					<label for="parecer" class="form-label">Parecer do primeiro GRAPROEM ou Coordenadoria:</label>
					<input type="text" class="form-control" id="parecer" name="parecer">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datapubliparecer" class="form-label">Data de publicação do primeiro parecer do GRAPROEM ou Coordenadoria:</label>
					<input type="text" class="form-control" id="datapubliparecer" name="datapubliparecer">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datafimanalise" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
					<input type="text" class="form-control" id="datafimanalise" name="datafimanalise">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsvma" class="form-label">Data final da análise SVMA:</label>
					<input type="text" class="form-control" id="datafinalsvma" name="datafinalsvma">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datafinalsmt" class="form-label">Data final da análise SMT:</label>
					<input type="text" class="form-control" id="datafinalsmt" name="datafinalsmt">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsmc" class="form-label">Data final da análise SMC:</label>
					<input type="text" class="form-control" id="datafinalsmc" name="datafinalsmc">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datafinalsehab" class="form-label">Data final da análise SEHAB:</label>
					<input type="text" class="form-control" id="datafinalsehab" name="datafinalsehab">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsiurb" class="form-label">Data final da análise SIURB:</label>
					<input type="text" class="form-control" id="datafinalsiurb" name="datafinalsiurb">
				</div>
			</div>


			<!-- Segundo GRAPROEM-->

			<h5 class="mb-3">Segundo GRAPROEM</h5>
			<hr class="mb-4">
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datacumprimento" class="form-label">Data de cumprimento do Comunique-se:</label>
					<input type="text" class="form-control" id="datacumprimento" name="datacumprimento">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datalimite2" class="form-label">Data de envio para análise pela Coordenadoria/Secretarias:</label>
					<input type="text" class="form-control" id="dataenvio2" name="dataenvio2">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="dataagendada2" class="form-label">Data agendada da segunda reunião do GRAPROEM:</label>
					<input type="text" class="form-control" id="dataagendada2" name="dataagendada2">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datareal2" class="form-label">Data da realização do segundo GRAPROEM:</label>
					<input type="text" class="form-control" id="datareal2" name="datareal2">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="motivodatadistinta2" class="form-label">Motivo da realização do segundo GRAPROEM ser em data distinta</label>
					<input type="text" class="form-control" id="motivodatadistinta2" name="motivodatadistinta2">
				</div>
				<div class="col-md-6 mb-3">
					<label for="parecer2" class="form-label">Parecer do segundo GRAPROEM ou Coordenadoria:</label>
					<input type="text" class="form-control" id="parecer2" name="parecer2">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="comuniqcomplementar" class="form-label">Houve Comunique-se complementar?</label>
					<input type="text" class="form-control" id="comuniqcomplementar" name="comuniqcomplementar">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datacomplementar" class="form-label">Data de publicação do Comunique-se complementar</label>
					<input type="text" class="form-control" id="datacomplementar" name="datacomplementar">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="dataresp" class="form-label">Data resposta do Comunique-se complementar</label>
					<input type="text" class="form-control" id="dataresp" name="dataresp">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datafimanalise2" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
					<input type="text" class="form-control" id="datafimanalise2" name="datafimanalise2">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsvma2" class="form-label">Data final da análise SVMA:</label>
					<input type="text" class="form-control" id="datafinalsvma2" name="datafinalsvma2">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datafinalsmt2" class="form-label">Data final da análise SMT:</label>
					<input type="text" class="form-control" id="datafinalsmt2" name="datafinalsmt2">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsmc2" class="form-label">Data final da análise SMC:</label>
					<input type="text" class="form-control" id="datafinaldatafinalsmc2smc" name="datafinalsmc2">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datafinalsehab2" class="form-label">Data final da análise SEHAB:</label>
					<input type="text" class="form-control" id="datafinalsehab2" name="datafinalsehab2">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsiurb2" class="form-label">Data final da análise SIURB:</label>
					<input type="text" class="form-control" id="datafinalsiurb2" name="datafinalsiurb2">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datalimite2" class="form-label">Data limite da análise das Coordenadorias/Secretarias:</label>
					<input type="text" class="form-control" id="datalimite2" name="datalimite2">
				</div>
			</div>


			<!--GRAPROEM Complementar-->

			<h5 class="mb-3">GRAPROEM Complementar</h5>
			<hr class="mb-4">
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datalimite3" class="form-label">Data de envio para análise pela Coordenadoria/Secretarias:</label>
					<input type="text" class="form-control" id="datalimite3" name="datalimite3">
				</div>
				<div class="col-md-6 mb-3">
					<label for="dataagendada3" class="form-label">Data agendada do GRAPROEM Complementar:</label>
					<input type="text" class="form-control" id="dataagendada3" name="dataagendada3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datareal3" class="form-label">Data da realização do GRAPROEM Complementar:</label>
					<input type="text" class="form-control" id="datareal3" name="datareal3">
				</div>
				<div class="col-md-6 mb-3">
					<label for="motivodatadistinta2" class="form-label">Motivo da realização do GRAPROEM complementar ser em data distinta</label>
					<input type="text" class="form-control" id="motivodatadistinta3" name="motivodatadistinta3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="parecer3" class="form-label">Parecer do GRAPROEM Complementar:</label>
					<input type="text" class="form-control" id="parecer3" name="parecer3">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datapublidec" class="form-label">Data de publicação da decisão do GRAPROEM:</label>
					<input type="text" class="form-control" id="datapublidec" name="datapublidec">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafimanalise3" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
					<input type="text" class="form-control" id="datafimanalise3" name="datafimanalise3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsvma3" class="form-label">Data final da análise SVMA:</label>
					<input type="text" class="form-control" id="datafinalsvma3" name="datafinalsvma3">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datafinalsmt3" class="form-label">Data final da análise SMT:</label>
					<input type="text" class="form-control" id="datafinalsmt3" name="datafinalsmt3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsmc3" class="form-label">Data final da análise SMC:</label>
					<input type="text" class="form-control" id="datafinalsmc3" name="datafinalsmc3">
				</div>
				<div class="col-md-6 mb-3">
					<label for="datafinalsehab3" class="form-label">Data final da análise SEHAB:</label>
					<input type="text" class="form-control" id="datafinalsehab3" name="datafinalsehab3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datafinalsiurb3" class="form-label">Data final da análise SIURB:</label>
					<input type="text" class="form-control" id="datafinalsiurb3" name="datafinalsiurb3">
				</div>			
				<div class="col-md-6 mb-3">
					<label for="datapublicoord" class="form-label">Data de publicação do despacho da Coordenadoria Complementar:</label>
					<input type="text" class="form-control" id="datapublicoord" name="datapublicoord">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="datalimite2" class="form-label">Data limite da análise das Coordenadorias/Secretarias:</label>
					<input type="text" class="form-control" id="datalimite2" name="datalimite2">
				</div>
			</div>
			<div class="row">
			<div class="col-md-6 mb-3">
					<label for="obs" class="form-label">Observação:</label>
					<input type="text" class="form-control" id="obs" name="obs">
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
	</script>

	<script>
		var search = document.getElementById('pesquisar');

		search.addEventListener("keydown", function(event) {
			if (event.key === "Enter") {
				searchData();
			}
		});

		function searchData() {
			window.location = 'cadastroprimeirainstancia.php?search=' + search.value;
		}
	</script>
</body>

</html>