<?php
// conexao.php
$host = 'localhost';
$db = 'cadastro';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}
require_once ('./fpdf186/fpdf.php');

if (isset($_POST['gerar_pdf'])) {
    // Receber os dados do formulário
    $data_inicial = $_POST['data_inicial'];
    $data_final = $_POST['data_final'];

    // Consulta ao banco de dados para obter os pedidos dentro do intervalo de datas
    $query = "SELECT c.nome, c.cpf, SUM(p.valor_total) AS total_comprado
              FROM pedido AS p
              INNER JOIN cliente AS c ON p.usuario_id = c.usuario_id
              WHERE p.data_pedido BETWEEN '$data_inicial' AND '$data_final'
              GROUP BY c.nome, c.cpf
              ORDER BY total_comprado DESC";

    $result = mysqli_query($conn, $query);



    // Gerar PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Título
    $pdf->Cell(0, 10, 'Relatorio de Clientes', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Periodo: ' . date('d/m/Y', strtotime($data_inicial)) . ' - ' . date('d/m/Y', strtotime($data_final)), 0, 1, 'C');
    $pdf->Ln(10);

    // Cabeçalhos da tabela
    $pdf->SetFillColor(229, 229, 229); // Cor de fundo #E0A800
    $pdf->SetTextColor(0); // Cor do texto branco
    $pdf->Cell(60, 10, 'Nome', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'CPF', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'Total Comprado', 1, 1, 'C', true);

    // Conteúdo da tabela
    $pdf->SetFillColor(255); // Cor de fundo branca para alternar
    $pdf->SetTextColor(0); // Cor do texto preto
    $pdf->SetFont('Arial', '', 12);
    $fill = false; // Variável para alternar cores de fundo
    $total_comprado = 0; // Variável para somar os valores
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(60, 10, $row['nome'], 1, 0, 'L', $fill);
        $pdf->Cell(50, 10, $row['cpf'], 1, 0, 'C', $fill);
        $pdf->Cell(50, 10, $row['total_comprado'], 1, 1, 'R', $fill);
        $total_comprado += $row['total_comprado']; // Adiciona o valor ao total
        $fill = !$fill; // Alterna a cor de fundo para cada linha
    }
    // Adiciona a linha com o total
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(110, 10, 'Total Geral', 1, 0, 'C', true);
    $pdf->Cell(50, 10, number_format($total_comprado, 2, ',', '.'), 1, 1, 'R', true);

    $pdf->Output();
}
?>