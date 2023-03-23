<?php 
if (!isset($_SESSION)) {
     session_start();
    }

if (!isset($_SESSION['SesID'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

require 'conexao.php';

$login = $_SESSION['SesID'];
$permissao = $_SESSION['Perm'];
$status = $_SESSION['Status'];

if ($permissao == 2){
  header("location: erropermissao.php");
}

 ?>

<!doctype html>
<html lang="pt-br">
  <head>

 <?php include 'head.php';?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



<html>
<head>
	<title>Alterar itens</title>  
    
</head>
<?php   
    include "conexao.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM item WHERE iditem = '$id'";
    $dados = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($dados);
    $numpatri = $linha['patrimonio'];
	  $numserie = $linha['numserie'];
	  $tipo = $linha['tipo'];
    $marca = $linha['marca'];
    $modelo = $linha['modelo'];
    $setor = $linha['localizacao'];
    $servidor = $linha['servidor'];
    $numprocesso = $linha['numprocesso'];
    $cimbpm = $linha['cimbpm'];
    $nomepc =  $linha['nome'];
    $statusitem = $linha['statusitem'];

?>


<body>


    
<div class="bootstrap-iso">
  <div class="container">
    
      <h4 class="mb-3">Alteração de bens</h4>
      <hr class="mb-4">
      <form class="need-validation" no validade method="POST" action="alteraritem.php" autocomplete="off">
        <div class = "row"> 
          <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Número do Patrimônio PMSP:</label>
            <input type="text" class="form-control" id="numpatri" name="numpatri" required="required" value="<?php echo $linha['patrimonio'] ?>" >
          </div>
          <div class="col-md-6 mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
            <select class="form-select" id="tipo" required name="tipo">
            <option>AMPLIFICADOR</option>
            <option>ANTENA PARABÓLICA</option>
            <option>AP TELEFONICO DIGITAL</option>
            <option>APARELHO FAX</option>
            <option>AR CONDICIONADO</option>
            <option>ARMARIO</option>
            <option>ARQUIVO DESLIZANTE</option>
            <option>BALCAO</option>
            <option>BATERIA</option>
            <option>CADEIRA</option>
            <option>CAIXAS DE SOM</option>
            <option>CALCULADORA</option>
            <option>CARRINHO PARA SUPERMERCADO</option>
            <option>COMPRESSOR DE ÁUDIO COM DOIS CANAIS</option>
            <option>ENCADERNADORA</option>
            <option>ESCADA DE ALUMÍNIO</option>
            <option>ESMERILHADEIRA</option>
            <option>ESTABILIZADOR</option>
            <option>ESTAÇÃO DE TRABALHO</option>
            <option>ESTANTE</option>
            <option>FRAGMENTADORA DE PAPEL</option>
            <option>FREEZER</option>
            <option>FURADEIRA</option>
            <option>GAVETEIRO</option>
            <option>GPS</option>
            <option>GUILHOTINA DE ESCRITÓRIO</option>
            <option>HARD DISK</option>
            <option>HORODATADOR PROTOCOLADOR</option>
            <option>IMPRESSORA</option>
            <option>LIXADEIRA DE CINTA</option>
            <option>LONGARINA</option>
            <option>MAPA</option>
            <option>MAQUINA FOTOGRAFICA / CÂMERA DIGITAL</option>
            <option>MARTELETE ROMPEDOR</option>
            <option>MEDIDOR DE DISTÂNCIA</option>
            <option>MEDUSA</option>
            <option>MESA</option>
            <option>MESA DE SOM</option>
            <option>MICROCOMPUTADOR</option>
            <option>MICROFONES</option>
            <option>MICRO-ONDAS</option>
            <option>MINIGRAVADOR DIGITAL</option>
            <option>MONITOR</option>
            <option>MORSA</option>
            <option>NOBREAK</option>
            <option>NOTEBOOK</option>
            <option>PAINEL ELETRÔNICO</option>
            <option>PEDESTAL</option>
            <option>PERSIANA</option>
            <option>PLOTTER</option>
            <option>POLTRONA</option>
            <option>PROJETOR MULTIMÍDIA (DATA SHOW)</option>
            <option>QUADRO DE AVISO</option>
            <option>RELÓGIO</option>
            <option>SCANNER</option>
            <option>SERVIDOR </option>
            <option>SOFA</option>
            <option>SWITCH</option>
            <option>TELA DE PROJEÇÃO RETRÁTIL</option>
            <option>TELEVISOR</option>
            <option>TRENA</option>
            <option>UNID. DE PROCESSAMENTO</option>
            <option>VENTILADOR</option>
            <option>Outros</option>
          </select> 

          <script>
                    var tipo = '<?php echo $tipo; ?>'; 
                    
                    switch (tipo){
                      case 'AMPLIFICADOR':
                        document.getElementById('tipo').value ="AMPLIFICADOR";
                        break;
                      case 'ANTENA PARABÓLICA':
                        document.getElementById('tipo').value ="ANTENA PARABÓLICA";
                        break;
                      case 'AP TELEFONICO DIGITAL':
                        document.getElementById('tipo').value ="AP TELEFONICO DIGITAL";
                        break;
                      case 'APARELHO FAX':
                        document.getElementById('tipo').value ="APARELHO FAX";break;
                      case 'AR CONDICIONADO':
                        document.getElementById('tipo').value ="AR CONDICIONADO";break;
                      case 'ARMARIO':
                        document.getElementById('tipo').value ="ARMARIO";break;
                      case 'ARQUIVO DESLIZANTE':
                        document.getElementById('tipo').value ="ARQUIVO DESLIZANTE";break;
                      case 'BALCAO':
                        document.getElementById('tipo').value ="BALCAO";break;
                      case 'BATERIA':
                        document.getElementById('tipo').value ="BATERIA";break;
                      case 'CADEIRA':
                        document.getElementById('tipo').value ="CADEIRA";break;
                      case 'CAIXAS DE SOM':
                        document.getElementById('tipo').value ="CAIXAS DE SOM";break;
                      case 'CALCULADORA':
                        document.getElementById('tipo').value ="CALCULADORA";break;
                      case 'CARRINHO PARA SUPERMERCADO':
                        document.getElementById('tipo').value ="CARRINHO PARA SUPERMERCADO";break;
                      case 'COMPRESSOR DE ÁUDIO COM DOIS CANAIS':
                        document.getElementById('tipo').value ="COMPRESSOR DE ÁUDIO COM DOIS CANAIS";break;
                      case 'ENCADERNADORA':
                        document.getElementById('tipo').value ="ENCADERNADORA";break;
                      case 'ESCADA DE ALUMÍNIO':
                        document.getElementById('tipo').value ="ESCADA DE ALUMÍNIO";break;
                      case 'ESMERILHADEIRA':
                        document.getElementById('tipo').value ="ESMERILHADEIRA";break;
                      case 'ESTABILIZADOR':
                        document.getElementById('tipo').value ="ESTABILIZADOR";break;
                      case 'ESTAÇÃO DE TRABALHO':
                        document.getElementById('tipo').value ="ESTAÇÃO DE TRABALHO";break;
                      case 'ESTANTE':
                        document.getElementById('tipo').value ="ESTANTE";break;
                      case 'FRAGMENTADORA DE PAPEL':
                        document.getElementById('tipo').value ="FRAGMENTADORA DE PAPEL";break;
                      case 'FREEZER':
                        document.getElementById('tipo').value ="FREEZER";break;
                      case 'FURADEIRA':
                        document.getElementById('tipo').value ="FURADEIRA";break;
                      case 'GAVETEIRO':
                        document.getElementById('tipo').value ="GAVETEIRO";break;
                      case 'GPS':
                        document.getElementById('tipo').value ="GPS";break;
                      case 'GUILHOTINA DE ESCRITÓRIO':
                        document.getElementById('tipo').value ="GUILHOTINA DE ESCRITÓRIO";break;
                      case 'HARD DISK':
                        document.getElementById('tipo').value ="HARD DISK";break;
                      case 'HORODATADOR PROTOCOLADOR':
                        document.getElementById('tipo').value ="HORODATADOR PROTOCOLADOR";break;
                      case 'IMPRESSORA':
                        document.getElementById('tipo').value ="IMPRESSORA";break;
                      case 'LIXADEIRA DE CINTA':
                        document.getElementById('tipo').value ="LIXADEIRA DE CINTA";break;
                      case 'LONGARINA':
                        document.getElementById('tipo').value ="LONGARINA";break;
                      case 'MAPA':
                        document.getElementById('tipo').value ="MAPA";break;
                      case 'MAQUINA FOTOGRAFICA / CÂMERA DIGITAL':
                        document.getElementById('tipo').value ="MAQUINA FOTOGRAFICA / CÂMERA DIGITAL";break;
                      case 'MARTELETE ROMPEDOR':
                        document.getElementById('tipo').value ="MARTELETE ROMPEDOR";break;
                      case 'MEDIDOR DE DISTÂNCIA':
                        document.getElementById('tipo').value ="MEDIDOR DE DISTÂNCIA";break;
                      case 'MEDUSA':
                        document.getElementById('tipo').value ="MEDUSA";break;
                      case 'MESA':
                        document.getElementById('tipo').value ="MESA";break;
                      case 'MESA DE SOM':
                        document.getElementById('tipo').value ="MESA DE SOM";break;
                      case 'MICROCOMPUTADOR':
                        document.getElementById('tipo').value ="MICROCOMPUTADOR";break;
                      case 'MICROFONES':
                        document.getElementById('tipo').value ="MICROFONES";break;
                      case 'MICRO-ONDAS':
                        document.getElementById('tipo').value ="MICRO-ONDAS";break;
                      case 'MINIGRAVADOR DIGITAL':
                        document.getElementById('tipo').value ="MINIGRAVADOR DIGITAL";break;
                      case 'MONITOR':
                        document.getElementById('tipo').value ="MONITOR";break;
                      case 'MORSA':
                        document.getElementById('tipo').value ="MORSA";break;
                      case 'NOBREAK':
                        document.getElementById('tipo').value ="NOBREAK";break;
                      case 'NOTEBOOK':
                        document.getElementById('tipo').value ="NOTEBOOK";break;
                      case 'PAINEL ELETRÔNICO':
                        document.getElementById('tipo').value ="PAINEL ELETRÔNICO";break;
                      case 'PEDESTAL':
                        document.getElementById('tipo').value ="PEDESTAL";break;
                      case 'PERSIANA':
                        document.getElementById('tipo').value ="PERSIANA";break;
                      case 'PLOTTER':
                        document.getElementById('tipo').value ="PLOTTER";break;
                      case 'POLTRONA':
                        document.getElementById('tipo').value ="POLTRONA";break;
                      case 'PROJETOR MULTIMÍDIA (DATA SHOW)':
                        document.getElementById('tipo').value ="PROJETOR MULTIMÍDIA (DATA SHOW)";break;
                      case 'QUADRO DE AVISO':
                        document.getElementById('tipo').value ="QUADRO DE AVISO";break;
                      case 'RELÓGIO':
                        document.getElementById('tipo').value ="RELÓGIO";break;
                      case 'SCANNER':
                        document.getElementById('tipo').value ="SCANNER";break;
                      case 'SERVIDOR':
                        document.getElementById('tipo').value ="SERVIDOR";break;
                      case 'SOFA':
                        document.getElementById('tipo').value ="SOFA";break;
                      case 'SWITCH':
                        document.getElementById('tipo').value ="SWITCH";break;
                      case 'TELA DE PROJEÇÃO RETRÁTIL':
                        document.getElementById('tipo').value ="TELA DE PROJEÇÃO RETRÁTIL";break;
                      case 'TELEVISOR':
                        document.getElementById('tipo').value ="TELEVISOR";break;
                      case 'TRENA':
                        document.getElementById('tipo').value ="TRENA";break;
                      case 'UNID. DE PROCESSAMENTO':
                        document.getElementById('tipo').value ="UNID. DE PROCESSAMENTO";break;
                      case 'VENTILADOR':
                        document.getElementById('tipo').value ="VENTILADOR";break;
                      case 'Outros':
                        document.getElementById('tipo').value ="Outros";break;
                    }  
                </script>


          </div>
         
		  </div>
        <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Marca:</label>
            <input type="text" class="form-control" id="marca" name="marca" required="required" value="<?php echo $linha['marca'] ?>" >
          </div>
          <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Modelo:</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required="required" value="<?php echo $linha['modelo'] ?>" >
          </div>    
        </div>          
        <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Número de Série:</label>
            <input type="text" class="form-control" id="numserie" name="numserie" required="required" value="<?php echo $linha['numserie'] ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Setor:</label>
            <input type="text" class="form-control" id="local" name="local" required="required" readonly value="<?php echo $linha['localizacao'] ?>" >
          </div>    
        </div>
        <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Nome do Servidor:</label>
            <input type="text" class="form-control" id="servidor" name="servidor" required="required" readonly value="<?php echo $linha['servidor'] ?>" >
          </div>
          <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">CIMBPM:</label>
            <input type="text" class="form-control" id="cimbpm" name="cimbpm" required="required" value="<?php echo $linha['cimbpm'] ?>" >
          </div>    
        </div> 
        <div class = "row"> 
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Número do Processo:</label>
            <input type="text" class="form-control" id="numprocesso" name="numprocesso" required="required"  value="<?php echo $linha['numprocesso'] ?>" >
          </div>
        <div class="col-md-6 mb-3">
           <label for="numprocesso" class="form-label">Nome do computador:</label>
           <input type="text" class="form-control" id="nomepc" name="nomepc"  value="<?php echo $linha['nome'] ?>" >
        </div>        
       </div>
       <div class = "row"> 
       <div class="col-md-6 mb-3">
			  <label for="codsbpm" class="form-label">Descrição PBPM:</label>
			  <input type="text" class="form-control" id="descsbpm" name="descsbpm" value="<?php echo $linha['descsbpm'] ?>" >
		  </div>  
        <div class="col-md-6 mb-3">
            <label for="numprocesso" class="form-label">Status:</label>
            <select class="form-select" id="statusitem" required name="statusitem"  value="<?php echo $linha['statusitem'] ?>" >
              <option>Ativo</option>  

              <option>Para Doação</option>
              <option>Para Descarte</option>
              <option>Doado</option>
              <option>Descartado</option>

              <script>
                    var statusitem = '<?php echo $statusitem; ?>'; 
                    
                    switch (statusitem){
                      case 'Ativo':
                        document.getElementById('statusitem').value = "Ativo";
                        break;
                      case 'Para Doação':
                        document.getElementById('statusitem').value = "Para Doação";
                        break;
                      case 'Para Descarte':
                        document.getElementById('statusitem').value = "Para Descarte";
                        break;
                      case 'Descartado':
                        document.getElementById('statusitem').value = "Descartado";
                        break;
                      case 'Doado':
                        document.getElementById('statusitem').value = "Doado";
                        break;

                    }  
                </script>

                
              </select>  
          </div>
          <div class="col-md-6 mb-3">
           
           <input type="hidden" class="form-control" id="id" name="id"  value="<?php echo $linha['iditem'] ?>" >
        </div>        
             
        
       </div>
        <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
                
        </div>
        </form>
    </div>
</div>

</body>

</html>
