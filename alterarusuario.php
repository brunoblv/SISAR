<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));



if(isset($_POST['salvar'])){
    
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
	$nome = $_POST['nome'];
	$permissao = $_POST['permissao'];
    $statususer = $_POST['statususer'];  
    
    switch($permissao){
        case 'SuperAdmin':
            $permissao = 0;
            break;
        case 'Administrador':
            $permissao = 1;
            break;
        case 'Ponto Focal':
            $permissao = 2;
            break;

    } 

   
    $mysqli->query("UPDATE usuarios
    SET usuario = '$usuario', nome = '$nome', permissao = '$permissao', statususer = '$statususer'
    WHERE id = '$id'") or die ($mysqli->error);
    
    echo "<script>window.alert('Alterado com sucesso!'); document.location.href='listarusuario.php'</script>";
   
    
 
}


?>