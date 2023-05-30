<?php
if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION['SesID'])) {
	session_destroy();
	header("Location: index.php");
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

		table {
			table-layout: auto;
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
								<button class="btnpesquisa btn-outline-success" onclick="searchData()" type="submit" name="pesquisa" id="pesquisa">Pesquisar</button>
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
							<th>Data Reunião</th>
							<th>Data Início</th>
							<th>Prazo</th>
							<th>Data Limite</th>
							<th>Dias restantes</th>
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
						admissibilidade.dataenvio, admissibilidade.datareuniao  
						FROM
						inicial JOIN distribuicao ON inicial.id = distribuicao.controleinterno
						JOIN admissibilidade ON inicial.id = admissibilidade.controleinterno
						WHERE sts='5' AND sei = '$data' ORDER BY id DESC";
						} else {
							$buscar_cadastros = "SELECT
							Inicial.*, 
							distribuicao.tec,
							admissibilidade.dataenvio, admissibilidade.datareuniao  
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
							$decreto = $receber_cadastros['decreto'];
							$dataenvio = $receber_cadastros['dataenvio'];
							$datareuniao = $receber_cadastros['datareuniao'];

							// Invertendo a data do SQL para o formato brasileiro

							$dataprotocolo_br = date("d/m/Y", strtotime($dataprotocolo));
							$dataenvio_br = date("d/m/Y", strtotime($dataenvio));

							$prazo = '';

							$graproem = 1;


							if ($tipoprocesso == 1) {
								if ($graproem == 1) {
									$prazo = 30;
								} elseif ($graproem > 1 && ($tipoalvara1 == 1 || $tipoalvara2 == 1 || $tipoalvara2 == 3)) {
									$prazo = 30;
								} elseif ($graproem > 1 && $tipoalvara1 == 1 && $tipoalvara2 == 2) {
									$prazo = 60;
								} elseif ($graproem > 1 && $tipoalvara1 == 2) {
									$prazo = 60;
								}
							} elseif ($tipoprocesso == 2) {
								if ($graproem == 1) {
									$prazo = 60;
								} elseif ($graproem > 1 && $tipoalvara1 == 1 && $tipoalvara2 == 1) {
									$prazo = 25;
								} elseif ($graproem > 1 && ($tipoalvara1 == 1 && ($tipoalvara2 == 1 || $tipoalvara2 == 3))) {
									$prazo = 55;
								} elseif ($graproem > 1 && $tipoalvara1 == 2) {
									$prazo = 55;
								}
							}

							$datalimite_at = date('Y/m/d', strtotime($dataenvio . " + $prazo days"));

							$hoje = date("Y-m-d");
							$diferenca = strtotime($datalimite_at) - strtotime($hoje);
							$diasrestantes = floor($diferenca / (60 * 60 * 24));

							$datalimitebr = date('d/m/Y', strtotime($datalimite_at));
							$datareuniaobr = date('d/m/Y', strtotime($datareuniao));
							

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

							$tec = $receber_cadastros['tec'];
						?>
							<tr>
								<td><a href="#" class='btnpesquisa btn-outline-info copiar botaoselecao' name="selecionar"><span class="glyphicon glyphicon-edit"></span>Selecionar</a></td>
								<td class="ci" scope="row"><?php echo $controleinterno ?></td>
								<td class="sei"><?php echo $sei ?></td>
								<td><?php echo $numsql ?></td>
								<td><?php echo $tec ?></td>
								<td class="dataprotocolo"><?php echo $dataprotocolo_br ?></td>
								<td class="tipoprocesso"><?php echo $tipoprocesso ?></td>
								<td class="tipoalvara1"><?php echo $tipoalvara1 ?></td>
								<td class="tipoalvara2"><?php echo $tipoalvara2 ?></td>
								<td><?php echo $tipoalvara3 ?></td>
								<td class="datareuniao"><?php echo $datareuniaobr ?></td>								
								<td class="dataat"><?php echo $dataenvio_br ?></td>
								<td><?php echo $prazo ?></td>
								<td class="datalimite"><?php echo $datalimitebr ?></td>
								<?php
								if ($diasrestantes >= 10) {
									echo '<td class="diasrestantes table-success">' . $diasrestantes . '</td>';
								} elseif ($diasrestantes >= 5) {
									echo '<td class="diasrestantes table-warning">' . $diasrestantes . '</td>';
								} elseif ($diasrestantes > 0) {
									echo '<td class="diasrestantes table-danger">' . $diasrestantes . '</td>';
								} else {
									echo '<td class="diasrestantes table-danger">Vencido!<br> Há ' . abs($diasrestantes) . ' dias </td>';
								}
								?>
								<td><?php echo $decreto ?></td>
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
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="sei" readonly name="sei"></input>
							</div>

							<!-- Convertendo a data de Protocolo para DD/MM/AAAA-->
							<?php

							?>

							<div class="col col-2">
								<label for="dataprotocolo" class="form-label">Data de Protocolo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataprotocolo" readonly name="dataprotocolo"></input>
							</div>
							<div class="col col-2">
								<label for="tipoprocesso" class="form-label">Tipo de Processo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="tipoprocesso" readonly name="tipoprocesso" value="<?php echo htmlspecialchars($tipoprocesso); ?>"></input>
							</div>
						</div>
					</div>
				</div>

				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Análise Técnica</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de início da análise pela coordenadoria/secretarias:</label>
								<input type="text" class="form-control form-control-sm" id="datainicio" name="datainicio" readonly>
							</div>
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de limite de análise pela coordenadoria/secretarias:</label>
								<input type="text" class="form-control form-control-sm" id="datalimite" name="datalimite" readonly>
							</div>
							<div class="col col-4">
								<label for="dataagendada" class="form-label">Data agendada da reunião do GRAPROEM:</label>
								<input type="text" class="form-control form-control-sm" id="dataagendada" name="dataagendada" readonly>
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
							<div class=".col-12 .col-md-8">
								<label class="form-label" for="obs">Observação:</label>
								<textarea class="form-control form-control-sm textarea" id="obs" rows="" name="obs" maxlength="300"></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Reanálise Técnica</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de cumprimento do Comunique-se:</label>
								<input type="date" class="form-control form-control-sm" id="datacumprimento_r" name="datacumprimento_r">
							</div>
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de limite de análise pela coordenadoria/secretarias:</label>
								<input type="date" class="form-control form-control-sm" id="datalimite_r" name="datalimite_r">
							</div>
							<div class="col col-4">
								<label for="dataagendada" class="form-label">Data agendada da reunião do GRAPROEM:</label>
								<input type="date" class="form-control form-control-sm" id="dataagendada_r" name="dataagendada_r">
							</div>
							<div class="col col-4">
								<label for="datareal" class="form-label">Data da realização do GRAPROEM:</label>
								<input type="date" class="form-control form-control-sm" id="datareal_r" name="datareal_r">
							</div>
							<div class="col col-4">
								<label for="motivo" class="form-label">Motivo da realização do GRAPROEM ser em data distinta</label>
								<input type="text" class="form-control form-control-sm" id="motivo_r" name="motivo_r">
							</div>
							<div class="col col-4">
								<label for="parecer" class="form-label">Parecer do GRAPROEM ou Coordenadoria:</label>
								<select class="form-select" aria-label="Default select example" name="parecer_r" id="parecer_r">
									<option selected></option>
									<option value="1">Parecer favorável</option>
									<option value="2">Comunique-se</option>
									<option value="3">Parecer contrário</option>
								</select>
							</div>
							<div class="col col-4">
								<label for="datapubli" class="form-label">Data de publicação do parecer do GRAPROEM ou Coordenadoria:</label>
								<input type="date" class="form-control form-control-sm" id="datapublicacao_r" name="datapubli_r">
							</div>
							<div class="col col-4">
								<label for="datasmul" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
								<input type="date" class="form-control form-control-sm" id="datasmul_r" name="datasmul_r">
							</div>
							<div class="col col-4">
								<label for="datasvma" class="form-label">Data final da análise SVMA:</label>
								<input type="date" class="form-control form-control-sm" id="datasvma_r" name="datasvma_r">
							</div>
							<div class="col col-4">
								<label for="datasmc" class="form-label">Data final da análise SMC:</label>
								<input type="date" class="form-control form-control-sm" id="datasmc_r" name="datasmc_r">
							</div>
							<div class="col col-4">
								<label for="datasmt" class="form-label">Data final da análise SMT:</label>
								<input type="date" class="form-control form-control-sm" id="datasmt_r" name="datasmt_r">
							</div>
							<div class="col col-4">
								<label for="datasehab" class="form-label">Data final da análise SEHAB:</label>
								<input type="date" class="form-control form-control-sm" id="datasehab_r" name="datasehab_r">
							</div>
							<div class="col col-4">
								<label for="datafinalsiurb" class="form-label">Data final da análise SIURB:</label>
								<input type="date" class="form-control form-control-sm" id="datasiurb_r" name="datasiurb_r">
							</div>
							<div class=".col-12 .col-md-8">
								<label class="form-label" for="obs">Observação:</label>
								<textarea class="form-control form-control-sm textarea" id="obs_r" rows="" name="obs_r" maxlength="300"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Análise Complementar</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
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
								<label for="datacumprimento_c" class="form-label">Data de resposta do Comunique-se complementar:</label>
								<input type="date" class="form-control form-control-sm" id="datacumprimento_c" name="datacumprimento_c">
							</div>
							<div class="col col-4">
								<label for="datainicio" class="form-label">Data de limite de análise pela coordenadoria/secretarias:</label>
								<input type="date" class="form-control form-control-sm" id="datalimite_c" name="datalimite_c">
							</div>
							<div class="col col-4">
								<label for="dataagendada" class="form-label">Data agendada da reunião do GRAPROEM:</label>
								<input type="date" class="form-control form-control-sm" id="dataagendada_c" name="dataagendada_c">
							</div>
							<div class="col col-4">
								<label for="datareal" class="form-label">Data da realização do GRAPROEM:</label>
								<input type="date" class="form-control form-control-sm" id="datareal_c" name="datareal_c">
							</div>
							<div class="col col-4">
								<label for="motivo" class="form-label">Motivo da realização do GRAPROEM ser em data distinta</label>
								<input type="text" class="form-control form-control-sm" id="motivo_c" name="motivo_c">
							</div>
							<div class="col col-4">
								<label for="parecer" class="form-label">Parecer do GRAPROEM ou Coordenadoria:</label>
								<select class="form-select" aria-label="Default select example" name="parecer_c" id="parecer_c">
									<option selected></option>
									<option value="1">Parecer favorável</option>
									<option value="2">Comunique-se</option>
									<option value="3">Parecer contrário</option>
								</select>
							</div>
							<div class="col col-4">
								<label for="datapubli" class="form-label">Data de publicação do parecer do GRAPROEM ou Coordenadoria:</label>
								<input type="date" class="form-control form-control-sm" id="datapubli_c" name="datapubli_c">
							</div>
							<div class="col col-4">
								<label for="datasmul" class="form-label">Data final da análise pela coordenadoria de SMUL:</label>
								<input type="date" class="form-control form-control-sm" id="datasmul_c" name="datasmul_c">
							</div>
							<div class="col col-4">
								<label for="datasvma" class="form-label">Data final da análise SVMA:</label>
								<input type="date" class="form-control form-control-sm" id="datasvma_c" name="datasvma_c">
							</div>
							<div class="col col-4">
								<label for="datasmc" class="form-label">Data final da análise SMC:</label>
								<input type="date" class="form-control form-control-sm" id="datasmc_c" name="datasmc_c">
							</div>
							<div class="col col-4">
								<label for="datasmt" class="form-label">Data final da análise SMT:</label>
								<input type="date" class="form-control form-control-sm" id="datasmt_c" name="datasmt_c">
							</div>
							<div class="col col-4">
								<label for="datasehab" class="form-label">Data final da análise SEHAB:</label>
								<input type="date" class="form-control form-control-sm" id="datasehab_c" name="datasehab_c">
							</div>
							<div class="col col-4">
								<label for="datafinalsiurb" class="form-label">Data final da análise SIURB:</label>
								<input type="date" class="form-control form-control-sm" id="datasiurb_c" name="datasiurb_c">
							</div>
							<div class="col col-4">
								<label for="datafinalsiurb" class="form-label">Data de publicação do despacho pela coordenadoria de SMUL:</label>
								<input type="date" class="form-control form-control-sm" id="datacoord" name="datacoord">
							</div>
							<div class=".col-12 .col-md-8">
								<label class="form-label" for="obs">Observação:</label>
								<textarea class="form-control form-control-sm textarea" id="obs_c" rows="" name="obs_c" maxlength="300"></textarea>
							</div>
						</div>
					</div>
				</div>
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

		$(function() {
			$('.copiar').click(function(event) {
				var copyValue = $(event.target)
					.closest("tr")
					.find("td.ci")
					.text()
					.trim();

				console.log('copyvalue: ', copyValue);

				$('#controleinterno').val(copyValue);

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

				console.log('copyvalue: ', copyValue)

				// seleciona o input com id desejado
				$('#sei')
					// seta o valor copiado para o input id=controleinterno
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

				console.log('copyvalue: ', copyValue)

				// seleciona o input com id desejado
				$('#dataprotocolo')
					// seta o valor copiado para o input id=controleinterno
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
					.find("td.dataat")
					// obtem o text no conteúdo do elemento <td>
					.text()
					// remove possiveis espaços no incio e fim da string
					.trim();

				console.log('copyvalue: ', copyValue)

				// seleciona o input com id desejado
				$('#datainicio')
					// seta o valor copiado para o input id=controleinterno
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
					.find("td.datalimite")
					// obtem o text no conteúdo do elemento <td>
					.text()
					// remove possiveis espaços no incio e fim da string
					.trim();

				console.log('copyvalue: ', copyValue)

				// seleciona o input com id desejado
				$('#datalimite')
					// seta o valor copiado para o input id=controleinterno
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
					.find("td.datareuniao")
					// obtem o text no conteúdo do elemento <td>
					.text()
					// remove possiveis espaços no incio e fim da string
					.trim();

				console.log('copyvalue: ', copyValue)

				// seleciona o input com id desejado
				$('#dataagendada')
					// seta o valor copiado para o input id=controleinterno
					.val(copyValue);

			});
		});
		
	</script>
</body>

</html>