<?php
// Função para conectar ao banco de dados
function conectarBanco()
{
    $conexao = new mysqli("localhost", "root", "", "cadastro");
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }
    return $conexao;
}

// Editar Produto
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    $conexao = conectarBanco();

    $sql = "SELECT * FROM produtos WHERE produto_id = $produto_id";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        $nome = $row["nome"];
        $descricao = $row["descricao"];
        $preco = $row["preco"];
        $estoque = $row["estoque"];

        $tipo = $row["tipo"];
        $imagem = $row["imagem"];
    } else {
        echo "Produto não encontrado.";
    }

    $conexao->close();
} else {
    echo "ID do produto não especificado.";
}
// Deletar Produto
if (isset($_POST['deletar'])) {
    $produto_id = $_POST['produto_id'];

    $conexao = conectarBanco();

    $sql = "DELETE FROM produtos WHERE produto_id = $produto_id";

    if ($conexao->query($sql) === TRUE) {
        header('Location: lista_produtos.php');
        // Redirecionar para a página de lista de produtos ou fazer outra ação após a exclusão.
    } else {
        echo "Erro ao deletar o produto: " . $conexao->error;
    }

    $conexao->close();
}



?>
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
    <!--  ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../../public/style.css">

    <title>Editar produto</title>
</head>

<body>

    <!-- menu-->
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
                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../usuario_adm/usuarios.php">
                                <i class="bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Usuarios"></i><br>
                                Usuarios</a>
                        </p>
                    </li>


                    <!--Perfil-->
                    <li class="nav-item mr-5">

                        <p class="text-center"> <a class="nav-link text-warning" href="../relatorio/relatorio.php">

                                <i class="bi bi-clipboard2-data" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="relatorio"></i><br>
                                Relatorio</a></p>

                    </li>

                    <!-- sair-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning" href="../usuario_adm/login_adm.php">
                                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Sair"></i><br>
                                Sair</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <h3 class="text-center m-3">Editar produto</h3>

    <section class="container">

        <form class="" action="atualizar_produto.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="produto_id" value="<?php echo $produto_id; ?>">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="nome">Nome:</label>
                    <input class="form-control " type="text" name="nome" value="<?php echo $nome; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="preco">Preço:</label>
                    <input class="form-control" type="number" name="preco" value="<?php echo $preco; ?>" step="0.01"
                        required>
                </div>
            </div>

            

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="tipo">Tipo:</label>
                    <select class="form-control" name="tipo" required>
                        <option value="whey" <?php echo ($tipo == 'whey') ? 'selected' : ''; ?>>Whey</option>
                        <option value="creatina" <?php echo ($tipo == 'creatina') ? 'selected' : ''; ?>>Creatina</option>
                        <option value="pretreino" <?php echo ($tipo == 'pretreino') ? 'selected' : ''; ?>>Pré Treino
                        </option>
                        <option value="glutamina" <?php echo ($tipo == 'glutamina') ? 'selected' : ''; ?>>Glutamina
                        </option>
                        <option value="bcaa" <?php echo ($tipo == 'bcaa') ? 'selected' : ''; ?>>BCAA</option>
                        <option value="kit" <?php echo ($tipo == 'kit') ? 'selected' : ''; ?>>Kit</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="estoque">Estoque:</label>
                    <input class="form-control" type="number" name="estoque" value="<?php echo $estoque; ?>" step="0.01"
                        required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="descricao">Descrição:</label>
                    <textarea class="form-control" name="descricao" required><?php echo $descricao; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="imagem">Imagem Atual:</label>
                    <img src="<?php echo $imagem; ?>" alt="Imagem atual" width="90">

                </div>

                <div class="form-group col-md-6">


                    <label class="font-weight-bold" for="nova_imagem">Imagem Nova:</label>
                    <input class="form-control-file" type="file" name="nova_imagem">
                </div>
            </div>

            <input class="btn btn-warning w-100 mt-3" type="submit" value="Atualizar Produto">
        </form>
    </section>



    <div class="dropdown-divider mt-5 "></div>


</body>

</html>