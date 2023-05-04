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
					<strong>Registro GRAPROEM</strong>
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
							<th>Técnico ATECC</th>
							<th>Data Protocolo</th>
							<th>Tipo Processo</th>
							<th>Tipo Alvará</th>
							<th>Tipo Alvará</th>
							<th>Tipo Alvará</th>
							<th>Data envio</th>
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
							$buscar_cadastros = "SELECT
						Inicial.*, 
						distribuicao.tec,
						admissibilidade.dataenvio 
						FROM
						inicial JOIN distribuicao ON inicial.id = distribuicao.controleinterno
						JOIN admissibilidade ON inicial.id = admissibilidade.controleinterno
						WHERE sts='5' AND sei LIKE '%$data%' ORDER BY id DESC";
						} else {
							$buscar_cadastros = "SELECT
							Inicial.*, 
							distribuicao.tec,
							admissibilidade.dataenvio 
							FROM
							inicial JOIN distribuicao ON inicial.id = distribuicao.controleinterno
							JOIN admissibilidade ON inicial.id = admissibilidade.controleinterno
							WHERE sts='5' ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
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
							$dataenvio = $receber_cadastros['dataenvio'];

							// Invertendo a data do SQL para o formato brasileiro

							$dataprotocolo_br = date("d/m/Y", strtotime($dataprotocolo));
							$dataenvio_br = date("d/m/Y", strtotime($dataenvio));


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
								<td class="dataprotocolo"><?php echo $dataprotocolo_br ?></td>
								<td class="tipoprocesso"><?php echo $tipoprocesso ?></td>
								<td class="tipoalvara1"><?php echo $tipoalvara1 ?></td>
								<td class="tipoalvara2"><?php echo $tipoalvara2 ?></td>
								<td><?php echo $tipoalvara3 ?></td>
								<td class="dataenvio"><?php echo $dataenvio_br ?></td>
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
									$(function() {
										$('.copiar').click(function(event) {
											var copyValue =
												// inicia seletor jQuery com o objeto clicado (no caso o elemento <a class="copiar">)
												$(event.target)
												// closest (https://api.jquery.com/closest/) retorna o seletor no tr da linha clicada 
												.closest("tr")
												// procura a <td> com a class target-copy
												.find("td.dataprotocolo")
												// obtem o text no conteúdo do elemento <td>
												.text()
												// remove possiveis espaços no incio e fim da string
												.trim();

											// seleciona o input com id desejado
											$('#dataprotocolo')
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
												.find("td.tipoprocesso")
												// obtem o text no conteúdo do elemento <td>
												.text()
												// remove possiveis espaços no incio e fim da string
												.trim();

											// seleciona o input com id desejado
											$('#tipoprocesso')
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
												.find("td.dataenvio")
												// obtem o text no conteúdo do elemento <td>
												.text()
												// remove possiveis espaços no incio e fim da string
												.trim();

											// seleciona o input com id desejado
											$('#dataenvio')
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
					<li class="page-item"><a class="page-link" href="cadastrograproem.php?pagina=1">Primeira</a></li>

					<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo "<li class='page-item'><a class='page-link' href='cadastrograproem.php?pagina=$pag_ant'>$pag_ant</a></li>";
						}
					} ?>

					<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

					<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'><a class='page-link' href='cadastrograproem.php?pagina=$pag_dep'>$pag_dep</a></li>";
						}
					}


					echo "<li class='page-item'><a class='page-link' href='cadastrograproem.php?pagina=$quantidade_pg'>Última</a></li>";

					echo '</ul>';
					echo '</nav>';



					?>
		</div>
		<div id="form" hidden>
			<form class="need-validation" no validade method="POST" action="addgraproem.php" autocomplete="off" name="formulario" id="formulario">
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados do Processo</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-2">
								<label for="sei" class="form-label">N° de Controle interno:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="controleinterno" readonly name="controleinterno"></input>
							</div>
							<div class="col col-2">
								<label for="sei" class="form-label">N° do Processo SEI:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="sei" readonly name="sei" ></input>
							</div>

							<!-- Convertendo a data de Protocolo para DD/MM/AAAA-->
							<?php

							$inverted_date = date("d/m/Y", strtotime($dataprotocolo));

							$datalimite = date('Y-m-d', strtotime($dataprotocolo . ' + 15 days'));

							$datalimite = date("d/m/Y", strtotime($datalimite));

							$buscar_cadastros = "SELECT
													CASE 
														WHEN parecer = 2 AND instancia = 1 AND graproem = 1 THEN 1
														WHEN parecer = 2 AND instancia = 1 AND graproem = 2 THEN 1
														WHEN parecer = 3 AND instancia = 1 THEN 2
														WHEN parecer = 2 AND instancia = 2 AND graproem = 2 THEN 2
														WHEN parecer = 2 AND instancia = 2 AND graproem = 3 THEN 2
														WHEN parecer = 3 AND instancia = 2 THEN 3
														WHEN parecer = 2 AND instancia = 3 AND graproem = 2 THEN 2
														WHEN parecer = 2 AND instancia = 3 AND graproem = 3 THEN 2
														ELSE 1
													END AS numinstancia,
													CASE 
														WHEN parecer = 2 AND instancia = 1 AND graproem = 1 THEN 2
														WHEN parecer = 2 AND instancia = 1 AND graproem = 2 THEN 3
														WHEN parecer = 3 AND instancia = 1 THEN 1
														WHEN parecer = 2 AND instancia = 2 AND graproem = 2 THEN 2
														WHEN parecer = 2 AND instancia = 2 AND graproem = 3 THEN 3
														WHEN parecer = 3 AND instancia = 2 THEN 1
														WHEN parecer = 2 AND instancia = 3 AND graproem = 2 THEN 2
														WHEN parecer = 2 AND instancia = 3 AND graproem = 3 THEN 3
														ELSE 1
													END AS numgraproem
												FROM graproem
												WHERE controleinterno = '$controleinterno'
												ORDER BY id DESC
												LIMIT 1";
							$query_cadastros = mysqli_query($conn, $buscar_cadastros);
							if ($query_cadastros && mysqli_num_rows($query_cadastros) > 0) {

								$receber_cadastros = mysqli_fetch_array($query_cadastros);
								$instancia = $receber_cadastros['numinstancia'];
								$graproem = $receber_cadastros['numgraproem'];
							} else {
								$instancia = 1;
								$graproem = 1;
							}

							$datalimite_at = '';						

							
							if ($tipoprocesso == 'Próprio de SMUL') {
								if ($graproem == 1) {
								  $datalimite_at = date('d-m-y', strtotime($dataenvio . ' +30 days'));
								} elseif ($graproem > 1) {
								  if ($tipoalvara1 == 'Nada' && ($tipoalvara2 == 'Alvara de Aprovação' || $tipoalvara2 == 'Alvara de Execução')) {
									$datalimite_at = date('D-m-y', strtotime($dataenvio . ' +30 days'));
								  } elseif ($tipoalvara1 == 'nada' && $tipoalvara2 == 'Alvara de Aprovação e Execução') {
									$datalimite_at = date('D-m-y', strtotime($dataenvio . ' +60 days'));
								  } elseif ($tipoalvara1 == 'Projeto Modificativo') {
									$datalimite_at = date('D-m-y', strtotime($dataenvio . ' +60 days'));
								  }
								}
							  }		

							?>							

							<div class="col col-2">
								<label for="dataprotocolo" class="form-label">Data de Protocolo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataprotocolo" readonly name="dataprotocolo"></input>
							</div>
							<div class="col col-2">
								<label for="tipoprocesso" class="form-label">Tipo de Processo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="tipoprocesso" readonly name="tipoprocesso"></input>
							</div>
							<div class="col col-2">
								<label for="instancia" class="form-label">Instância atual:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="instancia" readonly name="instancia" value="<?php echo htmlspecialchars($instancia); ?>"></input>
							</div>
							<div class="col col-2">
								<label for="instancia" class="form-label">GRAPROEM atual:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="graproem" readonly name="graproem" value="<?php echo htmlspecialchars($graproem); ?>"></input>
							</div>
							<div class="col col-2">
								<label for="dataenvio" class="form-label">Data de início da primeira Análise Técnica:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataenvio" readonly name="dataenvio"></input>
							</div>
							<div class="col col-2">
								<label for="instancia" class="form-label">Data limite para análise da Coordenadoria/Secretaria:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="datelimite" readonly name="datalimite"  value="<?php echo $datalimite_at?>"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Histórico das instâncias</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<?php
							$buscar_cadastros = "SELECT * FROM GRAPROEM WHERE controleinterno = '$controleinterno'";
							$query_cadastros = mysqli_query($conn, $buscar_cadastros); ?>
							<div class="table table-sm">
								<table class="table table-bordered table-sm">
									<thead>
										<tr>
											<th>Instância</th>
											<th>GRAPROEM</th>
											<th>Parecer</th>
											<th>OBS</th>
										</tr>
									</thead>
									<tbody>
										<?php

										while ($receber_cadastros = mysqli_fetch_array($query_cadastros)) {

											$instancia = $receber_cadastros['instancia'];
											$obs = $receber_cadastros['obs'];
											$graproem = $receber_cadastros['graproem'];
											$parecer = $receber_cadastros['parecer'];

											switch ($instancia) {
												case '1':
													$instancia = '1ª Instância';
													break;
												case '2':
													$instancia = '2ª Instância';
													break;
												case '3':
													$instancia = '3ª Instância';
											}

										?>
											<tr>
												<td class="ci" scope="row"><?php echo $instancia ?></td>
												<td class="sei"><?php echo $graproem ?></td>
												<td><?php echo $parecer ?></td>
												<td><?php echo $obs ?></td>

											</tr>
										<?php }; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>GRAPROEM</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-4">
								<label for="instancia" class="form-label">Instância:</label>
								<select class="form-select" aria-label="Default select example" name="instancia" id="instancia">
									<option value="1" <?php if ($instancia == 1) echo ' selected'; ?>>1ª Instância</option>
									<option value="2" <?php if ($instancia == 2) echo ' selected'; ?>>2ª Instância</option>
									<option value="3" <?php if ($instancia == 3) echo ' selected'; ?>>3ª Instância</option>
								</select>
							</div>
							<div class="col col-4">
								<label for="graproem" class="form-label">GRAPROEM:</label>
								<select class="form-select" aria-label="Default select example" name="graproem" id="graproem">
									<option value="1" <?php if ($instancia == 1) echo ' selected'; ?>>1º GRAPROEM</option>
									<option value="2" <?php if ($instancia == 2) echo ' selected'; ?>>2º GRAPROEM</option>
									<option value="3" <?php if ($instancia == 3) echo ' selected'; ?>>GRAPROEM Complementar</option>
								</select>
							</div>
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de início da análise pela coordenadoria/secretarias:</label>
								<input type="date" class="form-control form-control-sm" id="datainicio" name="datainicio">
							</div>							
							<div class="col col-4">
								<label for="dataagendada" class="form-label">Data agendada da reunião do GRAPROEM:</label>
								<input type="date" class="form-control form-control-sm" id="dataagendada" name="dataagendada">
							</div>
							<div class="col col-4">
								<label for="datareal" class="form-label">Data da realização do GRAPROEM:</label>
								<input type="date" class="form-control form-control-sm" id="datareal" name="datareal">
							</div>
							<div class="col col-4">
								<label for="motivo" class="form-label">Motivo da realização do GRAPROEM ser em data distinta</label>
								<input type="text" class="form-control form-control-sm" id="motivo" name="motivo">
							</div>
							<div class="col col-4">
								<label for="parecer" class="form-label">Parecer do GRAPROEM ou Coordenadoria:</label>
								<select class="form-select" aria-label="Default select example" name="parecer" id="parecer">
									<option selected></option>
									<option value="1">Parecer favorável</option>
									<option value="2">Comunique-se</option>
									<option value="3">Parecer contrário</option>
								</select>
							</div>
							<div class="col col-4">
								<label for="datapubli" class="form-label">Data de publicação do parecer do GRAPROEM ou Coordenadoria:</label>
								<input type="date" class="form-control form-control-sm" id="datapubli" name="datapubli">
							</div>
							<div class="col col-4">
								<label for="datacumprimento" class="form-label">Data de cumprimento do Comunique-se:</label>
								<input type="date" class="form-control form-control-sm" id="datacumprimento" name="datacumprimento">
							</div>
							<div class="col col-4">
								<label for="datasmul" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
								<input type="date" class="form-control form-control-sm" id="datasmul" name="datasmul">
							</div>
							<div class="col col-4">
								<label for="datasvma" class="form-label">Data final da análise SVMA:</label>
								<input type="date" class="form-control form-control-sm" id="datasvma" name="datasvma">
							</div>
							<div class="col col-4">
								<label for="datasmc" class="form-label">Data final da análise SMC:</label>
								<input type="date" class="form-control form-control-sm" id="datasmc" name="datasmc">
							</div>
							<div class="col col-4">
								<label for="datasmt" class="form-label">Data final da análise SMT:</label>
								<input type="date" class="form-control form-control-sm" id="datasmt" name="datasmt">
							</div>
							<div class="col col-4">
								<label for="datasehab" class="form-label">Data final da análise SEHAB:</label>
								<input type="date" class="form-control form-control-sm" id="datasehab" name="datasehab">
							</div>
							<div class="col col-4">
								<label for="datafinalsiurb" class="form-label">Data final da análise SIURB:</label>
								<input type="date" class="form-control form-control-sm" id="datasiurb" name="datasiurb">
							</div>
							<div class="col col-4">
								<label for="complementar" class="form-label">Houve Comunique-se complementar?</label>
								<select class="form-select" aria-label="Default select example" name="complementar" id="complementar">
									<option selected></option>
									<option value="1">Sim</option>
									<option value="0">Não</option>
								</select>
							</div>
							<div class="col col-4">
								<label for="datapublicomplementar" class="form-label">Data de publicação do Comunique-se complementar:</label>
								<input type="date" class="form-control form-control-sm" id="datapublicomplementar" name="datapublicomplementar">
							</div>
							<div class="col col-4">
								<label for="dataresposta" class="form-label">Data de resposta do Comunique-se complementar:</label>
								<input type="date" class="form-control form-control-sm" id="dataresposta" name="dataresposta">
							</div>
							<div class="col col-4">
								<label for="datacoord" class="form-label">Data de publicação do despacho pela coordenadoria</label>
								<input type="date" class="form-control form-control-sm" id="datacoord" name="datacoord">
							</div>
						</div>
						<div class=".col-12 .col-md-8">
							<label class="form-label" for="obs">Observação:</label>
							<textarea class="form-control form-control-sm textarea" id="obs" rows="" name="obs" maxlength="300"></textarea>
						</div>
					</div>
					<br>
					<div class="form-row">
						<div class="col col-3">
							<button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
							<button type="button" class="btn btn-dark ml-auto" name="cancelar" id="cancelar">Cancelar</button>
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
			window.location = 'cadastrograproem.php?search=' + search.value;
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
</body>

</html>