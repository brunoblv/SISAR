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


							?>
								<tr>
									<td><a class='btnpesquisa btn-outline-info copiar botaoselecao' id="botao"><span class="glyphicon glyphicon-edit"></span> Selecionar</a></td>
									<td class="ci" scope="row"><?php echo $controleinterno ?></td>
									<td class="sei"><?php echo $sei ?></td>
									<td><?php echo $numsql ?></td>
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
							<div class="col col-3">
								<label for="controleinterno" class="form-label">N° de Controle interno:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="controleinterno" readonly name="controleinterno" value="<?php echo htmlspecialchars($controleinterno); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="sei" class="form-label">N° do Processo SEI:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="sei" readonly name="sei" value="<?php echo htmlspecialchars($sei); ?>"></input>
							</div>

							<!-- Convertendo a data para DD/MM/AAAA-->
							<?php $inverted_date = date("d/m/Y", strtotime($dataprotocolo)); ?>

							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Data de Protocolo:</label>
								<input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="dataprotocolo" readonly name="dataprotocolo" value="<?php echo htmlspecialchars($inverted_date); ?>"></input>
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
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='TEC' ORDER BY NOME ASC"); ?>
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
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='TEC' ORDER BY NOME ASC "); ?>
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
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='ADM' ORDER BY NOME ASC  "); ?>
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
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='ADM' ORDER BY NOME ASC  "); ?>
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
									<?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='ADM' ORDER BY NOME ASC  "); ?>
									<?php while ($reg = $query->fetch_array()) { ?>
										<option value="<?php echo $reg['nome']; ?>">
											<?php echo $reg['nome']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col col-3">
								<label for="fisico" class="form-label">Observações 1:</label>
								<input type="text" class="form-control form-control-sm" id="obs1" name="obs1">
							</div>
							<div class="col col-3">
								<label for="aprova" class="form-label">Observações 2:</label>
								<input type="text" class="form-control form-control-sm" id="obs2" name="obs2">
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
						</div>
						<div class="form-row">
							<div class="col col-3">
								<label for="dataad" class="form-label">Data de início da Admissibilidade:</label>
								<input type="text" class="form-control form-control-sm" id="dataad" name="dataad">
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
	</script>



</body>

</html>