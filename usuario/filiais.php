<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>sparta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
    <!-- mascaras jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <link rel="stylesheet" href="../public/style.css">
    <title>Perfil</title>
</head>

<body>
    <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-1 box-shadow">
        <div class="container">

            <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <!-- relatorio de compra-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning"
                                href="../carrinho/relatorio/relatorio_compra.php"><i class="bi bi-bag-check "
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Minhas Compras"></i><br>
                                Minhas compras</a>
                        </p>
                    </li>

                    <!-- carrinho de compra-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning" href="../carrinho/carrinho.php">
                                <i class="bi bi-cart" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Carrinho de Compras"></i><br>
                                Carrinho</a></p>
                    </li>
                    <!--Perfil-->
                    <li class="nav-item mr-5">

                        <p class="text-center"> <a class="nav-link text-warning" href="../usuario/perfil.php">
                                <i class="bi bi-person-circle " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Configuração"></i><br>
                                Perfil</a></p>

                    </li>
                    <!-- sair-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning" href="../index.php">
                                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Sair"></i><br>
                                Sair</a></p>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="mt-3 container">
        <h1 class="text-center m-3">Sparta- Nossas Sedes</h1>

    </div>
    <div class="dropdown-divider m-3"></div>
    <div class="container py-4">

        <div class="row m-3">
            <div class="col-md-6 ">
                <h2>Brasilia</h2>
                <p>Brasília, a capital do Brasil, é conhecida por sua arquitetura modernista e seu planejamento urbano
                    único. Projetada por Oscar Niemeyer e Lúcio Costa, a cidade foi construída no formato de um avião,
                    com edifícios governamentais icônicos alinhados ao longo do Eixo Monumental. Além de ser o centro
                    político do país, Brasília oferece uma rica cena cultural, com museus, teatros e uma variedade de
                    eventos culturais ao longo do ano.</p>
                <p>Sede em Brasília:<br>
                    Endereço: Setor Comercial Sul, Quadra 2, Bloco C, Brasília - DF<br>
                    CEP: 70070-120<br>
                    Telefone: (61) 9876-5432
            </div>
            <div class="col-md-6">
                <img src="../img/cidades/brasilia.png" alt="Cidade 1" class="img-fluid mb-3">
            </div>
        </div>
        <div class="dropdown-divider m-3"></div>

        <div class="row ">
            <div class="col-md-6">
                <img src="../img/cidades/Campo Belo MG. Oeste de Minas. F.png" alt="Cidade 2" class="img-fluid mb-3">
            </div>
              
            <div class="col-md-6">
                <h2>Minas Gerais</h2>
                <p>Belo Horizonte, a capital de Minas Gerais, é conhecida por sua rica história, arquitetura marcante e
                    gastronomia deliciosa. Rodeada pelas montanhas da Serra do Curral, a cidade oferece uma mistura
                    única de cultura e natureza. Com seus parques, museus e uma vibrante cena cultural, Belo Horizonte
                    atrai visitantes em busca de experiências autênticas e uma calorosa hospitalidade mineira.</p>
                <p>Sede em Belo Horizonte, Minas Gerais:<br>

                    Endereço: Av. Afonso Pena, 1000, Funcionários, Belo Horizonte - MG<br>
                    CEP: 30130-002<br>
                    Telefone: (31) 9876-5432</p>
            </div>
        </div>
        <div class="dropdown-divider m-3"></div>
        <div class="row m-3">

            <div class="col-md-6">
                <h2>São Paulo</h2>
                <p>São Paulo, a maior cidade do Brasil, é conhecida por sua agitação e diversidade cultural. Como um
                    centro financeiro e comercial, a cidade atrai pessoas de todo o país em busca de oportunidades de
                    negócios e emprego. Com sua icônica Avenida Paulista, repleta de arranha-céus, museus e espaços
                    culturais, São Paulo é um caldeirão de culturas, gastronomia e entretenimento.</p>
                <p>Sede em São Paulo:<br>
                    Endereço: Av. Paulista, 1000, Bela Vista, São Paulo - SP<br>
                    CEP: 01310-100<br>
                    Telefone: (11) 1234-5678</p>
            </div>
            <div class="col-md-6">
                <img src="../img/cidades/Sao-Paulo-467-banner-1.png" alt="Cidade 3" class="img-fluid mb-3">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

