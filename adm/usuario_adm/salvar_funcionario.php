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
    <!--  mascaras jquery -->

    <link rel="stylesheet" href="../../public/style.css">
    <title>Produtos</title>
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
<section class="text-center container">
<?php
include 'conexao.php';

// Receber os dados do formulário
$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$cpf = $_POST['cpf'];
$cargo = $_POST['cargo'];
$salario = $_POST['salario'];
$data_contratacao = $_POST['data_contratacao'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$senha = $_POST['senha'];

// Verificar se o e-mail já existe na tabela de usuários
$verificarEmail = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
$verificarEmail->bind_param("s", $email);
$verificarEmail->execute();
$resultEmail = $verificarEmail->get_result();

if ($resultEmail->num_rows > 0) {
    // E-mail já existe na tabela
    echo '<div class="alert alert-danger my-5">';
    echo '<h3 class="text-center">E-mail já cadastrado. Por favor, escolha outro e-mail.</h3>';
    echo '</div>';
    echo ' <a class="btn text-center btn-warning mt-2" href="adicionar_funcionario.php">Voltar </a>';
} else {
    // Verificar se o CPF já existe na tabela de funcionarios
    $verificarCpfFuncionario = $conn->prepare("SELECT cpf FROM funcionario WHERE cpf = ?");
    $verificarCpfFuncionario->bind_param("s", $cpf);
    $verificarCpfFuncionario->execute();
    $resultCpfFuncionario = $verificarCpfFuncionario->get_result();

    if ($resultCpfFuncionario->num_rows > 0) {
        // CPF já existe na tabela de funcionarios
        echo '<div class="alert alert-danger my-5">';
        echo '<h3 class="text-center">Cpf ja existe.</h3>';
        echo '</div>';
    } else {
        // Inserir dados na tabela "usuario" usando declarações preparadas
        $sqlUsuario = "INSERT INTO usuario (nome, email, senha, perfil) 
                       VALUES (?, ?, ?, 'funcionario')";
        $stmtUsuario = $conn->prepare($sqlUsuario);
        $stmtUsuario->bind_param("sss", $nome, $email, $senha);

        if ($stmtUsuario->execute()) {
            // Obter o ID do usuário recém-inserido
            $usuario_id = $stmtUsuario->insert_id;

            // Inserir dados na tabela "funcionario" usando declarações preparadas
            $sqlFuncionario = "INSERT INTO funcionario (usuario_id, nome, email, matricula, cpf, cargo, salario, endereco, data_contratacao) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtFuncionario = $conn->prepare($sqlFuncionario);
            $stmtFuncionario->bind_param("isssdssss", $usuario_id, $nome, $email, $matricula, $cpf, $cargo, $salario, $endereco, $data_contratacao);

            if ($stmtFuncionario->execute()) {
                header('Location: usuarios.php');
                exit();
            } else {
                echo "Erro ao inserir dados do funcionário: " . $stmtFuncionario->error;
            }
        } else {
            echo "Erro ao inserir dados do usuário: " . $stmtUsuario->error;
        }
    }
}

// Fechar a conexão
$conn->close();
?></section>
</body>