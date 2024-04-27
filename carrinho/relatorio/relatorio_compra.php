<!DOCTYPE html>
<html lang="pt-br">
<!-- link bootstrap   -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>suplemento</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <!-- -->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="../../usuario/produtosWey.php"><i class="bi bi-house " data-bs-toggle="tooltip" data-bs-placement="top" title="inicio"></i><br>
                Inicio</a>
            </p>
          </li>
          <!-- carrinho de compra-->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="../../carrinho/carrinho.php">
                <i class="bi bi-cart" data-bs-toggle="tooltip" data-bs-placement="top" title="Carrinho de Compras"></i><br>
                Carrinho</a></p>
          </li>
          <!--Perfil-->
          <li class="nav-item mr-5">

            <p class="text-center"> <a class="nav-link text-warning" href="../../usuario/perfil.php">
                <i class="bi bi-person-circle " data-bs-toggle="tooltip" data-bs-placement="top" title="Configuração"></i><br>
                Perfil</a></p>

          </li>
          <!-- sair-->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="../index.php">
                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                Sair</a></p>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <section>
    <?php
    include 'id_usuario.php';

    if (isset($_SESSION['id_usuario'])) {
      $id_usuario = $_SESSION['id_usuario'];

      $conn = new mysqli('localhost', 'root', '', 'cadastro');

      if ($conn->connect_error) {
        die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
      }

      // Consulta para obter o nome do usuário logado (usando declaração preparada)
      $consulta_usuario = "SELECT nome FROM usuario WHERE usuario_id = ?";
      $stmt = $conn->prepare($consulta_usuario);
      $stmt->bind_param("i", $id_usuario);
      $stmt->execute();
      $stmt->bind_result($nome_usuario);

      if ($stmt->fetch()) {
        $stmt->close();

        // Consulta para obter todas as compras do usuário
        $consulta_compras = "SELECT pedido_id, valor_total, DATE_FORMAT(data_pedido, '%d/%m/%Y') as data_pedido_formatada FROM pedido WHERE usuario_id = ? ORDER BY pedido_id DESC";
        $stmt = $conn->prepare($consulta_compras);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result_compras = $stmt->get_result();

        if ($result_compras->num_rows > 0) {
    ?>
          <h1 class=" m-3 text-center ">Relatório de Compras</h1>
          <div class="container mt-5 ">


            <?php

            while ($row_compra = $result_compras->fetch_assoc()) {
              $pedido_id = $row_compra['pedido_id'];
              $valor_total = $row_compra['valor_total'];
              $data_pedido = $row_compra['data_pedido_formatada'];

              // Consulta para obter os detalhes do pedido
              $consulta_detalhes_pedido = "SELECT dp.produto_id, p.nome, dp.quantidade
                    FROM detalhes_pedido dp
                    JOIN produtos p ON dp.produto_id = p.produto_id
                    WHERE dp.pedido_id = ?";
              $stmt = $conn->prepare($consulta_detalhes_pedido);
              $stmt->bind_param("i", $pedido_id);
              $stmt->execute();
              $result_detalhes_pedido = $stmt->get_result();
            ?>
              <div class=" mt-2">
                <div class="mt-5 m-2 ">

                  <h4>Pedido realizado: <?php echo $data_pedido; ?></h4>
                  <h5 class="mt-4">Número do pedido: <?php echo $pedido_id; ?></h5>
                  <h5>Valor Total: R$ <?php echo $valor_total; ?></h5>

                  <h4 class="text-center m-2">Produtos adiquiridos</h4>
                  <ul>
                    <?php while ($row_detalhes = $result_detalhes_pedido->fetch_assoc()) { ?>



                      <p class="m-2"><?php echo $row_detalhes['nome']; ?> - Quantidade:
                        <?php echo $row_detalhes['quantidade']; ?>
                      </p>
                      <span class="border border-warning"></span>


                    <?php } ?>
                  </ul>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        <?php
        } else {
        ?>
          <div class="text-center container">
            <div class="alert alert-danger text-center mt-5" role="alert">
              <h3>Você ainda não fez compras.</h3>
            </div>
            <a class="btn btn-warning mt-3" href="../../usuario/produtosWey.php">Voltar</a>
          </div>
    <?php
        }
      } else {
        echo "Usuário não encontrado.";
      }

      $conn->close();
    } else {
      echo "Usuário não está logado ou o ID do usuário não está definido.";
    }
    ?>




  </section>
</body>

</html>