<?php

include 'conexao.php';

$mysqli = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {
  $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);  

  // Análise Técnica complementar


  $complementar = mysqli_real_escape_string($mysqli, $_POST['complementar']);

  if (isset($_POST['datapublicomplementar'])) {
    $datapublicomplementar = mysqli_real_escape_string($mysqli, $_POST['datapublicomplementar']);
    $datapublicomplementar = date("Y-m-d", strtotime(str_replace('/', '-', $datapublicomplementar)));
  } else {
    $datapublicomplementar = 'null';
  }

  if (isset($_POST['datacumprimento_c'])) {
    $datacumprimento_c = mysqli_real_escape_string($mysqli, $_POST['datacumprimento_c']);
    $datacumprimento_c = date("Y-m-d", strtotime(str_replace('/', '-', $datacumprimento_c)));
  } else {
    $datacumprimento_c = 'null';
  }

  if (isset($_POST['datalimite_c'])) {
    $datalimite_c = mysqli_real_escape_string($mysqli, $_POST['datalimite_c']);
    $datalimite_c = date("Y-m-d", strtotime(str_replace('/', '-', $datalimite_c)));
  } else {
    $datalimite_c = 'null';
  }

  if (isset($_POST['dataagendada_c'])) {
    $dataagendada_c = mysqli_real_escape_string($mysqli, $_POST['dataagendada_c']);
    $dataagendada_c = date("Y-m-d", strtotime(str_replace('/', '-', $dataagendada_c)));
  } else {
    $dataagendada_c = 'null';
  }

  if (isset($_POST['datareal_c'])) {
    $datareal_c = mysqli_real_escape_string($mysqli, $_POST['datareal_c']);
    $datareal_c = date("Y-m-d", strtotime(str_replace('/', '-', $datareal_c)));
  } else {
    $datareal_c = 'null';
  }
  if (isset($_POST['motivo_c'])) {
    $motivo_c = mysqli_real_escape_string($mysqli, $_POST['motivo_c']);
  } else {
    $motivo_c = '0';
  }

  if (isset($_POST['datasmul_c'])) {
    $datasmul_c = mysqli_real_escape_string($mysqli, $_POST['datasmul_c']);
    $datasmul_c = date("Y-m-d", strtotime(str_replace('/', '-', $datasmul_c)));
  } else {
    $datasmul_c = 'null';
  }

  if (isset($_POST['datasvma_c'])) {
    $datasvma_c = mysqli_real_escape_string($mysqli, $_POST['datasvma_c']);
    $datasvma_c = date("Y-m-d", strtotime(str_replace('/', '-', $datasvma_c)));
  } else {
    $datasvma_c = 'null';
  }

  if (isset($_POST['datasmc_c'])) {
    $datasmc_c = mysqli_real_escape_string($mysqli, $_POST['datasmc_c']);
    $datasmc_c = date("Y-m-d", strtotime(str_replace('/', '-', $datasmc_c)));
  } else {
    $datasmc_c = 'null';
  }
  if (isset($_POST['datasmt_c'])) {
    $datasmt_c = mysqli_real_escape_string($mysqli, $_POST['datasmt_c']);
    $datasmt_c = date("Y-m-d", strtotime(str_replace('/', '-', $datasmt_c)));
  } else {
    $datasmt_c = 'null';
  }
  if (isset($_POST['datasehab_c'])) {
    $datasehab_c = mysqli_real_escape_string($mysqli, $_POST['datasehab_c']);
    $datasehab_c = date("Y-m-d", strtotime(str_replace('/', '-', $datasehab_c)));
  } else {
    $datasehab_c = 'null';
  }
  if (isset($_POST['datasiurb_c'])) {
    $datasiurb_c = mysqli_real_escape_string($mysqli, $_POST['datasiurb_c']);
    $datasiurb_c = date("Y-m-d", strtotime(str_replace('/', '-', $datasiurb_c)));
  } else {
    $datasiurb_c = 'null';
  }

  $parecer_c = mysqli_real_escape_string($mysqli, $_POST['parecer_c']);

  if (isset($_POST['datapubli_c'])) {
    $datapubli_c = mysqli_real_escape_string($mysqli, $_POST['datapubli_c']);
    $datapubli_c = date("Y-m-d", strtotime(str_replace('/', '-', $datapubli_c)));
  } else {
    $datapubli_c = 'null';
  }

  if (isset($_POST['datacoord'])) {
    $datacoord = mysqli_real_escape_string($mysqli, $_POST['datacoord']);
    $datacoord = date("Y-m-d", strtotime(str_replace('/', '-', $datacoord)));
  } else {
    $datacoord = 'null';
  }
  
  

  $obs = mysqli_real_escape_string($mysqli, $_POST['obs_c']);


  $stmt = $mysqli->prepare("UPDATE primeirainstancia SET
   datacumprimento_c=?,
   datalimite_c=?,
   dataagendada_c=?,
   datareal_c=?,
   motivo_c=?,
   parecer_c=?,
   datapubli_c=?,
   datasmul_c=?,
   datasmc_c=?,
   datasmt_c=?,
   datasehab_c=?,
   datasiurb_c=?,
   datasvma_c=?,
   obs_c=?
   WHERE controleinterno=?");

  $stmt->bind_param(
    "sssssssssssssss",    
    $datacumprimento_c,
    $datalimite_c,
    $dataagendada_c,
    $datareal_c,
    $motivo_c,
    $parecer_c,
    $datapubli_c,
    $datasmul_c,
    $datasmc_c,
    $datasmt_c,
    $datasehab_c,
    $datasiurb_c,
    $datasvma_c,
    $datacoord,
    $obs_c
  );
  $stmt->execute();  
  

  $descricao = 'Análise Técnica Complementar';
  $datafim = '';

  $datas = array($datasmul_c, $datasvma_c, $datasmc_c, $datasmt_c, $datasehab_c, $datasiurb_c);
  $datafim = max($datas);
  $instancia = 1;
  $graproem = 3;

  $stmt = $mysqli->prepare("INSERT INTO controle_prazo (controleinterno, descricao, instancia, graproem, datainicio, datafim) VALUES (?,?,?,?,?,?)");
  $stmt->bind_param("isssss", $controleinterno, $descricao, $instancia, $graproem, $datacumprimento_c, $datafim);
  $stmt->execute();

  $stmt = $mysqli->prepare("UPDATE controle_prazo SET dias = ABS(DATEDIFF(?,?)) WHERE controleinterno=? AND instancia=? AND graproem=?");
  $stmt->bind_param("ssiss", $datacumprimento_c, $datafim, $controleinterno, $instancia, $graproem);
  $stmt->execute();  

  switch ($parecer_c) {
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


  echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
}
