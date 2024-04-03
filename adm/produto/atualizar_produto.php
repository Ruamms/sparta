<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto_id = $_POST['produto_id'];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];
    $tipo = $_POST["tipo"];

    // Conectar ao banco de dados e atualizar os detalhes do produto com base no ID
    $conexao = new mysqli("localhost", "root", "", "cadastro");

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    // Verifica se um novo arquivo de imagem foi enviado
    if ($_FILES['nova_imagem']['name']) {
        $imagem_temp = $_FILES['nova_imagem']['tmp_name'];
        $imagem_nome = $_FILES['nova_imagem']['name'];
        $caminho_imagem = 'produto/uploads/' . $imagem_nome; // Substitua pelo caminho real onde deseja armazenar as imagens

        // Move a imagem para o local desejado
        if (move_uploaded_file($imagem_temp, $caminho_imagem)) {
            // Atualiza a coluna "imagem" no banco de dados
            $sql = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = $preco,estoque = $estoque, tipo = '$tipo', imagem = '$caminho_imagem' WHERE produto_id = $produto_id";
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        // Não houve upload de imagem, atualiza apenas os outros campos
        $sql = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = $preco,estoque = $estoque, tipo = '$tipo' WHERE produto_id = $produto_id";
    }

    if ($conexao->query($sql) === TRUE) {
        header("Location: lista_produtos.php"); // Redireciona de volta à página de listagem de produtos após a atualização
    } else {
        echo "Erro ao atualizar o produto: " . $conexao->error;
    }

    $conexao->close();
}

?>
