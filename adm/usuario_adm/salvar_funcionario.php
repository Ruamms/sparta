<?php
include 'conexao.php';

// Receber os dados do formulário
$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$cpf = $_POST['cpf'];
$cargo = $_POST['cargo'];
$salario = $_POST['salario'];
$data_contratacao = $_POST['data_contratacao'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$senha = $_POST['senha'];

// Verificar se o e-mail já existe na tabela de usuários
$verificarEmail = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
$verificarEmail->bind_param("s", $email);
$verificarEmail->execute();
$resultEmail = $verificarEmail->get_result();

if ($resultEmail->num_rows > 0) {
    // E-mail já existe na tabela
    echo "E-mail já existe na tabela.";
} else {
    // Verificar se o CPF já existe na tabela de funcionarios
    $verificarCpfFuncionario = $conn->prepare("SELECT cpf FROM funcionario WHERE cpf = ?");
    $verificarCpfFuncionario->bind_param("s", $cpf);
    $verificarCpfFuncionario->execute();
    $resultCpfFuncionario = $verificarCpfFuncionario->get_result();

    if ($resultCpfFuncionario->num_rows > 0) {
        // CPF já existe na tabela de funcionarios
        echo "CPF já existe na tabela de funcionarios.";
    } else {
        // Inserir dados na tabela "usuario" usando declarações preparadas
        $sqlUsuario = "INSERT INTO usuario (nome, email, senha, perfil) 
                       VALUES (?, ?, ?, 'funcionario')";
        $stmtUsuario = $conn->prepare($sqlUsuario);
        $stmtUsuario->bind_param("sss", $nome, $email, $senha);

        if ($stmtUsuario->execute()) {
            // Obter o ID do usuário recém-inserido
            $usuario_id = $stmtUsuario->insert_id;

            // Inserir dados na tabela "funcionario" usando declarações preparadas
            $sqlFuncionario = "INSERT INTO funcionario (usuario_id, nome, email, matricula, cpf, cargo, salario, endereco, data_contratacao) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtFuncionario = $conn->prepare($sqlFuncionario);
            $stmtFuncionario->bind_param("isssdssss", $usuario_id, $nome, $email, $matricula, $cpf, $cargo, $salario, $endereco, $data_contratacao);

            if ($stmtFuncionario->execute()) {
                header('Location: usuarios.php');
                exit();
            } else {
                echo "Erro ao inserir dados do funcionário: " . $stmtFuncionario->error;
            }
        } else {
            echo "Erro ao inserir dados do usuário: " . $stmtUsuario->error;
        }
    }
}

// Fechar a conexão
$conn->close();
?>
