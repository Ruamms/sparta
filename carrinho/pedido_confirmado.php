<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão somente se não estiver ativa
}

// Verificar se o pedido_id está na sessão
if (!isset($_SESSION['pedido_id'])) {
    die("Número do pedido não encontrado na sessão.");
}

// Obter o pedido_id da sessão
$pedido_id = $_SESSION['pedido_id'];
?>
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <!-- inicio-->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="../index.php"><i class="bi bi-house " data-bs-toggle="tooltip" data-bs-placement="top" title="inicio"></i><br>
                Inicio</a>
            </p>
          </li>
          <!-- relatorio de compra-->
          <li class="nav-item mr-5">
            <p class="text-center">
              <a class="nav-link text-warning" href="./relatorio/relatorio_compra.php">
                <i class="bi bi-bag-check " data-bs-toggle="tooltip" data-bs-placement="top" title="Minhas Compras"></i><br>
                Minhas compras
              </a>
            </p>
          </li>
          <!-- carrinho de compra-->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="./carrinho.php">
                <i class="bi bi-cart" data-bs-toggle="tooltip" data-bs-placement="top" title="Carrinho de Compras"></i><br>
                Carrinho</a></p>
          </li>
          <!--Perfil-->
          <li class="nav-item mr-5">
            <p class="text-center">
              <a class="nav-link text-warning" href="../usuario/perfil.php">
                <i class="bi bi-person-circle " data-bs-toggle="tooltip" data-bs-placement="top" title="Configuração"></i><br>
                Perfil
              </a>
            </p>
          </li>
          <!-- sair-->
          <li class="nav-item mr-5">
            <p class="text-center">
              <a class="nav-link text-warning" href="../index.php?logout=1">
                <i class="bi bi-box-arrow-right" data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                Sair
              </a>
            </p>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2 class="m-3">Parabéns pela compra</h2>
    <div class="m-3">
      <h1>
        <?php include '../usuario/id_usuario.php'; ?>
      </h1>
    </div>

    <div class="alert alert-success my-5">
      O seu pedido foi concluído com sucesso!
      O número do pedido é:
      <h3 class="m-3">
        <?php echo htmlspecialchars($pedido_id); ?>
      </h3>
    </div>

    <p class="m-3">Agradecemos por comprar conosco.<br></p>

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