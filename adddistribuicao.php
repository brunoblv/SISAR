<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {	
	$controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
    $tec = mysqli_real_escape_string($mysqli, $_POST['tec']);
    $tectroca = mysqli_real_escape_string($mysqli, $_POST['tectroca']);
	$adm = mysqli_real_escape_string($mysqli, $_POST['adm']);
    $admsubst = mysqli_real_escape_string($mysqli, $_POST['admsubst']);
    $admsubst2 = mysqli_real_escape_string($mysqli, $_POST['admsubst2']);
    $obs1 = mysqli_real_escape_string($mysqli, $_POST['obs1']);
    $obs2 = mysqli_real_escape_string($mysqli, $_POST['obs2']);
    $baixa = mysqli_real_escape_string($mysqli, $_POST['baixa']);
    $dataad = mysqli_real_escape_string($mysqli, $_POST['dataad']);
    $dataad = date("Y-m-d",strtotime(str_replace('/','-',$dataad)));
    $pi = mysqli_real_escape_string($mysqli, $_POST['pi']);
    $assuntopi = mysqli_real_escape_string($mysqli, $_POST['assuntopi']);    


    $mysqli->query("INSERT INTO distribuicao (controleinterno, tec, tectroca, adm, admsubst, admsubst2, obs1, obs2, baixa, dataad, pi, assuntopi)
     VALUES('$controleinterno','$tec','$tectroca','$adm','$admsubst','$admsubst2','$obs1','$obs2','$baixa','$dataad','$pi','$assuntopi')") or die ($mysqli->error);
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
?>

