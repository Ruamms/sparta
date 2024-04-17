<?php
include ("conexao.php");
session_start();



// Verifique se o produto foi adicionado ao carrinho
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produto_id = $_GET['id'];

    // Consulte o banco de dados para obter os detalhes do produto
    $sql = "SELECT * FROM produtos WHERE produto_id = $produto_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['estoque'] > 0) {
            // O produto está disponível no estoque, então podemos adicioná-lo ao carrinho
            $produto = [
                'id' => $row['produto_id'],
                'nome' => $row['nome'],
                'preco' => $row['preco'],
                'estoque' => $row['estoque'], // Certifique-se de que esta linha está presente
                'quantidade' => 1,
            ];


            if (isset($_SESSION['carrinho'])) {
                $index = -1;
                foreach ($_SESSION['carrinho'] as $key => $item) {
                    if ($item['id'] == $produto['id']) {
                        $index = $key;
                        break;
                    }
                }

                if ($index !== -1) {
                    if ($_SESSION['carrinho'][$index]['quantidade'] < $row['estoque']) {
                        $_SESSION['carrinho'][$index]['quantidade']++;
                    } else {
                        echo '<div class="alert alert-danger" id="mensagem"><h3>Quantidade máxima atingida para este produto.</h3></div>';
                    }
                } else {
                    $_SESSION['carrinho'][] = $produto;
                }
            } else {
                $_SESSION['carrinho'] = [$produto];
            }

            // Exiba a mensagem de sucesso
            echo '<div class="alert alert-success" id="mensagem"><h3>Produto adicionado ao carrinho!</h3></div>';
        } else {
            // O produto não está disponível no estoque
            echo '<div class="alert alert-danger" id="mensagem"><h3>Produto sem estoque.</h3></div>';
        }
    } else {
        // O produto não foi encontrado no banco de dados
        echo '<div class="alert alert-danger" id="mensagem"><h3>Produto não encontrado.</h3></div>';
    }
}



?>
<!DOCTYPE html>
<html>

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

    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
<div class="bg-warning text-center py-1">
    <p>FRETE GRÁTIS para todo o BRASIL em compras a partir de R$149,90. Prazo de entrega de 2 a 10 dias úteis.</p>
  </div>

    <nav class="sticky-top navbar navbar-expand-lg navbar-light bg-dark py-1 box-shadow">
        <div class="container">
            <a href="../produtosWey.php" class="navbar-brand">
                <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../usuario/produtosWey.php">Inicio</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../carrinho/relatorio/relatorio_compra.php">Minhas
                                compras</a></h4>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container  ">
        <div class="row mt-3 mx-auto container">
            <div class="col-md-12">

                <h1 class="m-2 text-center">Adicione Produtos ao carrinho</h1>

                <a href="carrinho.php" class="m-3 btn btn-warning text-center ">
                    <h5>Carrinho</h5>
                </a>

                <div class="row align-middle  m-2">

                    <?php
                    // Consulta para obter a lista de produtos
                    $sql = "SELECT * FROM produtos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-mb-3 m-2 mt-3 ">';
                            echo '<div class=" text-center card p-2">';
                            echo '<div class="p-4">';
                            echo '<img class=" mt-3" style="height:6rem;width:6rem;margin:0 auto;" src="http://localhost/sparta/adm/produto/' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
                            echo '<div class="card-body">';
                            echo '<h4 class="card-title">' . $row['nome'] . '</h4>';
                            echo '<p class="font-weight-light">' . $row['descricao'] . '</p>';
                            echo '<p class="font-weight-light"> Estoque: ' . $row['estoque'] . '</p>';
                            echo '<p class="font-weight-bold">Preço: R$ ' . number_format($row['preco'], 2) . '</p>';


                            echo '<a href="index.php?id=' . $row['produto_id'] . '" class="btn btn-warning">Adicionar ao Carrinho
                                                    
                                                    </a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "Nenhum produto encontrado.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
    <div id="alertContainer"></div>
  </div>
  <script>
    function showAlert(message, type) {
      // Create alert element
      var alertDiv = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
        message +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>');

      // Append alert to container
      $('#alertContainer').append(alertDiv);

      // Automatically close alert after 3 seconds
      setTimeout(function() {
        alertDiv.alert('close');
      }, 3000);
    }

    // Exemplo de uso
    $(document).ready(function() {
      // Exibe uma mensagem de aviso temporária
      showAlert('Esta é uma mensagem de aviso temporária!', 'warning');
    });
  </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>








