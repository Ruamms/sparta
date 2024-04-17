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
    <title>Editar Funcionario</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark p-1 box-shadow">
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
                        <h4><a class="nav-link text-warning" href="../usuario_adm/usuarios.php">Usuarios</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../produto/lista_produtos.php">Produtos </a></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../relatorio/relatorio.php">Relatorios</a></h4>
                    </li>

                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../usuario/login.php">Sair</a></h4>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
   

    <section class="container">
    <h2 class="m-3">Funcionario</h2>
    <?php
include 'conexao.php';

// Verifica se o ID do usuário foi recebido e é válido
if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];

    // Busca os dados do cliente com base no ID do usuário
    $query = "SELECT * FROM funcionario WHERE usuario_id = $usuario_id";
    $result = $conn->query($query);

    // Verifica se o cliente foi encontrado
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Preenche os campos do formulário com as informações do cliente
        $nome = $row['nome'];
        $matricula = $row['matricula'];
        $cpf = $row['cpf'];
        $cargo = $row['cargo'];
        $salario = $row['salario'];
        $data_contratacao = $row['data_contratacao'];
        $email = $row['email']; 
        $endereco = $row['endereco'];
        
        $nome = $row['nome'];
        
        // Agora você pode preencher os campos do formulário com essas variáveis
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do usuário inválido ou não fornecido.";
}

$conn->close();
?>
 <form action="salvar_edit_funcionario.php" method="post" class="m-3 container">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="matricula">Matrícula:</label>
            <input type="text" class="form-control" id="matricula" placeholder="Digite 5 digitos" name="matricula" pattern="\d{5}" title="Digite exatamente 5 números" value="<?php echo $matricula; ?>"required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite o CPF no formato 999.999.999-99"value="<?php echo $cpf; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="salario">Salário:</label>
            <input type="text" class="form-control" id="salario" name="salario" pattern="^\d{1,3}(\.\d{3})*(,\d{2})?$" title="Digite um valor válido  Ex: 5.000,00"value="<?php echo $salario; ?>" required>
        </div>
       
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cargo" >Cargo:</label>
            <select class="form-control" id="cargo" name="cargo" required>
                
                <option value="Gerente">Gerente</option>
                <option value="Coordenador">Coordenador</option>
                <option value="Analista">Analista</option>
                <option value="Assistente">Assistente</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email"pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Por favor, insira um endereço de e-mail válido" value="<?php echo $email; ?>" required>
        </div>
        
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="data_contratacao">Data de Contratação:</label>
            <input type="date" class="form-control" id="data_contratacao" name="data_contratacao" value="<?php echo $data_contratacao; ?>"required>
        </div>
        <div class="form-group col-md-6">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required placeholder="admin">
        </div>
       
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" id="endereco" name="endereco"value="<?php echo $endereco; ?>" required>
            </div>
   
        
    </div>
    <button type="submit" class="btn btn-warning w-100 mt-3">Enviar</button>
</form>
                 
    </section>

</body>

</html>