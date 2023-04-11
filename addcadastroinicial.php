<?php

require_once 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));   
    
               

if(isset($_POST['salvar'])) {	
	$obs = mysqli_real_escape_string($mysqli, $_POST['obs']);
    $numsql = mysqli_real_escape_string($mysqli, $_POST['numsql']);
    $tipo = mysqli_real_escape_string($mysqli, $_POST['tipo']);
	$req = mysqli_real_escape_string($mysqli, $_POST['req']);
    $fisico = mysqli_real_escape_string($mysqli, $_POST['fisico']);
    $digital = mysqli_real_escape_string($mysqli, $_POST['digital']);
    $sei = mysqli_real_escape_string($mysqli, $_POST['sei']);
    $dataprotocolo = mysqli_real_escape_string($mysqli, $_POST['dataprotocolo']);
    $dataprotocolo = date("Y-m-d",strtotime(str_replace('/','-',$dataprotocolo)));
    $tipoprocesso = mysqli_real_escape_string($mysqli, $_POST['tipoprocesso']);
    $alv1 = mysqli_real_escape_string($mysqli, $_POST['alv1']);
    $alv2 = mysqli_real_escape_string($mysqli, $_POST['alv2']);
    $alv3 = mysqli_real_escape_string($mysqli, $_POST['alv3']);
    $stand = mysqli_real_escape_string($mysqli, $_POST['stand']);  
    $decreto = mysqli_real_escape_string($mysqli, $_POST['decreto']);
    $dataad = mysqli_real_escape_string($mysqli, $_POST['dataad']);
    $conclusao = 0;

    $date = date('Y-m-d', strtotime("-120 days"));
    $buscar_cadastros = "SELECT COUNT(id) AS numprotocolo FROM inicial WHERE numsql = '$numsql' AND dataprotocolo >= '$date'";
    $query_cadastros = mysqli_query($conn, $buscar_cadastros);

    $resultado = mysqli_fetch_assoc($query_cadastros);
    $prot = $resultado['numprotocolo'];   

    $status = '1';


    $stmt = $mysqli->prepare("INSERT INTO inicial (conclusao, obs, numsql, tipo, req, fisico, aprovadigital, sei, dataprotocolo, tipoprocesso, tipoalvara1, tipoalvara2, tipoalvara3, stand, sts, descstatus, decreto) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssssssssss", $conclusao, $obs, $numsql, $tipo, $req, $fisico, $digital, $sei, $dataprotocolo, $tipoprocesso, $alv1, $alv2, $alv3, $stand, $status, $decreto);
    $stmt->execute();    
    
    if ($prot == 0){
        echo "<script>window.alert('Cadastrado com Sucesso!'); document.location.href='principal.php'</script>";
    } else {
        echo "<script>window.alert('Cadastrado com Sucesso! Porém esse SQL tem protocolo em menos de 120 dias.'); document.location.href='principal.php'</script>";
    }
   
 }
?>

