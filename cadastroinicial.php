<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['SesID'])) {
  session_destroy();
  header("Location: index.php");
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
                <label for="datasql" class="form-label">Nº SQL:</label>
                <input type="text" class="form-control form-control-sm" id="buscasql" name="buscasql"></input>
              </div>
              <div class="ml-2">
                <button class="btnpesquisa2 btn-outline-success" type="submit" name="busca" id="busca">Pesquisar</button>
              </div>
            </div>
          </div>
        </form>

        <?php
        include 'conexao.php';

        $alert = '';
        $numsql = '';
        $pesquisa = '';

        if (isset($_POST['buscasql'])) {
          $pesquisa = $_POST['buscasql'];
          $numsql = $_POST['buscasql'];
          echo "o valor de pesquisa é:" . $pesquisa . $numsql;
          if ($conn) {
            $buscar_cadastros = "SELECT * FROM Inicial
              WHERE numsql = '$pesquisa'
              AND dataprotocolo BETWEEN DATE_SUB(NOW(), INTERVAL 120 DAY) AND NOW() ORDER BY dataprotocolo DESC LIMIT 1";

            $query_cadastros = mysqli_query($conn, $buscar_cadastros);

            if (mysqli_num_rows($query_cadastros) > 0) {
              // Formata os resultados da pesquisa em HTML
              while ($result = mysqli_fetch_assoc($query_cadastros)) {
                $id = $result['id'];
                $sei = $result['sei'];
                $dataprotocolo = $result['dataprotocolo'];
                $numsql = $result['numsql'];
                $conclusao = $result['conclusao'];
                $sts = $result['sts'];
              }

              // Criar objetos DateTime para as datas
              $data1 = new DateTime($dataprotocolo);
              $data2 = new DateTime(); // data atual

              // Calcula a diferença entre as datas em dias
              $diferenca = $data2->diff($data1)->format("%a");
              $diferenca = $diferenca - 1;

              $dataprotocolo = date("d/m/Y", strtotime($dataprotocolo));

              if ($sts == 4) {

                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Atenção!</strong> Esse SQL possui um protocolo inadmitido nos últimos 120 dias!
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
              <strong>O processo pode ser protocolado!</strong> Não há processos inadmitidos nos últimos 120 dias para esse SQL.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
              }
            } else {
              echo "Falha na conexão com o banco de dados.";
            }
          }
        }

        ?>

        <div class="form-row">
          <div class="col col-3">
            <label for="novocontrole" class="form-label">Número de Controle interno:</label>
            <input type="text" class="form-control form-control-sm" id="novocontrole" readonly name="novocontrole" value="<?php echo htmlspecialchars($pesquisa); ?>"></input>
          </div>
          <div class="col col-3">
            <label for="datasql" class="form-label">Data do último protocolo para esse SQL:</label>
            <input type="text" class="form-control form-control-sm" id="datasql" readonly name="datasql" value="<?php if (isset($diferenca)) {
                                                                                                                  echo htmlspecialchars($dataprotocolo . ' há ' . $diferenca . ' dias');
                                                                                                                } ?>"></input>
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
    <div id="dados" style="display: none;">
      <div class="card bg-light mb-3">
        <div class="card-header">
          <strong>Dados Iniciais</strong>
        </div>
        <div class="card-body">
          <form class="need-validation" novalidade method="POST" action="addcadastroinicial.php" autocomplete="off">
            <div class="form-row">
              <div class="col col-3">
                <label for="novocontrole" class="form-label">Número de Controle interno:</label>
                <input type="text" class="form-control form-control-sm" id="controleinterno" readonly name="controleinterno" value="<?php echo htmlspecialchars($next_id); ?>"></input>
              </div>
            </div>
            <div class="form-row">
              <div class="col col-3">
                <label for="sei" class="form-label sei">Nº SEI:</label>
                <input type="text" class="form-control form-control-sm" id="sei" name="sei" required="required">
              </div>
              <div class="col col-3">
                <label for="numsql" class="form-label sql">SQL:</label>
                <input type="text" class="form-control form-control-sm" id="numsql" name="numsql" value="<?php echo htmlspecialchars($numsql); ?>">
              </div>
              <div class="col col-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" class="form-control form-control-sm" id="tipo" name="tipo" placeholder="Verificar na TEV/COE o campo 05" maxlength="1">
              </div>
              <div class="col col-3">
                <label for="req" class="form-label">REQ:</label>
                <input type="text" class="form-control form-control-sm" id="req" name="req" placeholder="Verificar na TEV/COE o campo 05" maxlength="3">
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
                <input type="date" class="form-control form-control-sm" id="dataprotocolo" name="dataprotocolo" required>
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
                <label for="alv1" class="form-label">É projeto modificativo?</label>
                <select class="form-select" aria-label="Default select example" name="alv1" id="alv1">
                  <option selected></option>
                  <option value="1">Sim</option>
                  <option value="2">Não</option>
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
                <label for="decreto" class="form-label">Anterior ao Decreto ou após novo Decreto?:</label>
                <select class="form-select" aria-label="Default select example" name="decreto" id="decreto">
                  <option selected></option>
                  <option value="1">Anterior</option>
                  <option value="2">Posterior</option>
                </select>
              </div>
              <div class="col col-3">
                <label for="dataad" class="form-label">Data de início da Análise de Admissibilidade:</label>
                <input type="date" class="form-control form-control-sm" id="dataad" name="dataad" required>
              </div>
            </div>
            <div class="form-row motivos">
              <div class="col col-3">
                <label for="decisao" class="form-label">Pedidos</label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" name="pedido1">
                  <label class="form-check-label" for="pedido1"> Stand de vendas
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="2" name="pedido2">
                  <label class="form-check-label" for="pedido2"> Outorga onerosa
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="3" name="pedido3">
                  <label class="form-check-label" for="pedido3"> CEPAC
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="4" name="pedido4">
                  <label class="form-check-label" for="pedido4"> Operação Urbana
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="5" name="pedido5">
                  <label class="form-check-label" for="pedido5"> AUI
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="6" name="pedido6">
                  <label class="form-check-label" for="pedido6"> RIVI
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="7" name="pedido7">
                  <label class="form-check-label" for="pedido7"> Aquecimento Solar
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="8" name="pedido8">
                  <label class="form-check-label" for="pedido8"> Polo Gerador de Tráfego
                </div>
              </div>
            </div>
            <br>
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
    </div>
  </div>


</body>

<script>
  $(document).ready(function() {
    $('#myModal').modal('show');
  })

  function fecharmodal() {
    $('#myModal').modal('hide');
  }

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

  // Selecionando o botão e a div pelo id
  const botaoBusca = document.getElementById("busca");
  const divDados = document.getElementById("dados");

  // Adicionando um evento de clique ao botão
  botaoBusca.addEventListener("click", function(event) {
    // Evitando que o comportamento padrão do botão recarregue a página
    event.preventDefault();

    // Alterando a propriedade 'display' da div para torná-la visível
    divDados.style.display = "block";
  });
</script>

</html>