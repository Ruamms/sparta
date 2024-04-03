<?php
include 'conexao.php';

// Receber os dados do formulário
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$data_nasc = $_POST['data_nasc'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$numero_cartao =$_POST['numero_cartao'];

// Verificar se o e-mail já existe na tabela de usuários
$verificarEmail = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
$verificarEmail->bind_param("s", $email);
$verificarEmail->execute();
$resultEmail = $verificarEmail->get_result();

if ($resultEmail->num_rows > 0) {
    // O e-mail já existe
    echo '<div class="alert alert-danger my-5">';
    echo '<h2>E-mail já cadastrado. Por favor, escolha outro e-mail.</h2>';
    echo '</div>';
}else{
// Inserir dados na tabela "usuario"
$sqlUsuario = "INSERT INTO usuario (nome, email, senha, perfil) 
               VALUES (?, ?, ?, 'cliente')";
$stmtUsuario = $conn->prepare($sqlUsuario);

if ($stmtUsuario === false) {
    die("Erro na preparação da declaração de inserção do usuário: " . $conn->error);
}

// Bind parameters para a declaração de inserção do usuário
$stmtUsuario->bind_param("sss", $nome, $email, $senha);

if ($stmtUsuario->execute() === false) {
    die("Erro ao executar a declaração de inserção do usuário: " . $stmtUsuario->error);
}
}
// Obter o ID gerado automaticamente
$usuario_id = $stmtUsuario->insert_id;

// Fechar a declaração de inserção do usuário
$stmtUsuario->close();

// Inserir dados na tabela "cliente"
$sqlCliente = "INSERT INTO cliente (usuario_id, nome, endereco, telefone, data_nasc, cpf, email,numero_cartao) 
               VALUES (?, ?, ?, ?, ?, ?, ?,?)";
$stmtCliente = $conn->prepare($sqlCliente);

if ($stmtCliente === false) {
    die("Erro na preparação da declaração de inserção do cliente: " . $conn->error);
}

// Bind parameters para a declaração de inserção do cliente
$stmtCliente->bind_param("isssssss", $usuario_id, $nome, $endereco, $telefone, $data_nasc, $cpf, $email,$numero_cartao);

if ($stmtCliente->execute() === false) {
    die("Erro ao executar a declaração de inserção do cliente: " . $stmtCliente->error);
}

// Se chegou até aqui, os dados foram inseridos com sucesso
header('Location: login.php');

// Fechar a declaração de inserção do cliente
$stmtCliente->close();

// Fechar a conexão
$conn->close();
?>
