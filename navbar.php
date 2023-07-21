<style>

.nav-link[data-toggle].collapsed:after {
  content: " ▾";
}

.nav-link[data-toggle]:not(.collapsed):after {
  content: " ▴";
}

.sem-seta[data-toggle].collapsed:after {
  content: " ";
}

.sem-seta[data-toggle]:not(.collapsed):after {
  content: " ";
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
					<a href="principal.php"><span class="bx bx-home-alt icon mr-3"></span>Home</a>
				</li>
				<li class="active"><a class="nav-link collapsed text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><span class="bx bxs-plus-square  mr-3"></span>Cadastros</a>
					<div class="collapse" id="submenu1" aria-expanded="false">
						<ul class="flex-column pl-2 nav">
							<li>
								<a href="cadastroinicial.php"><span class="bx bx-plus mr-3"></span>Cadastro Inicial</a>
							</li>
							<li>
								<a href="cadastrodistribuicao.php"><span class="bx bxs-paper-plane mr-3"></span>Distribuição</a>
							</li>
							<li>
								<a href="cadastroadmissibilidade.php"><span class="bx bxs-analyse mr-3"></span>Admissibilidade</a>
							</li>
							<li>
								<a href="cadastroreconadmissibilidade.php"><span class="bx bx-analyse mr-3"></span>Reconsideração de Admissibilidade</a>
							</li>							
							<li>
								<a href="cadastrosecretarias.php"><span class="bx bxs-bank mr-3"></span>Coord. SMUL/Secretarias</a>
							</li>														
							<li>
								<a href="cadastroprazo.php"><span class="bx bx-stopwatch mr-3"></span>Suspensão de prazos</a>
							</li>
							<li>
								<a href="cadastroconclusao.php"><span class="bx bxs-check-circle mr-3"></span>Conclusão</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="active"><a class="nav-link collapsed text-truncate" href="#submenu2" data-toggle="collapse" data-target="#submenu2" aria-expanded="false"><span class="bx bxs-plus-square  mr-3"></span>Primeira Instância</a>
					<div class="collapse" id="submenu2" aria-expanded="false">
						<ul class="flex-column pl-2 nav">
							<li>
								<a href="cadastrograproem11.php"><span class="bx bx-plus mr-3"></span>1º GRAPROEM</a>
							</li>
							<li>
								<a href="cadastrograproem12.php"><span class="bx bxs-paper-plane mr-3"></span>2º GRAPROEM</a>
							</li>
							<li>
								<a href="cadastrograproem13.php"><span class="bx bxs-analyse mr-3"></span>3º GRAPROEM</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="active"><a class="nav-link collapsed text-truncate" href="#submenu4" data-toggle="collapse" data-target="#submenu4" aria-expanded="false"><span class="bx bxs-plus-square  mr-3"></span>Segunda Instância</a>
					<div class="collapse" id="submenu4" aria-expanded="false">
						<ul class="flex-column pl-2 nav">
							<li>
								<a href="cadastrograproem21.php"><span class="bx bx-plus mr-3"></span>1º GRAPROEM</a>
							</li>
							<li>
								<a href="cadastrograproem22.php"><span class="bx bxs-paper-plane mr-3"></span>2º GRAPROEM</a>
							</li>
							<li>
								<a href="cadastrograproem23.php"><span class="bx bxs-analyse mr-3"></span>3º GRAPROEM</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="active"><a class="nav-link collapsed text-truncate" href="#submenu5" data-toggle="collapse" data-target="#submenu5" aria-expanded="false"><span class="bx bxs-plus-square  mr-3"></span>Terceira Instância</a>
					<div class="collapse" id="submenu5" aria-expanded="false">
						<ul class="flex-column pl-2 nav">
							<li>
								<a href="cadastrograproem31.php"><span class="bx bx-plus mr-3"></span>1º GRAPROEM</a>
							</li>
							<li>
								<a href="cadastrograproem32.php"><span class="bx bxs-paper-plane mr-3"></span>2º GRAPROEM</a>
							</li>
							<li>
								<a href="cadastrograproem33.php"><span class="bx bxs-analyse mr-3"></span>3º GRAPROEM</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="active">
					<a href="consultarsql.php"><span class="bx bx-search-alt mr-3"></span>Consultar SQL</a>
				</li>
				<li class="active"><a class="nav-link collapsed text-truncate" href="#submenu3" data-toggle="collapse" data-target="#submenu3" aria-expanded="false"><span class="bx bx-calendar mr-3"></span>Controle de Prazos</a>
					<div class="collapse" id="submenu3" aria-expanded="false">
					<ul class="flex-column pl-2 nav">
							<li>
								<a href="controleprazos.php"><span class="bx bx-calendar-check mr-3"></span>Controle de prazo Geral</a>
							</li>							
						</ul>
						<ul class="flex-column pl-2 nav">
							<li>
								<a href="prazoad.php"><span class="bx bx-calendar-check mr-3"></span>Prazo para Análise de Admissibilidade</a>
							</li>							
						</ul>
					</div>
				</li>
				<li class="active">
					<a href="alterar.php"><span class="bx bx-edit mr-3"></span>Alteração de Dados</a>
				</li>				
				<li class="active">
					<a href="cadastrousuario.php"><span class="bx bxs-user-account mr-3"></span>Cadastro de Usuários</a>
				</li>
			</ul>
			<div class="footer"><span class="bx bxs-user mr-3"></span><?php echo $_SESSION['SesNome'];?> 
				
			</div>


			
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
		$(document).ready(function() {
			$("#submenu4").attr("aria-expanded", "false");
		});
		$(document).ready(function() {
			$("#submenu5").attr("aria-expanded", "false");
		});
	</script>