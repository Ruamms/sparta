<?php
$host = 'localhost';
$db = 'cadastro';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}
// Verifica se a conexão foi estabelecida com sucesso
if ($conn === false) {
    echo "Erro ao conectar ao banco de dados.";
    exit();
}

// Verifica se foi passado um ID válido
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Obtém o ID do produto a ser excluído
    $produto_id = $_GET['id'];

    // Prepara a consulta para excluir o produto com base no ID
    $sql = "DELETE FROM produtos WHERE produto_id = $produto_id";

    // Executa a consulta
    if(mysqli_query($conn, $sql)) {
        // Produto excluído com sucesso
        header('Location: lista_produtos.php');
    } else {
        // Se houver algum erro ao excluir o produto
        echo "Erro ao excluir o produto: " . mysqli_error($conn);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);
} else {
    // Se nenhum ID válido foi passado, redireciona para a página principal
    echo 'Não foi encontrado ID válido.';
    exit();
}
?>
