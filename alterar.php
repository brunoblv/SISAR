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
include 'navbar.php';

$login = $_SESSION['SesID'];
$permissao = $_SESSION['Perm'];
$status = $_SESSION['Status'];

if ($permissao == 2) {
    header("location: erropermissao.php");
}

//if ($row ==3){   

//  header("location: erropermissao.php");
//}

?>
<script>
    //Função para as caixas de data funcionarem corretamente.

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
</script>

<!doctype html>
<html lang="pt-br">


<head>
    <?php include 'head.php'; ?>
</head>

<body>

    <style>
        tr {
            cursor: hand;
        }
    </style>

    <!-- Page Content  -->

    <div id="content" class="p-4 p-md-5 pt-5">
        <div id="tabela">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    <strong>Alteração de dados</strong>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="d-flex align-items-center">
                            <div>
                                <input class="form-control form-control-sm" type="search" placeholder="Pesquisar com o N° SEI" name="pesquisar" id="pesquisar">
                            </div>
                            <div class="ml-2">
                                <button class="btnpesquisa btn-outline-success" onclick="searchData()" type="submit">Pesquisar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-group">
                <div class="table table-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Copiar</th>
                                <th>Nº Controle Interno</th>
                                <th>Nº SEI</th>
                                <th>SQL</th>
                                <th>Data Protocolo</th>
                                <th>Tipo Processo</th>
                                <th>Tipo Alvará</th>
                                <th>Tipo Alvará</th>
                                <th>Tipo Alvará</th>
                                <th>Status</th>
                                <th>Anterior ao Decreto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // Receber o número da página
                            $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                            //Setar a quantidade de itens por página
                            $qnt_result_pg = 10;

                            //Calcular o início da visualização
                            $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                            if (!empty($_GET['search'])) {
                                $data = $_GET['search'];

                                $data = mysqli_real_escape_string($conn, $data);

                                $buscar_cadastros = "SELECT * FROM INICIAL WHERE sei = '$data'";
                            } else {
                                $buscar_cadastros = "SELECT * FROM inicial WHERE id = 0";
                            }

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
                                $obs = $receber_cadastros['obs'];
                                $numsql = $receber_cadastros['numsql'];
                                $tipo = $receber_cadastros['tipo'];
                                $req = $receber_cadastros['req'];
                                $fisico = $receber_cadastros['fisico'];
                                $aprovadigital = $receber_cadastros['aprovadigital'];
                                $sei = $receber_cadastros['sei'];
                                $dataprotocolo = $receber_cadastros['dataprotocolo'];
                                $tipoprocesso = $receber_cadastros['tipoprocesso'];
                                $tipoalvara1 = $receber_cadastros['tipoalvara1'];
                                $tipoalvara2 = $receber_cadastros['tipoalvara2'];
                                $tipoalvara3 = $receber_cadastros['tipoalvara3'];
                                $stand = $receber_cadastros['stand'];
                                $sts = $receber_cadastros['sts'];                                
                                $decreto = $receber_cadastros['decreto'];
                                $dataad = $receber_cadastros['dataad'];
                                $outorga = $receber_cadastros['outorga'];
                                $cepac = $receber_cadastros['cepac'];
                                $ou = $receber_cadastros['ou'];
                                $aiu = $receber_cadastros['aiu'];
                                $rivi = $receber_cadastros['rivi'];
                                $aquecimento = $receber_cadastros['aquecimento'];
                                $gerador = $receber_cadastros['gerador'];

                                $inverted_date = date("d/m/Y", strtotime($dataprotocolo));
                                $inverted_datead  = date("d/m/Y", strtotime($dataad));

                                // Invertendo a data do SQL para o formato brasileiro

                                $inverted_date = date("d/m/Y", strtotime($dataprotocolo));

                                $interface = '';
                                $alv1 = '';
                                $alv2 = '';
                                $alv3 = '';
                                $status = '';
                                switch ($tipoprocesso) {
                                    case 1:
                                        $interface = 'Próprio de SMUL';
                                        break;
                                    case 2:
                                        $interface = 'Múltiplas Interfaces';
                                        break;
                                }

                                switch ($tipoalvara1) {
                                    case 1:
                                        $alv1 = 'Nada';
                                        break;
                                    case 2:
                                        $alv1 = 'Projeto Modificativo';
                                        break;
                                }

                                switch ($tipoalvara2) {
                                    case 1:
                                        $alv2 = 'Alvará de Aprovação';
                                        break;
                                    case 2:
                                        $alv2 = 'Alvará de Aprovação e Execução';
                                        break;
                                    case 3:
                                        $alv2 = 'Alvará de Execução';
                                        break;
                                }

                                switch ($tipoalvara3) {
                                    case 1:
                                        $alv3 = 'Edificação Nova';
                                        break;
                                    case 2:
                                        $alv3 = 'Reforma';
                                        break;
                                    case 3:
                                        $alv3 = 'Requalificação';
                                        break;
                                    case 4:
                                        $alv3 = 'Requalificação associada a reforma';
                                        break;
                                }

                                switch ($sts) {
                                    case 1:
                                        $status = 'Análise de Admissibilidade';
                                        break;
                                    case 2:
                                        $status = 'Inadmissível/Via ordinária';
                                        break;
                                    case 3:
                                        $status = 'Em análise';
                                        break;
                                    case 4:
                                        $status = 'Deferido';
                                        break;
                                    case 5:
                                        $status = 'Indeferido';
                                        break;
                                    case 6:
                                        $status = 'Inválido';
                                        break;
                                }


                            ?>

                                <?php
                                $buscar_cadastros = "SELECT * FROM DISTRIBUICAO WHERE CONTROLEINTERNO = ?";
                                $stmt = $conn->prepare($buscar_cadastros);
                                $stmt->bind_param("s", $controleinterno);
                                $stmt->execute();
                                $query_cadastros = $stmt->get_result();

                                

                                while ($receber_cadastros = mysqli_fetch_array($query_cadastros)) {
                                    $tec = $receber_cadastros['tec'];
                                    $tectroca = $receber_cadastros['tectroca'];
                                    $adm = $receber_cadastros['adm'];
                                    $admsubst = $receber_cadastros['admsubst'];
                                    $admsubst2 = $receber_cadastros['admsubst2'];
                                    $obs1 = $receber_cadastros['obs1'];
                                    $obs2 = $receber_cadastros['obs2'];
                                    $baixa = $receber_cadastros['baixa'];
                                    $pi = $receber_cadastros['pi'];
                                    $assuntopi = $receber_cadastros['assuntopi'];
                                }
                                ?>
                                <tr>
                                    <td><a class='btnpesquisa btn-outline-info copiar botaoselecao' id="botao"><span class="glyphicon glyphicon-edit"></span> Selecionar</a></td>
                                    <td class="ci" scope="row"><?php echo $controleinterno ?></td>
                                    <td class="sei"><?php echo $sei ?></td>
                                    <td class="sql"><?php echo $numsql ?></td>
                                    <td class="dataprotocolo"><?php echo $inverted_date ?></td>
                                    <td class="tipoprocesso"><?php echo $interface ?></td>
                                    <td><?php echo $alv1 ?></td>
                                    <td><?php echo $alv2 ?></td>
                                    <td><?php echo $alv3 ?></td>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo $decreto ?></td>

                                    <script>
                                        $(function() {
                                            $('.copiar').click(function(event) {
                                                var copyValue =
                                                    // inicia seletor jQuery com o objeto clicado (no caso o elemento <a class="copiar">)
                                                    $(event.target)
                                                    // closest (https://api.jquery.com/closest/) retorna o seletor no tr da linha clicada 
                                                    .closest("tr")
                                                    // procura a <td> com a class target-copy
                                                    .find("td.ci")
                                                    // obtem o text no conteúdo do elemento <td>
                                                    .text()
                                                    // remove possiveis espaços no incio e fim da string
                                                    .trim();

                                                // seleciona o input com id desejado
                                                $('#displayci')
                                                    // seta o valor copiado para o input id=senha
                                                    .val(copyValue);
                                            });
                                        });
                                        $(function() {
                                            $('.copiar').click(function(event) {
                                                var copyValue =
                                                    // inicia seletor jQuery com o objeto clicado (no caso o elemento <a class="copiar">)
                                                    $(event.target)
                                                    // closest (https://api.jquery.com/closest/) retorna o seletor no tr da linha clicada 
                                                    .closest("tr")
                                                    // procura a <td> com a class target-copy
                                                    .find("td.sql")
                                                    // obtem o text no conteúdo do elemento <td>
                                                    .text()
                                                    // remove possiveis espaços no incio e fim da string
                                                    .trim();

                                                // seleciona o input com id desejado
                                                $('#displaysql')
                                                    // seta o valor copiado para o input id=senha
                                                    .val(copyValue);
                                            });
                                        });
                                        $(function() {
                                            $('.copiar').click(function(event) {
                                                var copyValue =
                                                    // inicia seletor jQuery com o objeto clicado (no caso o elemento <a class="copiar">)
                                                    $(event.target)
                                                    // closest (https://api.jquery.com/closest/) retorna o seletor no tr da linha clicada 
                                                    .closest("tr")
                                                    // procura a <td> com a class target-copy
                                                    .find("td.sei")
                                                    // obtem o text no conteúdo do elemento <td>
                                                    .text()
                                                    // remove possiveis espaços no incio e fim da string
                                                    .trim();

                                                // seleciona o input com id desejado
                                                $('#displaysei')
                                                    // seta o valor copiado para o input id=senha
                                                    .val(copyValue);
                                            });
                                        });
                                        $(function() {
                                            $('.copiar').click(function(event) {
                                                var copyValue =
                                                    // inicia seletor jQuery com o objeto clicado (no caso o elemento <a class="copiar">)
                                                    $(event.target)
                                                    // closest (https://api.jquery.com/closest/) retorna o seletor no tr da linha clicada 
                                                    .closest("tr")
                                                    // procura a <td> com a class target-copy
                                                    .find("td.dataprotocolo")
                                                    // obtem o text no conteúdo do elemento <td>
                                                    .text()
                                                    // remove possiveis espaços no incio e fim da string
                                                    .trim();

                                                // seleciona o input com id desejado
                                                $('#displaydata')
                                                    // seta o valor copiado para o input id=senha
                                                    .val(copyValue);
                                            });
                                        });
                                    </script>
                                </tr>

                            <?php }; ?>
                        </tbody>
                    </table>

                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="alterar.php?pagina=1">Primeira</a></li>

                        <?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                            if ($pag_ant >= 1) {
                                echo "<li class='page-item'><a class='page-link' href='alterar.php?pagina=$pag_ant'>$pag_ant</a></li>";
                            }
                        } ?>

                        <li class="page-item"><a class='page-link'><?php echo $pagina ?></a></li>

                        <?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                            if ($pag_dep <= $quantidade_pg) {
                                echo "<li class='page-item'><a class='page-link' href='alterar.php?pagina=$pag_dep'>$pag_dep</a></li>";
                            }
                        }


                        echo "<li class='page-item'><a class='page-link' href='alterar.php?pagina=$quantidade_pg'>Última</a></li>";

                        echo '</ul>';
                        echo '</nav>';



                        ?>
            </div>
        </div>

        <div id="form" hidden>
            <form class="need-validation" no validade method="POST" action="edit.php" autocomplete="off" name="formulario" id="formulario">
                <div class="card bg-light mb-3">
                    <div class="card-header">
                        <strong>Dados do Processo</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col col-3">
                                <label for="controleinterno" class="form-label">N° de Controle interno:</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="displayci" readonly name="displayci" required="required" value="<?php echo htmlspecialchars($controleinterno); ?>"></input>
                            </div>
                            <div class="col col-3">
                                <label for="sei" class="form-label">N° do Processo SEI:</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="displaysei" readonly name="displaysei" required="required" value="<?php echo htmlspecialchars($sei); ?>"></input>
                            </div>
                            <div class="col col-3">
                                <label for="sei" class="form-label">N° do SQL:</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="displaysql" readonly name="displaysql" required="required" value="<?php echo htmlspecialchars($numsql); ?>"></input>
                            </div>
                            <div class="col col-3">
                                <label for="displaydata" class="form-label">Data de Protocolo:</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="displaydata" readonly name="displaydata" required="required" value="<?php echo htmlspecialchars($inverted_date); ?>"></input>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#tab1" data-toggle="tab">Dados Iniciais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab2" data-toggle="tab">Distribuição</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab3" data-toggle="tab">Admissibilidade</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab3" data-toggle="tab">Recons. Admissibilidade</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab3" data-toggle="tab">Coord. SMUL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab3" data-toggle="tab">Secretarias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab3" data-toggle="tab">1ª Instância</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab3" data-toggle="tab">2ª Instância</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab3" data-toggle="tab">3ª Instância</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab3" data-toggle="tab">Conclusão</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <?php include 'alterarinicial.php' ?>
                </div>
                <div class="tab-pane" id="tab2">
                    <?php include 'alterardistribuicao.php' ?>
                </div>
                <div class="tab-pane" id="tab3">

                </div>
            </div>

        </div>
    </div>

    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchData();
            }
        });

        function searchData() {
            window.location = 'alterar.php?search=' + search.value;
        }



        const button = document.querySelectorAll('.botaoselecao');
        const form = document.getElementById('form');
        const tabela = document.getElementById('tabela');

        [...button].forEach((botao) => {
            botao.addEventListener('click', () => {
                form.removeAttribute('hidden');
                tabela.setAttribute('hidden', true);
            });
        });

        const cancelar = document.getElementById('cancelar');

        cancelar.addEventListener('click', () => {
            form.setAttribute('hidden', true);
            tabela.setAttribute('hidden', false);
        });

        var btnCancelar = document.getElementById('cancelar');
        var divForm = document.getElementById('form');
        var divTabela = document.getElementById('tabela');

        btnCancelar.addEventListener('click', function() {
            divForm.hidden = true;
            divTabela.hidden = false;
        });


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

        $(document).ready(function() {
            // Quando uma aba é clicada
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                // Oculta o conteúdo de todas as outras abas
                $('.tab-pane').removeClass('show active');
                // Exibe o conteúdo da aba clicada
                $($(e.target).attr('href')).addClass('show active');
            });
        });

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
    </script>
</body>

</html>