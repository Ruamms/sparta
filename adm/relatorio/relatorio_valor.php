<!DOCTYPE html>
<html lang="pt-br">
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
    <title>Valor</title>
</head>

<body>
<?php
require('./fpdf186/fpdf.php');
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processa o formulário quando as datas são enviadas
    $dataInicial = $_POST['dataInicial'];
    $dataFinal = $_POST['dataFinal'];

    // Query SQL para somar os valores da coluna "valor_total" na tabela "pedidos" dentro do intervalo de datas
    $sql = "SELECT DATE_FORMAT(data_pedido, '%Y-%m') AS mes, SUM(valor_total) AS total FROM pedido WHERE data_pedido BETWEEN '$dataInicial' AND '$dataFinal' GROUP BY DATE_FORMAT(data_pedido, '%Y-%m')";

    try {
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Configurações para o PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 18);

            // Título
            $pdf->Cell(40, 10, utf8_decode('Relatório de Faturamento'));

            // Informações sobre o período
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'I', 14);
            $pdf->Cell(0, 10, utf8_decode("Período: $dataInicial até $dataFinal"), 0, 1, 'C');

            // Cabeçalho da tabela
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60, 10, utf8_decode('Mês'), 1, 0, 'C');
            $pdf->Cell(60, 10, utf8_decode('Faturamento'), 1, 1, 'C');

            // Dados da tabela
            $pdf->SetFont('Arial', '', 12);
            while ($row = $result->fetch_assoc()) {
                $pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row["mes"]), 1, 0, 'C'); // Convertendo para ISO-8859-1
                $pdf->Cell(60, 10, "R$ " . number_format($row["total"], 2), 1, 1, 'C');
            }

            // Faturamento total
            $sqlTotal = "SELECT SUM(valor_total) AS total FROM pedido WHERE data_pedido BETWEEN '$dataInicial' AND '$dataFinal'";
            $resultTotal = $conn->query($sqlTotal);
            if ($resultTotal->num_rows > 0) {
                $rowTotal = $resultTotal->fetch_assoc();
                $total = $rowTotal["total"];
                $pdf->Ln(10);
                $pdf->Cell(0, 10, "Faturamento Total: R$ " . number_format($total, 2), 0, 1, 'C');
            }

            // Limpa o buffer de saída
            ob_clean();

            // Saída do PDF
            $pdf->Output();
        } else {
            throw new Exception("Nenhum dado encontrado para o período especificado.");
        }
    } catch (Exception $e) {
        // Exibe mensagem de erro
        echo '<div class="alert alert-danger text-center mt-5" role="alert">
                <h3>' . $e->getMessage() . '</h3>
                <a class="btn btn-warning mt-3" href="./relatorio.php">Voltar</a>
            </div>';
    }
} else {
    // Formulário não enviado
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
            <a class="btn btn-warning mt-3" href="./relatorio.php">Voltar</a>
        </div>';
    echo' </div>';
}
?>


</body>

</html>