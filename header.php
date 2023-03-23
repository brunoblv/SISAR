

<nav class="navbar navbar-expand-xxl navbar-dark bg-dark" aria-label="Seventh navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SisGB</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleXxl" aria-controls="navbarsExampleXxl" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleXxl">
        <ul class="navbar-nav me-auto mb-2 mb-xl-0">
        <li class="nav-item">
            <a class="nav-link" href="principal.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownXxl" data-bs-toggle="dropdown" aria-expanded="false">Controle de Bens</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownXxl">
              <li><a class="dropdown-item" href="adicionaritem.php">Cadastro de Bens</a></li>
              <li><a class="dropdown-item" href="transferir.php">Transferência</a></li>
              <li><a class="dropdown-item" href="listaritem.php">Lista de bens</a></li>
         
            </ul>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownXxl" data-bs-toggle="dropdown" aria-expanded="false">Consultar</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownXxl">
              
            </ul>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownXxl" data-bs-toggle="dropdown" aria-expanded="false">Relatórios</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownXxl">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>        
      </div>
      <li class="nav-item dropdown">
            <a class="deslogar" href="#" id="dropdownXxl" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['SesNome'];?></a>
            <ul class="dropdown-menu" aria-labelledby="dropdownXxl">
              <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
             
            </ul>       
    </div>
  </nav>

