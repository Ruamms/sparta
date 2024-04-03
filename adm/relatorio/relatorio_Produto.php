<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

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
    <title>Relatorio</title>
</head>

<body>
    
    <?php
require_once('./fpdf186/fpdf.php');

try {
    include('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['visualizarTela']) || isset($_POST['gerarPDF'])) {
            // Process the form only if either button is clicked

            // Consulta para obter produtos vendidos nos dias especificados
            $queryProdutosVendidos = "
            SELECT p.produto_id, p.nome AS nome_produto, COUNT(dp.id_produto) AS quantidade_vendas, pe.data_pedido
            FROM produtos p
            LEFT JOIN detalhes_pedidos dp ON p.produto_id = dp.id_produto
            LEFT JOIN pedidos pe ON dp.id_pedido = pe.pedido_id
            WHERE pe.data_pedido BETWEEN ? AND ?
            GROUP BY p.produto_id, p.nome, pe.data_pedido
            ORDER BY pe.data_pedido
        ";
        
        $stmtProdutosVendidos = $conn->prepare($queryProdutosVendidos);
$stmtProdutosVendidos->bind_param('ss', $_POST['data_inicial'], $_POST['data_final']);
$stmtProdutosVendidos->execute();
$resultProdutosVendidos = $stmtProdutosVendidos->get_result()->fetch_all(MYSQLI_ASSOC);

        
            // Exibe os resultados em uma tabela
            if ($resultProdutosVendidos) {
                echo '
                <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
                    <div class="container">
                        <a href="#" class="navbar-brand">
                            <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
                        </a>
                        
                    </div>
                </nav>
            ';
            
                echo '<div class="mt-5 text-center container">';
                echo'<div class="d-flex text-center">';
                echo'<a class="btn btn-warning mt-3" href="relatorio.php">Voltar</a>';
                echo '<h3 class="text-center container">Produtos Vendidos </h3>';
                echo'</div>';
                echo '<table class="table table-striped table-bordered mt-5" container">';
                echo '<tr class="thead-dark text-center">';
                echo '<th class="w-25">Data</th>';
                echo '<th class="w-25">Produto</th>';
                echo '<th class="w-25">Quantidade de Vendas</th>';
                echo '</tr>';

                foreach ($resultProdutosVendidos as $produto) {
                    $dataFormatada = date('d, M, Y', strtotime($produto['data_pedido']));

                    echo '<tr >';
                    echo "<td >{$dataFormatada}</td>";
                    echo "<td >{$produto['nome_produto']}</td>";
                    echo "<td >{$produto['quantidade_vendas']}</td>";
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';

                // Se a opção escolhida for gerar PDF
                if (isset($_POST['gerarPDF'])) {
                    // Limpar o buffer de saída antes de gerar o PDF
                    ob_clean();

                    // Gerar PDF
                    $pdf = new FPDF();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', 'B', 16);
                    $pdf->Cell(40, 10, "Relatorio de Produtos", 0, 1, 'C'); // Centralizar o título

                    // Cabeçalho da tabela
                    $pdf->SetFont('Arial', 'B', 14);
                    $pdf->Cell(40, 10, "Data", 1);
                    $pdf->Cell(60, 10, "Produto", 1);
                    $pdf->Cell(40, 10, "Quantidade", 1);
                    $pdf->Ln(); // Nova linha

                    // Dados da tabela
                    $pdf->SetFont('Arial', '', 14);
                    foreach ($resultProdutosVendidos as $produto) {
                        $dataFormatada = date('d, M, Y', strtotime($produto['data_pedido']));

                        $pdf->Cell(40, 10, $dataFormatada, 1);
                        $pdf->Cell(60, 10, $produto['nome_produto'], 1);
                        $pdf->Cell(40, 10, $produto['quantidade_vendas'], 1);
                        $pdf->Ln(); // Nova linha
                    }

                    // Saída do PDF
                    $pdf->Output();
                }
            } else {
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
            echo '<div class="alert alert-danger text-center mt-5" role="alert">
            <h3>"Nenhum resultado encontrado para o período selecionado.</h3>
            
            </div>';
            echo ' <a class="btn btn-warning mt-3" href="./relatorio.php">Voltar</a>';
            echo' </div>';
            }
        }
    }
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>



</body>

</html>
