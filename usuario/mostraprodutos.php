<?php

if (!isset($_SESSION)) {
    session_start();
}
include 'conexao';
// Consulta para obter a lista de produtos
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-3 mt-3">';
        echo '<div class="card">';
        echo '<img class="m-3" style="height: 5rem;width: 5rem;" src="http://localhost/sparta/adm/produto/' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['nome'] . '</h5>';
        echo '<p class="card-text">' . $row['descricao'] . '</p>';
        echo '<p class="card-text">Preço: R$ ' . number_format($row['preco'], 2) . '</p>';
        echo '<p class="card-text">Numero de serie: ' . $row['produto_id'] . '</p>';
        echo '<a href="index.php?id=' . $row['produto_id'] . '" class="btn btn-primary">Adicionar ao Carrinho</a>';
        echo '</div></div></div>';
    }
} else {
    echo "Nenhum produto encontrado.";
}
