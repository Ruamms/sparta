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
    <title>Adicionar usuario</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">

            <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <h3><a class="nav-link text-warning" href="../index.php">Inicio</a></h3>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
include 'conexao.php';

// Verificar se o CPF foi enviado via POST
if(isset($_SESSION['cliente']['cpf'])) {
    $cpf = $_SESSION['cliente']['cpf'];
    
    // Verificar se o CPF existe na tabela de clientes
    $verificarCPF = $conn->prepare("SELECT * FROM cliente WHERE cpf = ?");
    $verificarCPF->bind_param("s", $cpf);
    $verificarCPF->execute();
    $resultCPF = $verificarCPF->get_result();
    
    if ($resultCPF->num_rows > 0) {
        // CPF existe, então recuperamos os dados do cliente
        $cliente = $resultCPF->fetch_assoc();
        
        // Receber os dados do formulário
        $nome = $_POST['nome'] ?? $cliente['nome'];
        $endereco = $_POST['endereco'] ?? $cliente['endereco'];
        $telefone = $_POST['telefone'] ?? $cliente['telefone'];
        $data_nasc = $_POST['data_nasc'] ?? $cliente['data_nasc'];
        $senha = $_POST['senha'] ?? $cliente['senha'];
        $cep = $_POST['cep'] ?? $cliente['cep'];
        $numero = $_POST['numero'] ?? $cliente['numero'];
        $cidade = $_POST['cidade'] ?? $cliente['cidade'];
        $estado = $_POST['estado'] ?? $cliente['estado'];
        $complemento = $_POST['complemento'] ?? $cliente['complemento'];
        $numero_cartao = isset($_POST['numero_cartao']) ? $_POST['numero_cartao'] : $cliente['numero_cartao'];

        // Realizar o update
        $sqlUpdate = "UPDATE cliente SET nome=?, endereco=?, telefone=?, data_nasc=?, email=?, senha=?, cep=?, numero=?, cidade=?, estado=?, complemento=?, numero_cartao=? WHERE cpf=?";
        $stmtUpdate = $conn->prepare($sqlUpdate);

        if ($stmtUpdate === false) {
            die("Erro na preparação da declaração de update do cliente: " . $conn->error);
        }

        // Bind parameters para a declaração de update do cliente
        $stmtUpdate->bind_param("sssssssssssss", $nome, $endereco, $telefone, $data_nasc, $email, $senha, $cep, $numero, $cidade, $estado, $complemento, $numero_cartao, $cpf);

        if ($stmtUpdate->execute() === false) {
            die("Erro ao executar a declaração de update do cliente: " . $stmtUpdate->error);
        }

        // Se chegou até aqui, o update foi realizado com sucesso
        echo '<div class="container text-center">';
        echo '<div class="alert alert-success my-5">';
        echo '<h3 class="text-center">Dados atualizados com sucesso!</h3>';
        echo '</div>';
        echo '</div>';

        // Fechar a declaração de update do cliente
        $stmtUpdate->close();
    } else {
        // CPF não encontrado na tabela de clientes
        echo '<div class="container text-center">';
        echo '<div class="alert alert-danger my-5">';
        echo '<h3 class="text-center">CPF não encontrado. Por favor, verifique o CPF informado.</h3>';
        echo '</div>';
        echo '</div>';
    }

    // Fechar a declaração de verificação do CPF
    $verificarCPF->close();
}

// Fechar a conexão
$conn->close();
?>


</body>

</html>