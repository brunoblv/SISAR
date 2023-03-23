<?php

include 'conexao.php';

$mysqli = new mysqli($host,$user,$password,$db_name) or die(mysqli_error($mysqli));

if(isset($_POST['salvar'])) {	
	$usuario = mysqli_real_escape_string($mysqli, $_POST['usuario']);
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $permissao = mysqli_real_escape_string($mysqli, $_POST['permissao']);
    $statususer = mysqli_real_escape_string($mysqli, $_POST['statususer']); 

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

 

    $mysqli->query("INSERT INTO usuarios (usuario, nome, permissao, statususer) VALUES('$usuario','$nome','$permissao','$statususer')") or die ($mysqli->error);
    
    echo "<script>window.alert('Cadastrado com Sucesso'); document.location.href='principal.php'</script>";
 }
?>

