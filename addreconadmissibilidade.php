<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {	
	$controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
    $parecer = mysqli_real_escape_string($mysqli, $_POST['parecer']);
    $datarecon = mysqli_real_escape_string($mysqli, $_POST['datarecon']); 
    $datarecon = date("Y-m-d",strtotime(str_replace('/','-',$datarecon)));   
    $datapubli = mysqli_real_escape_string($mysqli, $_POST['datapubli']); 
    $datapubli = date("Y-m-d",strtotime(str_replace('/','-',$datapubli)));  

    $mysqli->query("INSERT INTO reconad (controleinterno, parecer, datarecon, datapubli) VALUES('$controleinterno','$parecer','$datarecon', '$datapubli')") or die ($mysqli->error);
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
?>

