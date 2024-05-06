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
    <!--  ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../../public/style.css">
    <title>Usuarios</title>
</head>

<body>
    <!-- menu-->
    <nav class="navbar navbar-expand-md navbar-light bg-dark box-shadow">
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

                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../produto/lista_produtos.php">
                                <i class="bi-box" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Produtos"></i><br>
                                Produtos</a>
                        </p>
                    </li>
                    <!--Perfil-->
                    <li class="nav-item mr-5">

                        <p class="text-center"> <a class="nav-link text-warning" href="../relatorio/relatorio.php">

                                <i class="bi bi-clipboard2-data" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="relatorio"></i><br>
                                Relatorio</a></p>

                    </li>

                    <!-- sair-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning" href="../../index.php">
                                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Sair"></i><br>
                                Sair</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>





    <section class="container">
        <h3 class=" m-3">Usuarios Cadastrados</h3>
        <div class="d-flex">
            <div class="m-2">
                <p><a class="btn btn-success mt-3 m-1 w-100" href="adicionar_cliente.php"><i
                            class="bi bi-person-fill-add" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Cliente"></i><br>
                        Adicionar Cliente</a></p>
            </div>
            <div class="m-2">

                <p><a class="btn btn-success mt-3 m-1 w-100" href="adicionar_funcionario.php"><i
                            class="bi bi-person-fill-add" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Funcionario"></i><br>
                        Adicionar Funcionario</a></p>
            </div>
        </div>
        <table class="table mt-3 m-1 table-striped table-hover table-bordered text-center ">
            <tr class="thead-dark ">
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>

                <th>Perfil</th>

                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td class="align-middle">
            <?php echo $row['usuario_id']; ?>
        </td>
        <td class="align-middle">
            <?php echo ucfirst($row['nome']); ?>
        </td>
        <td class="align-middle">
            <?php echo $row['email']; ?>
        </td>
        <td class="align-middle">
            <?php echo ucfirst($row['perfil']); ?>
        </td>
        <td>
            <?php if ($row['bloqueado'] == 0): ?>
                
                <a class="btn w-75 btn-danger mt-1"
                    href="bloquear.php?usuario_id=<?php echo $row['usuario_id']; ?>">Bloquear</a>
                    <a class="btn w-75 btn-success mt-1"
                href="editar_cliente.php?usuario_id=<?php echo $row['usuario_id']; ?>">Editar</a>
            <?php else: ?>
               
                    <a class="btn w-75 btn-warning mt-1"
                    href="desbloquear.php?usuario_id=<?php echo $row['usuario_id']; ?>">Desbloquear</a>
            <?php endif; ?>
            
        </td>
    </tr>
<?php endwhile; ?>


        </table>
        <div class="dropdown-divider mt-5"></div>

    </section>
</body>

</html>