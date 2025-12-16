<?php
    require_once '../../config.php';

    $user = new User();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Principal - Administrador</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Área do Administrador</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="../admin/home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cup/cupsList.php">Copas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../match/gamesList.php">Jogos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Competidores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../user/profile.php">Conta</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-danger" href="../user/logout.php">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h2>Gerenciar Usuários</h2>
    <form>
        <input type="text">
    </form>
    <table class="table table-striped table-bordered">
        <tr>
            <td scope="col">Nome</td>
            <td scope="col">E-mail</td>
            <td scope="col">Data de Nascimento</td>
            <td scope="col">Role</td>
            <td scope="col">Ações</td>
        </tr>
    <?php 
        $data = $user->getData();
        if(count($data) > 0){
            for($i = 0; $i < count($data); $i++){
                echo "<tr>";
                foreach($data[$i] as $k => $v){
                    if($k != "id" && $k != "password"){
                        echo "<td>".$v."</td>";
                    }
                }
                echo "<td><a href=''>Editar</a><a href=''>Deletar</a></td>";
                echo "</tr>";
            }
            
        }
    ?>
    
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>