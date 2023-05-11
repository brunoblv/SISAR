<?php
// Recupera o valor enviado pela requisição AJAX
$ci = $_GET['termo'];

// Conecta ao banco de dados (substitua pelas suas informações)

include 'conexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Executa a pesquisa SQL usando o valor recebido
$stmt = $conn->prepare("SELECT inicial.sei, inicial.dataprotocolo, inicial.tipoalvara1, inicial.tipoalvara2,
 inicial.tipoalvara3, inicial.dataad, inicial.tipoprocesso, admissibilidade.dataenvio
					FROM Inicial
					JOIN Admissibilidade ON Inicial.id = Admissibilidade.controleinterno
					WHERE inicial.id = ?");
$stmt->bind_param("i", $ci);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $dados = array();

    while ($row = $result->fetch_assoc()) {
        $resultados = array();
        $resultados['ci'] = $row['id'];
        $resultados['sei'] = $row['sei'];
        $resultados['dataprotocolo'] = $row['dataprotocolo'];
        $resultados['dataad'] = $row['dataad'];
        $resultados['tipoprocesso'] = $row['tipoprocesso'];
        $resultados['alv1'] = $row['tipoalvara1'];
        $resultados['alv2'] = $row['tipoalvara2'];
        $resultados['alv3'] = $row['tipoalvara3'];
        $resultados['dataenvio'] = $row['dataenvio'];

        $dados[] = $resultados;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($dados);
    exit(); // Adicione esta linha para finalizar o script após imprimir o JSON
}


?>
