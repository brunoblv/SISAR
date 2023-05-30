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

  $obs = mysqli_real_escape_string($mysqli, $_POST['obs']);

  $obs = mysqli_real_escape_string($mysqli, $_POST['obs_r']);

  $obs = mysqli_real_escape_string($mysqli, $_POST['obs_c']);


  $stmt = $mysqli->prepare("INSERT INTO primeirainstancia (controleinterno, datainicio, datalimite, dataagendada, datareal, motivo, datasmul, datasvma, 
  datasmc, datasmt, datasehab, datasiurb, parecer, datapubli, obs, datacumprimento_r, datalimite_r, dataagendada_r, datareal_r, motivo_r, parecer_r, datapubli_r, datasmul_r,
  datasmc_r, datasmt_r, datasehab_r, datasiurb_r, datasvma_r, obs_r, complementar, datapublicomplementar, datacumprimento_c, datalimite_c, dataagendada_c, datareal_c, motivo_c, parecer_c,
  datapubli_c, datasmul_c, datasmc_c, datasmt_c, datasehab_c, datasiurb_c, datasvma_c, datacoord, obs_c) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt->bind_param(
    "isssssssssssssssssssssssssssssssssssssssssssss",
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
    $obs,
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
    $complementar,
    $datapublicomplementar,
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

  $descricao = 'Reanálise Técnica';
  $datafim = '';

  $datas = array($datasmul_r, $datasvma_r, $datasmc_r, $datasmt_r, $datasehab_r, $datasiurb_r);
  $datafim = max($datas);
  $instancia = 1;
  $graproem = 2;

  $stmt = $mysqli->prepare("INSERT INTO controle_prazo (controleinterno, descricao, instancia, graproem, datainicio, datafim) VALUES (?,?,?,?,?,?)");
  $stmt->bind_param("isssss", $controleinterno, $descricao, $instancia, $graproem, $datainicio, $datafim);
  $stmt->execute();

  $stmt = $mysqli->prepare("UPDATE controle_prazo SET dias = ABS(DATEDIFF(?,?)) WHERE controleinterno=? AND instancia=? AND graproem=?");
  $stmt->bind_param("ssiss", $datainicio, $datafim, $controleinterno, $instancia, $graproem);
  $stmt->execute();

  $descricao = 'Análise Técnica Complementar';
  $datafim = '';

  $datas = array($datasmul_c, $datasvma_c, $datasmc_c, $datasmt_c, $datasehab_c, $datasiurb_c);
  $datafim = max($datas);
  $instancia = 1;
  $graproem = 3;

  $stmt = $mysqli->prepare("INSERT INTO controle_prazo (controleinterno, descricao, instancia, graproem, datainicio, datafim) VALUES (?,?,?,?,?,?)");
  $stmt->bind_param("isssss", $controleinterno, $descricao, $instancia, $graproem, $datainicio, $datafim);
  $stmt->execute();

  $stmt = $mysqli->prepare("UPDATE controle_prazo SET dias = ABS(DATEDIFF(?,?)) WHERE controleinterno=? AND instancia=? AND graproem=?");
  $stmt->bind_param("ssiss", $datainicio, $datafim, $controleinterno, $instancia, $graproem);
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

  switch ($parecer_r) {
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
