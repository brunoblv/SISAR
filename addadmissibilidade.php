<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {    
    $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
    $parecer = mysqli_real_escape_string($mysqli, $_POST['parecer']);    
    $dataad = mysqli_real_escape_string($mysqli, $_POST['dataad']); 
    $dataad = date("Y-m-d",strtotime(str_replace('/','-',$dataad))); 
    $sub = mysqli_real_escape_string($mysqli, $_POST['sub']); 
    $categoria = mysqli_real_escape_string($mysqli, $_POST['categoria']); 

    if(!isset($_POST['coordenadoria'])) {
        $coordenadoria = 0;
    } else {
        $coordenadoria = mysqli_real_escape_string($mysqli, $_POST['coordenadoria']); 
    }    

    $dataenvio = mysqli_real_escape_string($mysqli, $_POST['dataenvio']); 
    $dataenvio = date("Y-m-d",strtotime(str_replace('/','-',$dataenvio))); 

    if($parecer == 2){
       $dataenvio = "0000-00-00";
       $coordenadoria = 0;
    }

    $mysqli->query("INSERT INTO admissibilidade (controleinterno, parecer, dataad, coordenadoria, dataenvio, sub, categoria) VALUES('$controleinterno','$parecer','$dataad','$coordenadoria','$dataenvio','$sub','$categoria')") or die ($mysqli->error);

    // Obter o ID do último registro inserido na tabela admissibilidade
    $last_id = mysqli_insert_id($mysqli);

    // Inserir dados na tabela motivoinad_rel para cada checkbox marcado

    if(isset($_POST['motivo1'])) {
        $motivo1 = mysqli_real_escape_string($mysqli, $_POST['motivo1']);
        $mysqli->query("INSERT INTO motivoinad_rel (controleinterno, idmotivo ) VALUES('$controleinterno','$motivo1')") or die ($mysqli->error);
    }

    if(isset($_POST['motivo2'])) {
        $motivo2 = mysqli_real_escape_string($mysqli, $_POST['motivo2']);
        $mysqli->query("INSERT INTO motivoinad_rel (controleinterno, idmotivo ) VALUES('$controleinterno','$motivo2')") or die ($mysqli->error);
    }

    if(isset($_POST['motivo3'])) {
        $motivo3 = mysqli_real_escape_string($mysqli, $_POST['motivo3']);
        $mysqli->query("INSERT INTO motivoinad_rel (controleinterno, idmotivo ) VALUES('$controleinterno','$motivo3')") or die ($mysqli->error);
    }

    if(isset($_POST['motivo4'])) {
        $motivo4 = mysqli_real_escape_string($mysqli, $_POST['motivo4']);
        $mysqli->query("INSERT INTO motivoinad_rel (controleinterno, idmotivo ) VALUES('$controleinterno','$motivo4')") or die ($mysqli->error);
    }

    if(isset($_POST['motivo5'])) {
        $motivo5 = mysqli_real_escape_string($mysqli, $_POST['motivo5']);
        $mysqli->query("INSERT INTO motivoinad_rel (controleinterno, idmotivo ) VALUES('$controleinterno','$motivo5')") or die ($mysqli->error);
    }

    if(isset($_POST['motivo6'])) {
        $motivo5 = mysqli_real_escape_string($mysqli, $_POST['motivo6']);
        $mysqli->query("INSERT INTO motivoinad_rel (controleinterno, idmotivo ) VALUES('$controleinterno','$motivo6')") or die ($mysqli->error);
    }


    // Caso o parecer da Análise de Admissibilidade seja "admissível" então será atribuído o status "admissível" que é representado pelo valor "2".
    // Senão é atribuído o valor "3" que significa "Inadmissível"

    if ($parecer == '1') {
        $status = "2";
    } else {
        $status = "3";
    }
    
    $stmt = $mysqli->prepare("UPDATE inicial SET sts=? WHERE id='$controleinterno'");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
}
 ?>

