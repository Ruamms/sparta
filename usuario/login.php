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

    <link rel="stylesheet" href="../public/style.css">

    <title>Login</title>
</head>

<body class="">

    <!-- menu-->
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


                    <li class="nav-item">
                        <p class="text-center"><a class="nav-link text-warning" href="../index.php"><i
                                    class="bi bi-house " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Inicio"></i><br>Inicio</a>
                        </p>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <h2 class="text-center m-3">Faça seu login</h2>


    <form class="container mt-5" style="max-width: 20rem;" action="autenticar.php" method="POST">

        <div class="form-group">
            <label class="font-weight-bold" for="email">Email</label>
            <input type="email" class="form-control" name="email" id="loginEmail" required>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="senha">Senha</label>
            <input type="password" class="form-control" id="loginSenha" name="senha" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-warning w-100">Entrar na Conta</button>
        </div>
        <small class="form-text text-muted">Esqueceu a senha? <a href="recuperar_senha.php">Clique aqui</a>.</small>
        <small class="form-text text-muted">Faça seu cadastro <a href="adicionar.php">Criar conta</a>.</small>
    </form>
    </div>


</body>

</html>