<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {	
	$controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
    $coordenadoria = mysqli_real_escape_string($mysqli, $_POST['coordenadoria']);
    $divisao = mysqli_real_escape_string($mysqli, $_POST['divisao']);
	$tec = mysqli_real_escape_string($mysqli, $_POST['tec']); 
    $tec2 = mysqli_real_escape_string($mysqli, $_POST['tec2']); 
    $sub = mysqli_real_escape_string($mysqli, $_POST['sub']); 
    $dataenvio = mysqli_real_escape_string($mysqli, $_POST['dataenvio']); 
    $dataenvio = date("Y-m-d",strtotime(str_replace('/','-',$dataenvio)));  


    $mysqli->query("INSERT INTO smul (controleinterno, coordenadoria, divisao,tec, tec2, sub, dataenvio) VALUES('$controleinterno','$coordenadoria','$divisao', '$tec','$tec2',
    '$sub','$dataenvio')") or die ($mysqli->error);
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
?>

