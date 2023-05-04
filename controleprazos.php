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
            <th class="table-primary" colspan="35">Primeira Instância</th>
            <th class="table-primary" colspan="22">Segunda Instância</th>
            <th class="table-primary" colspan="22">Terceira Instância</th>
          </tr>
          <tr class="linha-tabela">
            <td class="table-primary" colspan="4">Informações do Processo</td>
            <td class="table-primary" colspan="4">Protocolo</td>
            <td class="table-primary" colspan="5">Análise de Admissiblidade</td>
            <td class="table-primary" colspan="6">Análise Técnica</td>
            <td class="table-primary" colspan="4">Comunique-se</td>
            <td class="table-primary" colspan="6">Reanálise Técnica</td>
            <td class="table-primary" colspan="6">Observações Especiais</td>
            <td class="table-primary" colspan="6">Análise Técnica</td>
            <td class="table-primary" colspan="4">Comunique-se</td>
            <td class="table-primary" colspan="6">Reanálise Técnica</td>
            <td class="table-primary" colspan="6">Observações Especiais</td>
            <td class="table-primary" colspan="6">Análise Técnica</td>
            <td class="table-primary" colspan="4">Comunique-se</td>
            <td class="table-primary" colspan="6">Reanálise Técnica</td>
            <td class="table-primary" colspan="6">Observações Especiais</td>
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


          $buscar_cadastros = "SELECT
          i.id as controleinterno,
          i.sei,
          i.tipoprocesso,
          i.tipoalvara1,
          i.tipoalvara2,
          i.tipoalvara3,
          i.dataprotocolo,
          i.dataad AS datainicio_ad,
          a.parecer AS parecer_ad,
          a.dataenvio AS dataenvio_ad,
          i1.instancia,
          i1.graproem,
          i1.datainicio,         
          i1.datasmul,
          i1.datasvma,
          i1.datasmc,
          i1.datasmt,
          i1.datasehab,
          i1.datasiurb,
          i1.parecer,
          i2.instancia,
          i2.graproem,
          i2.datainicio,         
          i2.datasmul,
          i2.datasvma,
          i2.datasmc,
          i2.datasmt,
          i2.datasehab,
          i2.datasiurb,
          i2.parecer,
          i3.instancia,
          i3.graproem,
          i3.datainicio,          
          i3.datasmul,
          i3.datasvma,
          i3.datasmc,
          i3.datasmt,
          i3.datasehab,
          i3.datasiurb,
          i3.parecer

          FROM
          inicial i
          LEFT JOIN 
          admissibilidade a ON i.id = a.controleinterno 
          LEFT JOIN 
          graproem i1 ON i.id = i1.controleinterno AND i1.instancia = 1
          LEFT JOIN 
          graproem i2 ON i.id = i2.controleinterno AND i2.instancia = 1
          LEFT JOIN 
          graproem i3 ON i.id = i3.controleinterno AND i3.instancia = 1        
          
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

            $controleinterno = $receber_cadastros['controleinterno'];
            $sei = $receber_cadastros['sei'];
            $dataprotocolo = $receber_cadastros['dataprotocolo'];
            $tipoprocesso = $receber_cadastros['tipoprocesso'];
            $tipoalvara1 = $receber_cadastros['tipoalvara1'];
            $tipoalvara2 = $receber_cadastros['tipoalvara2'];
            $tipoalvara3 = $receber_cadastros['tipoalvara3'];
            $dataad = $receber_cadastros['datainicio_ad'];
            $dataenvio = $receber_cadastros['dataenvio_ad'];
            $suspensaoprazo = 0;

            $datainicio_ad = isset($receber_cadastros['datainicio_ad']) ? $receber_cadastros['datainicio_ad'] : 'N/A';

            $datafim_ad = isset($receber_cadastros['dataenvio_ad']) ? $receber_cadastros['dataenvio_ad'] : 'N/A';
            // Se o processo foi admissível ou não como Aprova Rápido
            $parecer_ad = isset($receber_cadastros['parecer_ad']) ? $receber_cadastros['parecer_ad'] : 'N/A';
            // a data de inicio da análise técnica é a mesma da data de envio para as Coordenadorias/Secretarias
            $datainicio_at = isset($receber_cadastros['dataenvio_ad']) ? $receber_cadastros['dataenvio_ad'] : 'N/A';
            // a data final da análise técnica é a o campo datasmul caso o tipo de processo seja "próprio de SMUL" ou a maior data de todas as coordenadorias se o tipo de processo for "Múltiplas Interfaces"
            if ($tipoprocesso == 1) {
              $datafim_at = isset($receber_cadastros['i1.datasmul']) ? $receber_cadastros['i1.datasmul'] : 'N/A';
            } else {
              $campos_data = array(
                $receber_cadastros['i1.datasmul'],
                $receber_cadastros['i1.datasvma'],
                $receber_cadastros['i1.datasmc'],
                $receber_cadastros['i1.datasmt'],
                $receber_cadastros['i1.datasehab'],
                $receber_cadastros['i1.datasiurb']
              );             
              // Ordena os valores do array em ordem decrescente de data
              rsort($campos_data);
              // Define o valor da variável $datafim_at como a data mais recente encontrada nos campos especificados
              $datafim_at = !empty($campos_data) ? $campos_data[0] : 'N/A';
            }



            // Cálculo de prazo de Admissibilidade e Invertendo a data do SQL para o formato brasileiro

            $hoje = date("Y-m-d");
            $diferenca = abs(strtotime($hoje) - strtotime($dataad));
            $dias = floor($diferenca / (60 * 60 * 24));
            $datalimite = date('Y-m-d', strtotime($dataad . ' + 15 days'));
            $diasrestantes = 15 - $dias;


            $totaldiasprot = abs(strtotime($datainicio_ad) - strtotime($dataprotocolo));
            $totaldiasprot = floor($totaldiasprot / (60 * 60 * 24));

            $totaldiasad = abs(strtotime($datafim_ad) - strtotime($datainicio_ad));
            $totaldiasad = floor($totaldiasad / (60 * 60 * 24));

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

            switch ($parecer_ad) {
              case 'N/A':
                $parecer_ad = 'N/A';
                break;
              case '1':
                $parecer_ad = 'Admissível';
                break;
              case '2':
                $parecer_ad = 'Inadmissível';
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
              <td><?php echo $totaldiasprot ?></td>
              <td><?php echo $datainicio_ad ?></td>
              <td><?php echo $datafim_ad ?></td>
              <td><?php echo $parecer_ad ?></td>
              <td>15</td>
              <?php
              if ($totaldiasad > 15) {
                echo '<td class="table-danger">' . $totaldiasad . '</td>';
              } else {

                echo '<td>' . $totaldiasad . '</td>';
              } ?>
              <td><?php echo $datafim_at ?></td>          






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