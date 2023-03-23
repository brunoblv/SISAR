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
							$buscar_cadastros = "SELECT * FROM inicial WHERE id IN (SELECT controleinterno FROM admissibilidade WHERE parecer = 1) AND tipoprocesso = 2 AND sei LIKE '%$data%' ORDER BY id DESC";
						} else {
							$buscar_cadastros = "SELECT * FROM inicial WHERE id IN (SELECT controleinterno FROM admissibilidade WHERE parecer = 1) AND tipoprocesso = 2 ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
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
					<li class="page-item"><a class="page-link" href="cadastrosmul.php?pagina=1">Primeira</a></li>

					<?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo "<li class='page-item'><a class='page-link' href='cadastrosmul.php?pagina=$pag_ant'>$pag_ant</a></li>";
						}
					} ?>

					<li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

					<?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'><a class='page-link' href='cadastrosmul.php?pagina=$pag_dep'>$pag_dep</a></li>";
						}
					}


					echo "<li class='page-item'><a class='page-link' href='cadastrosmul.php?pagina=$quantidade_pg'>Última</a></li>";

					echo '</ul>';
					echo '</nav>';
					?>
		</div>
		<h4 class="mb-3">Cadastro Outras Secretarias</h4>
		<hr class="mb-4">
		<form class="need-validation" no validade method="POST" action="addsecretarias.php" autocomplete="off" name="frm" onsubmit=" return verificarControleInterno();">
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="controleinterno" class="form-label">Nº de Controle Interno:</label>
					<input type="text" class="form-control" id="controleinterno" name="controleinterno" required="required" readonly>
				</div>
				<div class="col-md-6 mb-3">
					<label for="sei" class="form-label">Nº SEI:</label>
					<input type="text" class="form-control" id="sei" name="sei" required="required" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="svma" class="form-label">Nº do Processo Relacionado SVMA:</label>
					<input type="text" class="form-control" id="svma" name="svma" required="required">
				</div>
				<div class="col-md-6 mb-3">
					<label for="interfacesvma" class="form-label">Possui Interface?</label>
					<select class="form-select" aria-label="Default select example" name="interfacesvma" id="interfacesvma">
						<option selected></option>
						<option>Sim</option>
						<option>Não</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="smt" class="form-label">Nº do Processo Relacionado SMT:</label>
					<input type="text" class="form-control" id="smt" name="smt" required="required">
				</div>
				<div class="col-md-6 mb-3">
					<label for="interfacesvma" class="form-label">Possui Interface?</label>
					<select class="form-select" aria-label="Default select example" name="interfacesmt" id="interfacesmt">
						<option selected></option>
						<option>Sim</option>
						<option>Não</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="smc" class="form-label">Nº do Processo Relacionado SMC:</label>
					<input type="text" class="form-control" id="smc" name="smc" required="required">
				</div>
				<div class="col-md-6 mb-3">
					<label for="interfacesvma" class="form-label">Possui Interface?</label>
					<select class="form-select" aria-label="Default select example" name="interfacesmc" id="interfacesmc">
						<option selected></option>
						<option>Sim</option>
						<option>Não</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="svma" class="form-label">Nº do Processo Relacionado SEHAB:</label>
					<input type="text" class="form-control" id="sehab" name="sehab" required="required">
				</div>
				<div class="col-md-6 mb-3">
					<label for="interfacesvma" class="form-label">Possui Interface?</label>
					<select class="form-select" aria-label="Default select example" name="interfacesehab" id="interfacesehab">
						<option selected></option>
						<option>Sim</option>
						<option>Não</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="svma" class="form-label">Nº do Processo Relacionado SIURB:</label>
					<input type="text" class="form-control" id="siurb" name="siurb" required="required">
				</div>
				<div class="col-md-6 mb-3">
					<label for="interfacesvma" class="form-label">Possui Interface?</label>
					<select class="form-select" aria-label="Default select example" name="interfacesiurb" id="interfacesiurb">
						<option selected></option>
						<option>Sim</option>
						<option>Não</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="dataenvio" class="form-label">Data de envio dos processos para as Secretarias:</label>
					<input type="text" class="form-control" id="dataenvio" name="dataenvio" dataenvio="required">
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


	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	<script>
		var search = document.getElementById('pesquisar');

		search.addEventListener("keydown", function(event) {
			if (event.key === "Enter") {
				searchData();
			}
		});

		function searchData() {
			window.location = 'cadastrosmul.php?search=' + search.value;
		}
	</script>
</body>

</html>