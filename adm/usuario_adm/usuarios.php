<?php
include 'conexao.php';

$query = "SELECT * FROM usuario";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sparta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../public/style.css">
    <title>Usuarios</title>
</head>

<body class="">
    <!-- menu-->
    <nav class="navbar navbar-expand-md navbar-light bg-dark p-2 box-shadow">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <h4><a class="nav-link text-warning" href="../produto/lista_produtos.php">Produtos </a></h4>
                    </li>
                    <li class="nav-item">
                    <h4><a class="nav-link text-warning" href="../relatorio/relatorio.php">Relatorios</a></h4></li>

                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../../adm/usuario_adm/login_adm.php">Sair</a></h4>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
   
    
   


    <section class="container">
         <h2 class=" text-center mt-3">Usuarios</h2>
    
        <a class="btn btn-success mt-3 m-1 " href="adicionar_cliente.php">+ Cliente </a>
        <a class="btn btn-success mt-3 m-1" href="adicionar_funcionario.php">+ Funcionarios </a>
        <table class="table mt-3 m-1 table-striped table-hover table-bordered text-center ">
            <tr class="thead-dark ">
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Senha</th>
                <th>Perfil</th>
               
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="align-middle">
                        <?php echo $row['usuario_id']; ?>
                    </td>
                    <td class="align-middle">
                        <?php echo $row['nome']; ?>
                    </td>
                    <td class="align-middle">
                        <?php echo $row['email']; ?>
                    </td>
                    <td class="align-middle">
                        <?php echo $row['senha']; ?>
                    </td>
                    <td class="align-middle">
                        <?php echo $row['perfil']; ?>
                    </td>
                    
                   
                    <td>
                        <a class="btn w-75 btn-success mt-1"
                            href="editar.php?usuario_id=<?php echo $row['usuario_id']; ?>">Editar</a>
                        <a class="btn w-75 btn-danger mt-1"
                            href="excluir.php?usuario_id=<?php echo $row['usuario_id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <div class="dropdown-divider mt-5"></div>
       
    </section>
</body>

</html>