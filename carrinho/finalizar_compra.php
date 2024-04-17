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
    <!-- Inclua a biblioteca Faker.js a partir do CDN -->
    <script src="https://cdn.rawgit.com/Marak/faker.js/0.7.3/build/build/faker.min.js"></script>

    <link rel="stylesheet" href="../public/style.css">


</head>

<body style="height: 50rem;">
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">
            <a href="../usuario/produtosWey.php" class="navbar-brand">
                <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <h3><a class="nav-link text-warning" href="../usuario/produtosWey.php">Inicio</a></h3>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Finalize sua compra</h1>
        <div class="text-center">


            <?php
            session_start();

            // Verificar se o usuário está logado
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

                // Obter o ID do usuário da sessão
                $id_usuario = $_SESSION['id_usuario'];

                // Conectar ao banco de dados
                $host = 'localhost';
                $db = 'cadastro';
                $user = 'root';
                $pass = '';

                $conn = new mysqli($host, $user, $pass, $db);

                if ($conn->connect_error) {
                    die('Erro na conexão: ' . $conn->connect_error);
                }
                // Inicializar uma matriz para armazenar os IDs dos produtos comprados
                $ids_produtos_comprados = array();

                // Calcular o valor total dos produtos no carrinho
                $total = 0;

                // Inicializar uma variável para armazenar os detalhes do carrinho
                $detalhes_carrinho = '';
            }

            if (!empty($_SESSION['carrinho'])) {
                foreach ($_SESSION['carrinho'] as $id_produto => $item) {


                    // Calcular o valor total considerando o preço do produto e a quantidade
                    $subtotal = $item['preco'] * intval($item['quantidade']);
                    $total += $subtotal;

                    // Construir detalhes do carrinho com o ID do produto
                    $detalhes_carrinho .= $item['nome'] . ' - Quantidade: ' . $item['quantidade'] . '<br>';
                    // Consulta SQL para obter o número da tabela do produto
                    $sql_numero_tabela = "SELECT produto_id FROM produtos WHERE nome = ?";
                    $stmt_numero_tabela = $conn->prepare($sql_numero_tabela);

                    if ($stmt_numero_tabela) {
                        // Vincular o valor da variável à instrução
                        $stmt_numero_tabela->bind_param("s", $item['nome']);

                        // Executar a consulta
                        $stmt_numero_tabela->execute();

                        // Obter o resultado
                        $result_numero_tabela = $stmt_numero_tabela->get_result();

                        if ($result_numero_tabela->num_rows > 0) {
                            $row_numero_tabela = $result_numero_tabela->fetch_assoc();
                            $numero_tabela = $row_numero_tabela['produto_id'];
                        } else {
                            $numero_tabela = "Não encontrado";
                        }

                        // Adicionar o número da tabela ao detalhe do carrinho
                        $detalhes_carrinho .= 'Número de serie: ' . $numero_tabela . '<br><br>';

                        // Fechar a instrução e liberar recursos
                        $stmt_numero_tabela->close();
                    } else {
                        echo "Erro ao preparar a consulta do número da tabela do produto: " . $conn->error;
                    }
                }
            }


            // Consulta SQL para obter o nome, endereço e número do cartão do cliente
            $sql_cliente = "SELECT nome, endereco, numero_cartao FROM cliente WHERE usuario_id = ?";
            $stmt_cliente = $conn->prepare($sql_cliente);

            if ($stmt_cliente) {
                // Vincular o valor da variável à instrução
                $stmt_cliente->bind_param("i", $id_usuario);

                // Executar a consulta
                $stmt_cliente->execute();

                // Obter o resultado
                $result_cliente = $stmt_cliente->get_result();

                if ($result_cliente->num_rows > 0) {
                    $row_cliente = $result_cliente->fetch_assoc();
                    $nome_cliente = $row_cliente['nome'];
                    $endereco_cliente = $row_cliente['endereco'];
                    $numero_cartao = $row_cliente['numero_cartao'];
                } else {
                    $nome_cliente = ""; // Defina um valor padrão se o nome do cliente não for encontrado
                    $endereco_cliente = ""; // Defina um valor padrão se o endereço do cliente não for encontrado
                    $numero_cartao = ""; // Defina um valor padrão se o número do cartão não for encontrado
                }

                // Fechar a instrução e liberar recursos
                $stmt_cliente->close();
            } else {
                echo "Erro ao preparar a consulta de dados do cliente: " . $conn->error;
            }

            // Fechar a conexão com o banco de dados
            $conn->close();



            ?>

            <!-- Formulário de compra -->
            <form class="container mt-4 " onsubmit="return validarFormulario();" style="max-width: 20rem;"
                action="processar_pedido.php" method="POST">
                <div class="d-flex justify-content-center col-md-12">
                    <div class="form-group row m-3">
                            <div class="form-group col-12">
                                <label class="font-weight-bold">Nome do Cliente:</label>
                                <input type="text" name="nome_cliente" class="form-control w-100"
                                    value="<?php echo $nome_cliente; ?>" readonly>
                            </div>

                            <div class="form-group col-12">
                                <label class="font-weight-bold">Endereço de Entrega:</label>
                                <input type="text" name="endereco_cliente" class="form-control w-100"
                                    value="<?php echo $endereco_cliente; ?>" readonly>
                            </div>

                            <div class="form-group col-12">
                                <label class="font-weight-bold">Número do Cartão:</label>
                                <input type="text" name="numero_cartao" class="form-control w-100"
                                    value="<?php echo $numero_cartao; ?>" readonly>
                            </div>
                            <!-- Campos para mostrar informações do cliente -->
                            <div class="form-group col-122 d-none">
                                <label class="font-weight-bold" for="id_usuario">ID do Usuário:</label>
                                <input type="text" class="form-control w-100" id="id_usuario" name="id_usuario"
                                    value="<?php echo $id_usuario; ?>" required readonly>
                            </div>
                            <input type="hidden" name=" ids_produtos_comprados" value="<?php $ids_produtos_comprados; ?>">
                            <div class="form-group col-12">
                                <label class="font-weight-bold">Método de Pagamento:</label><br>
                                <select name="metodo_pagamento" id="metodo_pagamento" required>
                                    <option value="selecione">Selecione</option>
                                    <option value="credito">Cartão de Crédito</option>
                                    <option value="debito">Cartão de Débito</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label class="font-weight-bold">CVC (Código de Segurança):</label>
                                <input type="text" name="cvc" placeholder="CVC (3 dígitos)" maxlength="3">
                            </div>
                            <div class="form-group col-12">
                                <label class="font-weight-bold">Número de Parcelas:</label>
                                <select name="parcelas">
                                    <option value="1">1x</option>
                                    <option value="2">2x</option>
                                    <option value="3">3x</option>
                                    <option value="4">4x</option>
                                    <option value="5">5x</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row col-md-12 m-3">   
                                    <div class="form-group col-12">
                                        <!-- Exibir detalhes do carrinho -->
                                        <input type="hidden" name="ids_produtos_comprados"
                                            value="<?php echo implode(',', $ids_produtos_comprados); ?>">
                                        <input type="hidden" name="detalhes_carrinho" value="<?php echo $detalhes_carrinho; ?>">
                                        <!-- Exibir detalhes do carrinho -->
                                        <div class="form-group col-12">
                                            <label class="font-weight-bold">Detalhes do Carrinho:</label>
                                            <div>
                                                <?php echo $detalhes_carrinho; ?>
                                            </div>
                                        </div>
                                    </div>
                                <!-- Exibir o valor total da compra -->
                                    <div class="form-group col-12">
                                        <label class="font-weight-bold ">Valor Total da Compra:</label>
                                        <div>
                                            <?php echo 'R$ ' . number_format($total, 2); ?>
                                        </div>
                                        <input type="hidden" name="total" value="<?php echo $total; ?>"> <!-- Adicione o echo aqui -->
                                    </div>
                                    <div class="form-group col-12">
                                        <input type="submit" class="btn btn-warning" value="Finalizar Compra">
                                    </div>
                        </div>
                </div>
            </form>


            <script>
    // Obtém os elementos do formulário
    var metodoPagamentoSelect = document.getElementById("metodo_pagamento");
    var camposCartao = document.getElementById("campos_cartao");
    var parcelasSelect = document.getElementById("parcelas");

    // Adiciona um ouvinte de evento para o select
    metodoPagamentoSelect.addEventListener("change", function () {
        var selectedOption = metodoPagamentoSelect.value;

        // Oculta todos os campos
        camposCartao.style.display = "none";
        parcelasSelect.style.display = "none";

        // Mostra os campos com base na opção selecionada
        if (selectedOption === "credito" || selectedOption === "debito") {
            camposCartao.style.display = "block";

            // Se for crédito, mostra o seletor de parcelas
            if (selectedOption === "credito") {
                parcelasSelect.style.display = "block";
            }
        }
    });
</script>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>