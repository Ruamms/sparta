<?php
include 'conexao.php';

// Verifica se o parâmetro 'usuario_id' foi enviado via GET e se é um número válido
if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
    // Obtém o ID do usuário a ser excluído
    $id = $_GET['usuario_id'];

    // Verifica o perfil do usuário
    $selectProfileQuery = "SELECT perfil FROM usuario WHERE usuario_id = ?";
    $stmtProfile = $conn->prepare($selectProfileQuery);
    $stmtProfile->bind_param("i", $id);
    $stmtProfile->execute();
    $stmtProfile->bind_result($perfil);
    $stmtProfile->fetch();
    $stmtProfile->close();

    // Define a tabela a ser verificada com base no perfil do usuário
    $table = '';
    $emailColumn = '';
    $nameColumn = '';

    if ($perfil == 'cliente') {
        $table = 'cliente';
        $emailColumn = 'email';
        $nameColumn = 'nome';
    } elseif ($perfil == 'funcionario') {
        $table = 'funcionario';
        $emailColumn = 'email';
        $nameColumn = 'nome';
    }

    // Se a tabela foi definida, então procedemos com a exclusão
    if (!empty($table)) {
        // Verifica se o usuário está presente na tabela correspondente
        $checkQuery = "SELECT * FROM $table WHERE usuario_id = ?";
        $stmtCheck = $conn->prepare($checkQuery);
        $stmtCheck->bind_param("i", $id);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();

        // Se o usuário estiver na tabela, exclui o registro correspondente
        if ($result->num_rows > 0) {
            $deleteQuery = "DELETE FROM $table WHERE usuario_id = ?";
            $stmtDelete = $conn->prepare($deleteQuery);
            $stmtDelete->bind_param("i", $id);
            $stmtDelete->execute();
            $stmtDelete->close();
        }
    }

    // Exclui o usuário da tabela 'usuario'
    $deleteUserQuery = "DELETE FROM usuario WHERE usuario_id = ?";
    $stmtUser = $conn->prepare($deleteUserQuery);
    $stmtUser->bind_param("i", $id);

    // Executa a declaração preparada para excluir o usuário
    if ($stmtUser->execute()) {
        // Redireciona de volta para a lista de usuários após a exclusão bem-sucedida
        header('Location: usuarios.php');
        exit(); // Encerra o script após redirecionar
    } else {
        // Em caso de erro ao excluir usuário, exibe uma mensagem
        echo "Erro ao excluir usuário: " . $stmtUser->error;
    }

    // Fecha a declaração e a conexão
    $stmtUser->close();
    $stmtCheck->close();
} else {
    echo "ID inválido ou não fornecido na URL.";
}

// Fecha a conexão
$conn->close();
?>
