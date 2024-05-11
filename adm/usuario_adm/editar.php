<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>sparta</title>
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
    <title>Editar Usuário</title>
</head>

<body>
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
                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../usuario_adm/usuarios.php">
                                <i class="bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Usuarios"></i><br>
                                Usuarios</a>
                        </p>
                    </li>

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
                        <p class="text-center"><a class="nav-link text-warning" href="../usuario_adm/login_adm.php">
                                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Sair"></i><br>
                                Sair</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
   

    <section class="container text-center mt-5 ">

    <?php
include '../../usuario/conexao.php';

// Verifica se o ID do usuário foi fornecido e é válido
if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];

    // Busca os dados do usuário pelo ID
    $query = "SELECT * FROM usuario WHERE usuario_id = $usuario_id";
    $result = $conn->query($query);

    // Verifica se o usuário foi encontrado
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $perfil = $row['perfil'];

        // Verifica o perfil do usuário e determina a URL de edição correspondente
        $edit_url = '';
        if ($perfil == 'cliente') {
            $edit_url = 'editar_cliente.php';
            echo ' <h1 class="text-center m-5">Editar Cliente ?</h1>';
        } elseif ($perfil == 'funcionario') {
            $edit_url = 'editar_funcionario.php';
            echo ' <h1 class="text-center m-5">Editar Funcionario ?</h1>';
        } else {
            echo "Perfil do usuário desconhecido.";
            exit(); // Termina o script se o perfil for desconhecido
        }

        // Exibe o botão "Editar" com a URL apropriada
        echo '<a class="btn  btn-success m-3" href="' . $edit_url . '?usuario_id=' . $usuario_id . '">Sim</a>';
        echo '<a class="btn  btn-danger m-3" href="../usuario_adm/usuarios.php">Nao</a>';
    } else {
        echo "ID do usuário inválido ou não encontrado.";
    }
} else {
    echo "ID do usuário inválido ou não fornecido.";
}

$conn->close();
?>

    </section>

</body>

</html>