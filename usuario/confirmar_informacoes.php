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
        // Verificar se todos os campos foram preenchidos
        if (isset($_POST['data_selecionada']) && isset($_POST['telefone_selecionado']) && isset($_POST['cpf'])) {
            // Obter os dados do formulário
            $data_selecionada = $_POST['data_selecionada'];
            $telefone_selecionado = $_POST['telefone_selecionado'];
            $cpf = $_POST['cpf'];

            // Consultar o banco de dados para verificar se as informações estão corretas
            $sql_cliente = "SELECT * FROM cliente WHERE cpf = ? AND data_nasc = ? AND (telefone = ? OR telefone = ? OR telefone = ?)";
            $stmt_cliente = $conn->prepare($sql_cliente);

            if ($stmt_cliente) {
                // Vincular os parâmetros da consulta do cliente
                $stmt_cliente->bind_param("sssss", $cpf, $data_selecionada, $telefone_selecionado, $telefone_selecionado, $telefone_selecionado);

                // Executar a consulta do cliente
                $stmt_cliente->execute();

                // Obter o resultado do cliente
                $result_cliente = $stmt_cliente->get_result();

                // Verificar se a consulta do cliente retornou algum resultado
                if ($result_cliente->num_rows > 0) {
                    // Obter os detalhes do cliente
                    $cliente = $result_cliente->fetch_assoc();
                    $usuario_id = $cliente['usuario_id'];

                    // Consultar a tabela de usuários para obter o e-mail e senha
                    $sql_usuario = "SELECT email, senha FROM usuario WHERE usuario_id = ?";
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
                            // Exibir mensagem de sucesso e mostrar e-mail e senha
                            $usuario = $result_usuario->fetch_assoc();
                            echo '<div class="alert alert-success container text-center mt-5" role="alert">';
                            echo "Cliente encontrado. Email: " . $usuario['email'];
                            echo '</div>';
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
                    // Exibir mensagem de erro se as informações do cliente não correspondem
                    echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
                    echo "As informações fornecidas não correspondem aos dados do cliente.";
                    echo '</div>';
                    echo '<div class="text-center mt-3">';
                    echo '<a class="btn  btn-warning " href="login.php""> Tentar novamente</a>';
                    echo '</div>';
                }

                // Fechar a instrução do cliente
                $stmt_cliente->close();
            } else {
                echo "Erro ao preparar a consulta do cliente: " . $conn->error;
            }
        } else {
            // Exibir mensagem de erro se algum campo estiver faltando
            echo "Por favor, preencha todos os campos.";
        }
    } else {
        // Exibir mensagem de erro se o formulário não foi submetido
        echo "Erro: O formulário não foi submetido.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>



    <div class="container">

        <form class="container mt-4" style="max-width: 20rem;" method="post" action="atualizando-senha.php">
            <div class="form-group ">
                <div class="form-group ">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" readonly>
                </div>
                <div class="form-group ">
                    <label for="nova_senha">Nova Senha:</label>
                    <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
                </div>
                <div class="text-center ">
                    <button type="submit" class="btn btn-warning w-100 mt-3">Alterar Senha</button>
                </div>
            </div>
        </form>

    </div>

</body>

</html>