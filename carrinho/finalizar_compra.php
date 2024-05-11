<?php
if (!isset($_SESSION)) {
    session_start();
}

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
    <!-- Inclua a biblioteca Faker.js a partir do CDN -->
    <script src="https://cdn.rawgit.com/Marak/faker.js/0.7.3/build/build/faker.min.js"></script>
    <!--  ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../public/style.css">


</head>

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
                <!-- relatorio de compra-->
                <li class="nav-item mr-5">
                    <p class="text-center"><a class="nav-link text-warning" href="../usuario/produtosWey.php"><i class="bi bi-house " data-bs-toggle="tooltip" data-bs-placement="top" title="inicio"></i><br>
                            Inicio</a>
                    </p>
                </li>
                <!-- carrinho de compra-->
                <li class="nav-item mr-5">
                    <p class="text-center"><a class="nav-link text-warning" href="../carrinho/carrinho.php">
                            <i class="bi bi-cart" data-bs-toggle="tooltip" data-bs-placement="top" title="Carrinho de Compras"></i><br>
                            Carrinho</a></p>
                </li>
                <!--Perfil-->
                <li class="nav-item mr-5">

                    <p class="text-center"> <a class="nav-link text-warning" href="../usuario/perfil.php">
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
<div class="container mt-3">
    <h2>Detalhes do pedido</h2>
    <div class="container m-5">
        <?php

        // Iniciar a conexão com o banco de dados
        $host = 'localhost';
        $db = 'cadastro';
        $user = 'root';
        $pass = '';
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die('Erro na conexão: ' . $conn->connect_error);
        }
        // Inicializar variáveis
        $ids_produtos_comprados = array();
        $total = 0;
        $detalhes_carrinho = '';

        // Verificar se o usuário está logado
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            $id_usuario = $_SESSION['id_usuario'];

            // Processar informações do carrinho
            if (!empty($_SESSION['carrinho'])) {
                foreach ($_SESSION['carrinho'] as $id_produto => $item) {
                    // Calcula o subtotal
                    $subtotal = $item['preco'] * intval($item['quantidade']);
                    $total += $subtotal;

                    // Construir detalhes do carrinho
                    $detalhes_carrinho .= $item['nome'] . ' - Quantidade: ' . $item['quantidade'] . '<br>';

                    // Consulta SQL para obter o número do produto
                    $sql_numero_produto = "SELECT produto_id FROM produtos WHERE nome = ?";
                    $stmt_numero_produto = $conn->prepare($sql_numero_produto);

                    if ($stmt_numero_produto) {
                        $stmt_numero_produto->bind_param("s", $item['nome']);
                        $stmt_numero_produto->execute();
                        $result_numero_produto = $stmt_numero_produto->get_result();

                        if ($result_numero_produto->num_rows > 0) {
                            $row_numero_produto = $result_numero_produto->fetch_assoc();
                            $numero_produto = $row_numero_produto['produto_id'];
                        } else {
                            $numero_produto = "Não encontrado";
                        }

                        $detalhes_carrinho .= 'Número de série: ' . $numero_produto . '<br><br>';
                        $stmt_numero_produto->close();
                    } else {
                        echo "Erro ao preparar a consulta do número do produto: " . $conn->error;
                    }
                }
            }

            // Consulta SQL para obter informações do cliente
            $sql_cliente = "SELECT nome, endereco,cep,numero,cidade,estado,complemento,estado, numero_cartao FROM cliente WHERE usuario_id = ?";
            $stmt_cliente = $conn->prepare($sql_cliente);

            if ($stmt_cliente) {
                $stmt_cliente->bind_param("i", $id_usuario);
                $stmt_cliente->execute();
                $result_cliente = $stmt_cliente->get_result();

                if ($result_cliente->num_rows > 0) {
                    $row_cliente = $result_cliente->fetch_assoc();
                    $nome_cliente = $row_cliente['nome'];
                    $endereco_cliente = $row_cliente['endereco'];
                    $cep_cliente = $row_cliente['cep'];
                    $numero_cliente = $row_cliente['numero'];
                    $cidade_cliente = $row_cliente['cidade'];
                    $estado_cliente = $row_cliente['estado'];
                    $complemento_cliente = $row_cliente['complemento'];
                    $estado_cliente = $row_cliente['estado'];
                    $numero_cartao = $row_cliente['numero_cartao'];
                } else {
                    $nome_cliente = "";
                    $endereco_cliente = "";
                    $numero_cartao = "";
                }

                $stmt_cliente->close();
            } else {
                echo "Erro ao preparar a consulta de dados do cliente: " . $conn->error;
            }
        } else {
            // Redirecionar se o usuário não estiver logado
            header('Location: login.php');
            exit;
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
        ?>
    </div>

    <!-- Formulário de compra -->
    <form class="container m-3" id="formulario-pedido" onsubmit="return validarFormulario();" action="processar_pedido.php" method="POST">


        <div class="d-flex  col-md-14">

            <div class="form-group m-2 w-25">
                <div class="form-group col-12">
                    <label class="font-weight-bold">Nome:</label>
                    <input type="text" name="nome_cliente" class="form-control w-100" value="<?php echo $nome_cliente; ?>" readonly>
                </div>

                <div class="form-group col-12">
                    <label class="font-weight-bold">Endereço da Entrega:</label>
                    <input type="text" name="endereco_cliente" class="form-control w-100" value="<?php echo $endereco_cliente; ?>" readonly>
                </div>
                <div class="form-group col-12">
                    <label class="font-weight-bold">Cep:</label>
                    <input type="text" name="cep_cliente" class="form-control w-100" value="<?php echo $cep_cliente; ?>" readonly>
                </div>
            </div>
            <div class="form-group m-2 w-25 ">
                <div class="form-group col">
                    <label class="font-weight-bold">Cidade:</label>
                    <input type="text" name="cidade_cliente" class="form-control" value="<?php echo $cidade_cliente ?>" readonly>
                </div>
                <div class="form-group col">
                    <label class="font-weight-bold">Estado:</label>
                    <input type="text" name="estado_cliente" class="form-control" value="<?php echo $estado_cliente ?>" readonly>
                </div>
                <div class="form-group col">
                    <label class="font-weight-bold">Complemento:</label>
                    <input type="text" name="complemento_cliente" class="form-control" value="<?php echo $complemento_cliente; ?>" readonly>
                </div>
            </div>
            <div class="form-group m-2 w-25">
                <div class="form-group col">
                    <label class="font-weight-bold">Número do Cartão:</label>
                    <input type="hidden" name="numero_cartao" value="<?php echo $numero_cartao; ?>">
                    <!-- Aqui você envia o número completo -->
                    <?php
                    if (strlen($numero_cartao) >= 4) {
                        $ultimos_quatro_digitos = substr($numero_cartao, -4);
                        $mascara = str_repeat('*', strlen($numero_cartao) - 4) . $ultimos_quatro_digitos;
                    } else {
                        $mascara = $numero_cartao;
                    }
                    ?>
                    <input type="text" class="form-control w-75" value="<?php echo $mascara; ?>" readonly>
                </div>


                <div class="form-group col d-none">
                    <label class="font-weight-bold" for="id_usuario">ID do Usuário:</label>
                    <input type="text" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario; ?>" required readonly>
                </div>
                <!-- Campos para mostrar informações da compra -->
                <input type="hidden" name=" ids_produtos_comprados" value="<?php $ids_produtos_comprados; ?>">
                <div class="form-group col">
                    <label class="font-weight-bold">Método de Pagamento:</label><br>
                    <select class="w-75" name="metodo_pagamento" id="metodo_pagamento" required onchange="mostrarParcelas()">
                        <option value="selecione">Selecione</option>
                        <option value="credito">Cartão de Crédito</option>
                        <option value="debito">Cartão de Débito</option>
                    </select>
                </div>
                <div class="form-group  col">
                    <label class="font-weight-bold mt-3">CVC (Código de Segurança):</label>
                    <input class="w-75" type="text" name="cvc" placeholder="CVC (3 dígitos)" maxlength="3">
                </div>
                <div class="form-group col" id="parcelasDiv" style="display: none;">
                    <label class="font-weight-bold">Número de Parcelas:</label>
                    <select class="w-75" name="parcelas">
                        <option value="1">1x</option>
                        <option value="2">2x</option>
                        <option value="3">3x</option>
                        <option value="4">4x</option>
                        <option value="5">5x</option>
                    </select>
                </div>
            </div>
            <div class="form-group m-2 w-25">
                <div class="form-group ">
                    <!-- Exibir detalhes do carrinho -->
                    <input class="w-50" type="hidden" name="ids_produtos_comprados" value="<?php echo implode(',', $ids_produtos_comprados); ?>">
                    <input type="hidden" name="detalhes_carrinho" value="<?php echo $detalhes_carrinho; ?>">
                    <!-- Exibir detalhes do carrinho -->
                    <div class="form-group ">
                        <label class="font-weight-bold">Detalhes do Carrinho:</label>
                        <div>
                            <?php echo $detalhes_carrinho; ?>
                        </div>
                    </div>
                </div>
                <!-- Exibir o valor total da compra -->
                <div class="form-group ">
                    <label class="font-weight-bold">Valor Total da Compra:</label>
                    <div>
                        <?php
                        if ($total < 149.90) {
                            $total += 25.00; // Adiciona R$ 25,00 ao total se for menor que R$ 149,90
                            echo 'R$ ' . number_format($total, 2) . ' (Incluindo R$ 25,00 de frete)';
                        } else {
                            echo 'R$ ' . number_format($total, 2) . ' (Frete Gratis)';
                        }
                        ?>
                    </div>
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                </div>
                <div class="form-group ">
                    <input type="submit" class="btn btn-warning" value="Finalizar Compra">
                </div>

            </div>
        </div>
    </form>
    <script>
        function validarFormulario() {
            // Verificar se todos os campos estão preenchidos
            var nome = document.getElementsByName('nome_cliente')[0].value;
            var endereco = document.getElementsByName('endereco_cliente')[0].value;
            var cep = document.getElementsByName('cep_cliente')[0].value;
            var cidade = document.getElementsByName('cidade_cliente')[0].value;
            var estado = document.getElementsByName('estado_cliente')[0].value;
            var cvc = document.getElementsByName('cvc')[0].value;

            if (nome === "" || endereco === "" || cep === "" || cidade === "" || estado === "" || cvc === "") {
                alert("Por favor, Atualize seus dados.");
                // Redirecionar para outra página
                window.location.href = "../usuario/perfil.php";
                return false; // Impede o envio do formulário
            }


            // Verificar se o método de pagamento foi selecionado
            var metodoPagamento = document.getElementById('metodo_pagamento').value;
            if (metodoPagamento === "selecione") {
                alert("Por favor, selecione um método de pagamento.");
                return false; // Impede o envio do formulário
            }

            // Se todos os campos estiverem preenchidos e o método de pagamento selecionado, permitir o envio do formulário
            return true;
        }

        function mostrarParcelas() {
            var metodoPagamento = document.getElementById("metodo_pagamento").value;
            var parcelasDiv = document.getElementById("parcelasDiv");

            // Se o método de pagamento for "credito", mostra o campo de seleção de parcelas, caso contrário, esconde-o
            if (metodoPagamento === "credito") {
                parcelasDiv.style.display = "block";
            } else {
                parcelasDiv.style.display = "none";
            }
        }
    </script>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

</html>