<?php

include 'conexao.php';

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {
    $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
    $tec = mysqli_real_escape_string($mysqli, $_POST['tec']);
    $tec2 = mysqli_real_escape_string($mysqli, $_POST['tec2']);

    $stmt = $mysqli->prepare("INSERT INTO smul (controleinterno, tec, tec2) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $controleinterno, $tec, $tec2);
    $stmt->execute();
    $stmt->close();


    $status = 4;

    $stmt = $mysqli->prepare("UPDATE inicial SET sts=? WHERE id='$controleinterno'");
    $stmt->bind_param("s", $status);
    $stmt->execute();

    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
}
