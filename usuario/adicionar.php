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

    <link rel="stylesheet" href="../public/style.css">
    <title>Adicionar usuario</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">

            <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />

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
    <h1 class="mt-3 text-center">Cadastro</h1>


    <section class="container mt-3">
        <form action="salvar.php" class="container" method="post">
            <div class="d-flex justify-content-center ">

                <div class="form-group m-3">
                    <div class="form-group ">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group ">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" required>
                    </div>
                    <div class="form-group ">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" required>
                    </div>
                    <input type="hidden" id="tipo_cliente" name="tipo_cliente" value="cliente">
                    <div class="form-group ">
                        <label for="data_nasc">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
                    </div>
                </div>
               
                <div class="form-group m-3">

                    <div class="form-group ">
                        <label for="cardNumber">Número do Cartão de Crédito:</label>
                        <input type="text" class="form-control " id="cardNumber" name="numero_cartao"
                            pattern="\d{4}.\d{4}.\d{4}.\d{4}"
                            title="Digite o número do cartão no formato 0000.0000.0000.0000" required>
                    </div>
                    <div class="form-group ">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                            title="Digite o CPF no formato 999.999.999-99" required>
                    </div>
                    <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Por favor, insira um endereço de e-mail válido" required>
</div>

                    <div class="form-group ">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                </div>
            </div>

            <div class="text-center m-3">
            <button type="submit" class="btn w-25 btn-warning ">Finalizar Cadastro</button>
            </div>
        </form>
    </section>

</body>

</html>