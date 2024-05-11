<?php
include '../../usuario/conexao.php';

// Verifica se o parâmetro 'usuario_id' foi enviado via GET e se é um número válido
if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
    // Obtém o ID do usuário a ser desbloqueado
    $id = $_GET['usuario_id'];

    // Define o novo status de bloqueio como 0 (desbloqueado)
    $novoStatusBloqueio = 0;

    // Atualiza o status de bloqueio na tabela 'usuario'
    $updateQuery = "UPDATE usuario SET bloqueado = ? WHERE usuario_id = ?";
    $stmtUpdate = $conn->prepare($updateQuery);
    $stmtUpdate->bind_param("ii", $novoStatusBloqueio, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    // Redireciona de volta para a página anterior após o desbloqueio bem-sucedido
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit(); // Encerra o script após redirecionar
} else {
    echo "ID inválido ou não fornecido na URL.";
}

// Fecha a conexão
$conn->close();
?>
