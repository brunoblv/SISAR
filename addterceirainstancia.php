<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {	
	$controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);

    $datainicio = mysqli_real_escape_string($mysqli, $_POST['datainicio']);
    $datainicio = date("Y-m-d",strtotime(str_replace('/','-',$datainicio)));   

    $datalimite = mysqli_real_escape_string($mysqli, $_POST['datalimite']);
    $datalimite = date("Y-m-d",strtotime(str_replace('/','-',$datalimite)));   

    $datagendada = mysqli_real_escape_string($mysqli, $_POST['datagendada']);
    $datagendada = date("Y-m-d",strtotime(str_replace('/','-',$datagendada)));

    $datareal = mysqli_real_escape_string($mysqli, $_POST['datareal']);
    $datareal = date("Y-m-d",strtotime(str_replace('/','-',$datareal)));

    $motivodatadistinta = mysqli_real_escape_string($mysqli, $_POST['motivodatadistinta']);
    $parecer = mysqli_real_escape_string($mysqli, $_POST['parecer']);

    $datapubliparecer = mysqli_real_escape_string($mysqli, $_POST['datapubliparecer']);
    $datapubliparecer = date("Y-m-d",strtotime(str_replace('/','-',$datapubliparecer)));

    $datacumprimento = mysqli_real_escape_string($mysqli, $_POST['datacumprimento']);
    $datacumprimento = date("Y-m-d",strtotime(str_replace('/','-',$datacumprimento)));

    $datalimite2 = mysqli_real_escape_string($mysqli, $_POST['datalimite2']);
    $datalimite2 = date("Y-m-d",strtotime(str_replace('/','-',$datalimite2)));

    $dataagendada2 = mysqli_real_escape_string($mysqli, $_POST['dataagendada2']);
    $dataagendada2 = date("Y-m-d",strtotime(str_replace('/','-',$dataagendada2)));

    $datareal2 = mysqli_real_escape_string($mysqli, $_POST['datareal2']);
    $datareal2 = date("Y-m-d",strtotime(str_replace('/','-',$datareal2)));

    $motivodatadistinta2 = mysqli_real_escape_string($mysqli, $_POST['motivodatadistinta2']);
    $parecer2 = mysqli_real_escape_string($mysqli, $_POST['parecer2']);
    $comuniqcomplementar = mysqli_real_escape_string($mysqli, $_POST['comuniqcomplementar']);

    $datacomplementar = mysqli_real_escape_string($mysqli, $_POST['datacomplementar']);
    $datacomplementar = date("Y-m-d",strtotime(str_replace('/','-',$datacomplementar)));

    $dataresp = mysqli_real_escape_string($mysqli, $_POST['dataresp']);
    $dataresp = date("Y-m-d",strtotime(str_replace('/','-',$dataresp)));

    $datalimite3 = mysqli_real_escape_string($mysqli, $_POST['datalimite3']);
    $datalimite3 = date("Y-m-d",strtotime(str_replace('/','-',$datalimite3)));

    $dataagendada3 = mysqli_real_escape_string($mysqli, $_POST['dataagendada3']);
    $dataagendada3 = date("Y-m-d",strtotime(str_replace('/','-',$dataagendada3)));

    $datareal3 = mysqli_real_escape_string($mysqli, $_POST['datareal3']);
    $datareal3 = date("Y-m-d",strtotime(str_replace('/','-',$datareal3)));

    $motivodatadistinta3 = mysqli_real_escape_string($mysqli, $_POST['motivodatadistinta3']);
    $parecer3 = mysqli_real_escape_string($mysqli, $_POST['parecer3']);

    $datapublidec = mysqli_real_escape_string($mysqli, $_POST['datapublidec']);
    $datapublidec = date("Y-m-d",strtotime(str_replace('/','-',$datapublidec)));

    $datapublicoord = mysqli_real_escape_string($mysqli, $_POST['datapublicoord']);
    $datapublicoord = date("Y-m-d",strtotime(str_replace('/','-',$datapublicoord)));

    $obs = mysqli_real_escape_string($mysqli, $_POST['obs']);   

    $mysqli->query("INSERT INTO terceirainstancia (controleinterno,datainicio, datalimite, datagendada, datareal,motivodatadistinta, parecer, datapubliparecer, datacumprimento,datalimite2,
     dataagendada2, datareal2, motivodatadistinta2,parecer2,comuniqcomplementar, datacomplementar, dataresp,datalimite3, dataagendada3, datareal3, motivodatadistinta3,parecer3,
     datapublidec, datapublicoord, obs)
     VALUES('$controleinterno','$datainicio ','$datalimite', '$datagendada','$datareal', '$motivodatadistinta','$parecer', '$datapubliparecer','$datacumprimento',
     '$datalimite2','$dataagendada2', '$datareal2','$motivodatadistinta2','$parecer2','$comuniqcomplementar', '$datacomplementar','$dataresp','$datalimite3' ,'$dataagendada3',
      '$datareal3','$motivodatadistinta3','$parecer3','$datapublidec','$datapublicoord','$obs')")
      or die ($mysqli->error);
    
    //echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
