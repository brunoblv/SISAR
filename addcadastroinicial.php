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
    
    if (isset($_POST['pedido1'])) {
        $pedido1 = mysqli_real_escape_string($mysqli, $_POST['pedido1']);
        $mysqli->query("INSERT INTO pedido_rel (controleinterno, idpedido )
        VALUES('$controleinterno','$pedido1')") or die($mysqli->error);
    }

    if (isset($_POST['pedido2'])) {
        $pedido2 = mysqli_real_escape_string($mysqli, $_POST['pedido2']);
        $mysqli->query("INSERT INTO pedido_rel (controleinterno, idpedido )
        VALUES('$controleinterno','$pedido2')") or die($mysqli->error);
    }

    if (isset($_POST['pedido3'])) {
        $pedido3 = mysqli_real_escape_string($mysqli, $_POST['pedido3']);
        $mysqli->query("INSERT INTO pedido_rel (controleinterno, idpedido )
        VALUES('$controleinterno','$pedido3')") or die($mysqli->error);
    }

    if (isset($_POST['pedido4'])) {
        $pedido4 = mysqli_real_escape_string($mysqli, $_POST['pedido4']);
        $mysqli->query("INSERT INTO pedido_rel (controleinterno, idpedido )
        VALUES('$controleinterno','$pedido4')") or die($mysqli->error);
    }

    if (isset($_POST['pedido5'])) {
        $pedido5 = mysqli_real_escape_string($mysqli, $_POST['pedido5']);
        $mysqli->query("INSERT INTO pedido_rel (controleinterno, idpedido )
        VALUES('$controleinterno','$pedido5')") or die($mysqli->error);
    }

    if (isset($_POST['pedido6'])) {
        $pedido6 = mysqli_real_escape_string($mysqli, $_POST['pedido6']);
        $mysqli->query("INSERT INTO pedido_rel (controleinterno, idpedido )
        VALUES('$controleinterno','$pedido6')") or die($mysqli->error);
    }

    if (isset($_POST['pedido7'])) {
        $pedido7 = mysqli_real_escape_string($mysqli, $_POST['pedido7']);
        $mysqli->query("INSERT INTO pedido_rel (controleinterno, idpedido )
        VALUES('$controleinterno','$pedido7')") or die($mysqli->error);
    }

    if (isset($_POST['pedido6'])) {
        $pedido8 = mysqli_real_escape_string($mysqli, $_POST['pedido8']);
        $mysqli->query("INSERT INTO pedido_rel (controleinterno, idpedido )
        VALUES('$controleinterno','$pedido8')") or die($mysqli->error);
    }
    
    if ($prot == 0){
        echo "<script>window.alert('Cadastrado com Sucesso!'); document.location.href='principal.php'</script>";
    } else {
        echo "<script>window.alert('Cadastrado com Sucesso! Porém esse SQL tem protocolo em menos de 120 dias.'); document.location.href='principal.php'</script>";
    }
   
 }
