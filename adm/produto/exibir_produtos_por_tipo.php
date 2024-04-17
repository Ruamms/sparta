
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>sparta</title>
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

    <title>Produto Selecionado</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-dark p-2 box-shadow">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">

                        <h4><a class="nav-link text-warning" href="lista_produtos.php">Produtos</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../usuario_adm/usuarios.php">Usuarios</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../relatorio/relatorio.php">Relatorios</a></h4>
                    </li>

                    <li class="nav-item">
                        <h4><a class="nav-link text-warning" href="../usuario/login.php">Sair</a></h4>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="container ">
    <table class="table table-striped table-bordered mt-5">
            <tr class="thead-dark text-center">
                <th>Imagem</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Estoque</th>
                <th>Tipo</th>
                <th>Preço</th>
                <th>Ação</th>
            </tr>
    <?php
// Conectar ao banco de dados
$conexao = new mysqli("localhost", "root", "", "cadastro");

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Verificar se o tipo foi especificado via parâmetro GET
if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];

    // Consulta SQL para selecionar produtos com base no tipo
    $sql = "SELECT * FROM produtos WHERE tipo = '$tipo'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<h2 class='text-center mt-5'>Produtos do Tipo: $tipo</h2>";
        while ($row = $resultado->fetch_assoc()) {
            $produto_id = $row["produto_id"];
            $nome = $row["nome"];
            $descricao = $row["descricao"];
            $preco = $row["preco"];
            $imagem = $row["imagem"];
            
            echo '<tr class="text-center">';
            echo '<td><img class="m-3"  style="height: 5rem;width: 5rem;" src="http://localhost/sparta/adm/produto/' . $row["imagem"] . '" alt="' . $row["nome"] . '"></td>';
            echo '<td class="align-middle" >' . $row["nome"] . '</td>';
            echo '<td class="align-middle">' . $row["descricao"] . '</td>';
            echo '<td class="align-middle">' . $row["estoque"] . '</td>';
            echo '<td class="align-middle">Tipo: ' . $row["tipo"] . '</td>';
            echo '<td class=" align-middle">Preço: R$ ' . number_format($row["preco"], 2, ',', '.') . '</td>';
            echo '<td> <a class="mt-4 btn btn-success h-25   "href="editar_produto.php?id=' . $row["produto_id"] . '">Editar</a></td>';
            echo '</tr>';
        }
    } else {
        echo "<p>Nenhum produto encontrado para o tipo: $tipo</p>";
    }
} else {
    echo "<p>Tipo não especificado.</p>";
}

$conexao->close();
?>
    </section>
</body>
</html>
