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
    <title>Adicionar Funcionario</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">
            
                <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
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
    <h1 class="mt-3 text-center">Cadastro Funcionario</h1>

    
    <section class="container mt-5">

    <form action="salvar_funcionario.php" method="post" class="mt-4 container">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group col-md-6">
            <label for="matricula">Matrícula:</label>
            <input type="text" class="form-control" id="matricula" name="matricula" pattern="\d{5}" title="Digite exatamente 5 números" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite o CPF no formato 999.999.999-99" required>
        </div>
       
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cargo">Cargo:</label>
            <select class="form-control" id="cargo" name="cargo" required>
                <option value="gerente">Gerente</option>
                <option value="coordenador">Coordenador</option>
                <option value="analista">Analista</option>
                <option value="assistente">Assistente</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="salario">Salário:</label>
            <input type="text" class="form-control" id="salario" name="salario" pattern="^\d{1,3}(\.\d{3})*(,\d{2})?$" title="Digite um valor numérico válido" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="data_contratacao">Data de Contratação:</label>
            <input type="date" class="form-control" id="data_contratacao" name="data_contratacao" required>
        </div>
        <div class="form-group col-md-6">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" id="endereco" name="endereco" required>
            </div>
   
        <div class="form-group col-md-6">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
    </div>
    <button type="submit" class="btn btn-warning w-100 mt-3">Enviar</button>
</form>

</section>

</body>

</html>