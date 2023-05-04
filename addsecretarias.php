<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {	
	$controleinterno = mysqli_real_escape_string($mysqli, $_POST['controleinterno']);
    $svma = mysqli_real_escape_string($mysqli, $_POST['svma']);
    $interfacesvma = mysqli_real_escape_string($mysqli, $_POST['interfacesvma']);
	$smt = mysqli_real_escape_string($mysqli, $_POST['smt']); 
    $interfacesmt = mysqli_real_escape_string($mysqli, $_POST['interfacesmt']); 
    $smc = mysqli_real_escape_string($mysqli, $_POST['smc']); 
    $interfacesmc = mysqli_real_escape_string($mysqli, $_POST['interfacesmc']); 
    $sehab = mysqli_real_escape_string($mysqli, $_POST['sehab']); 
    $interfacesehab = mysqli_real_escape_string($mysqli, $_POST['interfacesehab']); 
    $siurb = mysqli_real_escape_string($mysqli, $_POST['siurb']); 
    $interfacesiurb = mysqli_real_escape_string($mysqli, $_POST['interfacesiurb']);
    $tec = mysqli_real_escape_string($mysqli, $_POST['tec']);
    $tec2 = mysqli_real_escape_string($mysqli, $_POST['tec2']);


    $mysqli->query("INSERT INTO secretarias (controleinterno, svma, interfacesvma,smt, interfacesmt, smc, interfacesmc, sehab, interfacesehab, siurb,interfacesiurb, tec, tec2)
     VALUES('$controleinterno','$svma','$interfacesvma', '$smt','$interfacesmt','$smc','$interfacesmc','$sehab','$interfacesehab','$siurb','$interfacesiurb','$tec', '$tec2')")
      or die ($mysqli->error);


    $status = 5;

    $stmt = $mysqli->prepare("UPDATE inicial SET sts=? WHERE id='$controleinterno'");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
?>

