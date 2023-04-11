<?php

include 'conexao.php';

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $tec = mysqli_real_escape_string($mysqli, $_POST['tec']);
    $tectroca = mysqli_real_escape_string($mysqli, $_POST['tectroca']);
    $adm = mysqli_real_escape_string($mysqli, $_POST['adm']);
    $admsubst = mysqli_real_escape_string($mysqli, $_POST['admsubst']);
    $admsubst2 = mysqli_real_escape_string($mysqli, $_POST['admsubst2']);
    $obs1 = mysqli_real_escape_string($mysqli, $_POST['obs1']);
    $obs2 = mysqli_real_escape_string($mysqli, $_POST['obs2']);
    $baixa = mysqli_real_escape_string($mysqli, $_POST['baixa']);
    $pi = mysqli_real_escape_string($mysqli, $_POST['pi']);
    $assuntopi = mysqli_real_escape_string($mysqli, $_POST['assuntopi']);


    $stmt = $mysqli->prepare("UPDATE distribuicao SET tec=?, tectroca=?, adm=?, admsubst=?, admsubst2=?, obs1=?, obs2=?, baixa=?, pi=?, assuntopi=? WHERE controleinterno='$id'");
    $stmt->bind_param("sssssssiss", $tec, $tectroca, $adm, $admsubst, $admsubst2, $obs1, $obs2, $baixa, $pi, $assuntopi);
    $stmt->execute();

    echo "<script>window.alert('Atualizado com Sucesso'); document.location.href='principal.php'</script>";
}
