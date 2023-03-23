<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {	
	$controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);

    $datainicio = mysqli_real_escape_string($mysqli, $_POST['datainicio']);
    $datainicio = date("Y-m-d",strtotime(str_replace('/','-',$datainicio)));   

    $datafim = mysqli_real_escape_string($mysqli, $_POST['datafim']);
    $datafim = date("Y-m-d",strtotime(str_replace('/','-',$datafim)));   

	$total = mysqli_real_escape_string($mysqli, $_POST['total']);   
    
    $motivo = mysqli_real_escape_string($mysqli, $_POST['motivo']);  
    

    $mysqli->query("INSERT INTO prazo (controleinterno, datainicio, datafim, total, motivo) VALUES('$controleinterno','$datainicio','$datafim', '$total','$motivo')") or die ($mysqli->error);
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
?>

