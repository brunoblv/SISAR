<?php

require_once 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));                 

if(isset($_POST['salvar'])) {	
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
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
    $status = mysqli_real_escape_string($mysqli, $_POST['status']);
    $descstatus = mysqli_real_escape_string($mysqli, $_POST['descstatus']);
    $decreto = mysqli_real_escape_string($mysqli, $_POST['decreto']);
    $dataad = mysqli_real_escape_string($mysqli, $_POST['dataad']);
    $dataad = date("Y-m-d",strtotime(str_replace('/','-',$dataad)));
    $conclusao = 0;

    $date = date('Y-m-d', strtotime("-120 days"));
    $buscar_cadastros = "SELECT COUNT(id) AS numprotocolo FROM inicial WHERE numsql = '$numsql' AND dataprotocolo >= '$date'";
    $query_cadastros = mysqli_query($conn, $buscar_cadastros);

    $resultado = mysqli_fetch_assoc($query_cadastros);
    $prot = $resultado['numprotocolo'];   


    $stmt = $mysqli->prepare("UPDATE inicial SET numsql=?, obs=?, tipo=?, req=?, fisico=?, aprovadigital=?, sei=?, dataprotocolo=?, tipoprocesso=?, tipoalvara1=?, tipoalvara2=?, tipoalvara3=?,
     stand=?, sts=?, descstatus=?, decreto=?, dataad=? WHERE id='$id'");
    $stmt->bind_param("ssiissssiiiiiisis", $numsql, $obs, $tipo, $req, $fisico, $digital, $sei, $dataprotocolo, $tipoprocesso, $alv1, $alv2, $alv3, $stand, $status, $descstatus, $decreto, $dataad);
    $stmt->execute();  
    
    echo $id;
    
   if ($prot == 0){
        echo "<script>window.alert('Atualizado com Sucesso!'); document.location.href='alterar.php'</script>";
    } else {
        echo "<script>window.alert('Atualizado com Sucesso! Porém esse SQL tem protocolo em menos de 120 dias.'); document.location.href='alterar.php'</script>";
    }
   
 }
?>

