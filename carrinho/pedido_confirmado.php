<!DOCTYPE html>
<html>

<head>
    <title>Confirmação de Pedido</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">
            <a href="../index.php" class="navbar-brand">
                <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="m-3">Parabéns pela compra</h2>
        <div class="m-3">
            <h1>
                <?php include 'id_usuario.php'; ?>
            </h1>
        </div>

        <div class="alert alert-success my-5">

            O seu pedido foi concluído com sucesso!
            O número do pedido é:
            <h3 class="m-3">
                <?php echo uniqid(); ?> 
            </h3>
            
        </div>

        <p class="m-3">Agradecemos por comprar conosco.<br>
         
        </p>

        <a href="../usuario/produtosWey.php" class="m-3 btn btn-warning">Voltar para a Página Inicial</a>
        <?php
        // Processo de finalização da compra
        
        // Limpe a sessão do carrinho
        
        unset($_SESSION['carrinho']);

        // Redirecione o usuário de volta à página carrinho.php após a finalização da compra
        echo '';
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>