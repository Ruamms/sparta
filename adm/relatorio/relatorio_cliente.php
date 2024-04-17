<?php
require('./fpdf186/fpdf.php');
include 'conexao.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter as datas do formulário
    $data_inicial = $_POST["data_inicial"];
    $data_final = $_POST["data_final"];

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para obter os dados de todos os clientes ordenados pelo total gasto
    $sql = "SELECT u.usuario_id, u.nome, SUM(p.valor_total) as total_gasto
            FROM usuario u
            JOIN pedido p ON u.usuario_id = p.id_usuario
            WHERE p.data_pedido BETWEEN '$data_inicial' AND '$data_final'
            GROUP BY u.usuario_id
            ORDER BY total_gasto DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibir os resultados
        $row = $result->fetch_assoc();
        $usuario_id = $row['usuario_id'];
        $nome_usuario = $row['nome'];
        $total_gasto = $row['total_gasto'];

        // Exibir informações na página HTML
        echo '
        <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
                </a>  
            </div>
        </nav>
        ';
        echo '<div class=" mt-3 text-center " style="height: 20rem;">';
        echo '<img class="card-img-top mx-auto " style="width: 9rem;" src="../../img/icons8-contabilidade-de-fundo-96.png" alt="Imagem de capa do card">';
        echo '<div class="card-body text-center  mt-2">';
        echo '<h3 class="card-title">Relatorio cliente</h3>';
        echo "<p class='card-title'>O cliente $nome_usuario (Registro: $usuario_id)<br> É o que mais comprou, gastando um total de R$ $total_gasto <br> no período de $data_inicial a $data_final.</p>";
        echo '</div>';
        echo '<a class="btn btn-warning mt-3" href="./relatorio.php">Voltar</a>';

        // Botão para gerar o PDF
        echo '<form method="post">';
        echo '<input type="hidden" name="data_inicial" value="' . $data_inicial . '">';
        echo '<input type="hidden" name="data_final" value="' . $data_final . '">';
        echo '<button type="submit" class="btn btn-primary mt-3" name="gerar_pdf">Gerar PDF</button>';
        echo '</form>';
    } else {
        // Exibir mensagem se não houver resultados
        echo '
            <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
                <div class="container">
                    <a href="#" class="navbar-brand">
                        <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
                    </a>
                    
                </div>
            </nav>
        ';
        echo '<div class="text-center container">';
        echo '<div class="alert alert-danger text-center mt-5" role="alert">';
        echo '<h3>';
        echo "Nenhum resultado encontrado para o período de $data_inicial a $data_final.";
        echo '</h3>';
        echo '</div>';
        echo '<a class="btn btn-warning mt-3" href="./relatorio.php">Voltar</a>';
        echo '</div>';
    }

    // Fechar a conexão
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sparta</title>
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

    <link rel="stylesheet" href="../../public/style.css">
    <title>Document</title>
</head>

<body>

    <!-- Seu HTML aqui -->

</body>

</html>
