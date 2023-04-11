<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['SesID'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

include 'conexao.php';

?>
<!doctype html>
<html lang="pt-br">

<head>
    <?php include 'head.php'; ?>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <p class="fw-bold">Processos atribuídos a mim</p>
        <div>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Nº Controle Interno</th>
                        <th>Nº SEI</th>  
                        <th>Nº SQL</th>                      
                        <th>Data Protocolo</th>  
                        <th>Etapa</th>                     
                        <th>Data Limite</th>
                        <th>Dias restantes</th>                         

                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Receber o número da página
                    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                    //Setar a quantidade de itens por página
                    $qnt_result_pg = 20;

                    //Calcular o início da visualização
                    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                    $buscar_cadastros = "SELECT inicial.id, inicial.numsql, inicial.sei, inicial.dataprotocolo, inicial.sts
                    FROM inicial
                    INNER JOIN distribuicao ON inicial.id = distribuicao.controleinterno
                    WHERE distribuicao.adm = '" . $_SESSION['SesNome'] . "' AND conclusao = 0
                    ORDER BY inicial.id DESC LIMIT " . $inicio . ", " . $qnt_result_pg;


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
                        $numsql = $receber_cadastros['numsql'];
                        $dataprotocolo = $receber_cadastros['dataprotocolo'];
                        $etapa = $receber_cadastros['sts'];

                        switch ($etapa){
                            case '1':
                                $etapa = '<td class="text-wrap table-primary">Aguardando distribuição</td>';
                                break;
                            case '2':
                                $etapa = '<td class="text-wrap table-secondary">Em análise de admissibilidade</td>';
                                break;
                            case '3':
                                $etapa = '<td class="text-wrap table-success">Aguardando envio para Coordenadoria SMUL/Secretarias</td>';
                                break;
                            case '5':
                                $etapa = '<td class="text-wrap table-danger">Em análise técnica (SMUL/Secretarias)</td>';
                                break;
                            case '6':
                                $etapa = '<td class="text-wrap table-warning">GRAPROEM favorável - Aguardando deferimento';
                                break;
                            case '7':
                                $etapa = 'Deferido';
                                break;                                           

                        }
                        

                        $hoje = date("Y-m-d");
                        $diferenca = abs(strtotime($hoje) - strtotime($dataprotocolo));
                        $dias = floor($diferenca / (60 * 60 * 24));
                        $datalimite = date('Y-m-d', strtotime($dataprotocolo . ' + 15 days'));
                        $diasrestantes = 15 - $dias;

                        $datalimite = date("d/m/Y", strtotime($datalimite));
                        $dataprotocolo = date("d/m/Y", strtotime($dataprotocolo));

                    ?>
                        <tr>
                            <td scope="row"><?php echo $controleinterno ?></div>
                            <td><?php echo $sei ?></td>
                            <td><?php echo $numsql ?></td>
                            <td><?php echo $dataprotocolo ?></td>
                            <?php echo $etapa;?>
                            <td><?php echo $datalimite ?></td>
                    
                            <?php

                            switch (true) {
                                case ($diasrestantes >= 10):
                                    echo '<td><button type="button" class="btn btn-outline-success btn-sm">Restam ' . $diasrestantes . ' dias.</button></td>';
                                    break;
                                case ($diasrestantes >= 7):
                                    echo '<td><button type="button" class="btn btn-outline-warning btn-sm">Restam ' . $diasrestantes . ' dias.</button></td>';
                                    break;
                                case ($diasrestantes >= 1):
                                    echo '<td><button type="button" class="btn btn-outline-warning btn-sm">Restam ' . $diasrestantes . ' dias.</button></td>';
                                    break;
                                case ($diasrestantes == 0):
                                    echo '<td><button type="button" class="btn btn-outline-danger btn-sm">Último dia!</button></td>';
                                    break;
                                case ($diasrestantes < 0):
                                    echo '<td><button type="button" class="btn btn-outline-danger btn-sm">PRAZO VENCIDO!</button></td>';
                                    break;
                            }

                            ?>

                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>


        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="prazoad.php?pagina=1">Primeira</a></li>

                <?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                    if ($pag_ant >= 1) {
                        echo "<li class='page-item'><a class='page-link' href='prazoad.php?pagina=$pag_ant'>$pag_ant</a></li>";
                    }
                } ?>

                <li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

                <?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                    if ($pag_dep <= $quantidade_pg) {
                        echo "<li class='page-item'><a class='page-link' href='prazoad.php?pagina=$pag_dep'>$pag_dep</a></li>";
                    }
                }


                echo "<li class='page-item'><a class='page-link' href='prazoad.php?pagina=$quantidade_pg'>Última</a></li>";

                echo '</ul>';
                echo '</nav>';



                ?>
            </ul>
        </nav>
    </div>


</body>

</html>