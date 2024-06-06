<?php
require('./fpdf186/fpdf.php');
include '../../usuario/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processa o formulário quando as datas são enviadas
    $dataInicial = $_POST['dataInicial'];
    $dataFinal = $_POST['dataFinal'];

    // Consultas SQL
    $sqlMes = "SELECT DATE_FORMAT(data_pedido, '%Y-%m') AS mes, SUM(valor_total) AS total 
               FROM pedido 
               WHERE data_pedido BETWEEN ? AND ? 
               GROUP BY DATE_FORMAT(data_pedido, '%Y-%m')";

    $sqlClientes = "SELECT c.nome, p.pedido_id, SUM(p.valor_total) AS total_gasto 
                    FROM pedido p
                    JOIN cliente c ON p.usuario_id = c.usuario_id 
                    WHERE p.data_pedido BETWEEN ? AND ? 
                    GROUP BY c.nome, p.pedido_id";

    $sqlItens = "SELECT dp.pedido_id, pr.nome AS item_nome, dp.quantidade, (dp.quantidade * pr.preco) AS preco_total, c.nome AS cliente_nome
                 FROM detalhes_pedido dp
                 JOIN produtos pr ON dp.produto_id = pr.produto_id
                 JOIN pedido p ON dp.pedido_id = p.pedido_id 
                 JOIN cliente c ON p.usuario_id = c.usuario_id
                 WHERE p.data_pedido BETWEEN ? AND ?";

    try {
        // Preparar e executar a consulta para o total por mês
        $stmtMes = $conn->prepare($sqlMes);
        $stmtMes->bind_param('ss', $dataInicial, $dataFinal);
        $stmtMes->execute();
        $resultMes = $stmtMes->get_result();

        // Preparar e executar a consulta para o gasto por cliente
        $stmtClientes = $conn->prepare($sqlClientes);
        $stmtClientes->bind_param('ss', $dataInicial, $dataFinal);
        $stmtClientes->execute();
        $resultClientes = $stmtClientes->get_result();

        // Preparar e executar a consulta para os itens de cada pedido
        $stmtItens = $conn->prepare($sqlItens);
        $stmtItens->bind_param('ss', $dataInicial, $dataFinal);
        $stmtItens->execute();
        $resultItens = $stmtItens->get_result();

        if ($resultMes->num_rows > 0) {
            // Configurações para o PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);

            // Título
            $pdf->Cell(0, 10, 'Relatorio de Ganhos', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Periodo: ' . date('d/m/Y', strtotime($dataInicial)) . ' - ' . date('d/m/Y', strtotime($dataFinal)), 0, 1, 'C');
            $pdf->Ln(10);

            // Tabela de faturamento por mês
            $pdf->SetFillColor(229, 229, 229);
            $pdf->SetTextColor(0);
            $pdf->Cell(60, 10, 'Mes', 1, 0, 'C', true);
            $pdf->Cell(60, 10, 'Faturamento', 1, 1, 'C', true);
            $pdf->SetFillColor(255);
            $pdf->SetFont('Arial', '', 12);
            while ($row = $resultMes->fetch_assoc()) {
                $pdf->Cell(60, 10,  date('m/Y', strtotime($row["mes"])), 1, 0, 'C', false);
                $pdf->Cell(60, 10, "R$ " . number_format($row["total"], 2, ',', '.'), 1, 1, 'C', false);
            }

            // Tabela de gasto por cliente
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Gasto por Cliente', 0, 1, 'C');
            $pdf->SetFillColor(229, 229, 229);
            $pdf->Cell(60, 10, 'Cliente', 1, 0, 'C', true);
            $pdf->Cell(60, 10, 'Pedido', 1, 0, 'C', true);
            $pdf->Cell(60, 10, 'Total Gasto', 1, 1, 'C', true);
            $pdf->SetFillColor(255);
            $pdf->SetFont('Arial', '', 12);
            $clientes = [];
            while ($row = $resultClientes->fetch_assoc()) {
                $pdf->Cell(60, 10, $row["nome"], 1, 0, 'C', false);
                $pdf->Cell(60, 10, $row["pedido_id"], 1, 0, 'C', false);
                $pdf->Cell(60, 10, "R$ " . number_format($row["total_gasto"], 2, ',', '.'), 1, 1, 'C', false);
                $clientes[$row["pedido_id"]][] = $row;
            }

            // Tabela de itens por pedido
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Itens por Pedido', 0, 1, 'C');
            $pdf->SetFillColor(229, 229, 229);
            $pdf->Cell(40, 10, 'Pedido', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Cliente', 1, 0, 'C', true);
            $pdf->Cell(55, 10, 'Item', 1, 0, 'C', true);
            $pdf->Cell(30, 10, 'Quantidade', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'Total', 1, 1, 'C', true);
            $pdf->SetFillColor(255);
            $pdf->SetFont('Arial', '', 12);

            $currentPedidoId = null;
            $currentClienteNome = null;

            while ($row = $resultItens->fetch_assoc()) {
                if ($row["pedido_id"] != $currentPedidoId) {
                    $currentPedidoId = $row["pedido_id"];
                    $currentClienteNome = $row["cliente_nome"];
                    $pdf->Cell(40, 10, $row["pedido_id"], 1, 0, 'C', false);
                    $pdf->Cell(40, 10, $row["cliente_nome"], 1, 0, 'C', false);
                } else {
                    $pdf->Cell(40, 10, '', 1, 0, 'C', false);
                    $pdf->Cell(40, 10, '', 1, 0, 'C', false);
                }
                $pdf->Cell(55, 10, $row["item_nome"], 1, 0, 'C', false);
                $pdf->Cell(30, 10, $row["quantidade"], 1, 0, 'C', false);
                $pdf->Cell(25, 10, "R$ " . number_format($row["preco_total"], 2, ',', '.'), 1, 1, 'C', false);
            }

            // Limpa o buffer de saída
            ob_clean();

            // Saída do PDF
            $pdf->Output();
        } else {
            echo 'Nenhum resultado encontrado para o período selecionado.';
        }
    } catch (Exception $e) {
        echo 'Erro ao gerar o relatório: ' . $e->getMessage();
    }
}
?>
