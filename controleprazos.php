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

          $buscar_cadastros = "
          SELECT
  i.id,
  i.sei,
  i.tipoprocesso,
  i.tipoalvara1,
  i.tipoalvara2,
  i.tipoalvara3,
  i.dataprotocolo,
  MAX(CASE WHEN cp.descricao = 'Protocolo' THEN cp.datainicio ELSE NULL END) AS datainicio_p,
  MAX(CASE WHEN cp.descricao = 'Análise de Admissibilidade' THEN cp.datainicio ELSE NULL END) AS datainicio_ad,
  MAX(CASE WHEN cp.descricao = 'Análise Técnica' THEN cp.datainicio ELSE NULL END) AS datainicio_at,
  MAX(CASE WHEN cp.descricao = 'Reanálise Técnica' THEN cp.datainicio ELSE NULL END) AS datainicio_rt,
  MAX(CASE WHEN cp.descricao = 'Análise Técnica Complementar' THEN cp.datainicio ELSE NULL END) AS datainicio_ac,
  MAX(CASE WHEN cp.descricao = 'Protocolo' THEN cp.datafim ELSE NULL END) AS datafim_p,
  MAX(CASE WHEN cp.descricao = 'Análise de Admissibilidade' THEN cp.datafim ELSE NULL END) AS datafim_ad,
  MAX(CASE WHEN cp.descricao = 'Análise Técnica' THEN cp.datafim ELSE NULL END) AS datafim_at,
  MAX(CASE WHEN cp.descricao = 'Reanálise Técnica' THEN cp.datafim ELSE NULL END) AS datafim_rt,
  MAX(CASE WHEN cp.descricao = 'Análise Técnica Complementar' THEN cp.datafim ELSE NULL END) AS datafim_ac,
  MAX(CASE WHEN cp.descricao = 'Protocolo' THEN cp.dias ELSE NULL END) AS dias_p,
  MAX(CASE WHEN cp.descricao = 'Análise de Admissibilidade' THEN cp.dias ELSE NULL END) AS dias_ad,
  MAX(CASE WHEN cp.descricao = 'Análise Técnica' THEN cp.dias ELSE NULL END) AS dias_at,
  MAX(CASE WHEN cp.descricao = 'Reanálise Técnica' THEN cp.dias ELSE NULL END) AS dias_rt,
  MAX(CASE WHEN cp.descricao = 'Análise Técnica Complementar' THEN cp.dias ELSE NULL END) AS dias_ac
FROM
  inicial i
JOIN
  controle_prazo cp ON cp.controleinterno = i.id
WHERE
  cp.descricao IN ('Protocolo', 'Análise de Admissibilidade', 'Análise Técnica', 'Reanálise Técnica', 'Análise Técnica Complementar')
GROUP BY
  i.id, i.sei, i.tipoprocesso, i.tipoalvara1, i.tipoalvara2, i.tipoalvara3, i.dataprotocolo


          ";


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

            $controleinterno = $receber_cadastros['id'];
            $sei = $receber_cadastros['sei'];
            $datainicio_p = $receber_cadastros['datainicio_p'];
            $datainicio_p = date("d/m/Y", strtotime($datainicio_p));
            $datafim_p = $receber_cadastros['datafim_p'];
            $dias_p = $receber_cadastros['dias_p'];
            $datafim_p = date("d/m/Y", strtotime($datafim_p));
            $datainicio_ad = $receber_cadastros['datainicio_ad'];
            $datainicio_ad = date("d/m/Y", strtotime($datainicio_ad));
            $datafim_ad = $receber_cadastros['datafim_ad'];
            $datafim_ad = date("d/m/Y", strtotime($datafim_ad));
            $datainicio_at = $receber_cadastros['datainicio_at'];
            $datainicio_at = date("d/m/Y", strtotime($datainicio_at));
            $datafim_at = $receber_cadastros['datafim_at'];
            $datafim_at = date("d/m/Y", strtotime($datafim_at));
            $datainicio_at = $receber_cadastros['datainicio_ac'];
            $datainicio_at = date("d/m/Y", strtotime($datainicio_ac));
            $datafim_at = $receber_cadastros['datafim_ac'];
            $datafim_at = date("d/m/Y", strtotime($datafim_ac));
            $dias_p = $receber_cadastros['dias_p'];
            $dias_ad = $receber_cadastros['dias_ad'];
            $dias_at = $receber_cadastros['dias_at'];
            $dias_ac = $receber_cadastros['dias_ac'];

            $tipoprocesso = $receber_cadastros['tipoprocesso'];
            $tipoalvara1 = $receber_cadastros['tipoalvara1'];
            $tipoalvara2 = $receber_cadastros['tipoalvara2'];
            $tipoalvara3 = $receber_cadastros['tipoalvara3'];
            
            $suspensaoprazo = 0;

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
              <td><?php echo $datainicio_p ?></td>
              <td><?php echo $datafim_p ?></td>
              <td>2</td>
              <td><?php echo $dias_p ?></td>
              <td><?php echo $datainicio_ad ?></td>
              <td><?php echo $datafim_ad ?></td>
              <td><?php echo $parecer_ad ?></td>
              <td>15</td>
              <td><?php echo $dias_ad ?></td>
              <td><?php echo $datainicio_at ?></td>
              <td><?php echo $datafim_at ?></td>
              <td><?php echo $parecer_at ?></td>
              <td>15</td>
              <td><?php echo $dias_at ?></td>




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