<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];
    $imagem = $_FILES["imagem"]["name"];
    $tipo = $_POST["tipo"];

    // Conectar ao banco de dados (substitua pelos seus dados de conexão)
    $conexao = new mysqli("localhost", "root", "", "cadastro");

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }
    $diretorio_destino = "produto/uploads/";

// Verifica se o diretório de destino existe, caso contrário, cria-o
if (!file_exists($diretorio_destino)) {
    mkdir($diretorio_destino, 0777, true);
}

$imagem = $_FILES["imagem"]["name"];
$caminho_imagem = $diretorio_destino . $imagem;

if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_imagem)) {
    // Resto do código
     // Conectar ao banco de dados (substitua pelos seus dados de conexão)
     $conexao = new mysqli("localhost", "root", "", "cadastro");
} else {
    echo "Erro ao fazer o upload da imagem.";
}
    // Inserir o produto no banco de dados com o caminho da imagem
    $sql = "INSERT INTO produtos (nome, descricao, preco,estoque, imagem, tipo) VALUES ('$nome', '$descricao', '$preco','$estoque', '$caminho_imagem', '$tipo')";

    if ($conexao->query($sql) === TRUE) {
        echo "Produto adicionado com sucesso!";
        header('Location: lista_produtos.php');
    } else {
        echo "Erro ao adicionar o produto: " . $conexao->error;
    }

    $conexao->close();
} else {
    echo "Erro ao fazer o upload da imagem.";
}


?>