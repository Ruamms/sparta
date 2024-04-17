<?php
session_start();

// Verifique se o usuário está logado
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // O usuário está logado, então exiba uma mensagem de boas-vindas com o nome
    echo '<h3>'  . $_SESSION['nome'] . '</h3>';
    
    // Faça uma consulta para obter o ID do usuário com base no nome de usuário
    $nome_usuario = $_SESSION['nome'];
    
    $host = 'localhost';
    $db = 'cadastro';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die('Erro na conexão: ' . $conn->connect_error);
    }

    // Consulta SQL para obter o ID do usuário
    $sql_id_usuario = "SELECT usuario_id FROM usuario WHERE nome = ?";
    
    // Preparar a instrução SQL
    $stmt_id_usuario = $conn->prepare($sql_id_usuario);

    if ($stmt_id_usuario) {
        // Vincular o valor da variável à instrução
        $stmt_id_usuario->bind_param("s", $nome_usuario);

        // Executar a consulta
        $stmt_id_usuario->execute();

        // Obter o resultado
        $result_id_usuario = $stmt_id_usuario->get_result();

        if ($result_id_usuario->num_rows > 0) {
            $row_id_usuario = $result_id_usuario->fetch_assoc();
            $id_usuario = $row_id_usuario['usuario_id'];

            // Armazene o ID do usuário em uma variável de sessão
            $_SESSION['id_usuario'] = $id_usuario;
            
            // Agora você tem o ID do usuário disponível em $_SESSION['id_usuario']
            
            // Fechar a instrução SQL
            $stmt_id_usuario->close();
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
?>
