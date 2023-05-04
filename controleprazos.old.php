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

  <style type="text/css">

  </style>
</head>

<body>

  <div id="content" class="p-4 p-md-5 pt-5">
    <div class="table table-sm">
      <table class="table table-bordered table-hover">
        <thead>
          <tr class="linha-tabela">
            <th class="table-primary" colspan="4">Informações do Processo</th>
            <th class="table-primary" colspan="4">Protocolo</th>
            <th class="table-primary" colspan="5">Análise de Admissiblidade</th>
            <th class="table-primary" colspan="6">Análise Técnica</th>
            <th class="table-primary" colspan="4">Comunique-se</th>
            <th class="table-primary" colspan="6">Reanálise Técnica</th>
            <th class="table-primary" colspan="6">Observações Especiais</th>
          </tr>
        </thead>
        <tbody>
          <tr class="linha-tabela">
            <td class="table-light"># Controle Interno</td>
            <td class="table-success">Nº Processo SEI</td>
            <td class="table-success">Tipo de Processo</td>
            <td class="table-success">Tipo de Alvará</td>
            <td class="table-success">Inicio</td>
            <td class="table-success">Final</td>
            <td class="table-success">Prazo</td>
            <td class="table-success">Real</td>
            <td class="table-success">Inicio</td>
            <td class="table-success">Final</td>
            <td class="table-success">Parecer</td>
            <td class="table-success">Prazo</td>
            <td class="table-success">Real</td>
            <td class="table-success">Início</td>
            <td class="table-success">Final</td>
            <td class="table-success">Parecer</td>
            <td class="table-success">Situação</td>
            <td class="table-success">Prazo</td>
            <td class="table-success">Real</td>
            <td class="table-success">Início</td>
            <td class="table-success">Final</td>
            <td class="table-success">Prazo</td>
            <td class="table-success">Real</td>
            <td class="table-success">Início</td>
            <td class="table-success">Final</td>
            <td class="table-success">Parecer</td>
            <td class="table-success">Situação</td>
            <td class="table-success">Prazo</td>
            <td class="table-success">Real</td>
            <td class="table-success">Processo em linha recursal?</td>
            <td class="table-success">Suspensão do prazo?</td>
            <td class="table-success">Nº dias durante análise de admissibilidade</td>
            <td class="table-success">Nº dias após análise de admissibilidade</td>
            <td class="table-success">Motivo de Suspensão</td>
            <td class="table-success">Observações</td>
          </tr>

          <?php

          // Receber o número da página
          $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
          $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

          //Setar a quantidade de itens por página
          $qnt_result_pg = 10;

          //Calcular o início da visualização
          $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;


          #$buscar_cadastros = "SELECT i.*, COALESCE(cp.descricao, 'N/A') AS descricao_cp, COALESCE(a.parecer, 'N/A') AS parecer_a, 
          #COALESCE(cp.datainicio, 'N/A') AS datainicio_cp, COALESCE(cp.datafim, 'N/A') AS datafim_cp
          #FROM inicial i
          #LEFT JOIN controle_prazo cp ON i.id = cp.controleinterno AND cp.descricao = 'Análise de Admissibilidade'
          #LEFT JOIN admissibilidade a ON i.id = a.controleinterno
          #ORDER BY i.id DESC LIMIT $inicio, $qnt_result_pg"; 

          $buscar_cadastros = "SELECT 
          i.id AS controleinterno,    
          i.sei,
          i.tipoprocesso,
          i.tipoalvara1,
          i.tipoalvara2,
          i.tipoalvara3,
          i.dataprotocolo,
          i.dataad,
          a.parecer AS parecer_AD,
          a.dataenvio AS dataenvio_ad,
          ad.datainicio AS datainicio_ad,
          ad.datafim AS datafim_ad,
          ad.dias AS real_ad,
          tec.datainicio AS tecnica_inicio,
          tec.datafim AS tecnica_final,
          tec.dias AS tecnica_real,    
          co.datainicio AS comunique_inicio,
          co.datafim AS comunique_final,
          co.dias AS comunique_real,   
          re.datainicio AS reanalise_inicio,
          re.datafim AS reanalise_final,
          re.dias AS reanalise_parecer    
          
      FROM 
          inicial i
      LEFT JOIN 
          admissibilidade A ON i.id = a.controleinterno
      LEFT JOIN 
          controle_prazo AD ON i.id = ad.controleinterno AND ad.descricao = 'Análise de Admissibilidade'
      LEFT JOIN 
          controle_prazo TEC ON i.id = tec.controleinterno AND TEC.descricao = 'Análise Técnica'
      LEFT JOIN 
          controle_prazo co ON i.id = co.controleinterno AND co.descricao = 'Comunique-se'
      LEFT JOIN 
          controle_prazo re ON i.id = re.controleinterno AND re.descricao = 'Reanálise Técnica'";


          $query_cadastros = mysqli_query($conn, $buscar_cadastros);
          //Paginação - Somar a quantidade de processos                   


          $result_pg = "SELECT COUNT(id) AS num_result FROM inicial";
          $resultado_pg = mysqli_query($conn, $result_pg);
          $row_pg = mysqli_fetch_assoc($resultado_pg);
          //echo $row_pg['num_result'];
          $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

          //Limitar a quantidade de Links antes e depois
          $max_links = 2;


          while ($receber_cadastros = mysqli_fetch_array($query_cadastros)) {

            $controleinterno = $receber_cadastros['controleinterno'];
            $sei = $receber_cadastros['sei'];
            $dataprotocolo = $receber_cadastros['dataprotocolo'];
            $tipoprocesso = $receber_cadastros['tipoprocesso'];
            $tipoalvara1 = $receber_cadastros['tipoalvara1'];
            $tipoalvara2 = $receber_cadastros['tipoalvara2'];
            $tipoalvara3 = $receber_cadastros['tipoalvara3'];
            $dataad = $receber_cadastros['dataad'];
            $dataenvio = $receber_cadastros['dataenvio_ad'];
            $suspensaoprazo = 0;

            $datainicio_AD = isset($receber_cadastros['datainicio_ad']) ? $receber_cadastros['datainicio_ad'] : 'N/A';
            $datafim_AD = isset($receber_cadastros['datafim_ad']) ? $receber_cadastros['datafim_ad'] : 'N/A';
            $parecer_AD = isset($receber_cadastros['parecer_AD']) ? $receber_cadastros['parecer_AD'] : 'N/A';
            $real_AD = isset($receber_cadastros['real_ad']) ? $receber_cadastros['real_ad'] : 'N/A';
            // Cálculo de prazo de Admissibilidade e Invertendo a data do SQL para o formato brasileiro

            $hoje = date("Y-m-d");
            $diferenca = abs(strtotime($hoje) - strtotime($dataad));
            $dias = floor($diferenca / (60 * 60 * 24));
            $datalimite = date('Y-m-d', strtotime($dataad . ' + 15 days'));
            $diasrestantes = 15 - $dias;


            $diferencaProt = abs(strtotime($datainicio_AD) - strtotime($dataprotocolo));
            $diferencaProt = floor($diferencaProt / (60 * 60 * 24));

                      
            if ($dataprotocolo != $dataad) {
              if ($dataenvio == "") {
                $resultado = "N/A";
              } else {
                $dias = (strtotime($dataenvio) - strtotime($dataad)) / 86400 - $suspensaoprazo;
                if (date("N", strtotime($dataad)) == 6) {
                  $dias -= 3;
                } elseif (date("N", strtotime($dataad)) == 7) {
                  $dias -= 2;
                } else {
                  $dias -= 1;
                }
                $resultado = $dias < 0 ? 0 : $dias;
              }
            } else {
              $resultado = "";
            }

            echo 'O valor de $dataprotocolo é:' . $dataprotocolo . "<br>";
            echo 'O valor de $dataenvio é:' . $dataenvio  . "<br>";
            echo 'O valor de $dataad é:' . $dataad  . "<br>";
            echo 'O valor de $dataprotocolo é:' . $dataprotocolo  . "<br>";



            $dataprotocolo = date("d/m/Y", strtotime($dataprotocolo));
            $dataad = date("d/m/Y", strtotime($dataad));
            $datalimite = date("d/m/Y", strtotime($datalimite));

            switch ($tipoprocesso) {
              case 1:
                $tipoprocesso = 'Próprio de SMUL';
                break;
              case 2:
                $tipoprocesso = 'Múltiplas Interfaces';
                break;
            }

            switch ($tipoalvara1) {
              case 1:
                $tipoalvara1 = 'Nada';
                break;
              case 2:
                $tipoalvara1 = 'Projeto Modificativo';
                break;
            }

            switch ($tipoalvara2) {
              case 1:
                $tipoalvara2 = 'Alvará de Aprovação';
                break;
              case 2:
                $tipoalvara2 = 'Alvará de Aprovação e Execução';
                break;
              case 3:
                $tipoalvara2 = 'Alvará de Execução';
                break;
            }

            switch ($tipoalvara3) {
              case 1:
                $tipoalvara3 = 'Edificação Nova';
                break;
              case 2:
                $tipoalvara3 = 'Reforma';
                break;
              case 3:
                $tipoalvara3 = 'Requalificação';
                break;
              case 4:
                $tipoalvara3 = 'Requalificação associada a reforma';
                break;
            }

            $tipoalvara = $tipoalvara1 . '/' . $tipoalvara2 . '/' . $tipoalvara3;

            switch ($parecer_AD) {
              case 'N/A':
                $parecer_AD = 'N/A';
                break;
              case '1':
                $parecer_AD = 'Admissível';
                break;
              case '2':
                $parecer_AD = 'Inadmissível';
                break;
            }
          ?>
            <tr class="linha-tabela">
              <td class="table-light"><?php echo $controleinterno ?></td>
              <td><?php echo $sei ?></td>
              <td><?php echo $tipoprocesso ?></td>
              <td><?php echo $tipoalvara ?></td>
              <td><?php echo $dataprotocolo ?></td>
              <td><?php echo $dataad ?></td>
              <td>2</td>
              <td><?php echo $resultado ?></td>
              <td><?php echo $datainicio_AD ?></td>
              <td><?php echo $datafim_AD ?></td>
              <td><?php echo $parecer_AD ?></td>
            </tr>
          <?php }; ?>
        </tbody>
      </table>

    </div>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="controleprazos.php?pagina=1">Primeira</a></li>

        <?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
          if ($pag_ant >= 1) {
            echo "<li class='page-item'><a class='page-link' href='controleprazos.php?pagina=$pag_ant'>$pag_ant</a></li>";
          }
        } ?>

        <li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

        <?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
          if ($pag_dep <= $quantidade_pg) {
            echo "<li class='page-item'><a class='page-link' href='controleprazos.php?pagina=$pag_dep'>$pag_dep</a></li>";
          }
        }


        echo "<li class='page-item'><a class='page-link' href='controleprazos.php?pagina=$quantidade_pg'>Última</a></li>";

        echo '</ul>';
        echo '</nav>';



        ?>
  </div>
  </div>
  <script>
    $(document).ready(function() {
      $('.linha-tabela').click(function() {
        $('.linha-tabela').removeClass('table-active');
        $(this).addClass('table-active');
      });
    });
  </script>





</body>

</html>