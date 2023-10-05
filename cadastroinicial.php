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