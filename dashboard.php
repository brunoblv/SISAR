<?php
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['SesID'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}

$login = $_SESSION['SesID'];

require_once 'conexao.php';

$buscar_cadastros = "SELECT permissao FROM usuarios WHERE `usuario`='" . strtolower($login) . "';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);

if (mysqli_num_rows($query_cadastros) != 1) {
  header("location: erropermissao.php");
} else {
  $resultado = mysqli_fetch_assoc($query_cadastros);
}

$buscar_cadastros = "SELECT permissao FROM usuarios WHERE `usuario`='" . strtolower($login) . "';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);

while ($row = $query_cadastros->fetch_assoc()) {
}

if ($row <> 0 and $row <> 1 and $row <> 2) {
  header("location: erropermissao.php");
}

?>
<!doctype html>
<html lang="pt-br">

<head>
  <?php include 'head.php'; ?>



</head>

<body>
<?php
include 'conexao.php';

/* Conta e imprime o número de computadores na Secretaria */

$buscar_cadastros = "SELECT COUNT(iditem) AS totalpcs FROM item WHERE tipo = 'MICROCOMPUTADOR';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$totalpcs = ceil ($row_pg['totalpcs']);

/* Conta e imprime o número de monitores na Secretaria */

$buscar_cadastros = "SELECT COUNT(iditem) AS totalmoni FROM item WHERE tipo = 'MONITOR';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$totalmoni = ceil ($row_pg['totalmoni']);

$buscar_cadastros = "SELECT COUNT(iditem) AS ascom FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'ASCOM';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$ascom = ceil ($row_pg['ascom']);

$buscar_cadastros = "SELECT COUNT(iditem) AS atecc FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'ATECC';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$atecc = ceil ($row_pg['atecc']);

$buscar_cadastros = "SELECT COUNT(iditem) AS atic FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'ATIC';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$atic = ceil ($row_pg['atic']);

$buscar_cadastros = "SELECT COUNT(iditem) AS gab FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'GABINETE';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$gab = ceil ($row_pg['gab']);

$buscar_cadastros = "SELECT COUNT(iditem) AS stel FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'STEL';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$stel = ceil ($row_pg['stel']);

$totalgab = $ascom + $atecc + $atic + $gab + $stel;

$buscar_cadastros = "SELECT COUNT(iditem) AS caf FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'caf';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$caf = ceil ($row_pg['caf']);

$buscar_cadastros = "SELECT COUNT(iditem) AS cafdgp FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'caf/dgp';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$cafdgp = ceil ($row_pg['cafdgp']);

$buscar_cadastros = "SELECT COUNT(iditem) AS cafdlc FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'caf/dlc';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$cafdlc = ceil ($row_pg['cafdlc']);

$buscar_cadastros = "SELECT COUNT(iditem) AS cafdof FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'caf/dof';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$cafdof = ceil ($row_pg['cafdof']);

$buscar_cadastros = "SELECT COUNT(iditem) AS cafdsup FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'caf/dsup';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$cafdsup = ceil ($row_pg['cafdsup']);

$buscar_cadastros = "SELECT COUNT(iditem) AS auditorio FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'auditorio';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$auditorio = ceil ($row_pg['auditorio']);

$buscar_cadastros = "SELECT COUNT(iditem) AS almoxarifado FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'caf/almoxarifado';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$almoxarifado = ceil ($row_pg['almoxarifado']);

$totalcaf = $caf + $cafdgp + $cafdlc + $cafdof + $cafdsup + $auditorio + $almoxarifado;

$buscar_cadastros = "SELECT COUNT(iditem) AS cap FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'cap';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$cap = ceil ($row_pg['cap']);

$buscar_cadastros = "SELECT COUNT(iditem) AS arthur FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'CAP/ARTHUR SABOYA';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$caparthur = ceil ($row_pg['arthur']);

$buscar_cadastros = "SELECT COUNT(iditem) AS capdeprot FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'cap/deprot';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$capdeprot = ceil ($row_pg['capdeprot']);

$buscar_cadastros = "SELECT COUNT(iditem) AS capdpci FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'cap/dpci';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$capdpci = ceil ($row_pg['capdpci']);


$buscar_cadastros = "SELECT COUNT(iditem) AS capdpd FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'cap/dpd';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$capdpd = ceil ($row_pg['capdpd']);

$buscar_cadastros = "SELECT COUNT(iditem) AS nucleo FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'CAP/NUCLEO DE ATENDIMENTO';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$nucleo = ceil ($row_pg['nucleo']);

$totalcap = $cap + $caparthur + $capdeprot + $capdpci + $capdpd + $nucleo;

$buscar_cadastros = "SELECT COUNT(iditem) AS caseg FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'CASE';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$case = ceil ($row_pg['caseg']);

$buscar_cadastros = "SELECT COUNT(iditem) AS casedcad FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'CASE/DCAD';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$casedcad = ceil ($row_pg['casedcad']);


$buscar_cadastros = "SELECT COUNT(iditem) AS caseddu FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'CASE/DDU';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$caseddu = ceil ($row_pg['caseddu']);


$buscar_cadastros = "SELECT COUNT(iditem) AS casedle FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'CASE/dle';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$casedle = ceil ($row_pg['casedle']);

$buscar_cadastros = "SELECT COUNT(iditem) AS cepeuc FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'cepeuc';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$cepeuc = ceil ($row_pg['cepeuc']);

$buscar_cadastros = "SELECT COUNT(iditem) AS comin FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'comin';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$comin = ceil ($row_pg['comin']);

$buscar_cadastros = "SELECT COUNT(iditem) AS comindcimp FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'comin/dcimp';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$comindcimp = ceil ($row_pg['comindcimp']);

$buscar_cadastros = "SELECT COUNT(iditem) AS comindcigp FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'comin/dcigp';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$comindcigp = ceil ($row_pg['comindcigp']);

$buscar_cadastros = "SELECT COUNT(iditem) AS contru FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'contru';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$contru = ceil ($row_pg['contru']);

$buscar_cadastros = "SELECT COUNT(iditem) AS contrudacess FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'contru/dacess';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$contrudacess = ceil ($row_pg['contrudacess']);

$buscar_cadastros = "SELECT COUNT(iditem) AS contrudins FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'contru/dins';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$contrudins = ceil ($row_pg['contrudins']);

$buscar_cadastros = "SELECT COUNT(iditem) AS contrudlr FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'contru/dlr';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$contrudlr = ceil ($row_pg['contrudlr']);

$buscar_cadastros = "SELECT COUNT(iditem) AS contrudsus FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'contru/dsus';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$contrudsus = ceil ($row_pg['contrudsus']);

$buscar_cadastros = "SELECT COUNT(iditem) AS deuso FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'deuso';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$deuso = ceil ($row_pg['deuso']);

$buscar_cadastros = "SELECT COUNT(iditem) AS deusodmus FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'deuso/dmus';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$deusodmus = ceil ($row_pg['deusodmus']);

$buscar_cadastros = "SELECT COUNT(iditem) AS deusodnus FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'deuso/dnus';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$deusodnus = ceil ($row_pg['deusodnus']);

$buscar_cadastros = "SELECT COUNT(iditem) AS deusodsiz FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'deuso/dsiz';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$deusodsiz = ceil ($row_pg['deusodsiz']);

$buscar_cadastros = "SELECT COUNT(iditem) AS geoinfo FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'geoinfo';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$geoinfo = ceil ($row_pg['geoinfo']);

$buscar_cadastros = "SELECT COUNT(iditem) AS gtec FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'gtec';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$gtec = ceil ($row_pg['gtec']);

$buscar_cadastros = "SELECT COUNT(iditem) AS parhis FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'parhis';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$parhis = ceil ($row_pg['parhis']);

$buscar_cadastros = "SELECT COUNT(iditem) AS parhisdhis FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'parhis/dhis';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$parhisdhis = ceil ($row_pg['parhisdhis']);

$buscar_cadastros = "SELECT COUNT(iditem) AS parhisdhmp FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'parhis/dhmp';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$parhisdhmp = ceil ($row_pg['parhisdhmp']);

$buscar_cadastros = "SELECT COUNT(iditem) AS parhisdps FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'parhis/dps';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$parhisdps = ceil ($row_pg['parhisdps']);

$buscar_cadastros = "SELECT COUNT(iditem) AS planurb FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'planurb';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$planurb = ceil ($row_pg['planurb']);

$buscar_cadastros = "SELECT COUNT(iditem) AS resid FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'resid';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$resid = ceil ($row_pg['resid']);

$buscar_cadastros = "SELECT COUNT(iditem) AS residdrgp FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'resid/drgp';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$residdrgp = ceil ($row_pg['residdrgp']);

$buscar_cadastros = "SELECT COUNT(iditem) AS residdrpm FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'resid/drpm';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$residdrpm = ceil ($row_pg['residdrpm']);

$buscar_cadastros = "SELECT COUNT(iditem) AS residdru FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'resid/dru';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$residdru = ceil ($row_pg['residdru']);

$buscar_cadastros = "SELECT COUNT(iditem) AS servin FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'servin';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$servin = ceil ($row_pg['servin']);

$buscar_cadastros = "SELECT COUNT(iditem) AS servindsigp FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'servin/dsigp';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$servindsigp = ceil ($row_pg['servindsigp']);

$buscar_cadastros = "SELECT COUNT(iditem) AS servindsimp FROM item WHERE tipo = 'MICROCOMPUTADOR' AND localizacao = 'servin/dsimp';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);
$row_pg = mysqli_fetch_assoc($query_cadastros);
$servindsimp = ceil ($row_pg['servindsimp']);


include 'navbar.php'; ?>

  <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">
    <div class="row">

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Computadores (Total)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalpcs ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Monitores (Total)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalmoni ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Switchs (Total)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="mb-4">
    <div class="row">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            GABINETE (total: <?php echo $totalgab ?>)
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">ASCOM: <?php echo $ascom ?></li>
            <li class="list-group-item">ATECC: <?php echo $atecc ?></li>
            <li class="list-group-item">ATIC: <?php echo $atic ?></li>
            <li class="list-group-item">GAB: <?php echo $gab ?></li>
            <li class="list-group-item">STEL: <?php echo $stel ?></li>
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            CAF: (total: <?php echo $totalcaf ?>)
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">CAF-G: <?php echo $caf ?></li>
            <li class="list-group-item">DGP: <?php echo $cafdgp ?></li>
            <li class="list-group-item">DLC: <?php echo $cafdlc ?></li>
            <li class="list-group-item">DOF: <?php echo $cafdof?></li>
            <li class="list-group-item">DSUP: <?php echo $cafdsup ?></li>
            <li class="list-group-item">AUDITÓRIO: <?php echo $auditorio ?></li>
            <li class="list-group-item">ALMOXARIFADO: <?php echo $almoxarifado ?></li>
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            CAP: (total: <?php echo $totalcap ?>)
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">CAP-G: <?php echo $cap ?></li>
            <li class="list-group-item">ARTHUR SABOYA: <?php echo $caparthur ?></li>
            <li class="list-group-item">DEPROT: <?php echo $capdeprot ?></li>
            <li class="list-group-item">DPCI: <?php echo $capdpci ?></li>
            <li class="list-group-item">DPD: <?php echo $capdpd ?></li>
            <li class="list-group-item">NÚCLEO: <?php echo $nucleo ?></li>
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            CASE
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">CASE-G: <?php echo $case ?></li>
            <li class="list-group-item">DCAD: <?php echo $casedcad ?></li>
            <li class="list-group-item">DDU: <?php echo $caseddu ?></li>
            <li class="list-group-item">DLE: <?php echo $casedle ?></li>        
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            CEPEUC
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">CEPEUC: <?php echo $cepeuc ?></li>  
                     
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            COMIN
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">COMIN-G: <?php echo $comin ?></li>  
            <li class="list-group-item">DCIGP: <?php echo $comindcigp ?></li>  
            <li class="list-group-item">DCIMP: <?php echo $comindcimp ?></li>  
               
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            CONTRU
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">CONTRU-G: <?php echo $contru ?></li>  
            <li class="list-group-item">DACESS: <?php echo $contrudacess ?></li>  
            <li class="list-group-item">DINS: <?php echo $contrudins ?></li>  
            <li class="list-group-item">DLR:  <?php echo $contrudlr ?></li>  
            <li class="list-group-item">DSUS:  <?php echo $contrudsus ?></li>        
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            DEUSO
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">DEUSO-G: <?php echo $deuso ?></li>
            <li class="list-group-item">DMUS: <?php echo $deusodmus ?></li>
            <li class="list-group-item">DNUS: <?php echo $deusodnus ?></li>
            <li class="list-group-item">DSIZ:<?php echo $deusodsiz ?></li>         
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            GEOINFO
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">GEOINFO: <?php echo $geoinfo ?></li>                   
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            GTEC
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">GTEC: <?php echo $gtec ?></li>           
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            PARHIS
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">PARHIS-G: <?php echo $parhis ?></li>    
            <li class="list-group-item">DHIS: <?php echo $parhisdhis ?></li>    
            <li class="list-group-item">DHMP: <?php echo $parhisdhmp ?></li>   
            <li class="list-group-item">DPS: <?php echo $parhisdps ?></li>    <        
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            PLANURB
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">PLANURB: <?php echo $planurb ?></li>    
                   
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            RESID
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">RESID-G: <?php echo $resid ?></li>    
            <li class="list-group-item">DRGP: <?php echo $residdrgp ?></li>    
            <li class="list-group-item">DRPM: <?php echo $residdrpm ?></li>    
            <li class="list-group-item">DRU: <?php echo $residdru ?></li>           
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            SERVIN
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">SERVIN-G: <?php echo $servin ?></li> 
            <li class="list-group-item">DSIGP: <?php echo $servindsigp ?></li>
            <li class="list-group-item">DSIMP: <?php echo $servindsimp ?></li></li>
                       
          </ul>
        </div>
      </div>

    </div>
  </div>











</body>

</html>