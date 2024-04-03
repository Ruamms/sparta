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

    <link rel="stylesheet" href="../public/style.css">

    <title>Login</title>
</head>

<body class="">

    <!-- menu-->
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">
           
                <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
         
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">


                    <li class="nav-item">
                        <h3><a class="nav-link text-warning" href="../index.php">Inicio</a></h3>
                    </li>

                </ul>
            </div>
        </div>
    </nav>



    <h2 style="margin-top:50px; text-align: center;">Recuperar senha</h2>

    <form method="post" action="recuperar_senha.php">
        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" required><br><br>
        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>
        <input type="submit" value="Recuperar Senha">
    </form>
    <?php
session_start();

// Conectar ao banco de dados
$host = 'localhost';
$db = 'cadastro';
$user = 'root'; // Substitua pelo usuário do seu banco de dados
$pass = ''; // Substitua pela senha do seu banco de dados

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];

    // Consultar o banco de dados para verificar se o CPF e a data de nascimento correspondem a um usuário
    $sql = "SELECT data_nasc FROM cliente WHERE cpf = ? AND data_nasc = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular os parâmetros da consulta
        $stmt->bind_param("ss", $cpf, $data_nascimento);

        // Executar a consulta
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();

        // Verificar se a consulta retornou algum resultado
        if ($result->num_rows > 0) {
            // CPF e data de nascimento correspondem a um usuário
            $row = $result->fetch_assoc();
            $data_nascimento_usuario = $row['data_nasc'];

            // Gerar três datas possíveis para o usuário escolher
            $datas_possiveis = array();
            $datas_possiveis[] = date('Y-m-d', strtotime($data_nascimento_usuario . ' -1 day'));
            $datas_possiveis[] = $data_nascimento_usuario;
            $datas_possiveis[] = date('Y-m-d', strtotime($data_nascimento_usuario . ' +1 day'));

            // Exibir as datas possíveis para o usuário escolher
            echo "<p>Por favor, selecione sua data de nascimento correta:</p>";
            echo "<form method='post' action='confirmar_data_nascimento.php'>";
            foreach ($datas_possiveis as $data) {
                echo "<input type='radio' name='data_selecionada' value='$data'> $data<br>";
            }
            echo "<input type='submit' value='Confirmar'>";
            echo "</form>";
        } else {
            // CPF e/ou data de nascimento incorretos
            echo "CPF e/ou data de nascimento incorretos. Por favor, tente novamente.";
        }

        // Fechar a instrução
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>

</body>
</html>

