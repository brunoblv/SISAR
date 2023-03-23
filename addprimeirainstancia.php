<?php

include 'conexao.php';

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {
  $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);

  $datainicio = mysqli_real_escape_string($mysqli, $_POST['datainicio']);
  $datainicio = date("Y-m-d", strtotime(str_replace('/', '-', $datainicio)));

  $datalimite = mysqli_real_escape_string($mysqli, $_POST['datalimite']);
  $datalimite = date("Y-m-d", strtotime(str_replace('/', '-', $datalimite)));

  $datagendada = mysqli_real_escape_string($mysqli, $_POST['datagendada']);
  $datagendada = date("Y-m-d", strtotime(str_replace('/', '-', $datagendada)));

  $datareal = mysqli_real_escape_string($mysqli, $_POST['datareal']);
  $datareal = date("Y-m-d", strtotime(str_replace('/', '-', $datareal)));

  $motivodatadistinta = mysqli_real_escape_string($mysqli, $_POST['motivodatadistinta']);
  $parecer = mysqli_real_escape_string($mysqli, $_POST['parecer']);

  $datapubliparecer = mysqli_real_escape_string($mysqli, $_POST['datapubliparecer']);
  $datapubliparecer = date("Y-m-d", strtotime(str_replace('/', '-', $datapubliparecer)));

  $datacumprimento = mysqli_real_escape_string($mysqli, $_POST['datacumprimento']);
  $datacumprimento = date("Y-m-d", strtotime(str_replace('/', '-', $datacumprimento)));

  $datalimite2 = mysqli_real_escape_string($mysqli, $_POST['datalimite2']);
  $datalimite2 = date("Y-m-d", strtotime(str_replace('/', '-', $datalimite2)));

  $dataagendada2 = mysqli_real_escape_string($mysqli, $_POST['dataagendada2']);
  $dataagendada2 = date("Y-m-d", strtotime(str_replace('/', '-', $dataagendada2)));

  $datareal2 = mysqli_real_escape_string($mysqli, $_POST['datareal2']);
  $datareal2 = date("Y-m-d", strtotime(str_replace('/', '-', $datareal2)));

  $motivodatadistinta2 = mysqli_real_escape_string($mysqli, $_POST['motivodatadistinta2']);
  $parecer2 = mysqli_real_escape_string($mysqli, $_POST['parecer2']);
  $comuniqcomplementar = mysqli_real_escape_string($mysqli, $_POST['comuniqcomplementar']);

  $datacomplementar = mysqli_real_escape_string($mysqli, $_POST['datacomplementar']);
  $datacomplementar = date("Y-m-d", strtotime(str_replace('/', '-', $datacomplementar)));

  $dataresp = mysqli_real_escape_string($mysqli, $_POST['dataresp']);
  $dataresp = date("Y-m-d", strtotime(str_replace('/', '-', $dataresp)));

  $datalimite3 = mysqli_real_escape_string($mysqli, $_POST['datalimite3']);
  $datalimite3 = date("Y-m-d", strtotime(str_replace('/', '-', $datalimite3)));

  $dataagendada3 = mysqli_real_escape_string($mysqli, $_POST['dataagendada3']);
  $dataagendada3 = date("Y-m-d", strtotime(str_replace('/', '-', $dataagendada3)));

  $datareal3 = mysqli_real_escape_string($mysqli, $_POST['datareal3']);
  $datareal3 = date("Y-m-d", strtotime(str_replace('/', '-', $datareal3)));

  $motivodatadistinta3 = mysqli_real_escape_string($mysqli, $_POST['motivodatadistinta3']);
  $parecer3 = mysqli_real_escape_string($mysqli, $_POST['parecer3']);

  $datapublidec = mysqli_real_escape_string($mysqli, $_POST['datapublidec']);
  $datapublidec = date("Y-m-d", strtotime(str_replace('/', '-', $datapublidec)));

  $datapublicoord = mysqli_real_escape_string($mysqli, $_POST['datapublicoord']);
  $datapublicoord = date("Y-m-d", strtotime(str_replace('/', '-', $datapublicoord)));

  $datafimanalise = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafimanalise = date("Y-m-d", strtotime(str_replace('/', '-', $datafimanalise)));

  $datafimanalise2 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafimanalise2 = date("Y-m-d", strtotime(str_replace('/', '-', $datafimanalise2)));

  $datafimanalise3 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafimanalise3 = date("Y-m-d", strtotime(str_replace('/', '-', $datafimanalise3)));

  $datafinalsvma = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsvma = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsvma)));

  $datafinalsvma2 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsvma2 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsvma2)));

  $datafinalsvma3 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsvma3 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsvma3)));

  $datafinalsmt = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsmt = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsmt)));

  $datafinalsmt2 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsmt2 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsmt2)));

  $datafinalsmt3 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsmt3 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsmt3)));

  $datafinalsmc = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsmc = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsmc)));

  $datafinalsmc2 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsmc2 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsmc2)));

  $datafinalsmc3 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsmc3 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsmc3)));

  $datafinalsehab = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsehab = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsehab)));

  $datafinalsehab2 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsehab2 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsehab2)));

  $datafinalsehab3 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsehab3 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsehab3)));

  $datafinalsiurb = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsiurb = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsiurb)));

  $datafinalsiurb2 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsiurb2 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsiurb2)));

  $datafinalsiurb3 = mysqli_real_escape_string($mysqli, $_POST['datafimanalise']);
  $datafinalsiurb3 = date("Y-m-d", strtotime(str_replace('/', '-', $datafinalsiurb3)));

  $dataenvio2 = mysqli_real_escape_string($mysqli, $_POST['dataenvio2']);
  $dataenvio2 = date("Y-m-d", strtotime(str_replace('/', '-', $dataenvio2)));

  $dataenvio3 = mysqli_real_escape_string($mysqli, $_POST['dataenvio3']);
  $dataenvio3 = date("Y-m-d", strtotime(str_replace('/', '-', $dataenvio3)));


  $obs = mysqli_real_escape_string($mysqli, $_POST['obs']);

  $mysqli->query("INSERT INTO primeirainstancia (controleinterno,datainicio, datalimite, datagendada, datareal,motivodatadistinta, parecer, datapubliparecer, datacumprimento,datalimite2,
dataagendada2, datareal2, motivodatadistinta2,parecer2,comuniqcomplementar, datacomplementar, dataresp,datalimite3, dataagendada3, datareal3, motivodatadistinta3,parecer3,
datapublidec, datapublicoord, obs, datafimanalise, datafimanalise2, datafimanalise3, datafinalsvma, datafinalsvma2, datafinalsvma3, datafinalsmt, datafinalsmt2, datafinalsmt3, datafinalsmc,
datafinalsmc2, datafinalsmc3, datafinalsehab, datafinalsehab2, datafinalsehab3, datafinalsiurb, datafinalsiurb2, datafinalsiurb3, dataenvio2, dataenvio3)
VALUES('$controleinterno','$datainicio','$datalimite','$datagendada','$datareal','$motivodatadistinta','$parecer','$datapubliparecer','$datacumprimento','$datalimite2',
'$dataagendada2','$datareal2','$motivodatadistinta2','$parecer2','$comuniqcomplementar','$datacomplementar','$dataresp','$datalimite3','$dataagendada3',
'$datareal3','$motivodatadistinta3','$parecer3','$datapublidec','$datapublicoord','$obs','$datafimanalise','$datafimanalise2','$datafimanalise3','$datafinalsvma','$datafinalsvma2',
'$datafinalsvma3','$datafinalsmt','$datafinalsmt2','$datafinalsmt3','$datafinalsmc','$datafinalsmc2','$datafinalsmc3','$datafinalsehab','$datafinalsehab2',
'$datafinalsehab3','$datafinalsiurb','$datafinalsiurb2','$datafinalsiurb3','$dataenvio2','$dataenvio3')")
    or die($mysqli->error);

  //echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
}
