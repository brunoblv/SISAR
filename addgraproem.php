<?php

include 'conexao.php';

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {
  $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
  $instancia = mysqli_real_escape_string($mysqli, $_POST['instancia']);
  $graproem = mysqli_real_escape_string($mysqli, $_POST['graproem']);

  if (isset($_POST['datainicio'])) {
    $datainicio = mysqli_real_escape_string($mysqli, $_POST['datainicio']);
    $datainicio = date("Y-m-d", strtotime(str_replace('/', '-', $datainicio)));
  } else {
    $datainicio = '0000-00-00';
  }

  if (isset($_POST['datalimite'])) {
    $datalimite = mysqli_real_escape_string($mysqli, $_POST['datalimite']);
    $datalimite = date("Y-m-d", strtotime(str_replace('/', '-', $datalimite)));
  } else {
    $datalimite = '0000-00-00';
  }

  if (isset($_POST['dataagendada'])) {
    $dataagendada = mysqli_real_escape_string($mysqli, $_POST['dataagendada']);
    $dataagendada = date("Y-m-d", strtotime(str_replace('/', '-', $dataagendada)));
  } else {
    $dataagendada = '0000-00-00';
  }

  if (isset($_POST['datareal'])) {
    $datareal = mysqli_real_escape_string($mysqli, $_POST['datareal']);
    $datareal = date("Y-m-d", strtotime(str_replace('/', '-', $datareal)));
  } else {
    $datareal = '0000-00-00';
  }
  if (isset($_POST['motivo'])) {
    $motivo = mysqli_real_escape_string($mysqli, $_POST['motivo']);    
  } else {
    $motivo = '0';
  }

  if (isset($_POST['datasmul'])) {
    $datasmul = mysqli_real_escape_string($mysqli, $_POST['datasmul']);
    $datasmul = date("Y-m-d", strtotime(str_replace('/', '-', $datasmul)));
  } else {
    $datasmul = '0000-00-00';
  }

  if (isset($_POST['datasvma'])) {
    $datasvma = mysqli_real_escape_string($mysqli, $_POST['datasvma']);
    $datasvma = date("Y-m-d", strtotime(str_replace('/', '-', $datasvma)));
  } else {
    $datasvma = '0000-00-00';
  }

  if (isset($_POST['datasmc'])) {
    $datasmc = mysqli_real_escape_string($mysqli, $_POST['datasmc']);
    $datasmc = date("Y-m-d", strtotime(str_replace('/', '-', $datasmc)));
  } else {
    $datasmc = '0000-00-00';
  }
  if (isset($_POST['datasmt'])) {
    $datasmt = mysqli_real_escape_string($mysqli, $_POST['datasmt']);
    $datasmt = date("Y-m-d", strtotime(str_replace('/', '-', $datasmt)));
  } else {
    $datasmt = '0000-00-00';
  }
  if (isset($_POST['datasehab'])) {
    $datasehab = mysqli_real_escape_string($mysqli, $_POST['datasehab']);
    $datasehab = date("Y-m-d", strtotime(str_replace('/', '-', $datasehab)));
  } else {
    $datasehab = '0000-00-00';
  }
  if (isset($_POST['datasiurb'])) {
    $datasiurb = mysqli_real_escape_string($mysqli, $_POST['datasiurb']);
    $datasiurb = date("Y-m-d", strtotime(str_replace('/', '-', $datasiurb)));
  } else {
    $datasiurb = '0000-00-00';
  }

  $parecer = mysqli_real_escape_string($mysqli, $_POST['parecer']);

  if (isset($_POST['datapubli'])) {
    $datapubli = mysqli_real_escape_string($mysqli, $_POST['datapubli']);
    $datapubli = date("Y-m-d", strtotime(str_replace('/', '-', $datapubli)));
  } else {
    $datapubli = '0000-00-00';
  }

  if (isset($_POST['datacumprimento'])) {
    $datacumprimento = mysqli_real_escape_string($mysqli, $_POST['datacumprimento']);
    $datacumprimento = date("Y-m-d", strtotime(str_replace('/', '-', $datacumprimento)));
  } else {
    $datacumprimento = '0000-00-00';
  }

  $complementar = mysqli_real_escape_string($mysqli, $_POST['complementar']);

  if (isset($_POST['datapublicomplementar'])) {
    $datapublicomplementar = mysqli_real_escape_string($mysqli, $_POST['datapublicomplementar']);
    $datapublicomplementar = date("Y-m-d", strtotime(str_replace('/', '-', $datapublicomplementar)));
  } else {
    $datapublicomplementar = '0000-00-00';
  }

  if (isset($_POST['dataresposta'])) {
    $dataresposta = mysqli_real_escape_string($mysqli, $_POST['dataresposta']);
    $dataresposta = date("Y-m-d", strtotime(str_replace('/', '-', $dataresposta)));
  } else {
    $dataresposta = '0000-00-00';
  }
  if (isset($_POST['datacoord'])) {
    $datacoord = mysqli_real_escape_string($mysqli, $_POST['datacoord']);
    $datacoord = date("Y-m-d", strtotime(str_replace('/', '-', $datacoord)));
  } else {
    $datacoord = '0000-00-00';
  }

  $obs = mysqli_real_escape_string($mysqli, $_POST['obs']);

  

  $stmt = $mysqli->prepare("INSERT INTO graproem (controleinterno, instancia, graproem, datainicio, datalimite, dataagendada, datareal, motivo, datasmul, datasvma, 
  datasmc, datasmt, datasehab, datasiurb, parecer, datapubli, datacumprimento, complementar, datapublicomplementar, dataresposta, datacoord, obs) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt->bind_param("isssssssssssssssssssss", $controleinterno, $instancia, $graproem, $datainicio, $datalimite, $dataagendada, $datareal, $motivo, $datasmul, $datasvma, 
  $datasmc, $datasmt, $datasehab, $datasiurb, $parecer, $datapubli, $datacumprimento, $complementar, $datapublicomplementar, $dataresposta, $datacoord,$obs);

  $stmt->execute();


  echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
}
