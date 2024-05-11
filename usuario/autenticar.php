<!DOCTYPE html>
<html lang="pt-br">
<!-- link bootstrap   -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>suplemento</title>
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
  <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
    <div class="container">

      <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

        </ul>
      </div>
    </div>
  </nav>
  <div class="mx-auto">
    <?php
    session_start();
    include 'conexao.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Use instruções preparadas para evitar injeção de SQL
    $query = "SELECT usuario_id, nome, perfil, bloqueado FROM usuario WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $email, $senha);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
      $stmt->bind_result($usuario_id, $nome, $perfil, $bloqueado);
      $stmt->fetch();

      if ($bloqueado == 1) {
        // Conta bloqueada
        echo '<div class="text-center container">';
        echo '<div class="alert alert-danger text-center mt-5" role="alert">
            <h3>Sua conta está bloqueada.</h3>
            
          </div>';
        echo '<a class="btn btn-warning mt-2" href="login.php">Voltar</a>';
        echo '</div>';
      } else {
        $_SESSION['usuario_id'] = $usuario_id;
        $_SESSION['nome'] = $nome; // Armazene o nome na sessão
        $_SESSION['email'] = $email;
        $_SESSION['perfil'] = $perfil;

        if ($perfil === 'cliente') {
          $_SESSION['logged_in'] = true;
          header('Location: produtosWey.php'); // Substitua com a página do cliente
    
        }  elseif ($perfil === 'funcionario') {
          $_SESSION['funcionario'] = true;
          header('Location: ../adm/usuario_adm/usuarios.php'); // Substitua com a página do funcionário
          exit();
        } else {
          // Perfil desconhecido
          echo '<div class="text-center container">';
          echo '<div class="alert alert-danger text-center mt-5" role="alert">
                <h3>Somente Clientes.</h3>
              </div>';
              echo '<a class="btn btn-warning mt-2" href="login.php">Voltar</a>';
          echo '</div>';
        }
      }
    } else {
      // Usuário não encontrado
      echo '<div class="text-center container">';
      echo '<div class="alert alert-danger text-center mt-5" role="alert">
            <h3>Usuário não encontrado.</h3>
          </div>';
          echo '<a class="btn btn-warning mt-2" href="login.php">Voltar</a>';
      echo '</div>';
    }

    $stmt->close();
    $conn->close();
    ?>



  </div>

</body>

</html>