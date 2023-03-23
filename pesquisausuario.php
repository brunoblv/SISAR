<?php

include 'conexao.php';

if (isset($_POST['pesquisar'])){
    $pesquisa = $_POST['pesquisar'];
    echo $pesquisa;
} else {
    $pesquisa='';
    echo $pesquisa;
}


$buscar_cadastros = "SELECT * FROM usuarios WHERE nome ='%$pesquisa%'";

$query_cadastros = mysqli_query($conn, $buscar_cadastros);


?>