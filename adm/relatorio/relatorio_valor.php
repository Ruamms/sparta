<?php
require('./fpdf186/fpdf.php');
include '../../usuario/conexao.php';

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
            $pdf->SetFont('Arial', 'B', 16);

            // Título
            $pdf->Cell(0, 10, utf8_decode('Relatorio de Ganhos'), 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Periodo: ' . date('d/m/Y', strtotime($dataInicial)) . ' - ' . date('d/m/Y', strtotime($dataFinal)), 0, 1, 'C');
            $pdf->Ln(10);

            // Cabeçalhos da tabela
            $pdf->SetFillColor(229, 229, 229); // Cor de fundo #E0A800
            $pdf->SetTextColor(0); // Cor do texto preto
            $pdf->Cell(60, 10, 'Mes', 1, 0, 'C', true);
            $pdf->Cell(60, 10, 'Faturamento', 1, 1, 'C', true);

            // Dados da tabela
            $pdf->SetFillColor(255); // Cor de fundo branca para alternar
            $pdf->SetFont('Arial', '', 12);
            while ($row = $result->fetch_assoc()) {
                $pdf->Cell(60, 10, $row["mes"], 1, 0, 'C', false);
                $pdf->Cell(60, 10, "R$ " . number_format($row["total"], 2, ',', '.'), 1, 1, 'C', false);
            }

            // Faturamento total
            $sqlTotal = "SELECT SUM(valor_total) AS total FROM pedido WHERE data_pedido BETWEEN '$dataInicial' AND '$dataFinal'";
            $resultTotal = $conn->query($sqlTotal);
            if ($resultTotal->num_rows > 0) {
                $rowTotal = $resultTotal->fetch_assoc();
                $total = $rowTotal["total"];
                $pdf->Ln(10);
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 10, "Faturamento Total: R$ " . number_format($total, 2, ',', '.'), 0, 1, 'C');
            }

            // Limpa o buffer de saída
            ob_clean();

            // Saída do PDF
            $pdf->Output();
        }
    } catch (Exception $e) {
        echo 'Erro ao gerar o relatório: ' . $e->getMessage();
    }
}
?>
