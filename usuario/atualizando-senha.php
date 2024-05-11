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
                        <h3><a class="nav-link text-warning" href="login.php">Login</a></h3>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <?php
    if (!isset($_SESSION)) {
        session_start();
    }

    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar se todos os campos foram preenchidos
        if (isset($_POST['email']) && isset($_POST['nova_senha'])) {
            // Obter os dados do formulário
            $email = $_POST['email'];
            $nova_senha = $_POST['nova_senha'];

            // Conectar ao banco de dados
            $host = 'localhost';
            $db = 'cadastro';
            $user = 'root'; // Substitua pelo usuário do seu banco de dados
            $pass = ''; // Substitua pela senha do seu banco de dados

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die('Erro na conexão: ' . $conn->connect_error);
            }

            // Verificar se a nova senha é diferente da senha atual
            $sql = "SELECT senha FROM usuario WHERE email = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Vincular os parâmetros da consulta
                $stmt->bind_param("s", $email);

                // Executar a consulta
                $stmt->execute();

                // Obter o resultado
                $stmt->store_result();
                $stmt->bind_result($senha_atual);

                // Verificar se a consulta retornou algum resultado
                if ($stmt->num_rows > 0) {
                    $stmt->fetch();

                    // Verificar se a nova senha é diferente da senha atual
                    if (password_verify($nova_senha, $senha_atual)) {
                        echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
                        echo "A nova senha não pode ser igual à senha atual.";
                        echo '</div>';
                    } else {
                        // Atualizar a senha na tabela de usuários
                        $sql_update = "UPDATE usuario SET senha = ? WHERE email = ?";
                        $stmt_update = $conn->prepare($sql_update);

                        if ($stmt_update) {


                            // Vincular os parâmetros da atualização da senha
                            $stmt_update->bind_param("ss", $nova_senha, $email);

                            // Executar a atualização
                            if ($stmt_update->execute()) {
                                // Senha atualizada com sucesso
                                echo '<div class="alert alert-success container text-center mt-5" role="alert">';
                                echo "<h3>Senha atualizada com sucesso.</h3";
                                echo '</div>';
                            } else {
                                // Exibir mensagem de erro se a atualização falhar
                                echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
                                echo "Erro ao atualizar a senha: " . $stmt_update->error;
                                echo '</div>';
                            }

                            // Fechar a instrução
                            $stmt_update->close();
                        } else {
                            echo "Erro ao preparar a atualização da senha: " . $conn->error;
                        }
                    }
                } else {
                    echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
                    echo "Usuário não encontrado.";
                    echo '</div>';
                }

                // Fechar a instrução
                $stmt->close();
            } else {
                echo "Erro ao preparar a consulta: " . $conn->error;
            }

            // Fechar a conexão com o banco de dados
            $conn->close();
        } else {
            // Exibir mensagem de erro se algum campo estiver faltando
            echo "Por favor, preencha todos os campos.";
        }
    }
    ?>





</body>

</html>