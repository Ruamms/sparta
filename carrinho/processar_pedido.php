<?php
session_start();

// Verificar se os dados do formulário foram recebidos
if (isset($_POST['nome_cliente'], $_POST['endereco_cliente'], $_POST['numero_cartao'], $_POST['id_usuario'], $_POST['total'], $_POST['metodo_pagamento'], $_POST['cvc'], $_POST['parcelas'], $_POST['detalhes_carrinho'])) {

    // Receber os dados do formulário
    $nome_cliente = $_POST['nome_cliente'];
    $endereco_cliente = $_POST['endereco_cliente'];
    $numero_cartao = $_POST['numero_cartao'];
    $id_usuario = $_POST['id_usuario'];
    $total = $_POST['total'];
    $metodo_pagamento = $_POST['metodo_pagamento'];
    $cvc = $_POST['cvc'];
    $parcelas = $_POST['parcelas'];
    $detalhes_carrinho = $_POST['detalhes_carrinho'];

    // Conectar ao banco de dados
    $host = 'localhost';
    $db = 'cadastro'; // Substitua pelo nome do seu banco de dados
    $user = 'root'; // Substitua pelo usuário do seu banco de dados
    $pass = ''; // Substitua pela senha do seu banco de dados

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die('Erro na conexão: ' . $conn->connect_error);
    }

    // Preparar e executar a consulta SQL para inserir os dados na tabela "pedido"
    $sql_pedido = "INSERT INTO pedido (usuario_id, data_pedido, endereco_entrega, valor_total) VALUES (?, NOW(), ?, ?)";
    $stmt_pedido = $conn->prepare($sql_pedido);

    if ($stmt_pedido) {
        // Vincular os parâmetros da consulta
        $stmt_pedido->bind_param("iss", $id_usuario, $endereco_cliente, $total);

        // Executar a consulta
        $stmt_pedido->execute();

        // Verificar se a consulta foi bem-sucedida
        if ($stmt_pedido->affected_rows > 0) {
            // Obter o ID do pedido inserido
            $pedido_id = $stmt_pedido->insert_id;

         

            // Dividir a string $detalhes_carrinho para obter detalhes de cada produto
            if (!empty($detalhes_carrinho)) {
                $detalhes_produtos = explode("<br>", $detalhes_carrinho);

                // Verificar se $detalhes_produtos é uma matriz antes de continuar
                if (is_array($detalhes_produtos)) {
                    foreach ($detalhes_produtos as $detalhe_produto) {
                        // Extrair o ID do produto e a quantidade
                        $detalhe = explode(" - ", $detalhe_produto);
                        if (count($detalhe) >= 2) {
                            $nome_produto = trim($detalhe[0]); // Obtém o nome do produto
                            $quantidade = trim(str_replace("Quantidade: ", "", $detalhe[1])); // Obtém a quantidade

                            // Consulta SQL para obter o produto_id com base no nome do produto
                            $sql_produto = "SELECT produto_id FROM produtos WHERE nome = ?";
                            $stmt_produto = $conn->prepare($sql_produto);

                            if ($stmt_produto) {
                                // Vincular o nome do produto à consulta
                                $stmt_produto->bind_param("s", $nome_produto);

                                // Executar a consulta
                                $stmt_produto->execute();

                                // Obter o resultado
                                $result_produto = $stmt_produto->get_result();

                                // Verificar se a consulta retornou algum resultado
                                if ($result_produto->num_rows > 0) {
                                    // Obter o produto_id
                                    $row_produto = $result_produto->fetch_assoc();
                                    $produto_id = $row_produto['produto_id'];

                                    // Preparar e executar a consulta SQL para inserir os detalhes do pedido na tabela "detalhes_pedido"
                                    $sql_detalhes_pedido = "INSERT INTO detalhes_pedido (pedido_id, produto_id, quantidade) VALUES (?, ?, ?)";
                                    $stmt_detalhes_pedido = $conn->prepare($sql_detalhes_pedido);

                                    if ($stmt_detalhes_pedido) {
                                        // Vincular os parâmetros da consulta
                                        $stmt_detalhes_pedido->bind_param("iii", $pedido_id, $produto_id, $quantidade);

                                        // Executar a consulta
                                        $stmt_detalhes_pedido->execute();

                                        // Verificar se a consulta foi bem-sucedida
                                        if ($stmt_detalhes_pedido->affected_rows <= 0) {
                                            echo "Erro ao inserir detalhes do pedido.";
                                        }

                                        // Fechar a instrução dos detalhes do pedido
                                        $stmt_detalhes_pedido->close();
                                    } else {
                                        echo "Erro ao preparar a consulta para inserir detalhes do pedido: " . $conn->error;
                                    }
                                } else {
                                    echo "Produto não encontrado: $nome_produto";
                                }

                                // Fechar a instrução do produto
                                $stmt_produto->close();
                            } else {
                                echo "Erro ao preparar a consulta para obter produto: " . $conn->error;
                            }

                        } else {
                            //echo "Erro: Detalhes dos produtos em um formato inválido.";
                        }
                    }
                } else {
                    //echo "Erro: Detalhes dos produtos não encontrados ou em um formato inválido.";
                }
            } else {
                //echo "Erro: Detalhes do carrinho não encontrados.";
            }
              // Inserir dados na tabela "pagamento"
              $sql_pagamento = "INSERT INTO pagamento (pedido_id, valor, data_pagamento, metodo_pagamento, numero_do_cartao, parcelas) VALUES (?, ?, NOW(), ?, ?, ?)";
              $stmt_pagamento = $conn->prepare($sql_pagamento);
  
              if ($stmt_pagamento) {
                  // Vincular os parâmetros da consulta
                  $stmt_pagamento->bind_param("idsss", $pedido_id, $total, $metodo_pagamento, $numero_cartao, $parcelas);
  
                  // Executar a consulta
                  $stmt_pagamento->execute();
  
                  // Verificar se a consulta foi bem-sucedida
                  if ($stmt_pagamento->affected_rows > 0) {
                      echo "Dados de pagamento inseridos com sucesso.";
                  } else {
                      echo "Erro ao inserir dados de pagamento.";
                  }
  
                  // Fechar a instrução de pagamento
                  $stmt_pagamento->close();
              } else {
                  echo "Erro ao preparar a consulta para inserir dados de pagamento: " . $conn->error;
              }

            // Fechar a instrução do pedido
            $stmt_pedido->close();
        } else {
            echo "Erro ao inserir pedido na tabela 'pedido': " . $conn->error;
        }
    } else {
        echo "Erro ao preparar a consulta para inserir pedido na tabela 'pedido': " . $conn->error;
    }

    // Função para inserir dados de pagamento na tabela "pagamento"


    // Função para atualizar o estoque do produto
    function atualizarEstoqueProduto($conn, $produto_id, $quantidade)
    {
        // Consulta SQL para obter o estoque atual do produto
        $sql_estoque_atual = "SELECT estoque FROM produtos WHERE produto_id = ?";
        $stmt_estoque_atual = $conn->prepare($sql_estoque_atual);

        if ($stmt_estoque_atual) {
            // Vincular o ID do produto à consulta
            $stmt_estoque_atual->bind_param("i", $produto_id);

            // Executar a consulta
            $stmt_estoque_atual->execute();

            // Obter o resultado
            $result_estoque_atual = $stmt_estoque_atual->get_result();

            // Verificar se a consulta retornou algum resultado
            if ($result_estoque_atual->num_rows > 0) {
                // Obter o estoque atual
                $row_estoque_atual = $result_estoque_atual->fetch_assoc();
                $estoque_atual = $row_estoque_atual['estoque'];

                // Calcular o novo estoque
                $novo_estoque = $estoque_atual - $quantidade;

                // Consulta SQL para atualizar o estoque do produto
                $sql_atualizar_estoque = "UPDATE produtos SET estoque = ? WHERE produto_id = ?";
                $stmt_atualizar_estoque = $conn->prepare($sql_atualizar_estoque);

                if ($stmt_atualizar_estoque) {
                    // Vincular os parâmetros da consulta
                    $stmt_atualizar_estoque->bind_param("ii", $novo_estoque, $produto_id);

                    // Executar a consulta para atualizar o estoque do produto
                    $stmt_atualizar_estoque->execute();

                    // Verificar se a atualização foi bem-sucedida
                    if ($stmt_atualizar_estoque->affected_rows > 0) {
                        // Estoque atualizado com sucesso
                        return true;
                    } else {
                        // Erro ao atualizar o estoque
                        return false;
                    }
                } else {
                    // Erro ao preparar a consulta de atualização de estoque
                    return false;
                }
            } else {
                // Produto não encontrado
                return false;
            }


        } else {
            // Erro ao preparar a consulta de estoque atual
            return false;
        }
    }

    // Uso da função para atualizar o estoque do produto
    if (atualizarEstoqueProduto($conn, $produto_id, $quantidade)) {
        // Estoque atualizado com sucesso
        echo "Estoque atualizado com sucesso.";
    } else {
        // Erro ao atualizar o estoque
        echo "Erro ao atualizar o estoque do produto.";
    }
    
    header('Location: ./pedido_confirmado.php');

    // Fechar a conexão com o banco de dados
    $conn->close();

}
?>
