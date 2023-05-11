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

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

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
					<strong>Reconsideração de admissiblidade</strong>
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
							<th>Data Publicação do parecer</th>
							<th>Tipo Processo</th>
							<th>Tipo Alvará</th>
							<th>Tipo Alvará</th>
							<th>Tipo Alvará</th>

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
							$buscar_cadastros = "SELECT i.sts, i.id, i.sei, i.numsql, i.dataprotocolo, i.tipoprocesso, i.tipoalvara1, i.tipoalvara2, i.tipoalvara3, d.tec
							FROM INICIAL i
							INNER JOIN DISTRIBUICAO d ON i.id = d.controleinterno
							LEFT JOIN reconsideracao_admissibilidade r ON i.id = r.controleinterno
							WHERE i.sts = 3 AND r.controleinterno IS NULL AND i.sei LIKE '%$data%' ORDER BY id DESC";
						} else {
							$buscar_cadastros = "SELECT i.sts, i.id, i.sei, i.numsql, i.dataprotocolo, i.tipoprocesso, i.tipoalvara1, i.tipoalvara2, i.tipoalvara3, d.tec
							FROM INICIAL i
							INNER JOIN DISTRIBUICAO d ON i.id = d.controleinterno
							LEFT JOIN reconsideracao_admissibilidade r ON i.id = r.controleinterno
							WHERE i.sts = 4 AND r.controleinterno IS NULL ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
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
							$tipoalvara1 = $receber_cadastros['tipoalvara1'];
							$tipoalvara2 = $receber_cadastros['tipoalvara2'];
							$tipoalvara3 = $receber_cadastros['tipoalvara3'];
							$tec = $receber_cadastros['tec'];
							$sts = $receber_cadastros['sts'];


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
					<li class="page-item"><a class="page-link" href="cadastroreconadmissibilidade.php?pagina=1">Primeira</a></li>

					<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo "<li class='page-item'><a class='page-link' href='cadastroreconadmissibilidade.php?pagina=$pag_ant'>$pag_ant</a></li>";
						}
					} ?>

					<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

					<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'><a class='page-link' href='cadastroreconadmissibilidade.php?pagina=$pag_dep'>$pag_dep</a></li>";
						}
					}


					echo "<li class='page-item'><a class='page-link' href='cadastroreconadmissibilidade.php?pagina=$quantidade_pg'>Última</a></li>";

					echo '</ul>';
					echo '</nav>';


					$stmt = $mysqli->prepare("SELECT * FROM inicial WHERE id = ?");
					$stmt->bind_param("i", $controleinterno);
					$stmt->execute();
					$result = $stmt->get_result();

					$dataprotocolo_br = '';

					while ($row = mysqli_fetch_array($result)) {
						$dataprotocolo = $row['dataprotocolo'];
					}

					$datalimite = date('Y-m-d', strtotime($dataprotocolo . ' + 15 days'));


					?>


		</div>
		<div id="form" hidden>
			<form class="need-validation" no validade method="POST" action="addreconadmissibilidade.php" autocomplete="off" name="formulario" id="formulario">
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados do Processo</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-3">
								<label for="sei" class="form-label">N° de Controle interno:</label>
								<input type="text" class="form-control form-control-sm" id="controleinterno" readonly name="controleinterno" value="<?php echo htmlspecialchars($controleinterno); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="sei" class="form-label">N° do Processo SEI:</label>
								<input type="text" class="form-control form-control-sm" id="sei" readonly name="sei" value="<?php echo htmlspecialchars($sei); ?>"></input>
							</div>

							<div class="col col-3">
								<label for="dataprotocolo" class="form-label">Data de Protocolo:</label>
								<input type="date" class="form-control form-control-sm" id="dataprotocolo" readonly name="dataprotocolo" value="<?php echo htmlspecialchars($dataprotocolo); ?>"></input>
							</div>
							<div class="col col-3">
								<label for="datalimite" class="form-label">Data de limite para análise de admissiblidade:</label>
								<input type="date" class="form-control form-control-sm" id="datalimite" readonly name="datalimite" value="<?php echo htmlspecialchars($datalimite); ?>"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="card bg-light mb-3">
					<div class="card-header">
						<strong>Dados de Reconsideração de Admissibilidade</strong>
					</div>
					<div class="card-body">
						<div>
							<form class="need-validation" no validade method="POST" action="addreconadmissibilidade.php" autocomplete="off" name="frm" onsubmit=" return verificarControleInterno();">
								<div class="form-row">
									<div class="col col-6">
										<label for="datarecon" class="form-label">Data de apresentação do pedido de reconsideração da decisão interlocutória</label>
										<input type="date" class="form-control form-control-sm" id="datarecon" name="datarecon">
									</div>
									<div class="col col-3">
										<label for="datapubli" class="form-label">Data de publicação da nova decisão interlocutória:</label>
										<input type="date" class="form-control form-control-sm" id="datapubli" name="datapubli">
									</div>
									<div class="col col-3">
										<label for="parecer" class="form-label">Parecer da nova decisão interlocutória:</label>
										<select class="form-select" aria-label="Default select example" name="parecer" id="parecer">
											<option selected></option>
											<option value="1">Admissível</option>
											<option value="2">Mantida a inadmissibilidade</option>
										</select>
									</div>
									<div class="col col-3">
										<label for="decisao" class="form-label">Data de envio Coordenadoria/Secretarias:</label>
										<input type="date" class="form-control form-control-sm" id="dataenvio" name="dataenvio" onchange="atualizarDataReuniao()">
									</div>
									<div class="col col-3">
										<label for="decisao" class="form-label">Coordenadoria/Divisão de SMUL</label>
										<select class="form-select" aria-label="Default select example" name="coordenadoria" id="coordenadoria">
											<option selected></option>
											<option value="1">COMIN</option>
											<option value="2">COMIN/DCIGP</option>
											<option value="3">COMIN/DCIMP</option>
											<option value="4">PARHIS</option>
											<option value="5">PARHIS/DHIS</option>
											<option value="6">PARHIS/DHMP</option>
											<option value="7">PARHIS/DPS</option>
											<option value="8">RESID</option>
											<option value="9">RESID/DRPM</option>
											<option value="10">RESID/DRGP</option>
											<option value="11">RESID/DRU</option>
											<option value="12">SERVIN</option>
											<option value="13">SERVIN/DSIGP</option>
											<option value="14">SERVIN/DCIMP</option>
										</select>
									</div>
									<div class="col col-3">
										<label for="datareuniao" class="form-label">Data Agendada GRAPROEM</label>
										<input type="date" class="form-control form-control-sm" id="datareuniao" name="datareuniao" readonly>
									</div>
								</div>
								<br>
								<button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
								<button type="button" class="btn btn-dark ml-auto" name="cancelar" id="cancelar">Cancelar</button>
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
			window.location = 'cadastroreconadmissibilidade.php?search=' + search.value;
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

		function atualizarDataReuniao() {
			var dataenvio = new Date(document.getElementById("dataenvio").value);
			var datareuniao = new Date(dataenvio);

			// Adicionar 60 dias à data da reunião
			datareuniao.setDate(datareuniao.getDate() + 60);

			// Verificar se a data da reunião é uma quarta-feira
			while (datareuniao.getDay() !== 2) { // 3 representa a quarta-feira (domingo = 0, segunda-feira = 1, ..., sábado = 6)
				datareuniao.setDate(datareuniao.getDate() - 1); // Adicionar um dia até encontrar uma quarta-feira
			}

			// Verificar se a data da reunião está dentro do prazo de 60 dias a partir da data de envio
			var limite = new Date(dataenvio);
			limite.setDate(limite.getDate() + 60);
			if (datareuniao > limite) {
				while (datareuniao.getDay() !== 2) { // Verificar se a data é uma quarta-feira
					datareuniao.setDate(datareuniao.getDate() - 1); // Subtrair um dia até encontrar uma quarta-feira
				}
			}	

			// Formatar a data no formato "YYYY-MM-DD"
			var dataFormatada = datareuniao.toISOString().split("T")[0];

			// Atualizar o valor do campo "datareuniao"
			document.getElementById("datareuniao").value = dataFormatada;
		}
	</script>
	</div>
	</div>




</body>

</html>