<?php

include 'conexao.php';

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {
  $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);

  if (isset($_POST['datainicio'])) {
    $datainicio = mysqli_real_escape_string($mysqli, $_POST['datainicio']);
    $datainicio = date("Y-m-d", strtotime(str_replace('/', '-', $datainicio)));
  } else {
    $datainicio = 'null';
  }

  if (isset($_POST['datalimite'])) {
    $datalimite = mysqli_real_escape_string($mysqli, $_POST['datalimite']);
    $datalimite = date("Y-m-d", strtotime(str_replace('/', '-', $datalimite)));
  } else {
    $datalimite = 'null';
  }

  if (isset($_POST['dataagendada'])) {
    $dataagendada = mysqli_real_escape_string($mysqli, $_POST['dataagendada']);
    $dataagendada = date("Y-m-d", strtotime(str_replace('/', '-', $dataagendada)));
  } else {
    $dataagendada = 'null';
  }

  if (isset($_POST['datareal'])) {
    $datareal = mysqli_real_escape_string($mysqli, $_POST['datareal']);
    $datareal = date("Y-m-d", strtotime(str_replace('/', '-', $datareal)));
  } else {
    $datareal = 'null';
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
    $datasmul = 'null';
  }

  if (isset($_POST['datasvma'])) {
    $datasvma = mysqli_real_escape_string($mysqli, $_POST['datasvma']);
    $datasvma = date("Y-m-d", strtotime(str_replace('/', '-', $datasvma)));
  } else {
    $datasvma = 'null';
  }

  if (isset($_POST['datasmc'])) {
    $datasmc = mysqli_real_escape_string($mysqli, $_POST['datasmc']);
    $datasmc = date("Y-m-d", strtotime(str_replace('/', '-', $datasmc)));
  } else {
    $datasmc = 'null';
  }
  if (isset($_POST['datasmt'])) {
    $datasmt = mysqli_real_escape_string($mysqli, $_POST['datasmt']);
    $datasmt = date("Y-m-d", strtotime(str_replace('/', '-', $datasmt)));
  } else {
    $datasmt = 'null';
  }
  if (isset($_POST['datasehab'])) {
    $datasehab = mysqli_real_escape_string($mysqli, $_POST['datasehab']);
    $datasehab = date("Y-m-d", strtotime(str_replace('/', '-', $datasehab)));
  } else {
    $datasehab = 'null';
  }
  if (isset($_POST['datasiurb'])) {
    $datasiurb = mysqli_real_escape_string($mysqli, $_POST['datasiurb']);
    $datasiurb = date("Y-m-d", strtotime(str_replace('/', '-', $datasiurb)));
  } else {
    $datasiurb = 'null';
  }

  $parecer = mysqli_real_escape_string($mysqli, $_POST['parecer']);

  if (isset($_POST['datapubli'])) {
    $datapubli = mysqli_real_escape_string($mysqli, $_POST['datapubli']);
    $datapubli = date("Y-m-d", strtotime(str_replace('/', '-', $datapubli)));
  } else {
    $datapubli = 'null';
  }  

  $obs = mysqli_real_escape_string($mysqli, $_POST['obs']);


  $stmt = $mysqli->prepare("INSERT INTO primeirainstancia (controleinterno, datainicio, datalimite, dataagendada, datareal, motivo, datasmul, datasvma, 
  datasmc, datasmt, datasehab, datasiurb, parecer, datapubli, obs) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt->bind_param(
    "issssssssssssss",
    $controleinterno,
    $datainicio,
    $datalimite,
    $dataagendada,
    $datareal,
    $motivo,
    $datasmul,
    $datasvma,
    $datasmc,
    $datasmt,
    $datasehab,
    $datasiurb,
    $parecer,
    $datapubli,
    $obs   
  );
  $stmt->execute();

  $descricao = 'Análise Técnica';
  $datafim = '';

  $datas = array($datasmul, $datasvma, $datasmc, $datasmt, $datasehab, $datasiurb);
  $datafim = max($datas);
  $instancia = 1;
  $graproem = 1;

  $stmt = $mysqli->prepare("INSERT INTO controle_prazo (controleinterno, descricao, instancia, graproem, datainicio, datafim) VALUES (?,?,?,?,?,?)");
  $stmt->bind_param("isssss", $controleinterno, $descricao, $instancia, $graproem, $datainicio, $datafim);
  $stmt->execute();

  $stmt = $mysqli->prepare("UPDATE controle_prazo SET dias = ABS(DATEDIFF(?,?)) WHERE controleinterno=?");
  $stmt->bind_param("ssi", $datainicio, $datafim, $controleinterno);
  $stmt->execute();
  

  switch ($parecer) {
    case 1:
      $status = 6;
      break;
    case 2:
      $status = 7;
      break;
    case 3:
      $status = 8;
      break;
  }

  $stmt = $mysqli->prepare("UPDATE inicial SET sts = ? WHERE id=?");
  $stmt->bind_param("si", $status, $controleinterno);
  $stmt->execute();
  

  echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
}
