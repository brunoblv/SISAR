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
					<strong>Cadastro Secretarias</strong>
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
							$buscar_cadastros = "SELECT Inicial.id, Inicial.dataad, inicial.dataprotocolo, Inicial.sei, Inicial.numsql, Inicial.tipoprocesso, Admissibilidade.dataenvio, Admissibilidade.coordenadoria
							FROM Inicial
							JOIN Admissibilidade ON Inicial.id = Admissibilidade.controleinterno
							
							WHERE Inicial.sts = 3 AND Inicial.id NOT IN (SELECT controleinterno FROM secretarias) AND inicial.sei LIKE '%$data%'";
						} else {
							$buscar_cadastros = "SELECT Inicial.id, Inicial.dataad, inicial.dataprotocolo, Inicial.sei, Inicial.numsql, Inicial.tipoprocesso, Admissibilidade.dataenvio, Admissibilidade.coordenadoria
							FROM Inicial
							JOIN Admissibilidade ON Inicial.id = Admissibilidade.controleinterno
							
							WHERE Inicial.sts = 3 AND Inicial.id NOT IN (SELECT controleinterno FROM secretarias)
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
							$dataad = $receber_cadastros['dataad'];
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


							$dataad = date("d/m/Y", strtotime($dataad));
							$dataenvio = date("d/m/Y", strtotime($dataenvio));
							$dataprotocolo = date("d/m/Y", strtotime($dataprotocolo));

						?>
							<tr>
								<td><a class='btnpesquisa btn-outline-info copiar botaoselecao'><span class="glyphicon glyphicon-edit"></span>Selecionar</a></td>
								<td class="ci" scope="row"><?php echo $controleinterno ?></td>
								<td class="sei"><?php echo $sei ?></td>
								<td><?php echo $numsql ?></td>
								<td><?php echo $dataad ?></td>
								<td><?php echo $dataenvio ?></td>
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
					<li class="page-item"><a class="page-link" href="cadastrosecretarias.php?pagina=1">Primeira</a></li>

					<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo "<li class='page-item'><a class='page-link' href='cadastrosecretarias.php?pagina=$pag_ant'>$pag_ant</a></li>";
						}
					} ?>

					<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

					<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'><a class='page-link' href='cadastrosecretarias.php?pagina=$pag_dep'>$pag_dep</a></li>";
						}
					}


					echo "<li class='page-item'><a class='page-link' href='cadastrosecretarias.php?pagina=$quantidade_pg'>Última</a></li>";

					echo '</ul>';
					echo '</nav>';



					?>
		</div>
		<div id="form" hidden>
			<form class="need-validation" no validade method="POST" action="addsecretarias.php" autocomplete="off" name="formulario" id="formulario">
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados do Processo</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-3">
								<label for="sei" class="form-label">N° de Controle interno:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="controleinterno" readonly name="controleinterno" value="<?php echo htmlspecialchars($controleinterno); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="sei" class="form-label">N° do Processo SEI:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="sei" readonly name="sei" value="<?php echo htmlspecialchars($sei); ?>"></input>
							</div>

							<!-- Convertendo a data de Protocolo para DD/MM/AAAA-->
							<?php
							$stmt = $conn->prepare("SELECT Inicial.id, Inicial.dataad, inicial.dataprotocolo, Inicial.sei, Inicial.numsql, Inicial.tipoprocesso, Admissibilidade.dataenvio, Admissibilidade.coordenadoria
							FROM Inicial
							JOIN Admissibilidade ON Inicial.id = Admissibilidade.controleinterno
							WHERE inicial.id = ?");
							$stmt->bind_param("i", $ci);
							$stmt->execute();
							$result = $stmt->get_result();
							

							while ($row = mysqli_fetch_array($result)) {
								$controleinterno = $row['id'];
								$numsql = $row['numsql'];
								$sei = $row['sei'];
								$dataad = $row['dataad'];
								$dataad_br = date("d/m/Y", strtotime($dataprotocolo));
								$dataprotocolo = $row['dataprotocolo'];
								$dataprotocolo_br = date("d/m/Y", strtotime($dataprotocolo));
								$tipoprocesso = $row['tipoprocesso'];								
								$dataenvio = $row['dataenvio'];								
								$coordenadoria = $row['coordenadoria'];
								$dataenvio_br = date("d/m/Y", strtotime($dataenvio));
								$sei = $row['sei'];
							}


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

							switch ($tipoprocesso) {
								case 1:
									$tipoprocesso = 'Próprio de SMUL';
									break;
								case 2:
									$tipoprocesso = 'Múltiplas Interfaces';
									break;
							}



							$datalimiteanalise = date("d/m/Y", strtotime($datalimiteanalise));
							$datalimiteprazo = date("d/m/Y", strtotime($datalimiteprazo));

							$dataprotocolo2 = date("d/m/Y", strtotime($dataprotocolo));
							$dataenvio2 = date("d/m/Y", strtotime($dataenvio));

							?>

							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Coordenadoria/Divisão em SMUL:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="coordenadoria" readonly name="coordenadoria" value="<?php echo htmlspecialchars($coordenadoria); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="datalimite" class="form-label">Data de Protocolo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="datalimite" readonly name="datalimite" value="<?php echo htmlspecialchars($dataprotocolo_br); ?>"></input>
							</div>
						</div>
						<div class="form-row">
							<div class="col col-3">
								<label for="tipoprocesso" class="form-label">Tipo de Processo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="tipoprocesso" readonly name="tipoprocesso" value="<?php echo htmlspecialchars($tipoprocesso); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="tipoprocesso" class="form-label">Data de envio para as Secretarias:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataenvio" readonly name="dataenvio" value="<?php echo htmlspecialchars($dataenvio_br); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Data limite para análise técnica das Secretarias:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataprotocolo" readonly name="dataprotocolo" value="<?php echo htmlspecialchars($datalimiteanalise); ?>"></input>
							</div>							
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados SMUL e Outras Secretarias</strong>
					</div>
					<div class="card-body">
						<div>
							<form class="need-validation" no validade method="POST" action="addsecretarias.php" autocomplete="off" name="frm" onsubmit=" return verificarControleInterno();">
								<div class="smul form-row">
									<div class="col col-4">
										<label for="tec" class="form-label">Técnico da Coordenadoria responsável:</label>
										<input type="text" class="form-control form-control-sm" id="tec" name="tec">
									</div>
									<div class="col col-4">
										<label for="tec2" class="form-label">Técnico da Coordenadoria após redistribuição:</label>
										<input type="text" class="form-control form-control-sm" id="tec2" name="tec2">
									</div>
								</div>
								<br>
								<br>
								<div class="outras form-row">
									<div class="col col-3">
										<input class="form-check-input" type="hidden" value="0" id="interfacesvma" name="interfacesvma">
										<input class="form-check-input" type="checkbox" value="1" id="interfacesvma" name="interfacesvma">
										<label class="form-check-label" for="flexCheckDefault">
											Possui interface com SVMA
										</label>
									</div>
									<div class="col col-3">
										<div class="input-group">
											<span class="input-group-text form-control-sm">Processo SVMA</span>
											<input type="text" aria-label="First name" class="form-control form-control-sm" name="svma">
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col col-3">
										<input class="form-check-input" type="hidden" value="0" id="interfacesmc" name="interfacesmc">
										<input class="form-check-input" type="checkbox" value="1" id="interfacesmc" name="interfacesmc">
										<label class="form-check-label" for="flexCheckDefault">
											Possui interface com SMC
										</label>
									</div>
									<div class="col col-3">
										<div class="input-group">
											<span class="input-group-text form-control-sm">Processo SMC</span>
											<input type="text" aria-label="First name" class="form-control form-control-sm" name="smc">
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col col-3">
										<input class="form-check-input" type="hidden" value="0" id="interfacesmt" name="interfacesmt">
										<input class="form-check-input" type="checkbox" value="1" id="interfacesmt" name="interfacesmt">
										<label class="form-check-label" for="flexCheckDefault">
											Possui interface com SMT
										</label>
									</div>
									<div class="col col-3">
										<div class="input-group">
											<span class="input-group-text form-control-sm">Processo SMT</span>
											<input type="text" aria-label="First name" class="form-control form-control-sm" name="smt">
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col col-3">
										<input class="form-check-input" type="hidden" value="0" id="interfacesehab" name="interfacesehab">
										<input class="form-check-input" type="checkbox" value="1" id="interfacesehab" name="interfacesehab">
										<label class="form-check-label" for="flexCheckDefault">
											Possui interface com SEHAB
										</label>
									</div>
									<div class="col col-3">
										<div class="input-group">
											<span class="input-group-text form-control-sm">Processo SEHAB</span>
											<input type="text" aria-label="First name" class="form-control form-control-sm" name="sehab">
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col col-3">
										<input class="form-check-input" type="checkbox" value="0" id="interfacesiurb" name="interfacesiurb">
										<input class="form-check-input" type="checkbox" value="1" id="interfacesiurb" name="interfacesiurb">
										<label class="form-check-label" for="flexCheckDefault">
											Possui interface com SIURB
										</label>
									</div>
									<div class="col col-3">
										<div class="input-group">
											<span class="input-group-text form-control-sm">Processo SIURB</span>
											<input type="text" aria-label="First name" class="form-control form-control-sm" name="siurb">
										</div>
									</div>
								</div>
								<br>
								<br>
								<div class="form-row">
									<div class="col col-3">
										<button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
										<button type="button" class="btn btn-dark ml-auto" name="cancelar" id="cancelar">Cancelar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
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
			window.location = 'cadastrosecretarias.php?search=' + search.value;
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
	</script>
	</div>
	</div>




</body>

</html>