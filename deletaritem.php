<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));
   
    $id = $_GET['id'];        
   
    $mysqli->query("DELETE FROM item WHERE iditem = '$id'") or die ($mysqli->error);
    
    echo "<script>window.alert('Excluído com sucesso!'); document.location.href='listaritem.php'</script>";
    
 



?>