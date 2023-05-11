<?php

require_once 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));
               

if (isset($_POST['salvar'])) {
    $controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
	$obs = mysqli_real_escape_string($mysqli, $_POST['obs']);
    $numsql = mysqli_real_escape_string($mysqli, $_POST['numsql']);
    $tipo = mysqli_real_escape_string($mysqli, $_POST['tipo']);
	$req = mysqli_real_escape_string($mysqli, $_POST['req']);
    $fisico = mysqli_real_escape_string($mysqli, $_POST['fisico']);
    $digital = mysqli_real_escape_string($mysqli, $_POST['digital']);
    $sei = mysqli_real_escape_string($mysqli, $_POST['sei']);
    $dataprotocolo = mysqli_real_escape_string($mysqli, $_POST['dataprotocolo']);
    $dataprotocolo = date("Y-m-d", strtotime(str_replace('/', '-', $dataprotocolo)));
    $tipoprocesso = mysqli_real_escape_string($mysqli, $_POST['tipoprocesso']);
    $alv1 = mysqli_real_escape_string($mysqli, $_POST['alv1']);
    $alv2 = mysqli_real_escape_string($mysqli, $_POST['alv2']);
    $alv3 = mysqli_real_escape_string($mysqli, $_POST['alv3']);
    $stand = mysqli_real_escape_string($mysqli, $_POST['stand']);
    $outorga = mysqli_real_escape_string($mysqli, $_POST['outorga']);
    $cepac = mysqli_real_escape_string($mysqli, $_POST['cepac']);
    $ou = mysqli_real_escape_string($mysqli, $_POST['ou']);
    $aiu = mysqli_real_escape_string($mysqli, $_POST['aiu']);
    $rivi = mysqli_real_escape_string($mysqli, $_POST['rivi']);
    $aquecimento = mysqli_real_escape_string($mysqli, $_POST['aquecimento']);
    $gerador = mysqli_real_escape_string($mysqli, $_POST['gerador']);    
    $decreto = mysqli_real_escape_string($mysqli, $_POST['decreto']);
    $dataad = mysqli_real_escape_string($mysqli, $_POST['dataad']);
    $dataad = date("Y-m-d", strtotime(str_replace('/', '-', $dataad)));
    $conclusao = 0;
	$datalimite = date('Y-m-d', strtotime($dataad . ' + 15 days'));
    $date = date('Y-m-d', strtotime("-120 days"));
    $buscar_cadastros = "SELECT COUNT(id) AS numprotocolo
     FROM inicial
     WHERE numsql = '$numsql' AND dataprotocolo >= '$date'";
    $query_cadastros = mysqli_query($conn, $buscar_cadastros);

    $resultado = mysqli_fetch_assoc($query_cadastros);
    $prot = $resultado['numprotocolo'];

    $status = '1';

    $stmt = $mysqli->prepare("
    INSERT INTO inicial
     (conclusao, obs, numsql, tipo, req, fisico, aprovadigital, sei, dataprotocolo, tipoprocesso,
     tipoalvara1, tipoalvara2,
     tipoalvara3, stand, sts, decreto, dataad, outorga, cepac, ou, aiu, rivi, aquecimento, gerador)
      VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssssssssssssssssss", $conclusao, $obs, $numsql, $tipo, $req, $fisico, $digital, $sei,
     $dataprotocolo,$tipoprocesso, $alv1, $alv2, $alv3, $stand, $status, $decreto, $dataad,$outorga, $cepac, $ou, 
     $aiu, $rivi, $aquecimento, $gerador
    );
    $stmt->execute();
    
    $descricao = "Protocolo";

    $stmt = $mysqli->prepare("INSERT INTO controle_prazo (controleinterno, descricao, datainicio, datafim) VALUES (?,?,?,?)");
    $stmt->bind_param("isss", $controleinterno, $descricao, $dataprotocolo, $dataad);
    $stmt->execute();      

    $stmt = $mysqli->prepare("UPDATE controle_prazo SET dias = ABS(DATEDIFF(?,?)) WHERE controleinterno=?");
    $stmt->bind_param("ssi", $dataad, $dataprotocolo, $controleinterno);
    $stmt->execute();  
    
    if ($prot == 0){
        echo "<script>window.alert('Cadastrado com Sucesso!'); document.location.href='principal.php'</script>";
    } else {
        echo "<script>window.alert('Cadastrado com Sucesso! Porém esse SQL tem protocolo em menos de 120 dias.'); document.location.href='principal.php'</script>";
    }
   
 }
