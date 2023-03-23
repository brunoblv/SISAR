<?php


if (!isset($_SESSION)) {
     session_start();
    }

if (!isset($_SESSION['SesID'])) {
    session_destroy();
    header("Location: home.php");
    exit;
}

$login = $_SESSION['SesID'];

require_once 'conexao.php';

$buscar_cadastros = "SELECT permissao FROM usuarios WHERE `usuario`='".strtolower($login)."';";
$query_cadastros = mysqli_query($conn, $buscar_cadastros);

if(mysqli_num_rows($query_cadastros) !=1){
   header("location: erropermissao.php");

   
}else{
   $resultado = mysqli_fetch_assoc($query_cadastros);
}

include 'conexao.php';



?>

<!doctype html>
<html lang="pt-br">
  <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <?php include 'head.php';?>
  <title>Consulta de itens</title>

</head>

<?php include "navbar.php";?>
<body>

<div id="content" class="p-4 p-md-5 pt-5">    
    <div class="container-fluid">
        <input class="form-control" type="search" placeholder="Pesquisar" name="pesquisar" id="pesquisar">
        <button class="btn btn-outline-success" onclick="searchData()" type="submit">Pesquisar</button>
    </div>

   <div class="table-responsive">
         <table class="table table-striped table-hover">
           <thead>
               <tr>
                <th>ID </th>
                <th>Usuário</th>
                <th>Nome</th>
                <th>Permissão</th>
                <th>Status</th>
                <th>Ações</th>               
               </tr>
           </thead>
           <tbody>
<?php

// Receber o número da página
$pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);                
$pagina = (!empty($pagina_atual)) ? $pagina_atual: 1;

//Setar a quantidade de itens por página
$qnt_result_pg = 25;

//Calcular o início da visualização
$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $buscar_cadastros = "SELECT * FROM usuarios WHERE usuario LIKE '%$data%' or nome LIKE '%$data%' and permissao >1 ORDER BY id DESC";
    }
    else
    {
        $buscar_cadastros = "SELECT * FROM usuarios WHERE permissao >1 ORDER BY id LIMIT $inicio, $qnt_result_pg";
    }    

$query_cadastros = mysqli_query($conn, $buscar_cadastros);
//Paginação - Somar a quantidade de processos                   


$result_pg = "SELECT COUNT(id) AS num_result FROM usuarios";                    
$resultado_pg = mysqli_query($conn, $result_pg);
$row_pg = mysqli_fetch_assoc($resultado_pg);
//echo $row_pg['num_result'];
$quantidade_pg = ceil ($row_pg['num_result'] / $qnt_result_pg);

//Limitar a quantidade de Links antes e depois
$max_links = 2;

                while($receber_cadastros = mysqli_fetch_array($query_cadastros)){
                    $id = $receber_cadastros['id'];
                    $login = $receber_cadastros['usuario'];
                    $nome = $receber_cadastros['nome'];
                    $permissao = $receber_cadastros['permissao'];
                    $status = $receber_cadastros['statususer'];
                    
                    switch ($permissao){
                        case 0:
                            $permissao = 'SuperAdmin';
                            break;
                        case 1:
                            $permissao = 'Administrador';
                            break;
                        case 2:
                            $permissao = 'Ponto Focal';
                                break;
                        }                
                   

               ?>
               <tr>
                   <td scope ="row"><?php echo $id ?></td>
                   <td><?php echo $nome ?></td>
                   <td><?php echo $login ?></td>
                   <td><?php echo $permissao ?></td>
                   <td><?php echo $status ?></td>
                   <td>
                            
                            <a href="alterausuario.php?id=<?php echo $id;?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            
                   </td>
                   
               </tr>
               <?php }; ?>      
           </tbody>
       </table>
   

                    
<nav aria-label="Page navigation example">
<ul class="pagination">
<li class="page-item"><a class="page-link" href="listarusuario.php?pagina=1">Primeira</a></li>

<?php for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
    if($pag_ant >=1){     
    echo "<li class='page-item'><a class='page-link' href='listarusuario.php?pagina=$pag_ant'>$pag_ant</a></li>";
    }
} ?>

<li class="page-item"><a class='page-link'><?php echo $pagina?></a></li>

<?php for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
    if($pag_dep <= $quantidade_pg) {
    echo "<li class='page-item'><a class='page-link' href='listarusuario.php?pagina=$pag_dep'>$pag_dep</a></li>";
    }

}


echo "<li class='page-item'><a class='page-link' href='listarusuario.php?pagina=$quantidade_pg'>Última</a></li>";

echo '</ul>';
echo '</nav>';



?>
</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <script>
      var search = document.getElementById('pesquisar');

      search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

      function searchData()
      {
          window.location = 'listarusuario.php?search='+search.value;
      }
  </script>
</html>