<?php
include '../../usuario/conexao.php';

// Verifica se o parâmetro 'usuario_id' foi enviado via GET e se é um número válido
if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
    // Obtém o ID do usuário a ser bloqueado ou desbloqueado
    $id = $_GET['usuario_id'];

    // Consulta o status atual de bloqueio do usuário
    $checkBlockedQuery = "SELECT bloqueado FROM usuario WHERE usuario_id = ?";
    $stmtCheckBlocked = $conn->prepare($checkBlockedQuery);
    $stmtCheckBlocked->bind_param("i", $id);
    $stmtCheckBlocked->execute();
    $stmtCheckBlocked->bind_result($bloqueado);
    $stmtCheckBlocked->fetch();
    $stmtCheckBlocked->close();

    // Inverte o status de bloqueio do usuário
    $novoStatusBloqueio = $bloqueado == 1 ? 0 : 1;

    // Atualiza o status de bloqueio na tabela 'usuario'
    $updateQuery = "UPDATE usuario SET bloqueado = ? WHERE usuario_id = ?";
    $stmtUpdate = $conn->prepare($updateQuery);
    $stmtUpdate->bind_param("ii", $novoStatusBloqueio, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    // Redireciona de volta para a página anterior após o bloqueio/desbloqueio bem-sucedido
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit(); // Encerra o script após redirecionar
} else {
    echo "ID inválido ou não fornecido na URL.";
}

// Fecha a conexão
$conn->close();
?>
