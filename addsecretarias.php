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
  

    
    




    $mysqli->query("INSERT INTO secretarias (controleinterno, svma, interfacesvma,smt, interfacesmt, smc, interfacesmc, sehab, interfacesehab, siurb,interfacesiurb)
     VALUES('$controleinterno','$svma','$interfacesvma', '$smt','$interfacesmt','$smc','$interfacesmc','$sehab','$interfacesehab','$siurb','$interfacesiurb')")
      or die ($mysqli->error);
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
?>

