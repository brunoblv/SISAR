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
		var date_input = $('input[name="dataoutorga"]');
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
		var date_input = $('input[name="dataresposta"]');
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
		var date_input = $('input[name="dataemissao"]');
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
		var date_input = $('input[name="dataapostilamento"]');
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
		var date_input = $('input[name="datatermo"]');
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
		var date_input = $('input[name="dataconclusao"]');
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
					<strong>Cadastro coordenadoria de SMUL</strong>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="d-flex align-items-center">
							<div>
								<input class="form-control form-control-sm form-control form-control-sm-sm" type="search" placeholder="Pesquisar com o N° SEI" name="pesquisar" id="pesquisar">
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
							<th>Data Protocolo</th>
							<th>Data de envio para Coordenadoria/Secretarias</th>
							<th>Tipo Processo</th>
							<th>Coordenadoria/Divisão</th>

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
							$buscar_cadastros = "SELECT i.id, i.sei, i.numsql, i.tipoprocesso, i.dataprotocolo, a.dataenvio, a.coordenadoria
							FROM inicial i
							INNER JOIN admissibilidade a ON i.id = a.controleinterno AND a.parecer = 1
							UNION
							SELECT i.id, i.sei, i.numsql, i.tipoprocesso, i.dataprotocolo, r.dataenvio, r.coordenadoria
							FROM inicial i
							INNER JOIN reconad r ON i.id = r.controleinterno AND r.parecer = 1
							WHERE i.sei = '%$data%'";
						} else {
							$buscar_cadastros = "SELECT i.id, i.sei, i.numsql, i.tipoprocesso, i.dataprotocolo, a.dataenvio, a.coordenadoria
							FROM inicial i
							INNER JOIN admissibilidade a ON i.id = a.controleinterno AND a.parecer = 1
							UNION
							SELECT i.id, i.sei, i.numsql, i.tipoprocesso, i.dataprotocolo, r.dataenvio as rdataenvio, r.coordenadoria as rcoord
							FROM inicial i
							INNER JOIN reconad r ON i.id = r.controleinterno AND r.parecer = 1
							LIMIT $inicio, $qnt_result_pg";
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
							$numsql = $receber_cadastros['numsql'];
							$sei = $receber_cadastros['sei'];
							$dataprotocolo = $receber_cadastros['dataprotocolo'];
							$tipoprocesso = $receber_cadastros['tipoprocesso'];
							$dataenvio = $receber_cadastros['dataenvio'];
							$coordenadoria = $receber_cadastros['coordenadoria'];





							// Invertendo a data do SQL para o formato brasileiro




							switch ($tipoprocesso) {
								case 1:
									$tipoprocesso = 'Próprio de SMUL';
									break;
								case 2:
									$tipoprocesso = 'Múltiplas Interfaces';
									break;
							}

							switch ($coordenadoria) {
								case 1:
									$coordenadoria = 'COMIN';
									break;
								case 2:
									$coordenadoria = 'COMIN/DCIGP';
									break;
								case 3:
									$coordenadoria = 'COMIN/DCIMP';
									break;
								case 4:
									$coordenadoria = 'PARHIS';
									break;
								case 5:
									$coordenadoria = 'PARHIS/DHIS';
									break;
								case 6:
									$coordenadoria = 'PARHIS/DHMP';
									break;
								case 7:
									$coordenadoria = 'PARHIS/DPS';
									break;
								case 8:
									$coordenadoria = 'RESID';
									break;
								case 9:
									$coordenadoria = 'RESID/DRPM';
									break;
								case 10:
									$coordenadoria = 'RESID/DRGP';
									break;
								case 11:
									$coordenadoria = 'RESID/DRU';
									break;
								case 12:
									$coordenadoria = 'SERVIN';
									break;
								case 13:
									$coordenadoria = 'SERVIN/DSIGP';
									break;
								case 14:
									$coordenadoria = 'SERVIN/DCIMP';
									break;
							}


							$dataprotocolo_br = date("d/m/Y", strtotime($dataprotocolo));
							$dataenvio_br = date("d/m/Y", strtotime($dataenvio));





						?>
							<tr>
								<td><a class='btnpesquisa btn-outline-info copiar botaoselecao'><span class="glyphicon glyphicon-edit"></span>Selecionar</a></td>
								<td class="ci" scope="row"><?php echo $controleinterno ?></td>
								<td class="sei"><?php echo $sei ?></td>
								<td><?php echo $numsql ?></td>
								<td><?php echo $dataprotocolo_br ?></td>
								<td><?php echo $dataenvio_br ?></td>
								<td><?php echo $tipoprocesso ?></td>
								<td><?php echo $coordenadoria ?></td>


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
					<li class="page-item"><a class="page-link" href="cadastroconclusao.php?pagina=1">Primeira</a></li>

					<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo "<li class='page-item'><a class='page-link' href='cadastroconclusao.php?pagina=$pag_ant'>$pag_ant</a></li>";
						}
					} ?>

					<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

					<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'><a class='page-link' href='cadastroconclusao.php?pagina=$pag_dep'>$pag_dep</a></li>";
						}
					}


					echo "<li class='page-item'><a class='page-link' href='cadastroconclusao.php?pagina=$quantidade_pg'>Última</a></li>";

					echo '</ul>';
					echo '</nav>';



					?>
		</div>
		<div id="form" hidden>
			<form class="need-validation" no validade method="POST" action="addconclusao.php" autocomplete="off" name="formulario" id="formulario">
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados do Processo</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-3">
								<label for="sei" class="form-label">N° de Controle interno:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="controleinterno" readonly name="controleinterno" required="required" value="<?php echo htmlspecialchars($controleinterno); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="sei" class="form-label">N° do Processo SEI:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="sei" readonly name="sei" required="required" value="<?php echo htmlspecialchars($sei); ?>"></input>
							</div>

							<!-- Convertendo a data de Protocolo para DD/MM/AAAA-->
							<?php



							if ($tipoprocesso == 1) {

								$datalimiteanalise = date('Y-m-d', strtotime($dataenvio . ' + 30 days'));
								$datalimiteprazo = date('Y-m-d', strtotime($dataprotocolo . ' + 30 days'));
								// echo $dataprotocolo;
								//echo $datalimiteprazo;

							} else {

								$datalimiteanalise = date('Y-m-d', strtotime($dataenvio . ' + 60 days'));
								$datalimiteprazo = date('Y-m-d', strtotime($dataprotocolo . ' + 60 days'));
								//echo $datalimiteanalise;
								//echo $datalimiteprazo;
							}



							$datalimiteanalise = date("d/m/Y", strtotime($datalimiteanalise));
							$datalimiteprazo = date("d/m/Y", strtotime($datalimiteprazo));

							$dataprotocolo2 = date("d/m/Y", strtotime($dataprotocolo));
							$dataenvio2 = date("d/m/Y", strtotime($dataenvio));

							?>

							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Coordenadoria/Divisão:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataprotocolo" readonly name="dataprotocolo" required="required" value="<?php echo htmlspecialchars($coordenadoria); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="datalimite" class="form-label">Data de Protocolo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="datalimite" readonly name="datalimite" required="required" value="<?php echo htmlspecialchars($dataprotocolo2); ?>"></input>
							</div>
						</div>
						<div class="form-row">
							<div class="col col-3">
								<label for="tipoprocesso" class="form-label">Tipo de Processo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="tipoprocesso" readonly name="tipoprocesso" required="required" value="<?php echo htmlspecialchars($tipoprocesso); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="tipoprocesso" class="form-label">Data de envio para Coordenadoria:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="tipoprocesso" readonly name="tipoprocesso" required="required" value="<?php echo htmlspecialchars($dataenvio_br); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Data limite para análise técnica da Coordenadoria:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataprotocolo" readonly name="dataprotocolo" required="required" value="<?php echo htmlspecialchars($datalimiteanalise); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Data limite para 45/75 dias:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataprotocolo" readonly name="dataprotocolo" required="required" value="<?php echo htmlspecialchars($datalimiteprazo); ?>"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados para conclusão</strong>
					</div>
					<div class="card-body">

						<div>
							<form class="need-validation" no validade method="POST" action="addconclusao.php" autocomplete="off" name="frm" onsubmit=" return verificarControleInterno();">
								<div class="form-row">
									<div class="col col-3">
										<label for="outorga" class="form-label">Há Outorga?:</label>
										<select class="form-select" id="outorga" required name="outorga">
											<option></option>
											<option value="1">Sim</option>
											<option value="0">Não</option>
										</select>
									</div>
									<div class="col col-3">
										<label for="dataoutorga" class="form-label">Data de início do Comunique-se de Outorga:</label>
										<input type="text" class="form-control form-control-sm" id="dataoutorga" name="dataoutorga" required="required">
									</div>
									<div class="col col-3">
										<label for="dataresposta" class="form-label">Data de resposta do Comunique-se de Outorga:</label>
										<input type="text" class="form-control form-control-sm" id="dataresposta" name="dataresposta" required="required">
									</div>
									<div class="col col-3">
										<label for="dataemissao" class="form-label">Data de emissão do Alvará:</label>
										<input type="text" class="form-control form-control-sm" id="dataemissao" name="dataemissao" required="required">
									</div>
								</div>
								<div class="form-row">
									<div class="col col-3">
										<label for="numeroalvara" class="form-label">Número do Alvará:</label>
										<input type="text" class="form-control form-control-sm" id="numeroalvara" name="numeroalvara" required="required">
									</div>
									<div class="col col-3">
										<label for="dataapostilamento" class="form-label">Data do pedido de apostilamento:</label>
										<input type="text" class="form-control form-control-sm" id="dataapostilamento" name="dataapostilamento" required="required">
									</div>
									<div class="col col-3">
										<label for="datatermo" class="form-label">Data de assinatura do termo de encerramento:</label>
										<input type="text" class="form-control form-control-sm" id="datatermo" name="datatermo" required="required">
									</div>
									<div class="col col-3">
										<label for="dataconclusao" class="form-label">Data da conclusão do processo SEI:</label>
										<input type="text" class="form-control form-control-sm" id="dataconclusao" name="dataconclusao" required="required">
									</div>
								</div>
								<div>
									<label class="form-label" for="obs">Observação:</label>
									<textarea class="form-control form-control-sm textarea" id="obs" rows="" name="obs" maxlength="300"></textarea>
								</div>
								<br>
								<button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
								<button type="submit" class="btn btn-dark ml-auto" name="cancelar" id="cancelar">Cancelar</button>
							</form>
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
			window.location = 'cadastroconclusao.php?search=' + search.value;
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

		$(document).ready(function() {
		$('#numeroalvara').mask('AAAA/00000-00');
	});
	</script>
	</div>
	</div>




</body>

</html>