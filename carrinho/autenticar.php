<?php
session_start();
include 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = "SELECT nome FROM usuario WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($query);

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // O usuário está logado, então exiba uma mensagem de boas-vindas com o nome
    $nome = $_SESSION['nome']; // Aqui você já possui o nome armazenado na sessão

    // Resto do seu código
} else {
    // O usuário não está logado, redirecione-o para a página de login
    header('Location: login.php');
    exit; // Certifique-se de que o script pare de ser executado após a redireção
}

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];

    if ($email === 'admin@hotmail.com' && $senha === 'admin@hotmail.com') { // Verifica se é o admin
        $_SESSION['admin'] = true;
        $_SESSION['nome'] = $nome; // Armazene o nome na sessão
        header('Location: ../adm/usuario_adm/usuarios.php');
    } else {
        $_SESSION['logged_in'] = true;
        $_SESSION['nome'] = $nome; // Armazene o nome na sessão
        $_SESSION['email'] = $email;
        header('Location: produtosWey.php');
    }
} else {
    echo '<div class="alert alert-danger" role="alert">
    "Credenciais inválidas. <a href="login.php">Tente novamente</a>
  </div>';
}


$conn->close();
?>
