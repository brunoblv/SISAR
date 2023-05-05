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
					<strong>Processos aguardando distribução</strong>
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
			<div class="input-group">
				<div class="table table-sm">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Copiar</th>
								<th>Nº Controle Interno</th>
								<th>Nº SEI</th>
								<th>SQL</th>
								<th>Data Protocolo</th>
								<th>Data Início Admissibilidade</th>
								<th>Data limite</th>
								<th>Dias restantes</th>
								<th>Tipo Processo</th>
								<th>Tipo Alvará</th>
								<th>Tipo Alvará</th>
								<th>Tipo Alvará</th>								
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
								$buscar_cadastros = "SELECT * FROM inicial WHERE id NOT IN (SELECT controleinterno FROM distribuicao) AND sei LIKE '%$data%' ORDER BY id DESC";
							} else {
								$buscar_cadastros = "SELECT * FROM inicial WHERE id NOT IN (SELECT controleinterno FROM distribuicao) ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
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
								$decreto = $receber_cadastros['decreto'];
								$dataad = $receber_cadastros['dataad'];
								

								// Cálculo de prazo de Admissibilidade e Invertendo a data do SQL para o formato brasileiro

								$hoje = date("Y-m-d");
								$diferenca = abs(strtotime($hoje) - strtotime($dataad));
								$dias = floor($diferenca / (60 * 60 * 24));
								$datalimite = date('Y-m-d', strtotime($dataad . ' + 15 days'));
								$diasrestantes = 15 - $dias;

								$dataprotocolo = date("d/m/Y", strtotime($dataprotocolo));
								$dataad = date("d/m/Y", strtotime($dataad));
								$datalimite = date("d/m/Y", strtotime($datalimite));

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

								if ($decreto == 1) {
									$decreto = "Sim";
								} else {
									$decreto = "Não";
								}


							?>
								<tr>
									<td><a class='btnpesquisa btn-outline-info copiar botaoselecao' id="botao"><span class="glyphicon glyphicon-edit"></span> Selecionar</a></td>
									<td class="ci" scope="row"><?php echo $controleinterno ?></td>
									<td class="sei"><?php echo $sei ?></td>
									<td class="numsql"><?php echo $numsql ?></td>
									<td><?php echo $dataprotocolo ?></td>
									<td class="dataad"><?php echo $dataad ?></td>
									<td class="datalimite"><?php echo $datalimite ?></td>

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

									<td><?php echo $tipoprocesso ?></td>
									<td><?php echo $tipoalvara1 ?></td>
									<td><?php echo $tipoalvara2 ?></td>
									<td><?php echo $tipoalvara3 ?></td>									
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
													.find("td.dataad")
													// obtem o text no conteúdo do elemento <td>
													.text()
													// remove possiveis espaços no incio e fim da string
													.trim();

												// seleciona o input com id desejado
												$('#dataad')
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
													.find("td.numsql")
													// obtem o text no conteúdo do elemento <td>
													.text()
													// remove possiveis espaços no incio e fim da string
													.trim();

												// seleciona o input com id desejado
												$('#numsql')
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
													.find("td.datalimite")
													// obtem o text no conteúdo do elemento <td>
													.text()
													// remove possiveis espaços no incio e fim da string
													.trim();

												// seleciona o input com id desejado
												$('#datalimite')
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
													.find("td.diasrestantes")
													// obtem o text no conteúdo do elemento <td>
													.text()
													// remove possiveis espaços no incio e fim da string
													.trim();

												// seleciona o input com id desejado
												$('#diasrestantes')
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
						<li class="page-item"><a class="page-link" href="cadastrodistribuicao.php?pagina=1">Primeira</a></li>

						<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
							if ($pag_ant >= 1) {
								echo "<li class='page-item'><a class='page-link' href='cadastrodistribuicao.php?pagina=$pag_ant'>$pag_ant</a></li>";
							}
						} ?>

						<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

						<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
							if ($pag_dep <= $quantidade_pg) {
								echo "<li class='page-item'><a class='page-link' href='cadastrodistribuicao.php?pagina=$pag_dep'>$pag_dep</a></li>";
							}
						}


						echo "<li class='page-item'><a class='page-link' href='cadastrodistribuicao.php?pagina=$quantidade_pg'>Última</a></li>";

						echo '</ul>';
						echo '</nav>';



						?>
			</div>
		</div>

		<div id="form" hidden>
			<form class="need-validation" no validade method="POST" action="adddistribuicao.php" autocomplete="off" name="formulario" id="formulario">
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados do Processo</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-2">
								<label for="controleinterno" class="form-label">N° de Controle interno:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="controleinterno" readonly name="controleinterno" value="<?php echo htmlspecialchars($controleinterno); ?>"></input>
							</div>
							<div class="col col-2">
								<label for="sei" class="form-label">N° do Processo SEI:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="sei" readonly name="sei" value="<?php echo htmlspecialchars($sei); ?>"></input>
							</div>
							<div class="col col-2">
								<label for="sei" class="form-label">N° SQL:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="numsql" readonly name="numsql" value="<?php echo htmlspecialchars($numsql); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="dataad" class="form-label">Data de início da Análise de Admissibilidade:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataad" readonly name="dataad" value="<?php echo htmlspecialchars($dataad); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="datalimite" class="form-label">Data limite para Análise de Admissibilidade:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="datalimite" readonly name="datalimite" value="<?php echo htmlspecialchars($datalimite); ?>"></input>
							</div>		
							<div class="col col-3">
								<label for="diasrestantes" class="form-label">Dias restantes:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="diasrestantes" readonly name="diasrestantes" value="<?php echo htmlspecialchars($diasrestantes); ?>"></input>
							</div>						
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados de Distribuição</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-3">
								<label for="tec" class="form-label">Técnico de ATECC responsável:</label>
								<select class="form-select" id="tec" required name="tec">
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='TEC' OR cargo='' ORDER BY NOME ASC"); ?>
									<?php while ($reg = $query->fetch_array()) { ?>
										<option value="<?php echo $reg['nome']; ?>">
											<?php echo $reg['nome']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col col-3">
								<label for="tectroca" class="form-label">Técnico de ATECC responsável após troca:</label>
								<select class="form-select" id="tectroca" required name="tectroca">
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='TEC' OR cargo='' ORDER BY NOME ASC "); ?>
									<?php while ($reg = $query->fetch_array()) { ?>
										<option value="<?php echo $reg['nome']; ?>">
											<?php echo $reg['nome']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col col-3">
								<label for="adm" class="form-label">ADM de ATECC responsável:</label>
								<select class="form-select" id="adm" required name="adm">
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='ADM' OR cargo='' ORDER BY NOME ASC  "); ?>
									<?php while ($reg = $query->fetch_array()) { ?>
										<option value="<?php echo $reg['nome']; ?>">
											<?php echo $reg['nome']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col col-3">
								<label for="admsubst" class="form-label">ADM de ATECC substituto:</label>
								<select class="form-select" id="admsubst" required name="admsubst">
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='ADM' OR cargo='' ORDER BY NOME ASC  "); ?>
									<?php while ($reg = $query->fetch_array()) { ?>
										<option value="<?php echo $reg['nome']; ?>">
											<?php echo $reg['nome']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="col col-3">
								<label for="admsubst2" class="form-label">ADM de ATECC substituto do substituto:</label>
								<select class="form-select" id="admsubst2" required name="admsubst2">
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='ADM' OR cargo='' ORDER BY NOME ASC  "); ?>
									<?php while ($reg = $query->fetch_array()) { ?>
										<option value="<?php echo $reg['nome']; ?>">
											<?php echo $reg['nome']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col col-3">
								<label for="baixa" class="form-label">Verificada baixa no pagamento das guias?:</label>
								<select class="form-select" id="baixa" required name="baixa">
									<option></option>
									<option value="1">Sim</option>
									<option value="2">Isento</option>
									<option value="3">Sim, vinculado</option>
									<option value="4">Isento, vinculado</option>
								</select>
							</div>
							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Processo relacionado incomum:</label>
								<input type="text" class="form-control form-control-sm" id="pi" name="pi">
							</div>
							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Assunto do processo relacionado incomum:</label>
								<input type="text" class="form-control form-control-sm" id="assuntopi" name="assuntopi">
							</div>
						</div>
						<div class="row">
							<div class=".col-12 .col-md-8">
								<label class="form-label" for="obs">Observação:</label>
								<textarea class="form-control form-control-sm textarea" id="obs" rows="" name="obs1" maxlength="300"></textarea>
							</div>
						</div>
						<div class="row">
							<div class=".col-12 .col-md-8">
								<label class="form-label" for="obs">Observação 2:</label>
								<textarea class="form-control form-control-sm textarea" id="obs" rows="" name="obs2" maxlength="300"></textarea>
							</div>
						</div>
						<br>
						<div class="form-row">
							<div class="col col-3">
								<button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
								<button type="submit" class="btn btn-dark ml-auto" name="cancelar" id="cancelar">Cancelar</button>
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
			window.location = 'cadastrodistribuicao.php?search=' + search.value;
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
			$('#pi').mask('0000.0000/0000000-0');
		});
	</script>
</body>

</html>