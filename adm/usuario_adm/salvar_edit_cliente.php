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

    <link rel="stylesheet" href="../../public/style.css">
    <title>Editar usuario</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
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
        session_start();
        include '../../usuario/conexao.php';

        if (isset($_SESSION['perfil']) and ($_SESSION['perfil'] === 'cliente')) {
            $email = $_SESSION['email'];

            $conn = new mysqli('localhost', 'root', '', 'cadastro');

            if ($conn->connect_error) {
                die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
            }

            // Verificar se o email existe na tabela de clientes
            $verificarEmail = $conn->prepare("SELECT * FROM cliente WHERE email = ?");
            $verificarEmail->bind_param("s", $email);
            $verificarEmail->execute();
            $resultEmail = $verificarEmail->get_result();
            // Fechar a declaração de verificação do email
            $verificarEmail->close();
            $cliente = $resultEmail->fetch_assoc();
            $usuario_id = $cliente['usuario_id'];
        } else if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
            $usuario_id = $_GET['usuario_id'];

            // Busca os dados do cliente com base no ID do usuário
            $query = "SELECT * FROM cliente WHERE usuario_id = $usuario_id";
            $result = $conn->query($query);
            // Verifica se o cliente foi encontrado
            if ($result->num_rows > 0) {
                $cliente = $result->fetch_assoc();
            }
        }

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recupera os dados do formulário e filtra-os
            $nome = isset($_POST['nome']) && !empty($_POST['nome']) ? $_POST['nome'] : $cliente['nome'];
            $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : $cliente['email'];
            $endereco = isset($_POST['endereco']) && !empty($_POST['endereco']) ? $_POST['endereco'] : $cliente['endereco'];
            $telefone = isset($_POST['telefone']) && !empty($_POST['telefone']) ? $_POST['telefone'] : $cliente['telefone'];
            $data_nasc = isset($_POST['data_nasc']) && !empty($_POST['data_nasc']) ? $_POST['data_nasc'] : $cliente['data_nasc'];
            $senha = $_POST['senha'];
            $cep = isset($_POST['cep']) && !empty($_POST['cep']) ? $_POST['cep'] : $cliente['cep'];
            $numero = isset($_POST['numero']) && !empty($_POST['numero']) ? $_POST['numero'] : $cliente['numero'];
            $cidade = isset($_POST['cidade']) && !empty($_POST['cidade']) ? $_POST['cidade'] : $cliente['cidade'];
            $estado = isset($_POST['estado']) && !empty($_POST['estado']) ? $_POST['estado'] : $cliente['estado'];
            $complemento = isset($_POST['complemento']) && !empty($_POST['complemento']) ? $_POST['complemento'] : $cliente['complemento'];
            $numero_cartao = isset($_POST['numero_cartao']) && !empty($_POST['numero_cartao']) ? $_POST['numero_cartao'] : $cliente['numero_cartao'];
            $cpf = $cliente['cpf'];

            // Verifica se o nome, email, senha e CPF foram fornecidos
            if (!empty($nome) && !empty($email)) {               

                // Verifica se o email foi alterado
                $query_email_original = "SELECT email FROM cliente WHERE usuario_id = $usuario_id";
                $result_email_original = $conn->query($query_email_original);

                if ($result_email_original) {
                    $row_email_original = $result_email_original->fetch_assoc();
                    $email_original = $row_email_original['email'];

                    if ($email != $email_original) {
                        // Verifica se o novo e-mail já está em uso por outro cliente ou usuário
                        $query_verifica_email_cliente = "SELECT COUNT(*) AS total FROM cliente WHERE email = '$email'";
                        $result_verifica_email_cliente = $conn->query($query_verifica_email_cliente);
                        $row_verifica_email_cliente = $result_verifica_email_cliente->fetch_assoc();
                        $total_clientes_com_email_cliente = $row_verifica_email_cliente['total'];

                        $query_verifica_email_usuario = "SELECT COUNT(*) AS total FROM usuario WHERE email = '$email'";
                        $result_verifica_email_usuario = $conn->query($query_verifica_email_usuario);
                        $row_verifica_email_usuario = $result_verifica_email_usuario->fetch_assoc();
                        $total_usuarios_com_email_usuario = $row_verifica_email_usuario['total'];

                        if ($total_clientes_com_email_cliente > 0 || $total_usuarios_com_email_usuario > 0) {
                            echo "O e-mail '$email' já está em uso por outro cliente ou usuário.";
                            exit; // Para a execução do script
                        }
                    }
                } else {
                    echo "Erro ao obter e-mail original: " . $conn->error;
                    exit;
                }

                // Atualiza os dados do cliente na tabela cliente                        
                $query_update_cliente = "UPDATE cliente SET nome='$nome', email='$email', cpf='$cpf',endereco='$endereco',telefone='$telefone',data_nasc='$data_nasc',numero_cartao='$numero_cartao', cep = '$cep', numero = '$numero', cidade = '$cidade',estado = '$estado', complemento = '$complemento' WHERE usuario_id=$usuario_id";
                if ($conn->query($query_update_cliente) === TRUE) {
                    // Atualiza os dados do usuário na tabela usuario 
                    if (empty($senha)) {
                        $query_update_usuario = "UPDATE usuario SET nome='$nome', email='$email' WHERE usuario_id=$usuario_id";
                    } else {
                        $query_update_usuario = "UPDATE usuario SET nome='$nome', email='$email', senha='$senha' WHERE usuario_id=$usuario_id";
                    }                                               
                    if ($conn->query($query_update_usuario) === TRUE) {
                        echo '<script>alert("Salvo com sucesso!");</script>'; // Mensagem de sucesso antes do redirecionamento
                        if ($_SESSION['perfil'] === 'cliente') {
                            echo '<script>setTimeout(function(){window.location.href="../../usuario/produtosWey.php";}, 1000);</script>'; // Redirecionamento com atraso de 1 segundo (1000 milissegundos)
                        } else if ($_SESSION['perfil'] === 'funcionario') {
                            echo '<script>setTimeout(function(){window.location.href="usuarios.php";}, 1000);</script>'; // Redirecionamento com atraso de 1 segundo (1000 milissegundos)
                        }
                        exit;
                    } else {
                        echo "Erro ao atualizar os dados do usuário: " . $conn->error;
                    }
                } else {
                    echo "Erro ao atualizar os dados do cliente: " . $conn->error;
                }
            } else {
                echo "O nome, email, senha e CPF não foram fornecidos.";
            }
        } else {
            echo "O formulário não foi enviado.";
        }
        $conn->close();
        ?>

    </section>

</body>

</html>