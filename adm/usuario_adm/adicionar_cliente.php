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
    <!--  ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!--  mascaras jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


    <link rel="stylesheet" href="../../public/style.css">
    <title>Adicionar usuario</title>
</head>

<body>

    <!-- menu-->
    <nav class="navbar navbar-expand-md navbar-light bg-dark p-2 box-shadow">
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
                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../usuario_adm/usuarios.php">
                                <i class="bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Usuarios"></i><br>
                                Usuarios</a>
                        </p>
                    </li>

                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../produto/lista_produtos.php">
                                <i class="bi-box" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Produtos"></i><br>
                                Produtos</a>
                        </p>
                    </li>
                    <!--Perfil-->
                    <li class="nav-item mr-5">

                        <p class="text-center"> <a class="nav-link text-warning" href="../relatorio/relatorio.php">

                                <i class="bi bi-clipboard2-data" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="relatorio"></i><br>
                                Relatorio</a></p>

                    </li>

                    <!-- sair-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning" href="../usuario_adm/login_adm.php">
                                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Sair"></i><br>
                                Sair</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <section class="container mt-3">
        <h2 class="m-2 ">Cliente</h2>
        <form action="salvar.php" class="container" method="post">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" required>
                </div>

                <input type="hidden" id="tipo_cliente" name="tipo_cliente" value="cliente">


                <div class="form-group col-md-6">
                    <label for="data_nasc">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>


                <div class="form-group col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">

                    <label for="cardNumber">Número do Cartão de Crédito:</label>
                    <input type="text" class="form-control " id="cardNumber" name="numero_cartao"
                        pattern="\d{4}.\d{4}.\d{4}.\d{4}"
                        title="Digite o número do cartão " required>

                </div>

                <div class="form-group col-md-6">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>

            </div>
            <button type="submit" class="btn btn-warning w-100 mt-3">Enviar</button>

        </form>
    </section>
    <script>
        $(document).ready(function () {
            $('#cpf').mask('000.000.000-00', { reverse: true });
        });
        $(document).ready(function () {
            $('#cardNumber').mask('0000.0000.0000.0000', { reverse: true });
        });
        $(document).ready(function () {
            $('#telefone').mask('00-00000-0000', { reverse: true });
        });
    </script>


</body>

</html>