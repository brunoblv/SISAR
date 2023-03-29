<style>
	.nav-link[data-toggle].collapsed:after {
		content: " ▾";
	}

	.nav-link[data-toggle]:not(.collapsed):after {
		content: " ▴";
	}
</style>

<div class="wrapper d-flex align-items-stretch">
	<nav id="sidebar">
		<div class="custom-menu">
			<button type="button" id="sidebarCollapse" class="btn btn-primary">
				<i class="fa fa-bars"></i>
				<span class="sr-only">Toggle Menu</span>
			</button>
		</div>

		<div class="p-4">
			<h1><a href="principal.php" class="logo">SISAR <span>Sistema Aprova Rápido</span></a></h1>
			<ul class="list-unstyled components mb-5">
				<li class="active">
					<a href="principal.php"><span class="fa fa-home mr-3"></span>Home</a>
				</li>
				<li class="active"><a class="nav-link collapsed text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><span class="fa fa-home mr-3"></span>Cadastros</a>
					<div class="collapse" id="submenu1" aria-expanded="false">
						<ul class="flex-column pl-2 nav">
							<li>
								<a href="cadastroinicial.php"><span class="fa fa-desktop mr-3"></span>Cadastro Inicial</a>
							</li>
							<li>
								<a href="cadastrodistribuicao.php"><span class="fa fa-briefcase mr-3"></span>Distribuição</a>
							</li>
							<li>
								<a href="cadastroadmissibilidade.php"><span class="fa fa-user mr-3"></span>Admissibilidade</a>
							</li>
							<li>
								<a href="cadastroreconadmissibilidade.php"><span class="fa fa-user mr-3"></span>Reconsideração de Admissibilidade</a>
							</li>
							<li>
								<a href="cadastrosmul.php"><span class="fa fa-user mr-3"></span>Coordenadoria de SMUL</a>
							</li>
							<li>
								<a href="cadastrosecretarias.php"><span class="fa fa-user mr-3"></span>Outras Secretarias</a>
							</li>
							<li>
								<a href="cadastroprimeirainstancia.php"><span class="fa fa-user mr-3"></span>1ª Instância</a>
							</li>
							<li>
								<a href="cadastrosegundainstancia.php"><span class="fa fa-user mr-3"></span>2ª Instância</a>
							</li>
							<li>
								<a href="cadastroterceirainstancia.php"><span class="fa fa-user mr-3"></span>3ª Instância</a>
							</li>
							<li>
								<a href="cadastroprazo.php"><span class="fa fa-user mr-3"></span>Suspensão de prazos</a>
							</li>
							<li>
								<a href="cadastroconclusao.php"><span class="fa fa-user mr-3"></span>Conclusão</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="active">
					<a href="consultarsql.php"><span class="fa fa-home mr-3"></span>Consultar SQL</a>
				</li>
				<li class="active"><a class="nav-link collapsed text-truncate" href="#submenu2" data-toggle="collapse" data-target="#submenu2" aria-expanded="false"><span class="fa fa-home mr-3"></span>Controle de Prazos</a>
					<div class="collapse" id="submenu2" aria-expanded="false">
						<ul class="flex-column pl-2 nav">
							<li>
								<a href="prazoad.php"><span class="fa fa-desktop mr-3"></span>Prazo para Análise de Admissibilidade</a>
							</li>							
						</ul>
					</div>
				</li>
				<li class="active"><a class="nav-link collapsed text-truncate" href="#submenu3" data-toggle="collapse" data-target="#submenu3" aria-expanded="false"><span class="fa fa-home mr-3"></span>Alteração de Dados</a>
					<div class="collapse" id="submenu3" aria-expanded="false">
						<ul class="flex-column pl-2 nav">
							<li>
								<a href="alterar.php"><span class="fa fa-desktop mr-3"></span>Dados Iniciais</a>
							</li>							
						</ul>
					</div>
				</li>
				<li class="active">
					<a href="principal.php"><span class="fa fa-home mr-3"></span>Cadastro de Usuários</a>
				</li>
			</ul>


			<div class="footer">
				
			</div>
			<?php echo $_SESSION['SesNome'];?> 
		</div>
	</nav>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#sidebarCollapse').on('click', function() {
				$('#sidebar').toggleClass('active');
			});
		});

		$(document).ready(function() {
			$("#submenu1").attr("aria-expanded", "false");
		});

		$(document).ready(function() {
			$("#submenu2").attr("aria-expanded", "false");
		});

		$(document).ready(function() {
			$("#submenu3").attr("aria-expanded", "false");
		});
	</script>