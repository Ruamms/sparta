<!DOCTYPE html>
<html>

<head>
    <title>Confirmação de Pedido</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--  ícones do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
<div class="bg-warning text-center py-1">
    <p>FRETE GRÁTIS para todo o BRASIL em compras a partir de R$149,90. Prazo de entrega de 2 a 10 dias úteis.</p>
  </div>
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
           <!-- inicio-->
          <li class="nav-item mr-5">
            <h4><a class="nav-link text-warning" href="../index.php"><i
                  class="bi bi-house " data-bs-toggle="tooltip" data-bs-placement="top"
                  title="inicio"></i></a>
            </h4>
          </li>
           <!-- relatorio de compra-->
           <li class="nav-item mr-5">
            <h4><a class="nav-link text-warning" href="../carrinho/relatorio/relatorio_compra.php"><i
                  class="bi bi-bag-check " data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Minhas Compras"></i></a>
            </h4>
          </li>
          <!-- carrinho de compra-->
          <li class="nav-item mr-5">
            <h4><a class="nav-link text-warning" href="../carrinho/carrinho.php">
                <i class="bi bi-cart" data-bs-toggle="tooltip" data-bs-placement="top" title="Carrinho de Compras"></i>
              </a></h4>
          </li>
           <!--Perfil-->
          <li class="nav-item mr-5">
            <a class="nav-link text-warning" href="../usuario/perfil.php">
              <h4>
                <i class="bi bi-person-gear " data-bs-toggle="tooltip" data-bs-placement="top" title="Configuração"></i>
              </h4>
            </a>

          </li>
           <!-- sair-->
          <li class="nav-item mr-5">
            <h4><a class="nav-link text-warning" href="../usuario/login.php">
                <i class="bi  bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i>
              </a></h4>
          </li>

        </ul>
      </div>
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

        <a href="../index.php" class="m-3 btn btn-warning">Voltar para a Página Inicial</a>
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