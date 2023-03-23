<?php 
if (!isset($_SESSION)) {
     session_start();
    }

if (!isset($_SESSION['SesID'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

require 'conexao.php';

$login = $_SESSION['SesID'];
$permissao = $_SESSION['Perm'];
$status = $_SESSION['Status'];

if ($permissao == 2){
  header("location: erropermissao.php");
}
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include 'head.php';?>

<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="css/bootstrap-iso.css" /> 
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />


    <title>Cadastro de Usuários</title>
</head>

<body class="bg-light">

<?php   
    include "conexao.php";
    $id = $_GET['edit'] ?? '';
    $sql = "SELECT * FROM item WHERE id = '$id'";
    $dados = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($dados);         

?>

<!-- Inclui o Head com a NAVBar e os Scripts-->

<?php include 'header.php';?>

<!-- Controla o aparecimento dos campos caso seja escolhida a opção "Multipla Interface" no cadastro de processos-->

<?php require_once 'alteraritem.php';?>
<div class="bootstrap-iso">
  <div class="container">
    
      <h4 class="mb-3">Cadastro de bens</h4>
      <hr class="mb-4">
      <form class="need-validation" no validade method="POST" action="alteraitem.php" autocomplete="off">
        <div class = "row"> 
          <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Número do Patrimônio PMSP:</label>
            <input type="text" class="form-control" id="numpatri" name="numpatri" required="required" value="<?php echo $linha['patrimonio']; ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Tipo:</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required="required" value="<?php echo $linha['tipo']; ?>">
          </div>  
        </div>
        <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Marca:</label>
            <input type="text" class="form-control" id="marca" name="marca" required="required" value="<?php echo $linha['marca']; ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Modelo:</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required="required" value="<?php echo $linha['modelo']; ?>">
          </div>    
        </div>          
        <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numserie" class="form-label">Número de Série:</label>
            <input type="text" class="form-control" id="numserie" name="numserie" required="required" value="<?php echo $linha['numserie']; ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label for="setor" class="form-label">Setor:</label>
            <input type="text" class="form-control" id="setor" name="setor" required="required" value="<?php echo $linha['setor']; ?>">
          </div>    
        </div>
        <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Nome do Servidor:</label>
            <input type="text" class="form-control" id="servidor" name="servidor" required="required" value="<?php echo $linha['servidor']; ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">NIB:</label>
            <input type="text" class="form-control" id="nib" name="nib" required="required" value="<?php echo $linha['nib']; ?>">
          </div>    
        </div> 
        <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">NF:</label>
            <input type="text" class="form-control" id="nf" name="nf" required="required" value="<?php echo $linha['nf']; ?>">
          </div>
        <div class="col-md-6 mb-3">
           <label for="numprocesso" class="form-label">Nome do computador:</label>
           <input type="text" class="form-control" id="nomepc" name="nomepc" value="<?php echo $linha['nome']; ?>">
        </div>        
       </div>
       <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Status:</label>
            <select class="custom-select d-block w-100" id="statusitem" required name="statusitem" value="<?php echo $linha['statusitem']; ?>">
              <option>Ativo</option>  
              <option>Para Doação</option>
              <option>Para Descarte</option>
              <option>Doado</option>
              <option>Descartado</option>
                
              </select>  
          </div>
      
        
        
       </div>
        <button type="submit" class="btn btn-primary" name="salvar">Salvar Alterações</button>
                
        </div>
        </form>
    </div>
</div>


