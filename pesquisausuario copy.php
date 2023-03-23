<?php

include 'conexao.php';


// Captura o termo de pesquisa enviado pelo JavaScript
$pesquisar = $_POST["pesquisar"];

// Realiza a pesquisa no banco de dados usando o termo de pesquisa
// Substitua essas linhas com a lógica de pesquisa do seu aplicativo

$buscar_cadastros = "SELECT * FROM inicial WHERE numsql ='%$pesquisar%'";

$query_cadastros = mysqli_query($conn, $buscar_cadastros);

// Formata os resultados da pesquisa em HTML
$html = "<ul>";
foreach ($searchResults as $result) {
  $html .= "<li>" . $result["id"] . "</li>";
}
$html .= "</ul>";

// Retorna os resultados da pesquisa para o JavaScript
echo $html;
?>



