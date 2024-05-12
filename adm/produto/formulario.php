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

    <link rel="stylesheet" href="../../public/style.css">

    <title>Adicionar produto</title>
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


                    <!--Perfil-->
                    <li class="nav-item mr-5">

                        <p class="text-center"> <a class="nav-link text-warning" href="../relatorio/relatorio.php">

                                <i class="bi bi-clipboard2-data" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="relatorio"></i><br>
                                Relatorio</a></p>

                    </li>

                    <!-- sair-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning" href="../../index.php?logout=1">
                                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Sair"></i><br>
                                Sair</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h3 class="text-center m-3">Adicionar Produto</h3>



    <section class="container mt-3">

        <form   class="container"action="adicionar_produto.php" method="POST" enctype="multipart/form-data">
            
        <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="nome">Nome:</label><br>
                    <input class="w-100" type="text" name="nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="descricao">Descrição:</label><br>
                    <input class="w-100" type="text" name="descricao" required>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="preco">Preço:</label><br>
                    <input class="w-100" type="number" name="preco" step="0.01" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="estoque">Estoque:</label><br>
                    <input class="w-100" type="number" name="estoque" step="0.01" required>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="imagem">Imagem</label><br>
                    <input class="w-100" type="file" name="imagem" accept="image/*" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="tipo">Tipo:</label><br>
                    <select class="w-75" name="tipo" required>
                        <option value="whey">Whey</option>
                        <option value="creatina">Creatina</option>
                        <option value="pretreino">Pré treino</option>
                        <option value="glutamina">Glutamina</option>
                        <option value="bcaa">Bcaa</option>
                        <option value="Kit">Kit</option>
                        <option value="vitamina">Vitamina</option>
                    </select>
                </div>
            </div>

            <input class=" btn btn-warning   w-100 mt-3" type="submit" value="Adicionar Produto">
        </form>


</body>

</html>