<?php

include 'conexao.php';

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {
  $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);


  // Reanálise Técnica

  if (isset($_POST['datacumprimento_r'])) {
    $datacumprimento_r = mysqli_real_escape_string($mysqli, $_POST['datacumprimento_r']);
    $datacumprimento_r = date("Y-m-d", strtotime(str_replace('/', '-', $datacumprimento_r)));
  } else {
    $datacumprimento_r = 'null';
  }

  if (isset($_POST['datalimite_r'])) {
    $datalimite_r = mysqli_real_escape_string($mysqli, $_POST['datalimite_r']);
    $datalimite_r = date("Y-m-d", strtotime(str_replace('/', '-', $datalimite_r)));
  } else {
    $datalimite_r = 'null';
  }

  if (isset($_POST['dataagendada_r'])) {
    $dataagendada_r = mysqli_real_escape_string($mysqli, $_POST['dataagendada_r']);
    $dataagendada_r = date("Y-m-d", strtotime(str_replace('/', '-', $dataagendada_r)));
  } else {
    $dataagendada_r = 'null';
  }

  if (isset($_POST['datareal_r'])) {
    $datareal_r = mysqli_real_escape_string($mysqli, $_POST['datareal_r']);
    $datareal_r = date("Y-m-d", strtotime(str_replace('/', '-', $datareal_r)));
  } else {
    $datareal_r = 'null';
  }
  if (isset($_POST['motivo_r'])) {
    $motivo_r = mysqli_real_escape_string($mysqli, $_POST['motivo_r']);
  } else {
    $motivo_r = '0';
  }

  if (isset($_POST['datasmul_r'])) {
    $datasmul_r = mysqli_real_escape_string($mysqli, $_POST['datasmul_r']);
    $datasmul_r = date("Y-m-d", strtotime(str_replace('/', '-', $datasmul_r)));
  } else {
    $datasmul_r = 'null';
  }

  if (isset($_POST['datasvma_r'])) {
    $datasvma_r = mysqli_real_escape_string($mysqli, $_POST['datasvma_r']);
    $datasvma_r = date("Y-m-d", strtotime(str_replace('/', '-', $datasvma_r)));
  } else {
    $datasvma_r = 'null';
  }

  if (isset($_POST['datasmc_r'])) {
    $datasmc_r = mysqli_real_escape_string($mysqli, $_POST['datasmc_r']);
    $datasmc_r = date("Y-m-d", strtotime(str_replace('/', '-', $datasmc_r)));
  } else {
    $datasmc_r = 'null';
  }
  if (isset($_POST['datasmt_r'])) {
    $datasmt_r = mysqli_real_escape_string($mysqli, $_POST['datasmt_r']);
    $datasmt_r = date("Y-m-d", strtotime(str_replace('/', '-', $datasmt_r)));
  } else {
    $datasmt_r = 'null';
  }
  if (isset($_POST['datasehab_r'])) {
    $datasehab_r = mysqli_real_escape_string($mysqli, $_POST['datasehab_r']);
    $datasehab_r = date("Y-m-d", strtotime(str_replace('/', '-', $datasehab_r)));
  } else {
    $datasehab_r = 'null';
  }
  if (isset($_POST['datasiurb_r'])) {
    $datasiurb_r = mysqli_real_escape_string($mysqli, $_POST['datasiurb_r']);
    $datasiurb_r = date("Y-m-d", strtotime(str_replace('/', '-', $datasiurb_r)));
  } else {
    $datasiurb_r = 'null';
  }

  $parecer_r = mysqli_real_escape_string($mysqli, $_POST['parecer_r']);

  if (isset($_POST['datapubli_r'])) {
    $datapubli_r = mysqli_real_escape_string($mysqli, $_POST['datapubli_r']);
    $datapubli_r = date("Y-m-d", strtotime(str_replace('/', '-', $datapubli_r)));
  } else {
    $datapubli_r = 'null';
  }  

  $obs = mysqli_real_escape_string($mysqli, $_POST['obs_r']);


  $stmt = $mysqli->prepare("UPDATE primeirainstancia SET
   datacumprimento_r=?,
   datalimite_r=?,
   dataagendada_r=?,
   datareal_r=?,
   motivo_r=?,
   parecer_r=?,
   datapubli_r=?,
   datasmul_r=?,
   datasmc_r=?,
   datasmt_r=?,
   datasehab_r=?,
   datasiurb_r=?,
   datasvma_r=?,
   obs_r=?
   WHERE controleinterno=?");

  $stmt->bind_param(
    "sssssssssssssss",
    $datacumprimento_r,
    $datalimite_r,
    $dataagendada_r,
    $datareal_r,
    $motivo_r,
    $parecer_r,
    $datapubli_r,
    $datasmul_r,
    $datasmc_r,
    $datasmt_r,
    $datasehab_r,
    $datasiurb_r,
    $datasvma_r,
    $obs_r,
    $controleinterno
  );
  $stmt->execute();

  $descricao = 'Reanálise Técnica';
  $datafim = '';

  $datas = array($datasmul_r, $datasvma_r, $datasmc_r, $datasmt_r, $datasehab_r, $datasiurb_r);
  $datafim = max($datas);
  $instancia = 2;
  $graproem = 2;

  $stmt = $mysqli->prepare("INSERT INTO controle_prazo (controleinterno, descricao, instancia, graproem, datainicio, datafim) VALUES (?,?,?,?,?,?)");
  $stmt->bind_param("isssss", $controleinterno, $descricao, $instancia, $graproem, $datacumprimento_r, $datafim);
  $stmt->execute();

  $stmt = $mysqli->prepare("UPDATE controle_prazo SET dias = ABS(DATEDIFF(?,?)) WHERE controleinterno=? AND instancia=? AND graproem=?");
  $stmt->bind_param("ssiss", $datacumprimento_r, $datafim, $controleinterno, $instancia, $graproem);
  $stmt->execute();
  
 
  switch ($parecer_r) {
    case 1:
      $status = 9;
      break;
    case 2:
      $status = 10;
      break;
    case 3:
      $status = 11;
      break;
  }

  echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
}
