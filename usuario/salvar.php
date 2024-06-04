<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>sparta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../public/style.css">
    <title>Adicionar usuario</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">

            <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <h3><a class="nav-link text-warning" href="../index.php">Inicio</a></h3>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    include 'conexao.php';

    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $data_nasc = $_POST['data_nasc'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'],PASSWORD_DEFAULT);
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $complemento = $_POST['complemento'];
    $numero_cartao = isset($_POST['numero_cartao']) ? $_POST['numero_cartao'] : ''; 

    // Verificar se o e-mail já existe na tabela de usuários
    $verificarEmail = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
    $verificarEmail->bind_param("s", $email);
    $verificarEmail->execute();
    $resultEmail = $verificarEmail->get_result();

    if ($resultEmail->num_rows > 0) {
        // O e-mail já existe
        echo '<div class="container text-center">';
        echo '<div class="alert alert-danger my-5">';
        echo '<h3 class="text-center">E-mail já cadastrado. Por favor, escolha outro e-mail.</h3>';
        echo '</div>';
        echo '<a class="btn btn-warning  text-center" href="adicionar.php"">Voltar</a>';
        echo '</div>';
    } else {
        // Verificar se o CPF já existe na tabela de clientes
        $verificarCPF = $conn->prepare("SELECT * FROM cliente WHERE cpf = ?");
        $verificarCPF->bind_param("s", $cpf);
        $verificarCPF->execute();
        $resultCPF = $verificarCPF->get_result();

        if ($resultCPF->num_rows > 0) {
            // O CPF já existe
            echo '<div class="container text-center">';
            echo '<div class="alert alert-danger my-5">';
            echo '<h3 class="text-center">CPF já cadastrado. Por favor, escolha outro CPF.</h3>';
            echo '</div>';
            echo '<a class="btn btn-warning  text-center" href="adicionar.php"">Voltar</a>';
            echo '</div>';
        } else {
            // Inserir dados na tabela "usuario"
            $sqlUsuario = "INSERT INTO usuario (nome, email, senha, perfil) VALUES (?, ?, ?, 'cliente')";
            $stmtUsuario = $conn->prepare($sqlUsuario);

            if ($stmtUsuario === false) {
                die("Erro na preparação da declaração de inserção do usuário: " . $conn->error);
            }

            // Bind parameters para a declaração de inserção do usuário
            $stmtUsuario->bind_param("sss", $nome, $email, $senha);

            if ($stmtUsuario->execute() === false) {
                die("Erro ao executar a declaração de inserção do usuário: " . $stmtUsuario->error);
            }

            // Obter o ID gerado automaticamente
            $usuario_id = $stmtUsuario->insert_id;

            // Fechar a declaração de inserção do usuário
            $stmtUsuario->close();

            // Inserir dados na tabela "cliente"
            $sqlCliente = "INSERT INTO cliente (usuario_id, nome, endereco, telefone, data_nasc, cpf, email, cep, numero, cidade, estado, complemento, numero_cartao) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtCliente = $conn->prepare($sqlCliente);

            if ($stmtCliente === false) {
                die("Erro na preparação da declaração de inserção do cliente: " . $conn->error);
            }

            // Bind parameters para a declaração de inserção do cliente
            $stmtCliente->bind_param("issssssssssss", $usuario_id, $nome, $endereco, $telefone, $data_nasc, $cpf, $email, $cep, $numero, $cidade, $estado, $complemento, $numero_cartao);
            
            if ($stmtCliente->execute() === false) {
                die("Erro ao executar a declaração de inserção do cliente: " . $stmtCliente->error);
            }

            // Se chegou até aqui, os dados foram inseridos com sucesso
            header('Location: login.php');

            // Fechar a declaração de inserção do cliente
            $stmtCliente->close();
        }
    }

    // Fechar a conexão
    $conn->close();
    ?>


</body>

</html>