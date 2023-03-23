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

if ($permissao == 2) {
  header("location: erropermissao.php");
}

?>
<!doctype html>
<html lang="pt-br">

<head>
  <?php include 'head.php'; ?>
  <title>Alteração Usuários</title>



</head>

<body>

  <?php include 'navbar.php';

  include "conexao.php";
  $id = $_GET['id'];
  $sql = "SELECT * FROM usuarios WHERE id = '$id'";
  $dados = mysqli_query($conn, $sql);
  $linha = mysqli_fetch_assoc($dados);
  $nome = $linha['nome'];
  $usuario = $linha['usuario'];
  $permissao = $linha['permissao'];

  ?>

  <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">
    <h4 class="mb-3">Alteração de usuários</h4>
    <hr class="mb-4">
    <form class="need-validation" no validade method="POST" action="alterarusuario.php" autocomplete="off">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="numprocesso" class="form-label">Usuário:</label>
          <input type="text" class="form-control" id="usuario" name="usuario" required="required" value="<?php echo $linha['usuario'] ?>">
        </div>
        <div class="col-md-6 mb-3">
          <label for="numprocesso" class="form-label">Nome:</label>
          <input type="text" class="form-control" id="nome" name="nome" required="required" value="<?php echo $linha['nome'] ?>">
        </div>
      </div>
      <div class="row">

        <div class="col-md-6 mb-3">
          <label for="permissao" class="form-label">Permissão:</label>
          <select class="form-select" id="permissao" required name="permissao">
            <option value="Ponto Focal">SuperAdmin</option>
            <option value="Administrador">Administrador</option>
            <option value="Ponto Focal">Ponto Focal</option>

            <script>
              var permissao = '<?php echo $permissao; ?>';

              switch (permissao) {
                case 'SuperAdmin':
                  document.getElementById('permissao').value = "SuperAdmin";
                  break;
                case 'Administrador':
                  document.getElementById('permissao').value = "Administrador";
                  break;
                case 'Ponto Focal':
                  document.getElementById('permissao').value = "Ponto Focal";
                  break;

              }
            </script>

          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="statususer" class="form-label">Status:</label>
          <select class="form-select" id="statususer" required name="statususer">
            <option>Ativo</option>
            <option>Desativado</option>
          </select>
          <script>
            var statususer = '<?php echo $statususer; ?>';
            if (statususer == 'Ativo') {
              document.getElementById('statususer').value = "Ativo";
            } else {
              document.getElementById('statususer').value = "Desativado";
            }
          </script>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>

      <div class="col-md-6 mb-3">

        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $linha['id'] ?>">
      </div>

  </div>
  </form>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>



</body>

</html>