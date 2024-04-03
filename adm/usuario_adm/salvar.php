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

    <link rel="stylesheet" href="../../public/style.css">
    <title>Adicionar usuario</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
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
                        <h4><a class="nav-link text-warning" href="../relatorio/relatorio.php">Relatorios</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../usuario_adm/usuarios.php">Usuarios</a></h4>
                    </li>

                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../../usuario/login.php">Sair</a></h4>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <section class="container mt-3">
    <?php
include 'conexao.php';

// Receber os dados do formulário
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$data_nasc = $_POST['data_nasc'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$numero_cartao =$_POST['numero_cartao'];

// Verificar se o e-mail já existe na tabela de usuários
$verificarEmail = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
$verificarEmail->bind_param("s", $email);
$verificarEmail->execute();
$resultEmail = $verificarEmail->get_result();

if ($resultEmail->num_rows > 0) {
    // O e-mail já existe
    echo '<div class="alert alert-danger my-5">';
    echo '<h2>E-mail já cadastrado. Por favor, escolha outro e-mail.</h2>';
    echo '</div>';
    
} else {
    // Inserir dados na tabela "usuario" usando declarações preparadas
    $sqlUsuario = "INSERT INTO usuario (nome, email, senha, perfil) 
                   VALUES (?, ?, ?, 'cliente')";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("sss", $nome, $email, $senha);

    if ($stmtUsuario->execute()) {
        // Obter o ID do usuário recém-inserido
        $usuario_id = $conn->insert_id;

        // Inserir dados na tabela "cliente"
        $sqlCliente = "INSERT INTO cliente (usuario_id, nome, endereco, telefone, data_nasc, cpf, email,numero_cartao) 
                       VALUES (?, ?, ?, ?, ?, ?, ?,?)";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->bind_param("isssssss", $usuario_id, $nome, $endereco, $telefone, $data_nasc, $cpf, $email,$numero_cartao);

        if ($stmtCliente->execute()) {
            header('Location: usuarios.php');
            exit();
        } else {
            echo '<div class="alert alert-danger my-5">';
            echo '<h2>Erro ao inserir dados do cliente: ' . $conn->error . '</h2>';
            echo '</div>';
        }
    } else {
        echo '<div class="alert alert-danger my-5">';
        echo '<h2>Erro ao inserir dados do usuário: ' . $conn->error . '</h2>';
        echo '</div>';
    }
}

// Fechar a conexão
$conn->close();
?>

    </section>

</body>

</html>