<?php
if (!isset($_SESSION)) {
    session_start();
}

// Verifique se o usuário está logado
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

    // Faça uma consulta para obter o ID do usuário com base no nome de usuário
    $usuario_id = $_SESSION['usuario_id'];

    $host = 'localhost';
    $db = 'cadastro';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die('Erro na conexão: ' . $conn->connect_error);
    }

    // Consulta SQL para obter o ID do usuário
    $sql = "SELECT nome, email FROM usuario WHERE usuario_id = ?";

    // Preparar a instrução SQL
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular o valor da variável à instrução
        $stmt->bind_param("s", $usuario_id);

        // Executar a consulta
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Armazene o ID do usuário em uma variável de sessão
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['email'] = $row['email'];

            // Agora você tem o ID do usuário disponível em $_SESSION['id_usuario']

            // Fechar a instrução SQL
            $stmt->close();

            // O usuário está logado, então exiba uma mensagem de boas-vindas com o nome
            echo '<h3>'  . $_SESSION['nome'] . '</h3>';
        } else {
            echo "ID de usuário não encontrado.";
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    } else {
        echo "Erro ao preparar a consulta de ID de usuário: " . $conn->error;
    }
} else {
    // O usuário não está logado, redirecione-o para a página de login
    header('Location: login.php');
    exit; // Certifique-se de que o script pare de ser executado após a redireção
}
