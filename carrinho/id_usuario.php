<?php
session_start();

// Verificar se o usuário está logado
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // O usuário está logado

    // Obter o ID do usuário da sessão
    $id_usuario = $_SESSION['id_usuario'];

    // Conectar ao banco de dados
    $host = 'localhost';
    $db = 'cadastro';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die('Erro na conexão: ' . $conn->connect_error);
    }

    // Consulta SQL para obter o perfil do usuário
    $sql_perfil = "SELECT perfil FROM usuario WHERE usuario_id = ?";
    $stmt_perfil = $conn->prepare($sql_perfil);

    if ($stmt_perfil) {
        // Vincular o valor da variável à instrução
        $stmt_perfil->bind_param("i", $id_usuario);

        // Executar a consulta
        $stmt_perfil->execute();

        // Obter o resultado
        $result_perfil = $stmt_perfil->get_result();

        if ($result_perfil->num_rows > 0) {
            $row_perfil = $result_perfil->fetch_assoc();
            $perfil_usuario = $row_perfil['perfil'];

            // Verificar se o perfil é "cliente"
            if ($perfil_usuario == "cliente") {
                // Consulta SQL para obter as informações do cliente
                $sql_cliente_info = "SELECT nome, email, endereco, telefone, data_nasc, cep, numero, cidade, estado, complemento FROM cliente WHERE usuario_id = ?";
                $stmt_cliente_info = $conn->prepare($sql_cliente_info);

                if ($stmt_cliente_info) {
                    // Vincular o valor da variável à instrução
                    $stmt_cliente_info->bind_param("i", $id_usuario);

                    // Executar a consulta
                    $stmt_cliente_info->execute();

                    // Obter o resultado
                    $result_cliente_info = $stmt_cliente_info->get_result();

                    if ($result_cliente_info->num_rows > 0) {
                        $row_cliente_info = $result_cliente_info->fetch_assoc();

                        // Armazenar as informações do cliente em variáveis de sessão
                        $_SESSION['id_usuario'] = $id_usuario;
                        $_SESSION['nome_usuario'] = $row_cliente_info['nome'];
                        $_SESSION['email_usuario'] = $row_cliente_info['email'];
                        $_SESSION['endereco_usuario'] = $row_cliente_info['endereco'];
                        $_SESSION['telefone_usuario'] = $row_cliente_info['telefone'];
                        $_SESSION['data_nasc_usuario'] = $row_cliente_info['data_nasc'];
                        $_SESSION['cep_usuario'] = $row_cliente_info['cep'];
                        $_SESSION['numero_usuario'] = $row_cliente_info['numero'];
                        $_SESSION['cidade_usuario'] = $row_cliente_info['cidade'];
                        $_SESSION['estado_usuario'] = $row_cliente_info['estado'];
                        $_SESSION['complemento_usuario'] = $row_cliente_info['complemento'];

                        // Fechar a instrução e liberar recursos
                        $stmt_cliente_info->close();
                    } else {
                        echo "Informações do cliente não encontradas.";
                    }
                } else {
                    echo "Erro ao preparar a consulta de informações do cliente: " . $conn->error;
                }
            } else {
                echo "O usuário não é um cliente.";
            }
        } else {
            echo "Perfil do usuário não encontrado.";
        }

        // Fechar a instrução e liberar recursos
        $stmt_perfil->close();
    } else {
        echo "Erro ao preparar a consulta de perfil do usuário: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    // O usuário não está logado, redirecioná-lo para a página de login
    header('Location: login.php');
    exit; // Certifique-se de que o script pare de ser executado após a redireção
}
?> 
