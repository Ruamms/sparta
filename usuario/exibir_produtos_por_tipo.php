<!DOCTYPE html>
<html lang="pt-br">
<!-- link bootstrap   -->

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
    <link rel="stylesheet" href="../public/style.css">

</head>

<body>


     <!-- menu-->
  <nav class="navbar navbar-expand-md navbar-light bg-dark py-2 box-shadow">
    <div class="container">
      <a href="../index.php" class="navbar-brand">
        <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <h3><a class="nav-link text-warning" href="../usuario/produtosWey.php">Inicio</a></h3>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    <!-- filtro e nome login-->
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
        session_start();
        // Verifique se o usuário está logado
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // O usuário está logado, então exiba uma mensagem de boas-vindas com o nome
        
        } else {
            // O usuário não está logado, redirecione-o para a página de login
            header('Location: login.php');
            exit; // Certifique-se de que o script pare de ser executado após a redireção
        }

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
               
                echo "<h1 class='text-center mt-5'>$_SESSION[nome] Produtos do Tipo: $tipo</h1>";
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
                    echo '<td> <a class="btn btn-success h-25 mt-3  "href="../carrinho/index.php">Ver mais</a></td>';
                    echo '</tr>';
                }
            } else {
              echo '<a class="btn btn-success h-25 mt-3  "href="../carrinho/index.php">Comprar</a>';
                    echo '</div>';
                echo "<div class='alert alert-danger' role='alert'><p>Nenhum produto encontrado para o tipo: $tipo</p></div>";
            }
        } else {
            echo "<p>Tipo não especificado.</p>";
        }

        $conexao->close();
        ?>
    </section>