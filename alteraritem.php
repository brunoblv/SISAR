<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));



if(isset($_POST['salvar'])){
    
    $id = $_POST['id'];
    $numpatri = $_POST['numpatri'];
    $descsbpm = $_POST['descsbpm'];
	$numserie = $_POST['numserie'];    
	$tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $setor =  $_POST['local'];
    $servidor = $_POST['servidor'];
    $numprocesso = $_POST['numprocesso'];
    $cimbpm = $_POST['cimbpm'];
    $nomepc =  $_POST['nomepc'];
    $statusitem = $_POST['statusitem'];
   
    $mysqli->query("UPDATE item
    SET patrimonio = '$numpatri', descsbpm ='$descsbpm',numserie = '$numserie', tipo = '$tipo', marca = '$marca', modelo = '$modelo', localizacao = '$setor', servidor = '$servidor', numprocesso = '$numprocesso', cimbpm = '$cimbpm', nome = '$nomepc', statusitem = '$statusitem' 
    WHERE iditem = '$id'") or die ($mysqli->error);
    
    echo "<script>window.alert('Alterado com sucesso!'); document.location.href='listaritem.php'</script>";
    
 
}


?>