<!DOCTYPE html>
<html lang="pt-br">
<!-- link bootstrap   -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Sparta</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!--  ícones do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./public/style.css">

</head>

<body>


  <!-- menu-->
  <div class="bg-warning text-center py-1 ">
    <p>FRETE GRÁTIS para todo o BRASIL em compras a partir de R$149,90. Prazo de entrega de 2 a 10 dias úteis.</p>
  </div>

  <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-1 box-shadow">
    <div class="container">

      <img class="imagem-login" src="./img/Sparta Suplementos - Logo.png" alt="sparta" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <!-- carrinho de compra-->
          <li class="nav-item mr-5">
            <p class="text-center"><a class="nav-link text-warning" href="carrinho/carrinho.php">
                <i class="bi bi-cart" data-bs-toggle="tooltip" data-bs-placement="top" title="Carrinho de Compras"></i><br>
                Carrinho</a></p>
          </li>
          <!--Perfil-->
          <?php
          if (!isset($_SESSION)) {
            session_start();
          }
          include("usuario/conexao.php");
          if (isset($_SESSION['logado']) && $_SESSION['logado'] === 2) {
            echo '<li class="nav-item mr-5">
                                    <p class="text-center">
                                        <a class="nav-link text-warning" href="./carrinho/relatorio/relatorio_compra.php">
                                        <i class="bi bi-bag-check " data-bs-toggle="tooltip" data-bs-placement="top" title="Minhas Compras"></i><br>
                                            Minhas compras
                                        </a>
                                    </p>
                                </li>';
            echo '<li class="nav-item mr-5">
                      <p class="text-center">
                          <a class="nav-link text-warning" href="usuario/perfil.php">
                              <i class="bi bi-person-circle " data-bs-toggle="tooltip" data-bs-placement="top" title="Configuração"></i><br>
                              Perfil
                          </a>
                      </p>
                  </li>';
            echo '<li class="nav-item mr-5">
                  <p class="text-center">
                      <a class="nav-link text-warning" href="index.php?logout=1">
                          <i class="bi bi-box-arrow-right" data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                          Sair
                      </a>
                  </p>
              </li>';

            // Processamento do logout
            if (isset($_GET['logout'])) {
              $_SESSION['logado'] = 1;
              $_SESSION['usuario_id'] = 0;
              $_SESSION['nome'] = ''; // Armazene o nome na sessão
              $_SESSION['email'] = '';
              $_SESSION['perfil'] = '';
              $_SESSION['cep_usuario'] = '';
              header("location: index.php");
              exit();
            }
          } else {
            echo '<!-- Tela Login-->
                  <li class="nav-item mr-5">
                      <p class="text-center"><a class="nav-link text-warning" href="usuario/login.php"><i
                          class="bi bi-box-arrow-in-left " data-bs-toggle="tooltip" data-bs-placement="top"
                          title="Login"></i><br>
                          Login</a>
                      </p>
                  </li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container text-center mt-3">
    <div class="row align-items-start">
      <div class="col">
        <img class="imagem-login" src="img/suplemento-alimentar-o-que-e-par.png" alt="sparta" />
      </div>
      <div class="col">
        <h2 class="m-5 ">Seja Bem vindo</h2>
        <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === 2){ include 'usuario/id_usuario.php';} ?>
      </div>
      <div class="col">
        <img class="imagem-login" src="img/suplementos.png" alt="sparta" />
      </div>
    </div>
  </div>

  <!-- filtro e nome login-->

  <div class="dropdown-divider m-3"></div>
  <!-- produtos vindo do banco-->

  <!-- Início do carrossel -->
  <div id="carouselProdutos" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php
      $conexao = new mysqli("localhost", "root", "", "cadastro");

      if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
      }

      $sql = "SELECT * FROM produtos";
      $resultado = $conexao->query($sql);

      if ($resultado !== false && $resultado->num_rows > 0) {
        // Se houver resultados, execute o loop para exibir os produtos
      } else {
        echo "Nenhum produto cadastrado.";
      }

      $active = true;
      $contador = 0;
      if ($resultado !== false && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
          if ($contador % 3 == 0) {
            echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
            echo '<div class="row container mx-auto">';
          }
          echo '<div class="col-md-4 " >';
          echo '<div class="mt-3">';
          echo '<div class="card text-center align-items-center" style="height: 18rem; width: 20rem;">';
          echo '<div class="p-2">';
          echo '<img class="m-1 img-fluid" style="height: 6rem; width: 5rem;" src="http://localhost/sparta/adm/produto/' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
          echo '<div class="card-body">';
          echo '<h4>' . $row["nome"] . '</h4>';
          echo '<p>' . $row["descricao"] . '</p>';

          echo '<a class="btn btn-warning mt-2" href="carrinho/index.php">Ver Mais</a>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          $contador++;
          if ($contador % 3 == 0 || $contador == $resultado->num_rows) {
            echo '</div>';
            echo '</div>';
            $active = false;
          }
        }
      } else {
        echo "Nenhum produto cadastrado.";
      }
      ?>
    </div>
    <a class="carousel-control-prev " href="#carouselProdutos" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon " aria-hidden="true"></span>
      <span class="sr-only ">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselProdutos" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Próximo</span>
    </a>
  </div>
  <!-- Fim do carrossel -->

  <!-- Kits -->
  <div class="dropdown-divider mt-3"></div>
  <h2 class="text-center m-5"> Kit Ideal Para Você</h2>
  <div class="dropdown-divider"></div>
  <section class=" container mt-3 d-sm-flex ">

    <div class="card col-sm-4 m-1">
      <div class="container">
        <img class="card-img-top" src="img/ki1.jpg" alt="Imagem de capa do card">
        <div class="card-body text-center">
          <h2 class="card-title">Hipertofria</h2>
          <p class="">Combo Definição</p>
          <h3 class="card-text m-3 ">R$210,00</h3>
          <a href="carrinho/index.php" class="btn btn-warning m-3">Ver mais</a>
        </div>
      </div>
    </div>

    <div class="card col-sm-4 m-1">
      <div class="container">
        <img class="card-img-top" src="img/kit4.jpg" alt="Imagem de capa do card">
        <div class="card-body text-center  ">
          <h2 class="card-title">Power Treino</h2>
          <p class="">Melhore Seu Treino</p>
          <h3 class="card-text  ">R$190,00</h3>
          <a href="carrinho/index.php" class="btn btn-warning m-2">Ver mais</a>
        </div>
      </div>
    </div>


    <div class="card col-sm-4 m-1 ">
      <div class="container">
        <img class="card-img-top" src="img/kit3.jpg" alt="Imagem de capa do card">
        <div class="card-body text-center ">
          <h2 class="card-title">Ganho de Massa</h2>
          <p class="">Ganhe massa muscular</p>
          <h3 class="card-text ">R$270,00</h3>
          <a href="carrinho/index.php" class="btn btn-warning m-3">Ver mais</a>
        </div>
      </div>
    </div>
  </section>

  <div class="dropdown-divider mt-3 "></div>


  <!--Duvidas-->
  <section class="container text-center">
    <div class="my-3">

      <h2 class="display-4 text-warning">Perguntas Frequentes</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6" id="perguntasFrequentes">
        <div class="pergunta py-2">
          <a class="lead font-weight-bold text-warning" data-toggle="collapse" href="#pergunta1" aria-expanded="true" aria-controls="pergunta1">→ O que é whey protein ?</a>
          <div id="pergunta1" class="collapse show" data-parent="#perguntasFrequentes" role="tabpanel">
            <p>
              Whey trata-se de uma alternativa de boa qualidade e baixo custo para as pessoas que desejam aumentar o
              consumo de proteínas dentro do planejamento alimentar diário.
            </p>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="pergunta py-2">
          <a class="lead font-weight-bold text-warning" data-toggle="collapse" href="#pergunta2" aria-expanded="true" aria-controls="pergunta2">→ Como consumir whey Protein ?</a>
          <div id="pergunta2" class="collapse" data-parent="#perguntasFrequentes" role="tabpanel">
            <p>
              Sugerimos 30g do produto como porção, podendo ser diluído no líquido e quantidade de sua preferência.
              Podem ser consumidas quantas porções o indivíduo precisar ao dia.
            </p>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="pergunta py-2">
          <a class="lead font-weight-bold text-warning" data-toggle="collapse" href="#pergunta3" aria-expanded="true" aria-controls="pergunta3">→ Beneficios do whey protein ?</a>
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
            <li><a class="text-warning" href="usuario/filiais.php">São Paulo</a></li>
            <li><a class="text-warning" href="usuario/filiais.php">Minas Gerais</a></li>
            <li><a class="text-warning" href="usuario/filiais.php">Braslia</a></li>
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
              <a class="btn btn-outline-warning btn-sm btn-block md-2 mt-1" href="https://www.facebook.com/" style="max-width: 140px">Facebook</a>
            </li>
            <li>
              <a class="btn btn-outline-warning btn-sm btn-block md-2 mt-1" href="https://twitter.com" style="max-width: 140px">Twiter</a>
            </li>
            <li>
              <a class="btn btn-outline-warning btn-sm btn-block md-2 mt-1" href="https://www.instagram.com/" style="max-width: 140px">Instagram</a>
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