<?php 
if (!isset($_SESSION)) {
     session_start();
    }

if (!isset($_SESSION['SesID'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}




 ?>
<!doctype html>
<html lang="pt-br">
  <head>
  <?php include 'head.php';?>
	
  </head>
  <body> 
    <div class="alert alert-danger" role="alert">
      Você não tem permissão de acessar essa função! 
      <a href='principal.php'> Voltar </a>
    </div>
	

  </body>
</html>