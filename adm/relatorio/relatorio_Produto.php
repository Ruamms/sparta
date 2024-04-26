<?php
require_once('./fpdf186/fpdf.php');
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe as datas do formulário
    $dataInicial = $_POST['data_inicial'];
    $dataFinal = $_POST['data_final'];

    // Consulta SQL para obter os produtos vendidos durante o período
    $queryProdutosVendidos = "SELECT p.nome AS produto, SUM(dp.quantidade) AS total_vendido
                              FROM detalhes_pedido AS dp
                              INNER JOIN produtos AS p ON dp.produto_id = p.produto_id
                              INNER JOIN pedido AS ped ON dp.pedido_id = ped.pedido_id
                              WHERE ped.data_pedido BETWEEN '$dataInicial' AND '$dataFinal'
                              GROUP BY dp.produto_id
                              ORDER BY total_vendido DESC";

    // Executa a consulta
    $resultProdutosVendidos = $conn->query($queryProdutosVendidos);

    // Inicializa o PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Título
    $pdf->Cell(0, 10, 'Relatorio de Produtos', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Periodo: ' . date('d/m/Y', strtotime($dataInicial)) . ' - ' . date('d/m/Y', strtotime($dataFinal)), 0, 1, 'C');
    $pdf->Ln(10);

    // Cabeçalhos da tabela com cor de fundo
    $pdf->SetFillColor(229, 229, 229); // Cor de fundo cinza
    $pdf->SetTextColor(0); // Cor do texto preto
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(80, 10, 'Produto', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'Quantidade Vendida', 1, 1, 'C', true);

    // Conteúdo da tabela
    $pdf->SetFillColor(255); // Cor de fundo branca para alternar
    $pdf->SetTextColor(0); // Cor do texto preto
    $pdf->SetFont('Arial', '', 12);
    $fill = false; // Variável para alternar cores de fundo

    // Dados da tabela
    $pdf->SetFont('Arial', '', 12);
    $fill = false; // Variável para alternar cores de fundo
    while ($row = $resultProdutosVendidos->fetch_assoc()) {
        $pdf->Cell(80, 10, utf8_decode($row['produto']), 1, 0, 'L', $fill);
        $pdf->Cell(50, 10, $row['total_vendido'], 1, 1, 'C', $fill);
        $fill = !$fill; // Alterna a cor de fundo para cada linha
    }

    // Saída do PDF
    $pdf->Output();
}
?>
