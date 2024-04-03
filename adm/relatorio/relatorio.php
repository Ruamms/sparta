<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

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
    <title>Relatorio</title>
</head>

<body class="">
    <!-- menu-->
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
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
                        <h4><a class="nav-link text-warning" href="../produto/lista_produtos.php">Produtos </a></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../usuario_adm/usuarios.php">Usuarios</a></h4>
                    </li>

                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../../usuario/login.php">Sair</a></h4>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="m-5 text-center">Relatorio /ADM</h1>

    <section>
        <div class="d-flex container aling-center">

            <div class="m-5 text-center ">
                <h2>Financeiro</h2>
                <form action="relatorio_valor.php" method="post">
                    <label class="font-weight-bold  m-3" for="dataInicial">Data Inicial:</label><br>
                    <input class="w-75" type="date" name="dataInicial" required><br>

                    <label class="font-weight-bold  m-3" for="dataFinal">Data Final:</label><br>
                    <input class="w-75" type="date" name="dataFinal" required><br>

                    <button class="m-3 btn btn-warning" type="submit" name="gerarPdf">Gerar PDF</button>
                    <button class=" m-3 btn btn-secondary" type="submit" name="exibirResultado">Gerar
                        Relatorio</button>
                </form>

            </div>
            <div class="m-5 text-center ">
                <h2>Cliente</h2>
                <form action="relatorio_cliente.php" method="post">
                    <label class="font-weight-bold  m-3" for="data_inicial">Data Inicial:</label><br>
                    <input class="w-75" type="date" id="data_inicial" name="data_inicial" required><br>

                    <label class="font-weight-bold  m-3" for="data_final">Data Final:</label><br>
                    <input class="w-75" type="date" id="data_final" name="data_final" required><br>
                    <input class="m-3 btn btn-warning" type="submit" name="gerar_pdf" value="Gerar PDF">
                    <input class=" m-3 btn btn-secondary" type="submit" value="Gerar Relatório">
                </form>
            </div>
            <div class="m-5 text-center ">
                <h2>Produto</h2>
                <form action="relatorio_Produto.php" method="post">
                    <label class="font-weight-bold  m-3" for="data_inicial">Data Inicial:</label><br>
                    <input class="w-75" type="date" name="data_inicial" required><br>
                    <label class="font-weight-bold  m-3"for="data_final">Data Final:</label><br>
                   <input class="w-75" type="date"name="data_final" required><br>
                   <button class="m-3 btn btn-warning" type="submit" name="gerarPDF">Gerar PDF</button>
                    <button class=" m-3 btn btn-secondary" type="submit" name="visualizarTela">Gerar Relaptorio </button>
                   
                     </form>
            </div>
        </div>
    </section>

</body>

</html>