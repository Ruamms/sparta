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

    <title>Login</title>
</head>

<body class="">

    <!-- menu-->
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



    <h2 style="margin-top:50px; text-align: center;">Recuperar senha</h2>
    <?php
if (!isset($_SESSION)) {
    session_start();
}

// Conectar ao banco de dados
$host = 'localhost';
$db = 'cadastro';
$user = 'root'; // Substitua pelo usuário do seu banco de dados
$pass = ''; // Substitua pela senha do seu banco de dados

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['data_selecionada']) && isset($_POST['telefone_selecionado']) && isset($_POST['cpf'])) {
        // Obter os dados do formulário
        $data_selecionada = $_POST['data_selecionada'];
        $telefone_selecionado = $_POST['telefone_selecionado'];
        $cpf = $_POST['cpf'];

        // Consultar o banco de dados para verificar se as informações do cliente estão corretas
        $sql_cliente = "SELECT * FROM cliente WHERE cpf = ? AND data_nasc = ? AND telefone = ?";
        $stmt_cliente = $conn->prepare($sql_cliente);

        if ($stmt_cliente) {
            // Vincular os parâmetros da consulta do cliente
            $stmt_cliente->bind_param("sss", $cpf, $data_selecionada, $telefone_selecionado);

            // Executar a consulta do cliente
            $stmt_cliente->execute();

            // Obter o resultado do cliente
            $result_cliente = $stmt_cliente->get_result();

            // Verificar se a consulta do cliente retornou algum resultado
            if ($result_cliente->num_rows > 0) {
                // Obter os detalhes do cliente
                $cliente = $result_cliente->fetch_assoc();
                $usuario_id = $cliente['usuario_id'];

                // Consultar a tabela de usuários para obter o e-mail
                $sql_usuario = "SELECT email FROM usuario WHERE usuario_id = ?";
                $stmt_usuario = $conn->prepare($sql_usuario);

                if ($stmt_usuario) {
                    // Vincular os parâmetros da consulta do usuário
                    $stmt_usuario->bind_param("i", $usuario_id);

                    // Executar a consulta do usuário
                    $stmt_usuario->execute();

                    // Obter o resultado do usuário
                    $result_usuario = $stmt_usuario->get_result();

                    // Verificar se a consulta do usuário retornou algum resultado
                    if ($result_usuario->num_rows > 0) {
                        // Obter o e-mail do usuário
                        $usuario = $result_usuario->fetch_assoc();
                        $email = $usuario['email'];

                        // Exibir formulário para inserir a nova senha
                        echo '<form class="container mt-4" style="max-width: 20rem;" method="post" action="atualizando-senha.php">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="' . htmlspecialchars($email) . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha:</label>
                            <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning w-100 mt-3">Alterar Senha</button>
                        </div>
                      </form>';
                    } else {
                        // Exibir mensagem de erro se não encontrar o usuário
                        echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
                        echo "Erro ao encontrar o usuário.";
                        echo '</div>';
                    }

                    // Fechar a instrução do usuário
                    $stmt_usuario->close();
                } else {
                    echo "Erro ao preparar a consulta do usuário: " . $conn->error;
                }
            } else {
                // Exibir mensagem de erro se as informações do cliente não corresponderem
                echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
                echo "As informações fornecidas não correspondem aos dados do cliente.";
                echo '</div>';
                echo '<div class="text-center mt-3">';
                echo '<a class="btn btn-warning" href="login.php">Tentar novamente</a>';
                echo '</div>';
            }

            // Fechar a instrução do cliente
            $stmt_cliente->close();
        } else {
            echo "Erro ao preparar a consulta do cliente: " . $conn->error;
        }
    } elseif (isset($_POST['nova_senha']) && isset($_POST['email']) && isset($_POST['cpf'])) {
        // Obter os dados do formulário para atualização da senha
        $nova_senha = $_POST['nova_senha'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];

        // Atualizar a senha na tabela usuario
        $sql_usuario = "UPDATE usuario SET senha = ? WHERE email = ?";
        $stmt_usuario = $conn->prepare($sql_usuario);

        if ($stmt_usuario) {
            // Vincular os parâmetros da consulta de atualização do usuário
            $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT); // Hash da nova senha
            $stmt_usuario->bind_param("ss", $nova_senha_hash, $email);

            // Executar a consulta de atualização do usuário
            if ($stmt_usuario->execute()) {
                // Exibir mensagem de sucesso
                echo '<div class="alert alert-success container text-center mt-5" role="alert">';
                echo "Senha atualizada com sucesso.";
                
                echo '</div>';
            } else {
                // Exibir mensagem de erro se a atualização falhar
                echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
                echo "Erro ao atualizar a senha.";
                echo '</div>';
            }

            // Fechar a instrução do usuário
            $stmt_usuario->close();
        } else {
            echo "Erro ao preparar a consulta de atualização do usuário: " . $conn->error;
        }
    } else {
        
    }
} else {
    // Exibir mensagem de erro se o formulário não foi submetido
    echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
    echo "Erro: O formulário não foi submetido.";
    echo '</div>';
}


// FUNCIONARIO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['matricula_selecionada']) && isset($_POST['cpf'])) {
        $matricula_selecionada = $_POST['matricula_selecionada'];
        $cpf = $_POST['cpf'];

       
        // Verificar a matrícula na tabela funcionario
        $sql_funcionario = "SELECT email FROM funcionario WHERE matricula = ? AND cpf = ?";
        $stmt_funcionario = $conn->prepare($sql_funcionario);

        if ($stmt_funcionario) {
            $stmt_funcionario->bind_param("ss", $matricula_selecionada, $cpf);
            $stmt_funcionario->execute();
            $result_funcionario = $stmt_funcionario->get_result();

            if ($result_funcionario->num_rows > 0) {
                $funcionario = $result_funcionario->fetch_assoc();
                $email = $funcionario['email'];

                // Exibir formulário para inserir a nova senha
                echo '<form class="container mt-4" style="max-width: 20rem;" method="post" action="atualizando-senha.php">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="' . htmlspecialchars($email) . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha:</label>
                            <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
                        </div>
                        <input type="hidden" name="cpf" value="' . htmlspecialchars($cpf) . '">
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning w-100 mt-3">Alterar Senha</button>
                        </div>
                      </form>';
            } else {
                echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
                echo "Matrícula ou CPF inválido.";
                echo '</div>';
            }

            $stmt_funcionario->close();
        } else {
            echo "Erro ao preparar a consulta do funcionário: " . $conn->error;
        }
    } else {
        echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
        echo "Por favor, selecione uma matrícula.";
        echo '</div>';
    }
} else {
    echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
    echo "Erro: O formulário não foi submetido.";
    echo '</div>';
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
?>


</body>

</html>