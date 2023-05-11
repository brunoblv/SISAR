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
					<strong>Processos aguardando análise de admissibilidade</strong>
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
							<th>Data início Admissibilidade</th>
							<th>Data limite</th>
							<th>Dias restantes</th>
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
							$buscar_cadastros = "SELECT Inicial.*, distribuicao.tec FROM inicial JOIN distribuicao ON inicial.id = distribuicao.controleinterno WHERE inicial.id IN (SELECT controleinterno FROM distribuicao) AND inicial.id NOT IN (SELECT controleinterno FROM admissibilidade) AND sei LIKE '%$data%' ORDER BY id DESC";
						} else {
							$buscar_cadastros = "SELECT Inicial.*, distribuicao.tec FROM inicial JOIN distribuicao ON inicial.id = distribuicao.controleinterno  WHERE inicial.id IN (SELECT controleinterno FROM distribuicao)AND inicial.id NOT IN (SELECT controleinterno FROM admissibilidade) ORDER BY inicial.id DESC LIMIT $inicio, $qnt_result_pg";
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
							$dataad = $receber_cadastros['dataad'];
							$tipoprocesso = $receber_cadastros['tipoprocesso'];
							$tipoalvara1 = $receber_cadastros['tipoalvara1'];
							$tipoalvara2 = $receber_cadastros['tipoalvara2'];
							$tipoalvara3 = $receber_cadastros['tipoalvara3'];
							$stand = $receber_cadastros['stand'];
							$sts = $receber_cadastros['sts'];
							$decreto = $receber_cadastros['decreto'];


							//calculando quantos dias faltam para vencer a análise de admissibilidade
							$hoje = date("Y-m-d");
							$diferenca = abs(strtotime($hoje) - strtotime($dataad));
							$dias = floor($diferenca / (60 * 60 * 24));
							$datalimite = date('Y-m-d', strtotime($dataad . ' + 15 days'));
							$diasrestantes = 15 - $dias;


							// Invertendo a data do SQL para o formato brasileiro
							$dataprotocolo_br = date("d/m/Y", strtotime($dataprotocolo));
							$dataad_br = date("d/m/Y", strtotime($dataad));
							$datalimite_br = date("d/m/Y", strtotime($datalimite));


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


							$tec = $receber_cadastros['tec'];
						?>
							<tr>
								<td><a class='btnpesquisa btn-outline-info copiar botaoselecao'><span class="glyphicon glyphicon-edit"></span>Selecionar</a></td>
								<td class="ci" scope="row"><?php echo $controleinterno ?></td>
								<td class="sei"><?php echo $sei ?></td>
								<td><?php echo $numsql ?></td>
								<td><?php echo $tec ?></td>
								<td><?php echo $dataprotocolo_br ?></td>
								<td><?php echo $dataad_br ?></td>
								<td><?php echo $datalimite_br ?></td>
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
					<li class="page-item"><a class="page-link" href="cadastroadmissibilidade.php?pagina=1">Primeira</a></li>

					<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo "<li class='page-item'><a class='page-link' href='cadastroadmissibilidade.php?pagina=$pag_ant'>$pag_ant</a></li>";
						}
					} ?>

					<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

					<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'><a class='page-link' href='cadastroadmissibilidade.php?pagina=$pag_dep'>$pag_dep</a></li>";
						}
					}


					echo "<li class='page-item'><a class='page-link' href='cadastroadmissibilidade.php?pagina=$quantidade_pg'>Última</a></li>";

					echo '</ul>';
					echo '</nav>';

					?>

		</div>
		<div id="form" hidden>
			<form class="need-validation" no validade method="POST" action="addadmissibilidade.php" autocomplete="off" name="formulario" id="formulario">
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


							$datalimite = date('Y-m-d', strtotime($dataad . ' + 15 days'));

							$datalimite = date("d/m/Y", strtotime($datalimite));

							$dataad = date("d/m/Y", strtotime($dataad));

							?>

							<div class="col col-3">
								<label for="dataad" class="form-label">Data de início da Análise de Admissibilidade</label>
								<input type="text" class="form-control form-control-sm" id="dataad" readonly name="dataad" value="<?php echo htmlspecialchars($dataad); ?>"></input>
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
						<strong>Dados de Admissibilidade</strong>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col col-3">
								<label for="decisao" class="form-label">Data de publicação da decisão interlocutória</label>
								<input type="date" class="form-control form-control-sm" id="datapubli" name="datapubli">
							</div>
							<div class="col col-3">
								<label for="decisao" class="form-label">Parecer da decisão interlocutória</label>
								<select class="form-select" aria-label="Default select example" name="parecer" id="parecer" required>
									<option selected></option>
									<option value='1'>Admissível</option>
									<option value='2'>Inadmissível</option>
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
						</div>
						<div class="form-row">
							<div class="col col-3">
								<label for="sub" class="form-label">Subprefeitura:</label>
								<select class="form-select" aria-label="Default select example" name="sub" id="sub">
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
							<div class="col col-3">
								<label for="categoria" class="form-label">Categoria de Uso:</label>
								<input type="text" class="form-control form-control-sm" id="categoria" name="categoria">
							</div>

							<div class="col col-3">
								<label for="datareuniao" class="form-label">Data Agendada GRAPROEM</label>
								<input type="date" class="form-control form-control-sm" id="datareuniao" name="datareuniao" readonly>
							</div>
						</div>
						<br>
						<div class="form-row motivos" style="display: none;">
							<div class="col col-3">
								<label for="decisao" class="form-label">Motivos da Inadmissibilidade</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" name="motivo1">
									<label class="form-check-label" for="motivo1"> Não cumprimento de requisito
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="2" name="motivo2">
									<label class="form-check-label" for="motivo2"> Ausência de documentos
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="3" name="motivo3">
									<label class="form-check-label" for="motivo3"> Documentação não conforme com descrição solicitada
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="4" name="motivo4">
									<label class="form-check-label" for="motivo4"> Não está de acordo com os parâmetros urbanisticos
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="5" name="motivo5">
									<label class="form-check-label" for="motivo5"> Não foi dado baixa no pagamento das guias
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="6" name="motivo6">
									<label class="form-check-label" for="motivo5"> Nenhuma das anteriores
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
				while (datareuniao.getDay() !== 3) { // Verificar se a data é uma quarta-feira
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