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
    <?php
    include 'head.php';
    require_once 'conexao.php';
    ?>

</head>

<body>

    <?php

    // Busca os registros no banco de dados
    $sql = "SELECT * FROM inicial";
    $resultado = mysqli_query($conn, $sql);
    ?>

    <!-- Cria a tabela usando o Bootstrap -->
    <table class="table">
        <thead>
            <tr>
                <th>CI</th>
                <th>Nº SQL</th>
                <th>Nº SEI</th>
                <th>Tipo</th>
                <th>Requerimento</th>
                <th>Nº Processo Físico</th>
                <th>Nº Aprova Digital</th>
                <th>Data Protocolo</th>
                <th>Tipo de Processo</th>
                <th>Tipo Alvará</th>
                <th>Tipo Alvará</th>
                <th>Tipo Alvará</th>
                <th>Status</th>
                <th>Desc. Status</th>
                <th>Decreto</th>
                <th>Clique para atualizar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>

                <tr>
                    
                    <td><?php echo $row['id']; ?></div></td>
                    <td><input class="form-control form-control-sm" type="text" size="10" value="<?php echo $row['numsql']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['sei']); ?>" value="<?php echo $row['sei']; ?>"></div></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['tipo']); ?>" value="<?php echo $row['tipo']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['req']); ?>" value="<?php echo $row['req']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['fisico']); ?>" value="<?php echo $row['fisico']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['aprovadigital']); ?>" value="<?php echo $row['aprovadigital']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['dataprotocolo']); ?>" value="<?php echo $row['dataprotocolo']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['tipoprocesso']); ?>" value="<?php echo $row['tipoprocesso']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['tipoalvara1']); ?>" value="<?php echo $row['tipoalvara1']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['tipoalvara2']); ?>" value="<?php echo $row['tipoalvara2']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['tipoalvara3']); ?>" value="<?php echo $row['tipoalvara3']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['sts']); ?>" value="<?php echo $row['sts']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['descstatus']); ?>" value="<?php echo $row['descstatus']; ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" size="<?php echo strlen($row['decreto']); ?>" value="<?php echo $row['decreto']; ?>"></td>
                    <td><button class="btn btn-primary">Atualizar</button></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
</body>

</html>

<script>
    $(function() {
        $('button').click(function() {
            var id = $(this).closest('tr').find('td:first-child').text();
            var numsql = $(this).closest('tr').find('input[type="text"]:eq(0)').val();
            var sei = $(this).closest('tr').find('input[type="text"]:eq(1)').val();
            var tipo = $(this).closest('tr').find('input[type="text"]:eq(2)').val();
            var req = $(this).closest('tr').find('input[type="text"]:eq(3)').val();
            var fisico = $(this).closest('tr').find('input[type="text"]:eq(4)').val();
            var aprovadigital = $(this).closest('tr').find('input[type="text"]:eq(5)').val();
            var dataprotocolo = $(this).closest('tr').find('input[type="text"]:eq(6)').val();
            var tipoprocesso = $(this).closest('tr').find('input[type="text"]:eq(7)').val();
            var tipoalvara1 = $(this).closest('tr').find('input[type="text"]:eq(8)').val();
            var tipoalvara2 = $(this).closest('tr').find('input[type="text"]:eq(9)').val();
            var tipoalvara3 = $(this).closest('tr').find('input[type="text"]:eq(10)').val();
            var sts = $(this).closest('tr').find('input[type="text"]:eq(11)').val();
            var descstatus = $(this).closest('tr').find('input[type="text"]:eq(12)').val();
            var decreto = $(this).closest('tr').find('input[type="text"]:eq(13)').val();

            $.ajax({
                type: 'POST',
                url: 'atualizar.php',
                data: {
                    id: id,
                    numsql: numsql,
                    sei: sei,
                    tipo: tipo,
                    req: req,
                    fisico: fisico,
                    aprovadigital: aprovadigital,
                    dataprotocolo: dataprotocolo,
                    tipoprocesso: tipoprocesso,
                    tipoalvara1: tipoalvara1,
                    tipoalvara2: tipoalvara2,
                    tipoalvara3: tipoalvara3,
                    sts: sts,
                    descstatus: descstatus,
                    decreto: decreto
                },
                success: function() {
                    alert('Registro atualizado com sucesso!');
                },
                error: function() {
                    alert('Erro ao atualizar o registro.');
                }
            });
        });
    });
</script>