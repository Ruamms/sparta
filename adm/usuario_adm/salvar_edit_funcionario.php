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


// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário e filtra-os
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
    $salario = mysqli_real_escape_string($conn, $_POST['salario']);
    $cargo = mysqli_real_escape_string($conn, $_POST['cargo']);
    $data_contratacao = mysqli_real_escape_string($conn, $_POST['data_contratacao']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);

    // Verifica se o nome, email, senha e CPF foram fornecidos
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($cpf)) {
        // Verifica se o usuário ID foi fornecido
        if (isset($_POST['usuario_id'])) {
            $usuario_id = $_POST['usuario_id'];

            // Verifica se o CPF foi alterado
            $query_cpf_original = "SELECT cpf FROM funcionario WHERE usuario_id = $usuario_id";
            $result_cpf_original = $conn->query($query_cpf_original);

            if ($result_cpf_original) {
                $row_cpf_original = $result_cpf_original->fetch_assoc();
                $cpf_original = $row_cpf_original['cpf'];

                // Verifica se o CPF foi alterado
                if ($cpf != $cpf_original) {
                    // Verifica se o CPF está em uso por outro cliente
                    $query_verifica_cpf_cliente = "SELECT COUNT(*) AS total FROM cliente WHERE cpf = '$cpf'";
                    $result_verifica_cpf_cliente = $conn->query($query_verifica_cpf_cliente);

                    if ($result_verifica_cpf_cliente) {
                        $row_verifica_cpf_cliente = $result_verifica_cpf_cliente->fetch_assoc();
                        $total_clientes_com_cpf = $row_verifica_cpf_cliente['total'];

                        if ($total_clientes_com_cpf > 0) {
                            echo "O CPF '$cpf' já está em uso por outro cliente.";
                            exit; // Para a execução do script
                        }
                    } else {
                        echo "Erro ao verificar CPF: " . $conn->error;
                        exit;
                    }
                }
            } else {
                echo "Erro ao obter CPF original: " . $conn->error;
                exit;
            }
            

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
            $query_update_cliente = "UPDATE cliente SET nome='$nome', email='$email', cpf='$cpf' WHERE usuario_id=$usuario_id";
            if ($conn->query($query_update_cliente) === TRUE) {
                // Atualiza os dados do usuário na tabela usuario
                $query_update_usuario = "UPDATE usuario SET nome='$nome', email='$email', senha='$senha' WHERE usuario_id=$usuario_id";
                if ($conn->query($query_update_usuario) === TRUE) {
                    header('Location: usuarios.php');
                    exit;
                } else {
                    echo "Erro ao atualizar os dados do usuário: " . $conn->error;
                }
            } else {
                echo "Erro ao atualizar os dados do cliente: " . $conn->error;
            }
        } else {
            echo "ID do usuário não foi fornecido.";
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