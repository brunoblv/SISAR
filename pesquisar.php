<?php
require_once 'conexao.php';

// Captura o termo de pesquisa enviado pelo JavaScript

$pesquisar = $_POST["pesquisar"];

// Realiza a pesquisa no banco de dados usando o termo de pesquisa

$buscar_cadastros = "SELECT * FROM Inicial
WHERE numsql = '$pesquisar'
AND sts = 2
AND dataprotocolo BETWEEN DATE_SUB(NOW(), INTERVAL 120 DAY) AND NOW() ORDER BY dataprotocolo DESC LIMIT 1";


$query_cadastros = mysqli_query($conn, $buscar_cadastros);

// Formata os resultados da pesquisa em HTML


if (mysqli_num_rows($query_cadastros) > 0) {
    // Formata os resultados da pesquisa em HTML
    while ($result = mysqli_fetch_assoc($query_cadastros)) {
        $id = $result['id'];
        $sei = $result['sei'];
        $dataprotocolo = $result['dataprotocolo'];
        $numsql = $result['numsql'];
    }  



    echo "<script>window.alert('Esse SQL tem um processo indeferido protocolado no dia {$dataprotocolo}, SEI nº: {$sei}, Controle Interno Nº: {$id}');
    document.location.href='cadastroinicial.php'</script>";
   

} else {
    // Mostra a mensagem de 0 resultados
    echo "<script>window.alert('Não foram encontrados protocolos indeferidos nos últimos 120 dias'); document.location.href='cadastroinicial.php</script>";
}
?>