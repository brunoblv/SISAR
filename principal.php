<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['SesID'])) {
    session_destroy();
    header("Location: login.php");
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
                        <th>AGPP Responsável</th>
                        <th>Data Protocolo</th>
                        <th>Fase atual</th>                       

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

                    $buscar_cadastros = "SELECT inicial.id, inicial.sei, inicial.dataprotocolo
                    FROM inicial
                    INNER JOIN distribuicao ON inicial.id = distribuicao.controleinterno
                    WHERE distribuicao.adm = '" . $_SESSION['SesNome'] . "'
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
                        $dataprotocolo = $receber_cadastros['dataprotocolo'];

                        $hoje = date("Y-m-d");
                        $diferenca = abs(strtotime($hoje) - strtotime($dataprotocolo));
                        $dias = floor($diferenca / (60 * 60 * 24));
                        $datalimite = date('Y-m-d', strtotime($dataprotocolo . ' + 15 days'));
                        $diasrestantes = 15 - $dias;

                    ?>
                        <tr>
                            <td scope="row"><?php echo $controleinterno ?>
                            <td><?php echo $sei ?></td>
                            <td><?php echo $dataprotocolo ?></td>
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