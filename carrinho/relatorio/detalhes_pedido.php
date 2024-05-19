<?php
// Conexão com o banco de dados
$host = 'localhost';
$db = 'cadastro';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die('Erro na conexão: ' . $conn->connect_error);
}

if (isset($_GET['pedido_id'])) {
  $pedido_id = intval($_GET['pedido_id']);

  // Consulta para obter detalhes do pedido
  $query_pedido = "SELECT * FROM pedido WHERE pedido_id = $pedido_id";
  $result_pedido = $conn->query($query_pedido);
  $pedido = $result_pedido->fetch_assoc();

  // Consulta para obter detalhes dos itens do pedido com as imagens dos produtos
  $query_itens = "
    SELECT dp.*, p.imagem, p.nome 
    FROM detalhes_pedido dp 
    JOIN produtos p ON dp.produto_id = p.produto_id 
    WHERE dp.pedido_id = $pedido_id";
  $result_itens = $conn->query($query_itens);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<!-- link bootstrap   -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>suplemento</title>
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

</head>

<body>


  <div class="bg-warning text-center py-1">
    <p>FRETE GRÁTIS para todo o BRASIL em compras a partir de R$149,90. Prazo de entrega de 2 a 10 dias úteis.</p>
  </div>
  <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-1 box-shadow">
    <div class="container">

      <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <!-- -->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="../../index.php"><i class="bi bi-house "
                  data-bs-toggle="tooltip" data-bs-placement="top" title="inicio"></i><br>
                Inicio</a>
            </p>
          </li>
          <!-- carrinho de compra-->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="../../carrinho/carrinho.php">
                <i class="bi bi-cart" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Carrinho de Compras"></i><br>
                Carrinho</a></p>
          </li>
          <!--Perfil-->
          <li class="nav-item mr-5">

            <p class="text-center"> <a class="nav-link text-warning" href="../../usuario/perfil.php">
                <i class="bi bi-person-circle " data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Configuração"></i><br>
                Perfil</a></p>

          </li>
          <!-- sair-->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="../../index.php?logout=1">
                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                Sair</a></p>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <div class="container mt-5">
    <h2>Detalhes do Pedido</h2>
    <div class="container ">
      <div class="class="container>


        <div>
          <?php if (isset($pedido) && $pedido) { ?>
            <p>Pedido realizado:
              <?php
              $data_pedido = strtotime($pedido['data_pedido']);
              echo htmlspecialchars(date('d/m/Y', $data_pedido), ENT_QUOTES, 'UTF-8');
              ?>
            </p>
            <p>Número do pedido: <?php echo htmlspecialchars($pedido['pedido_id'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Valor Total: R$ <?php echo htmlspecialchars($pedido['valor_total'], ENT_QUOTES, 'UTF-8'); ?></p>
          </div>


          <div class="text-center mt-5">
            <a href="../index.php" class="btn btn-warning">Comprar Novamente</a>
          </div>


          <div>
            <?php
            if (isset($pedido)) {

              // Calcular a diferença de dias entre a data do pedido e a data atual
              $data_pedido_date = DateTime::createFromFormat('Y-m-d', $pedido['data_pedido']);
              $data_atual_date = new DateTime();
              if ($data_pedido_date === false) {
                echo "Erro ao interpretar a data do pedido: " . htmlspecialchars($pedido['data_pedido'], ENT_QUOTES, 'UTF-8');
              } else {
                $diferenca_dias = $data_pedido_date->diff($data_atual_date)->days;
                $percentual_conclusao = min(100, ($diferenca_dias / 2) * 20); // Incrementa 20% a cada 2 dias
          

                // Determinar a mensagem de status do pedido
                if ($percentual_conclusao >= 100) {
                  $status_pedido = 'Entregue';
                } elseif ($percentual_conclusao >= 80) {
                  $status_pedido = 'Pedido em rota de entrega para seu endereço';
                } elseif ($percentual_conclusao >= 70) {
                  $status_pedido = 'Seu pedido chegou ao centro logistico';
                } elseif ($percentual_conclusao >= 60) {
                  $status_pedido = 'Em transporte';
                } elseif ($percentual_conclusao >= 50) {
                  $status_pedido = 'Seu pedido saiu do centro logístico';
                } elseif ($percentual_conclusao >= 30) {
                  $status_pedido = 'Separando para envio';
                } elseif ($percentual_conclusao >= 20) {
                  $status_pedido = 'Pedido processado';
                } else {
                  $status_pedido = 'Pedido recebido';
                }
              }
              ?>

              <h5 class="text-center mt-5">Status do Pedido</h5>
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo $percentual_conclusao; ?>%;"
                  aria-valuenow="<?php echo $percentual_conclusao; ?>" aria-valuemin="0" aria-valuemax="100">

                </div>
              </div>
              <p class="text-center"> <?php echo htmlspecialchars($status_pedido, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php } ?>
          </div>
        </div>
      </div>
      <h5 class="mt-4">Produtos adquiridos</h5>
      <ul class="list-group mt-2">
        <?php while ($item = $result_itens->fetch_assoc()) { ?>
          <li class="list-group-item d-flex align-items-center">
            <img class="mt-3" style="height:4rem;width:4rem;margin-right:10px;"
              src="http://localhost/sparta/adm/produto/<?php echo htmlspecialchars($item['imagem'], ENT_QUOTES, 'UTF-8'); ?>"
              alt="<?php echo htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8'); ?>">
            <div>
              <p><?php echo htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8'); ?> - Quantidade:
                <?php echo htmlspecialchars($item['quantidade'], ENT_QUOTES, 'UTF-8'); ?>
              </p>
            </div>
          </li>
        <?php } ?>
      </ul>
    <?php } else { ?>
      <p>Pedido não encontrado.</p>
    <?php } ?>


  </div>
</body>

</html>