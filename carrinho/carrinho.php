<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>sparta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
                        <h4><a class="nav-link text-warning" href="../usuario/produtosWey.php"><i class="bi bi-house " data-bs-toggle="tooltip" data-bs-placement="top" title="Inicio"></i></a>
                        </h4>
                    </li>
                    <!-- relatorio de compra-->
                    <li class="nav-item mr-5">
                        <h4><a class="nav-link text-warning" href="../carrinho/relatorio/relatorio_compra.php"><i class="bi bi-bag-check " data-bs-toggle="tooltip" data-bs-placement="top" title="Minhas Compras"></i></a>
                        </h4>
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

    <div class="container mt-3">
        <h1 class="mt-3">Carrinho de Compras</h1>
        <?php
        // Função para remover um produto do carrinho
        function deleteCartItem($productId)
        {
            if (isset($_SESSION['carrinho'][$productId])) {
                unset($_SESSION['carrinho'][$productId]);
            }
        }

        $itens_carrinho = array();

        // Se o formulário for enviado e o botão de remover for pressionado
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            switch ($_POST['action']) {
                case 'add':
                    // Verificar a quantidade disponível em estoque antes de adicionar ao carrinho
                    if (isset($_SESSION['carrinho'][$id])) {
                        // Verificar se a quantidade a ser adicionada excede o estoque
                        if ($_SESSION['carrinho'][$id]['quantidade'] < $_SESSION['carrinho'][$id]['estoque']) {
                            $_SESSION['carrinho'][$id]['quantidade']++;
                        } else {
                            // Se a quantidade exceder o estoque, exibir uma mensagem ou tomar outra ação apropriada
                            echo '<p class="alert alert-warning">Quantidade máxima disponível atingida para este produto.</p>';
                        }
                    }
                    break;
                case 'subtract':
                    // Diminuir a quantidade do item no carrinho, mas garantir que não seja menor que 1
                    if ($_SESSION['carrinho'][$id]['quantidade'] > 1) {
                        $_SESSION['carrinho'][$id]['quantidade']--;
                    } else {
                        // Remover o produto do carrinho
                        unset($_SESSION['carrinho'][$id]);
                    }
                    break;
                case 'remove':
                    // Remover o item do carrinho
                    unset($_SESSION['carrinho'][$id]);
                    break;
            }
        }

        // Inicialize o valor total e a quantidade de itens
        $total = 0;
        $totalItems = 0;

        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            echo '<table class="table mt-3">
<thead>
<tr>
    <th>Nome do Produto</th>
    <th>Estoque</th>
    <th>Preço</th>
    <th>Quantidade</th>
</tr>
</thead>
<tbody>';

            foreach ($_SESSION['carrinho'] as $id => $produto) {
                // Calcular o subtotal do produto
                $subTotal = $produto['preco'] * intval($produto['quantidade']);
                $total += $subTotal; // Atualiza o valor total
                $totalItems += intval($produto['quantidade']); // Atualiza a quantidade total de itens

                echo '<tr>

<td>' . $produto['nome'] . '</td>
<td>' . $produto['estoque'] . '</td>
<td>R$ ' . number_format($produto['preco'], 2) . '</td>
<td>
    <form method="post">
        <input type="hidden" name="id" value="' . $id . '">
        <button class="btn btn-dark m-1" type="submit" name="action" value="subtract">-</button>
        ' . $produto['quantidade'] . '
        <button class="btn btn-dark m-1" type="submit" name="action" value="add">+</button>
        <button class="btn btn-danger m-1" type="submit" name="action" value="remove">Remover</button>
    </form>
</td>
</tr>';
            }
            $cep_cliente = isset($_SESSION['cliente']['cep']) ? $_SESSION['cliente']['cep'] : '';

            echo '</tbody></table>';
            echo '<h5 class="mt-3 m-2">Quantidade total de itens no carrinho: ' . $totalItems . '</h5>';
            if ($total >= 149.9) {
                echo '<h4 class="mt-4 m-2">Valor total dos produtos no carrinho: R$ ' . number_format($total, 2) . ' (Frete grátis)</h4>';
            } else {
                echo '<h4 class="mt-4 m-2">Valor total dos produtos no carrinho: R$ ' . number_format($total, 2) . '</h4>';
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'calc_frete') {
                    $frete = 25.00;
                    $total += $frete;
                    echo '<h4 class="mt-4 m-2">Valor do frete: R$ ' . number_format($frete, 2) . '</h4>';
                    echo '<h4 class="mt-4 m-2">Valor final do carrinho (incluindo frete): R$ ' . number_format($total, 2) . '</h4>';
                }
                echo '<form method="post">';
                echo '<input type="hidden" name="id" value="1">'; // Adiciona um campo hidden com um valor arbitrário
                echo '<input type="text" name="cep" placeholder="CEP" value="$cep_client">';
                echo '<button class="btn btn-dark m-1" type="submit" name="action" value="calc_frete">Calcular Frete</button>';
                echo '</form>';
            }
            if (!empty($_SESSION['carrinho'])) {
                echo '<a href="index.php" class="btn btn-warning mt-3 m-2">Continuar Comprando</a>';
                echo '<a href="finalizar_compra.php" class="btn btn-primary mt-3 m-2">Finalizar compra</a>';
            } else {
                echo '<p class="mt-3">Seu carrinho está vazio. Não é possível finalizar a compra.</p>';
            }
        } else {
            echo '<div class="text-center container">';
            echo '<div class="alert alert-danger text-center mt-5" role="alert">
<h3>Seu carrinho está vazio.</h3>
</div>';
            echo '<a class="btn btn-warning mt-3" href="../usuario/produtosWey.php">Voltar</a>';
            echo '</div>';
        }
        ?>
    </div>

</body>

</html>