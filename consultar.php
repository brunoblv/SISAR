<?php

include 'navbar.php';


 include 'head.php';


// Conexão com o banco de dados
include 'conexao.php';

$conn = new mysqli($host, $user, $password, $db_name);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Recebe o valor do parâmetro "sql" via GET
$sql = $_GET["sql"];

// Monta a consulta SQL
$date = date('Y-m-d', strtotime("-120 days"));
$query = "SELECT * FROM inicial WHERE numsql = '$sql' AND dataprotocolo >= '$date'";

// Executa a consulta
$result = $conn->query($query);

// Verifica se a consulta retornou resultados
if ($result->num_rows > 0) {
	// Exibe os resultados em uma tabela HTML
	echo "<table class='table table-bordered'>";
	echo "<thead><tr><th>Processo SEI</th><th>SQL</th><th>Data de Protocolo</th></tr></thead>";
	while($row = $result->fetch_assoc()) {
		echo "<tr><td>".$row["sei"]."</td><td>".$row["numsql"]."</td><td>".$row["outrocampo"]."</td></tr>";
	}
	echo "</table>";
} else {
	echo "Nenhum resultado encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
