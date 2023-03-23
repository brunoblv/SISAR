<?php 
if (!isset($_SESSION)) {
     session_start();
    }

if (!isset($_SESSION['SesID'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

include 'navbar.php';

$login = $_SESSION['SesID'];
$permissao = $_SESSION['Perm'];
$status = $_SESSION['Status'];

if ($permissao == 2){
  header("location: erropermissao.php");
}



 ?>
<!doctype html>
<html lang="pt-br">
  <head>
  <?php include 'head.php';?>


	
  </head>
  <body>		
  

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
		<h4 class="mb-3">Cadastro de usuários</h4>
		<hr class="mb-4">
		<form class="need-validation" no validade method="POST" action="cadastrausuario.php" autocomplete="off">
		  <div class = "row"> 
			<div class="col-md-6 mb-3">
			  <label for="numprocesso" class="form-label">Usuário:</label>
			  <input type="text" class="form-control" id="usuario" name="usuario" required="required">
			</div>
			<div class="col-md-6 mb-3">
			  <label for="numprocesso" class="form-label">Nome:</label>
			  <input type="text" class="form-control" id="nome" name="nome" required="required">
			</div>  
		  </div>
		  <div class = "row"> 
		  <div class="col-md-6 mb-3">
                <label for="permissao" class="form-label">Permissão:</label>
                    <select class="form-select" id="permissao" required name="permissao">
                        <option>Administrador</option>
                        <option>Ponto Focal</option>                       
                        
                    </select>  
                </div>
     
      <div class="col-md-6 mb-3">
                <label for="statususer" class="form-label">Status:</label>
                    <select class="form-select" id="statususer" required name="statususer">
                        <option>Ativo</option>
                        <option>Desativado</option>                       
                        
                    </select>  
      </div>
			
		 </div>
		  <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
				  
		  </div>
		  </form>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

	

  </body>
</html>