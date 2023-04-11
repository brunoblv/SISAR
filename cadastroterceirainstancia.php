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
		var date_input = $('input[name="dataad"]');
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
		<div id="tabela">
			<div class="card bg-light mb-3">
				<div class="card-header">
					<strong>Processos aguardando 1ª Instância</strong>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="d-flex align-items-center">
							<div>
								<input class="form-control form-control-sm" type="search" placeholder="Pesquisar com o N° SEI" name="pesquisar" id="pesquisar">
							</div>
							<div class="ml-2">
								<button class="btnpesquisa btn-outline-success" onclick="searchData()" type="submit">Pesquisar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="table table-sm">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Copiar</th>
							<th>Nº Controle Interno</th>
							<th>Nº SEI</th>
							<th>SQL</th>
							<th>Técnico ATECC</th>
							<th>Data Protocolo</th>
							<th>Tipo Processo</th>
							<th>Tipo Alvará</th>
							<th>Tipo Alvará</th>
							<th>Tipo Alvará</th>
							<th>Status</th>
							<th>Anterior ao Decreto</th>

						</tr>
					</thead>
					<tbody>
						<?php

						// Receber o número da página
						$pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
						$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

						//Setar a quantidade de itens por página
						$qnt_result_pg = 10;

						//Calcular o início da visualização
						$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

						if (!empty($_GET['search'])) {
							$data = $_GET['search'];
							$buscar_cadastros = "SELECT Inicial.*, distribuicao.tec FROM inicial JOIN distribuicao ON inicial.id = distribuicao.controleinterno WHERE id IN (SELECT controleinterno FROM distribuicao) AND id NOT IN (SELECT controleinterno FROM admissibilidade) AND sei LIKE '%$data%' ORDER BY id DESC";
						} else {
							$buscar_cadastros = "SELECT Inicial.*, distribuicao.tec FROM inicial JOIN distribuicao ON inicial.id = distribuicao.controleinterno  WHERE id IN (SELECT controleinterno FROM distribuicao)AND id NOT IN (SELECT controleinterno FROM admissibilidade) ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
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
							$sts = $receber_cadastros['sts'];
							$descstatus = $receber_cadastros['descstatus'];
							$decreto = $receber_cadastros['decreto'];

							// Invertendo a data do SQL para o formato brasileiro

							$inverted_date = date("d/m/Y", strtotime($dataprotocolo));


							switch ($tipoprocesso) {
								case 1:
									$tipoprocesso = 'Próprio de SMUL';
									break;
								case 2:
									$tipoprocesso = 'Múltiplas Interfaces';
									break;
							}

							switch ($tipoalvara1) {
								case 1:
									$tipoalvara1 = 'Nada';
									break;
								case 2:
									$tipoalvara1 = 'Projeto Modificativo';
									break;
							}

							switch ($tipoalvara2) {
								case 1:
									$tipoalvara2 = 'Alvará de Aprovação';
									break;
								case 2:
									$tipoalvara2 = 'Alvará de Aprovação e Execução';
									break;
								case 3:
									$tipoalvara2 = 'Alvará de Execução';
									break;
							}

							switch ($tipoalvara3) {
								case 1:
									$tipoalvara3 = 'Edificação Nova';
									break;
								case 2:
									$tipoalvara3 = 'Reforma';
									break;
								case 3:
									$tipoalvara3 = 'Requalificação';
									break;
								case 4:
									$tipoalvara3 = 'Requalificação associada a reforma';
									break;
							}

							switch ($sts) {
								case 1:
									$sts = 'Análise de Admissibilidade';
									break;
								case 2:
									$sts = 'Inadmissível/Via ordinária';
									break;
								case 3:
									$sts = 'Em análise';
									break;
								case 4:
									$sts = 'Deferido';
									break;
								case 5:
									$sts = 'Indeferido';
									break;
								case 6:
									$sts = 'Inválido';
									break;
							}


							$tec = $receber_cadastros['tec'];
						?>
							<tr>
								<td><a class='btnpesquisa btn-outline-info copiar botaoselecao'><span class="glyphicon glyphicon-edit"></span>Selecionar</a></td>
								<td class="ci" scope="row"><?php echo $controleinterno ?></td>
								<td class="sei"><?php echo $sei ?></td>
								<td><?php echo $numsql ?></td>
								<td><?php echo $tec ?></td>
								<td><?php echo $inverted_date ?></td>
								<td><?php echo $tipoprocesso ?></td>
								<td><?php echo $tipoalvara1 ?></td>
								<td><?php echo $tipoalvara2 ?></td>
								<td><?php echo $tipoalvara3 ?></td>
								<td><?php echo $status ?></td>
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
		<div id="form" hidden>
			<form class="need-validation" no validade method="POST" action="addprimeirainstancia.php" autocomplete="off" name="formulario" id="formulario">
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados do Processo</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-2">
								<label for="sei" class="form-label">N° de Controle interno:</label>
								<input type="text" class="form-control form-control-sm" id="controleinterno" readonly name="controleinterno" value="<?php echo htmlspecialchars($controleinterno); ?>"></input>
							</div>
							<div class="col col-2">
								<label for="sei" class="form-label">N° do Processo SEI:</label>
								<input type="text" class="form-control form-control-sm" id="sei" readonly name="sei" value="<?php echo htmlspecialchars($sei); ?>"></input>
							</div>

							<!-- Convertendo a data de Protocolo para DD/MM/AAAA-->
							<?php

							$inverted_date = date("d/m/Y", strtotime($dataprotocolo));

							$datalimite = date('Y-m-d', strtotime($dataprotocolo . ' + 15 days'));

							$datalimite = date("d/m/Y", strtotime($datalimite));

							?>

							<div class="col col-2">
								<label for="dataprotocolo" class="form-label">Data de Protocolo:</label>
								<input type="text" class="form-control form-control-sm" id="dataprotocolo" readonly name="dataprotocolo" value="<?php echo htmlspecialchars($inverted_date); ?>"></input>
							</div>
							<div class="col col-2">
								<label for="datalimite" class="form-label">Data limite de análise:</label>
								<input type="text" class="form-control form-control-sm" id="datalimite" readonly name="datalimite" value="<?php echo htmlspecialchars($datalimite); ?>"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Primeiro GRAPROEM</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de início da análise pela coordenadoria/secretarias:</label>
								<input type="text" class="form-control" id="datainicio" name="datainicio">
							</div>
							<div class="col col-4">
								<label for="datalimite" class="form-label">Data limite para análise pela coordenadoria/secretarias:</label>
								<input type="text" class="form-control" id="datalimite" name="datalimite">
							</div>
							<div class="col col-4">
								<label for="datagendada" class="form-label">Data agendada da primeira reunião do GRAPROEM:</label>
								<input type="text" class="form-control" id="datagendada" name="datagendada">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datareal" class="form-label">Data da realização do primeiro GRAPROEM:</label>
								<input type="text" class="form-control" id="datareal" name="datareal">
							</div>
							<div class="col col-4">
								<label for="motivodatadistinta" class="form-label">Motivo da realização do primeiro GRAPROEM ser em data distinta</label>
								<input type="text" class="form-control" id="motivodatadistinta" name="motivodatadistinta">
							</div>
							<div class="col col-4">
								<label for="parecer" class="form-label">Parecer do primeiro GRAPROEM ou Coordenadoria:</label>
								<input type="text" class="form-control" id="parecer" name="parecer">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datapubliparecer" class="form-label">Data de publicação do primeiro parecer do GRAPROEM ou Coordenadoria:</label>
								<input type="text" class="form-control" id="datapubliparecer" name="datapubliparecer">
							</div>
							<div class="col col-4">
								<label for="datafimanalise" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
								<input type="text" class="form-control" id="datafimanalise" name="datafimanalise">
							</div>
							<div class="col col-4">
								<label for="datafinalsvma" class="form-label">Data final da análise SVMA:</label>
								<input type="text" class="form-control" id="datafinalsvma" name="datafinalsvma">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datafinalsmt" class="form-label">Data final da análise SMT:</label>
								<input type="text" class="form-control" id="datafinalsmt" name="datafinalsmt">
							</div>

							<div class="col col-4">
								<label for="datafinalsmc" class="form-label">Data final da análise SMC:</label>
								<input type="text" class="form-control" id="datafinalsmc" name="datafinalsmc">
							</div>
							<div class="col col-4">
								<label for="datafinalsehab" class="form-label">Data final da análise SEHAB:</label>
								<input type="text" class="form-control" id="datafinalsehab" name="datafinalsehab">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-3">
								<label for="datafinalsiurb" class="form-label">Data final da análise SIURB:</label>
								<input type="text" class="form-control" id="datafinalsiurb" name="datafinalsiurb">
							</div>
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Segundo GRAPROEM</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-4">
								<label for="datacumprimento" class="form-label">Data de cumprimento do Comunique-se:</label>
								<input type="text" class="form-control" id="datacumprimento" name="datacumprimento">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de início da análise pela coordenadoria/Secretarias:</label>
								<input type="text" class="form-control" id="datainicio2" name="datainicio2">
							</div>
							<div class="col col-4">
								<label for="datalimite" class="form-label">Data limite para análise pela coordenadoria/Secretarias:</label>
								<input type="text" class="form-control" id="datalimite2" name="datalimite2">
							</div>
							<div class="col col-4">
								<label for="datagendada" class="form-label">Data agendada da segunda reunião do GRAPROEM:</label>
								<input type="text" class="form-control" id="datagendada2" name="datagendada2">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datareal" class="form-label">Data da realização do segundo GRAPROEM:</label>
								<input type="text" class="form-control" id="datareal2" name="datareal2">
							</div>
							<div class="col col-4">
								<label for="motivodatadistinta" class="form-label">Motivo da realização do segundo GRAPROEM ser em data distinta</label>
								<input type="text" class="form-control" id="motivodatadistinta2" name="motivodatadistinta2">
							</div>
							<div class="col col-4">
								<label for="parecer" class="form-label">Parecer do segundo GRAPROEM ou Coordenadoria:</label>
								<input type="text" class="form-control" id="parecer2" name="parecer2">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="comuniqcomplementar" class="form-label">Houve Comunique-se complementar?</label>
								<input type="text" class="form-control" id="comuniqcomplementar" name="comuniqcomplementar">
							</div>
							<div class="col col-4">
								<label for="datacomplementar" class="form-label">Data de publicação do Comunique-se complementar</label>
								<input type="text" class="form-control" id="datacomplementar" name="datacomplementar">
							</div>
							<div class="col col-4">
								<label for="dataresp" class="form-label">Data resposta do Comunique-se complementar</label>
								<input type="text" class="form-control" id="dataresp" name="dataresp">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datapubliparecer" class="form-label">Data de publicação do segundo parecer GRAPROEM/Coordenadoria:</label>
								<input type="text" class="form-control" id="datapubliparecer" name="datapubliparecer">
							</div>
							<div class="col col-4">
								<label for="datafimanalise" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
								<input type="text" class="form-control" id="datafinalsmul2" name="datafinalsmul2">
							</div>
							<div class="col col-4">
								<label for="datafinalsvma" class="form-label">Data final da análise SVMA:</label>
								<input type="text" class="form-control" id="datafinalsvma2" name="datafinalsvma2">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datafinalsmt" class="form-label">Data final da análise SMT:</label>
								<input type="text" class="form-control" id="datafinalsmt2" name="datafinalsmt2">
							</div>

							<div class="col col-4">
								<label for="datafinalsmc" class="form-label">Data final da análise SMC:</label>
								<input type="text" class="form-control" id="datafinalsmc2" name="datafinalsmc2">
							</div>
							<div class="col col-4">
								<label for="datafinalsehab" class="form-label">Data final da análise SEHAB:</label>
								<input type="text" class="form-control" id="datafinalsehab2" name="datafinalsehab2">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datafinalsiurb" class="form-label">Data final da análise SIURB:</label>
								<input type="text" class="form-control" id="datafinalsiurb2" name="datafinalsiurb2">
							</div>
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>GRAPROEM complementar</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de início da análise pela coordenadoria/Secretarias:</label>
								<input type="text" class="form-control" id="datainicio3" name="datainicio3">
							</div>
							<div class="col col-4">
								<label for="datalimite" class="form-label">Data limite para análise pela coordenadoria/Secretarias:</label>
								<input type="text" class="form-control" id="datalimite3" name="datalimite3">
							</div>
							<div class="col col-4">
								<label for="datagendada" class="form-label">Data agendada da segunda reunião do GRAPROEM:</label>
								<input type="text" class="form-control" id="datagendada3" name="datagendada3">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datareal" class="form-label">Data da realização do segundo GRAPROEM:</label>
								<input type="text" class="form-control" id="datareal3" name="datareal3">
							</div>
							<div class="col col-4">
								<label for="motivodatadistinta" class="form-label">Motivo da realização do segundo GRAPROEM ser em data distinta</label>
								<input type="text" class="form-control" id="motivodatadistinta3" name="motivodatadistinta3">
							</div>
							<div class="col col-4">
								<label for="parecer" class="form-label">Data de publicação da decisão do GRAPROEM:</label>
								<input type="text" class="form-control" id="datapublidec" name="datapublidec">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datafimanalise" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
								<input type="text" class="form-control" id="datafinalsmul2" name="datafinalsmul2">
							</div>
							<div class="col col-4">
								<label for="datafinalsvma" class="form-label">Data final da análise SVMA:</label>
								<input type="text" class="form-control" id="datafinalsvma2" name="datafinalsvma2">
							</div>
							<div class="col col-4">
								<label for="datafinalsmt" class="form-label">Data final da análise SMT:</label>
								<input type="text" class="form-control" id="datafinalsmt2" name="datafinalsmt2">
							</div>
						</div>
						<div class="form-row">
							<div class="col col-4">
								<label for="datafinalsmc" class="form-label">Data final da análise SMC:</label>
								<input type="text" class="form-control" id="datafinalsmc2" name="datafinalsmc2">
							</div>
							<div class="col col-4">
								<label for="datafinalsehab" class="form-label">Data final da análise SEHAB:</label>
								<input type="text" class="form-control" id="datafinalsehab2" name="datafinalsehab2">
							</div>
							<div class="col col-4">
								<label for="datafinalsiurb" class="form-label">Data final da análise SIURB:</label>
								<input type="text" class="form-control" id="datafinalsiurb2" name="datafinalsiurb2">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>


	<script>
		var search = document.getElementById('pesquisar');

		search.addEventListener("keydown", function(event) {
			if (event.key === "Enter") {
				searchData();
			}
		});

		function searchData() {
			window.location = 'cadastroadmissibilidade.php?search=' + search.value;
		}

		const button = document.querySelectorAll('.botaoselecao');
		const form = document.getElementById('form');
		const tabela = document.getElementById('tabela');

		[...button].forEach((botao) => {
			botao.addEventListener('click', () => {
				form.removeAttribute('hidden');
				tabela.setAttribute('hidden', true);
			});
		});

		const cancelar = document.getElementById('cancelar');

		cancelar.addEventListener('click', () => {
			form.setAttribute('hidden', true);
			tabela.setAttribute('hidden', false);
		});

		var btnCancelar = document.getElementById('cancelar');
		var divForm = document.getElementById('form');
		var divTabela = document.getElementById('tabela');

		btnCancelar.addEventListener('click', function() {
			divForm.hidden = true;
			divTabela.hidden = false;
		});

		const selectElement = document.getElementById('parecer');
		const motivosElement = document.querySelector('.motivos');
		const dataenvio = document.getElementById('dataenvio');
		const coordenadoria = document.getElementById('coordenadoria');

		selectElement.addEventListener('change', function() {
			if (this.value === '2') {
				motivosElement.style.display = 'block';
				dataenvio.readOnly = true;
				coordenadoria.disabled = true;
				dataenvio.removeAttribute('required');
				coordenadoria.removeAttribute('required');
			} else {
				motivosElement.style.display = 'none';
				dataenvio.readOnly = false;
				coordenadoria.disabled = false;
				dataenvio.setAttribute('required', true);
				coordenadoria.setAttribute('required', true);
			}
		});
	</script>
	</div>
	</div>




</body>

</html>