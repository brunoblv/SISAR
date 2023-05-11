<?php

include_once 'conexao.php';

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {
    $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
    $parecer = mysqli_real_escape_string($mysqli, $_POST['parecer']);
    $datarecon = mysqli_real_escape_string($mysqli, $_POST['datarecon']);
    $datarecon = date("Y-m-d", strtotime(str_replace('/', '-', $datarecon)));
    $datapubli = mysqli_real_escape_string($mysqli, $_POST['datapubli']);
    $datapubli = date("Y-m-d", strtotime(str_replace('/', '-', $datapubli)));
    $dataenvio = mysqli_real_escape_string($mysqli, $_POST['dataenvio']);
    $dataenvio = date("Y-m-d", strtotime(str_replace('/', '-', $dataenvio)));
    $coordenadoria = mysqli_real_escape_string($mysqli, $_POST['coordenadoria']);
    $datareuniao = mysqli_real_escape_string($mysqli, $_POST['datareuniao']);
    $datareuniao = date("Y-m-d", strtotime(str_replace('/', '-', $datareuniao)));

    $stmt = $mysqli->prepare("INSERT INTO reconsideracao_admissibilidade
     (controleinterno, parecer, datarecon, datapubli, dataenvio)
      VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $controleinterno, $parecer, $datarecon, $datapubli, $dataenvio);
    $stmt->execute();


    if ($parecer == "1") {
        $status = "3";
    } else {
        $status = "4";
        $conclusao = "1";
    }

    $stmt = $mysqli->prepare("UPDATE admissibilidade SET dataenvio=?, coordenadoria=?, datareuniao=?
      WHERE controleinterno=?");
    $stmt->bind_param("ssss", $dataenvio, $coordenadoria, $datareuniao, $controleinterno);
    $stmt->execute();

    $stmt = $mysqli->prepare("UPDATE inicial SET sts=?, conclusao=? WHERE id=?");
    $stmt->bind_param("sss", $status, $conclusao, $controleinterno);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
}
