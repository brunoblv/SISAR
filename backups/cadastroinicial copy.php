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

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Título do Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-header">
            <strong>Verificar protocolos do SQL</strong>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="d-flex align-items-center">
                <form class="need-validation" no validade method="POST" action="pesquisar.php" autocomplete="off" name="formulario" id="formulario">>
                  <input class="form-control form-control-sm form-control form-control-sm-sm" type="search" placeholder="Pesquisar com o N° SQL" name="pesquisar" id="pesquisar">
                  <button class="btnpesquisa btn-outline-success" onclick="search()" type="submit">Pesquisar</button>   
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="fecharmodal()">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar mudanças</button>
      </div>
    </div>
  </div>
  </div>
  <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">
    <div class="card bg-light mb-3">
      <div class="card-header">
        <strong>Cadastro Inicial</strong>
      </div>
      <div class="card-body">
        <div class="form-row">
          <div class="col col-3">
            <label for="novocontrole" class="form-label">Número de Controle interno:</label>
            <input type="text" class="form-control form-control-sm" id="novocontrole" readonly name="novocontrole" required="required" value="<?php echo htmlspecialchars($next_id); ?>"></input>
          </div>
          <div class="col col-3">
            <label for="datasql" class="form-label">Data do último protocolo para esse SQL:</label>
            <input type="text" class="form-control form-control-sm" id="datasql" readonly name="datasql" required="required" value="<?php echo htmlspecialchars($next_id); ?>"></input>
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
              <input type="text" class="form-control form-control-sm" id="numsql" name="numsql" required="required">
            </div>
            <div class="col col-3">
              <label for="tipo" class="form-label">Tipo:</label>
              <input type="text" class="form-control form-control-sm" id="tipo" name="tipo" required="required">
            </div>
            <div class="col col-3">
              <label for="req" class="form-label">REQ:</label>
              <input type="text" class="form-control form-control-sm" id="req" name="req" required="required">
            </div>
          </div>
          <div class="form-row">
            <div class="col col-3">
              <label for="aprova" class="form-label digital">N° Aprova Digital:</label>
              <input type="text" class="form-control form-control-sm" id="digital" name="digital" required="required">
            </div>
            <div class="col col-3">
              <label for="fisico" class="form-label fisico">Nº Processo Físico:</label>
              <input type="text" class="form-control form-control-sm" id="fisico" name="fisico" required="required">
            </div>
            <div class="col col-3">
              <label for="dataprotocolo" class="form-label">Data do Protocolo:</label>
              <input type="text" class="form-control form-control-sm" id="dataprotocolo" name="dataprotocolo" required="required">
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
              <label for="uso" class="form-label">Categoria de Uso:</label>
              <input type="text" class="form-control form-control-sm" id="uso" name="uso" required="required">
            </div>
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
              <input type="text" class="form-control form-control-sm" id="descstatus" name="descstatus" required="required">
            </div>
            <div class="col col-3">
              <label for="decreto" class="form-label">Anterior ao Decreto ou após novo Decreto?:</label>
              <input type="text" class="form-control form-control-sm" id="decreto" name="decreto" required="required">
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

  function fecharmodal() {
    $('#myModal').modal('hide');
  }


  $(document).ready(function() {
    $('#myModal').modal('show');
  })

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

  function search() {
    // Captura o valor do input de pesquisa
    var pesquisar = document.getElementById("pesquisar").value;

    // Cria uma nova solicitação HTTP
    var xhr = new XMLHttpRequest();

    // Configura a solicitação com o método POST e a URL do arquivo PHP que irá lidar com a pesquisa
    xhr.open("POST", "pesquisar.php", true);

    // Define o cabeçalho da solicitação
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Define a função de callback para lidar com a resposta do servidor
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Insere os resultados da pesquisa no corpo do modal
        document.getElementById("search-results").innerHTML = xhr.responseText;
      }
    };

    // Envia a solicitação com os dados de pesquisa
    xhr.send("pesquisar=" + pesquisar);
  }

  let variavel = decodeURIComponent(document.cookie.replace(/(?:(?:^|.*;\s*)variavel\s*\=\s*([^;]*).*$)|^.*$/, "$1"));
  console.log(variavel);
</script>

</html>