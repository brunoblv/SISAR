<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {	
	$controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
    $outorga = mysqli_real_escape_string($mysqli, $_POST['outorga']);

    $dataoutorga = mysqli_real_escape_string($mysqli, $_POST['dataoutorga']);
    $dataoutorga = date("Y-m-d",strtotime(str_replace('/','-',$dataoutorga)));   

	$dataresposta = mysqli_real_escape_string($mysqli, $_POST['dataresposta']); 
    $dataresposta = date("Y-m-d",strtotime(str_replace('/','-',$dataresposta)));  

    $dataemissao = mysqli_real_escape_string($mysqli, $_POST['dataemissao']);
    $dataemissao = date("Y-m-d",strtotime(str_replace('/','-',$dataemissao)));  

	$numeroalvara = mysqli_real_escape_string($mysqli, $_POST['numeroalvara']); 

    $dataapostilamento = mysqli_real_escape_string($mysqli, $_POST['dataapostilamento']);
    $dataapostilamento = date("Y-m-d",strtotime(str_replace('/','-',$dataapostilamento)));  

	$datatermo = mysqli_real_escape_string($mysqli, $_POST['datatermo']); 
    $datatermo = date("Y-m-d",strtotime(str_replace('/','-',$datatermo)));  

    $dataconclusao = mysqli_real_escape_string($mysqli, $_POST['dataconclusao']);
    $dataconclusao = date("Y-m-d",strtotime(str_replace('/','-',$dataconclusao)));  

	$obs = mysqli_real_escape_string($mysqli, $_POST['obs']);    

    $mysqli->query("INSERT INTO conclusao (controleinterno, outorga, dataoutorga, dataresposta, dataemissao, numeroalvara, dataapostilamento, datatermo, dataconclusao, obs)
     VALUES('$controleinterno','$outorga','$dataoutorga', '$dataresposta','$dataemissao','$numeroalvara','$dataapostilamento', '$datatermo','$dataconclusao','$obs')")
      or die ($mysqli->error);
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
?>

