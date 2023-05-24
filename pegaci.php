<?php
session_start();

if (isset($_POST['valor'])) {
  $valorRecebido = $_POST['valor'];

  // Armazenar o valor na sessão

  $_SESSION['valor'] = $valorRecebido;
  
  // Redirecionar para outra página
  header("Location: cadastrograproem.php");
  exit;
}
?>
