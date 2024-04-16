<!DOCTYPE html>
<html lang="pt-br">
<!-- link bootstrap   -->

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
  <link rel="stylesheet" href="../public/style.css">

</head>

<body>


  <!-- menu-->
  <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
    <div class="container">

      <a href="../index.php" class="navbar-brand">
          <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
      </a>  
      <button class="navbar-toggler" type="button" data-tog   gle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <h4><a class="nav-link text-warning" href="../carrinho/relatorio/relatorio_compra.php">Minhas Compras</a>
            </h4>
          </li>
          <li class="nav-item">
            <h4><a class="nav-link text-warning" href="../carrinho/carrinho.php">Carrinho</a></h4>
          </li>
          <li class="nav-item">
            <h4><a class="nav-link text-warning" href="../usuario/login.php">Sair</a></h4>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <h1 class="m-5 text-center">Bem vindo </h1>


  <!-- filtro e nome login-->
  <section class="container text-center ">
    <div>
      <?php

      include 'id_usuario.php';
      ?>
    </div>
    <br>
    <div>
      <form action="exibir_produtos_por_tipo.php" method="GET">
        <label for="tipo"><p class="font-weight-bold m-1">Escolha o produto:</p></label>
        <select class="font-weight-bold m-1 border-0" name="tipo" id="tipo">
          <option value="whey">Whey Protein </option>
          <option value="creatina">Creatina</option>
          <option value="pretreino">Pré-treino</option>
          <option value="bcaa">BCAA</option>
          <option value="glutamina">Glutamina</option>
          <option value="Kit">kit</option>
        </select>
        <input class="btn btn-warning m-1 " type="submit" value="Mostrar Produtos">
      </form>
    </div>
  </section>
  <div class="dropdown-divider m-3"></div>
  <!-- produtos vindo do banco-->

  <section class="d-flex container produtos">

    <?php
    // Conectar ao banco de dados (substitua pelos seus dados de conexão)
    $conexao = new mysqli("localhost", "root", "", "cadastro");

    if ($conexao->connect_error) {
      die("Erro na conexão: " . $conexao->connect_error);
    }

    // Consultar os produtos no banco de dados
    $sql = "SELECT * FROM produtos";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
      while ($row = $resultado->fetch_assoc()) {
        echo '<div class="mt-3 m-3 " >';
        echo '<div class="card text-center align-items-center" style="width: 16rem;  height: 24rem;">';
             echo '<div class="p-3">';
                 echo '<img class="m-3 "style="height: 6rem;width: 6rem;" src="http://localhost/sparta/adm/produto/' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
                   echo '<div class="card-body">';
                   echo '<h3 >' . $row["nome"] . '</h3>';
                   echo '<p>' . $row["descricao"] . '</p>';

                   echo '<p class="card-text">Preço: R$ ' . number_format($row["preco"], 2, ',', '.') . '</p>';
                   echo '<a class="btn btn-warning mt-3" href="../carrinho/index.php"">Comprar</a>';
                 echo '</div>';
             echo '</div>';
         echo '</div>';
     echo '</div>';
      }
    } else {
      echo "Nenhum produto cadastrado.";
    }
    $conexao->close();
    ?>

  </section>
  <!-- Kits -->
  <div class="dropdown-divider mt-5"></div>
  <h1 class="text-center m-5"> Kit Ideal Para Você</h1>
  <div class="dropdown-divider"></div>
  <section class=" container mt-5 d-sm-flex ">

    <div class="card col-sm-4 p-1 m-1">
      <div class="container">
        <img class="card-img-top" src="../img/ki1.jpg" alt="Imagem de capa do card">
        <div class="card-body text-center mt-3">
          <h2 class="card-title">Hipertofria</h2>
          <p class="">Combo Definição</p>
          <p class="">Brinde Garrafa</p>
          <h3 class="card-text m-3 ">R$210,00</h3>
          <a href="../carrinho/index.php" class="btn btn-warning m-3">Comprar</a>
        </div>
      </div>
    </div>

    <div class="card col-sm-4 p-1 m-1">
      <div class="container">
        <img class="card-img-top" src="../img/kit4.jpg" alt="Imagem de capa do card">
        <div class="card-body text-center  mt-3">
          <h2 class="card-title">Power Treino</h2>
          <p class="">Melhore Seu Treino</p>
          <p class="">Brinde Garrafa</p>
          <h3 class="card-text m-3 ">R$190,00</h3>
          <a href="../carrinho/index.php" class="btn btn-warning m-3">Comprar</a>
        </div>
      </div>
    </div>


    <div class="card col-sm-4 p-1 m-1">
      <div class="container">
        <img class="card-img-top" src="../img/kit3.jpg" alt="Imagem de capa do card">
        <div class="card-body text-center  mt-2">
          <h2 class="card-title">Ganho de Massa</h2>
          <p class="">Ganhe massa muscular</p>
          <p class="">Brinde Garrafa</p>
          <h3 class="card-text m-3">R$270,00</h3>
          <a href="../carrinho/index.php" class="btn btn-warning m-3">Comprar</a>
        </div>
      </div>
    </div>
  </section>

  <div class="dropdown-divider mt-5 "></div>


  <!--Duvidas-->
  <section class="container text-center">
    <div class="my-5">
     
      <h2 class="display-4 text-warning">Perguntas Frequentes</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6" id="perguntasFrequentes">
        <div class="pergunta py-2">
          <a class="lead font-weight-bold text-warning" data-toggle="collapse" href="#pergunta1" aria-expanded="true"
            aria-controls="pergunta1">→ O que é whey protein ?</a>
          <div id="pergunta1" class="collapse show" data-parent="#perguntasFrequentes" role="tabpanel">
            <p>
              Whey trata-se de uma alternativa de boa qualidade e baixo custo para as pessoas que desejam aumentar o
              consumo de proteínas dentro do planejamento alimentar diário.
            </p>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="pergunta py-2">
          <a class="lead font-weight-bold text-warning" data-toggle="collapse" href="#pergunta2" aria-expanded="true"
            aria-controls="pergunta2">→ Como consumir whey Protein ?</a>
          <div id="pergunta2" class="collapse" data-parent="#perguntasFrequentes" role="tabpanel">
            <p>
              Sugerimos 30g do produto como porção, podendo ser diluído no líquido e quantidade de sua preferência.
              Podem ser consumidas quantas porções o indivíduo precisar ao dia.
            </p>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="pergunta py-2">
          <a class="lead font-weight-bold text-warning" data-toggle="collapse" href="#pergunta3" aria-expanded="true"
            aria-controls="pergunta3">→ Beneficios do whey protein ?</a>
          <div id="pergunta3" class="collapse" data-parent="#perguntasFrequentes" role="tabpanel">
            <p>
              Fornece sensação de saciedade.<br>Ajuda no combate a inflamação muscular.<br>
              Fonte de proteínas de alto valor biológico.<br>
              Ajuda no aumento de volume de massa magra.<br>
              Potencializa a recuperação do tecido muscular.<br>
              Pode ser usado tanto em dietas de aumento como de redução de massa.
            </p>
          </div>
        </div>
        <div class="dropdown-divider"></div>


  </section>
  <!--Footer-->
  <footer class="bg-dark text-white ">
    <div class="container ">
      <div class="d-flex justify-content-center">

        <div class="mt-3">
          <h4 class="h6">Franquias</h4>
          <ul class="list-unstyled  mt-3">
            <li><a class="text-warning" href="#">São Paulo</a></li>
            <li><a class="text-warning" href="#">Minas Gerais</a></li>
            <li><a class="text-warning" href="#">Braslia</a></li>
          </ul>
        </div>

        <div class="col-md-3 mt-3">
          <h4 class="h6">Contato</h4>
          <ul class="list-unstyled text-white mt-3">
            <li>Spartan@hotmail.com</li>
            <li>21 99999-9999</li>
            <li>De Seg. à Sex. das 8h às 18h</li>
          </ul>
        </div>
        <div class="col-md-2 mt-3">
          <h4 class="h6">REDES SOCIAIS</h4>
          <ul class="list-unstyled">
            <li>
              <a class="btn btn-outline-warning btn-sm btn-block md-2 mt-1" href="#"
                style="max-width: 140px">Facebook</a>
            </li>
            <li>
              <a class="btn btn-outline-warning btn-sm btn-block md-2 mt-1" href="#" style="max-width: 140px">Twiter</a>
            </li>
            <li>
              <a class="btn btn-outline-warning btn-sm btn-block md-2 mt-1" href="#"
                style="max-width: 140px">Instagram</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="bg-warning text-center py-1">

    </div>
  </footer>
</body>

</html>