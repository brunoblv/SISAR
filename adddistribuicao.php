<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {    
    $controleinterno = $_POST['controleinterno'];
    $tec = $_POST['tec'];
    $tectroca = $_POST['tectroca'];
    $adm = $_POST['adm'];
    $admsubst = $_POST['admsubst'];
    $admsubst2 = $_POST['admsubst2'];
    $obs1 = $_POST['obs1'];
    $obs2 = $_POST['obs2'];
    $baixa = $_POST['baixa'];   
    $pi = $_POST['pi'];
    $assuntopi = $_POST['assuntopi'];

    // criar o comando SQL com espaços reservados para os valores de entrada
    $sql = "INSERT INTO distribuicao (controleinterno, tec, tectroca, adm, admsubst, admsubst2, obs1, obs2, baixa, pi, assuntopi) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // preparar o comando SQL
    $stmt = $mysqli->prepare($sql);
    
    // vincular os valores de entrada aos espaços reservados no comando SQL
    $stmt->bind_param("sssssssssss", $controleinterno, $tec, $tectroca, $adm, $admsubst, $admsubst2, $obs1, $obs2, $baixa, $pi, $assuntopi);

    // executar o comando SQL
    $stmt->execute();

    // verificar se houve algum erro na execução do comando SQL
    if($stmt->error) {
        echo "<script>window.alert('Erro ao cadastrar'); document.location.href='principal.php'</script>";
    } else {
        echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
    }

    $status = 2;
    
    $stmt = $mysqli->prepare("UPDATE inicial SET sts=? WHERE id='$controleinterno'");
    $stmt->bind_param("s", $status);
    $stmt->execute();

    // fechar a conexão com o banco de dados
    $stmt->close();
    $mysqli->close();
}

?>

