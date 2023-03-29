<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['SesID'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}

include 'navbar.php';
include 'conexao.php';

$login = $_SESSION['SesID'];
$permissao = $_SESSION['Perm'];
$status = $_SESSION['Status'];

if ($permissao == 2) {
  header("location: erropermissao.php");
}

$sql = "SELECT MAX(id) AS last_id FROM inicial";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Caso haja registros, pega o valor do último número registrado e adiciona 1
  $row = $result->fetch_assoc();
  $next_id = $row["last_id"] + 1;
} else {
  // Caso não haja registros, assume o valor 1
  $next_id = 1;
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php include 'head.php'; ?>
</head>

<body>

  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
  </svg>

  <?php
  $dataprotocolo = '';

  ?>

  <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">
    <div class="card bg-light mb-3">
      <div class="card-header">
        <strong>Cadastro Inicial</strong>
      </div>
      <div class="card-body">
        <form method="POST" action="">
          <div class="form-row">
            <div class="d-flex align-items-center">
              <div>
                <label for="datasql" class="form-label">SQL:</label>
                <input type="text" class="form-control form-control-sm" id="buscasql" name="buscasql"></input>
              </div>
              <div class="ml-2">
                <button class="btnpesquisa2 btn-outline-success" type="submit" name="busca">Pesquisar</button>
              </div>
            </div>
          </div>
        </form>

        <?php
        include 'conexao.php';

        $alert = '';
        $numsql = '';

        if (isset($_POST['busca'])) {
          $pesquisa = $_POST['buscasql'];
          $numsql = $_POST['buscasql'];
          if ($conn) {
            $buscar_cadastros = "SELECT * FROM Inicial
              WHERE numsql = '$pesquisa'
              AND sts = 2
              AND dataprotocolo BETWEEN DATE_SUB(NOW(), INTERVAL 120 DAY) AND NOW() ORDER BY dataprotocolo DESC LIMIT 1";

            $query_cadastros = mysqli_query($conn, $buscar_cadastros);

            if (mysqli_num_rows($query_cadastros) > 0) {
              // Formata os resultados da pesquisa em HTML
              while ($result = mysqli_fetch_assoc($query_cadastros)) {
                $id = $result['id'];
                $sei = $result['sei'];
                $dataprotocolo = $result['dataprotocolo'];
                $numsql = $result['numsql'];
              }

              // Criar objetos DateTime para as datas
              $data1 = new DateTime($dataprotocolo);
              $data2 = new DateTime(); // data atual

              // Calcula a diferença entre as datas em dias
              $diferenca = $data2->diff($data1)->format("%a");
              $diferenca = $diferenca - 1;

              $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Atenção!</strong> Esse SQL possui um protocolo indeferido nos últimos 120 dias!
              <br><br>
              A data de protocolo do último processo foi em ' . htmlspecialchars($dataprotocolo) . ' <strong>há ' . htmlspecialchars($diferenca) . ' dias.</strong>
              <br><br>';

              if ($diferenca < 90) {
                $aviso = "Não poderão ser protocolados processos via procedimento Aprova-Rápido";
              } elseif ($diferenca >= 90 && $diferenca < 120) {
                $aviso = "Poderão ser protocolados apenas pedidos de Alvará de Aprovação ou de Alvará de Execução";
              }

              $alert .= $aviso . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            } else {
              // Mostra a mensagem de 0 resultados

              $alert = '<div class="alert alert-success d-flex align-items-center" role="alert">
              <strong>O processo pode ser protocolado!</strong> Não há processos indeferidos nos últimos 120 dias para esse SQL.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
          } else {
            echo "Falha na conexão com o banco de dados.";
          }
        }
        ?>

        <div class="form-row">
          <div class="col col-3">
            <label for="novocontrole" class="form-label">Número de Controle interno:</label>
            <input type="text" class="form-control form-control-sm" id="novocontrole" readonly name="novocontrole" value="<?php echo htmlspecialchars($next_id); ?>"></input>
          </div>
          <div class="col col-3">
            <label for="datasql" class="form-label">Data do último protocolo para esse SQL:</label>
            <input type="text" class="form-control form-control-sm" id="datasql" readonly name="datasql" value="<?php echo htmlspecialchars($dataprotocolo); ?>"></input>
          </div>
        </div>
        <div class="form-row">
          <div class="col col-6">
            <br>
            <?php echo $alert; ?>

          </div>
        </div>
      </div>
    </div>
    <div class="card bg-light mb-3">
      <div class="card-header">
        <strong>Dados Iniciais</strong>
      </div>
      <div class="card-body">
        <form class="need-validation" novalidade method="POST" action="addcadastroinicial.php" autocomplete="off">
          <div class="form-row">
            <div class="col col-3">
              <label for="sei" class="form-label sei">Nº SEI:</label>
              <input type="text" class="form-control form-control-sm" id="sei" name="sei" required="required">
            </div>
            <div class="col col-3">
              <label for="numsql" class="form-label sql">SQL:</label>
              <input type="text" class="form-control form-control-sm" id="numsql" name="numsql" readonly value="<?php echo htmlspecialchars($numsql); ?>">
            </div>
            <div class="col col-3">
              <label for="tipo" class="form-label">Tipo:</label>
              <input type="text" class="form-control form-control-sm" id="tipo" name="tipo">
            </div>
            <div class="col col-3">
              <label for="req" class="form-label">REQ:</label>
              <input type="text" class="form-control form-control-sm" id="req" name="req">
            </div>
          </div>
          <div class="form-row">
            <div class="col col-3">
              <label for="aprova" class="form-label digital">N° Aprova Digital:</label>
              <input type="text" class="form-control form-control-sm" id="digital" name="digital">
            </div>
            <div class="col col-3">
              <label for="fisico" class="form-label fisico">Nº Processo Físico:</label>
              <input type="text" class="form-control form-control-sm" id="fisico" name="fisico">
            </div>
            <div class="col col-3">
              <label for="dataprotocolo" class="form-label">Data de Protocolo pelo interessado:</label>
              <input type="text" class="form-control form-control-sm" id="dataprotocolo" name="dataprotocolo">
            </div>
            <div class="col col-3">
              <label for="tipoprocesso" class="form-label">Tipo de processo:</label>
              <select class="form-select" aria-label="Default select example" name="tipoprocesso" id="tipoprocesso">
                <option selected></option>
                <option value="1">Próprio de SMUL</option>
                <option value="2">Múltiplas Interfaces</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col col-3">
              <label for="alv1" class="form-label">Tipo de Alvará:</label>
              <select class="form-select" aria-label="Default select example" name="alv1" id="alv1">
                <option selected></option>
                <option value="1">Nada</option>
                <option value="2">Projeto Modificativo</option>
              </select>
            </div>
            <div class="col col-3">
              <label for="alv2" class="form-label">Tipo de Alvará 2:</label>
              <select class="form-select" aria-label="Default select example" name="alv2" id="alv2">
                <option selected></option>
                <option value="1">Alvará de Aprovação</option>
                <option value="2">Alvará de Aprovação e Execução</option>
                <option value="3">Alvará de Execução</option>
              </select>
            </div>
            <div class="col col-3">
              <label for="alv3" class="form-label">Tipo de Alvará 3:</label>
              <select class="form-select" aria-label="Default select example" name="alv3" id="alv3">
                <option selected></option>
                <option value="1">Edificação Nova</option>
                <option value="2">Reforma</option>
                <option value="3">Requalificação</option>
                <option value="4">Requalificação associada a reforma</option>
              </select>
            </div>
            <div class="col col-3">
              <label for="stand" class="form-label">Há pedido de stand de vendas?:</label>
              <select class="form-select" aria-label="Default select example" name="stand" id="stand">
                <option selected></option>
                <option value="1">Sim</option>
                <option value="2">Não</option>
              </select>
            </div>
          </div>
          <div class="form-row">
             <div class="col col-3">
              <label for="status" class="form-label">Status:</label>
              <select class="form-select" aria-label="Default select example" name="status" id="status">
                <option selected></option>
                <option value="1">Análise de Admissibilidade</option>
                <option value="2">Inadmissível/Via ordinária</option>
                <option value="3">Em análise</option>
                <option value="4">Deferidos</option>
                <option value="5">Indeferidos</option>
                <option value="6">Inválido</option>
              </select>
            </div>
            <div class="col col-3">
              <label for="descstatus" class="form-label">Descrição de Status:</label>
              <input type="text" class="form-control form-control-sm" id="descstatus" name="descstatus">
            </div>
            <div class="col col-3">
              <label for="decreto" class="form-label">Anterior ao Decreto ou após novo Decreto?:</label>
              <select class="form-select" aria-label="Default select example" name="decreto" id="decreto">
                <option selected></option>
                <option value="1">Anterior</option>
                <option value="2">Posterior</option>
              </select>
            </div>
            <div class="col col-3">
              <label for="dataad" class="form-label">Data de início Admissibilidade:</label>
              <input type="text" class="form-control form-control-sm" id="dataad" name="dataad">
            </div>
          </div>
          <div class="row">
            <div class=".col-12 .col-md-8">
              <label class="form-label" for="obs">Observação:</label>
              <textarea class="form-control form-control-sm textarea" id="obs" rows="" name="obs" maxlength="300"></textarea>
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
        </form>
      </div>
    </div>
</body>

<script>
  //Função para as caixas de data funcionarem corretamente.


  $(document).ready(function() {
    $('#myModal').modal('show');
  })

  function fecharmodal() {
    $('#myModal').modal('hide');
  }

  $(document).ready(function() {
    var date_input = $('input[name="dataprotocolo"]');
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
      format: 'dd/mm/yyyy',
      container: container,
      todayHighlight: true,
      autoclose: true,
      regional: 'pt-BR'
    })
  })

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

  $(document).ready(function() {
    $('#fisico').mask('0000-0.000.000-0');
  });

  $(document).ready(function() {
    $('#digital').mask('00000-00-AA-AAA');
  });

  $(document).ready(function() {
    $('#sql').mask('000.000.0000-0');
  });

  $(document).ready(function() {
    $('#sei').mask('0000.0000/0000000-0');
  });
</script>

</html>