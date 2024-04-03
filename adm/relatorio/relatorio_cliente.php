<?php
require('./fpdf186/fpdf.php'); // Certifique-se de incluir o caminho correto para o arquivo fpdf.php
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
            JOIN pedidos p ON u.usuario_id = p.id_usuario
            WHERE p.data_pedido BETWEEN '$data_inicial' AND '$data_final'
            GROUP BY u.usuario_id
            ORDER BY total_gasto DESC";

    $result = $conn->query($sql);
    // Cogigo para imprimir o pdf
    if ($result->num_rows > 0) {
        // Exibir os resultados
        $row = $result->fetch_assoc();
        $usuario_id = $row['usuario_id'];
        $nome_usuario = $row['nome'];
        $total_gasto = $row['total_gasto'];

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




        // Verificar se o botão de gerar PDF foi pressionado
        if (isset($_POST['gerar_pdf'])) {
            ob_start(); // Inicia o buffer de saída

            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="relatorio.pdf"');

            // Gerar o relatório em PDF
            // Gerar o relatório em PDF
            $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(40, 10, "Relatório de Clientes");

        $pdf->Ln(10);


            // Adicionar informações do cliente ao PDF
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(40, 10, "Cliente: $nome_usuario (Registro: $usuario_id)");
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 14);
            $pdf->Cell(40, 10, "Valor gasto: R$ " . number_format($total_gasto, 2), 0, 1, 'C');
            $pdf->Ln(10);

            $pdf->Output();

            ob_end_flush(); // Envia o buffer de saída e desativa o buffer de saída
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
        echo '<div class="alert alert-danger text-center mt-5" role="alert">';
        echo '<h3>';
        echo "Nenhum resultado encontrado para o período de $data_inicial a $data_final.";
        echo '</h3>';
       
        echo' </div>';
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

   


</body>

</html>