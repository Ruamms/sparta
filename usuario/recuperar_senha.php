<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>sparta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../public/style.css">

    <title>Login</title>
</head>

<body class="">

    <!-- menu-->
    <nav class="navbar navbar-expand-md navbar-light bg-dark py-3 box-shadow">
        <div class="container">

            <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
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



    <h2 class="text-center mt-3">Recuperar senha</h2>

    <div class="container form-container">
        <form class="container text-center mt-3" style="max-width: 20rem;" method="post" action="recuperar_senha.php">
            <div class="form-group">
                <label for="cpf">Digite seu CPF :</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>

            <button type="submit" class="btn btn-warning m-2">Recuperar Senha</button>
        </form>
    </div>
    <?php
if (!isset($_SESSION)) {
    session_start();
}

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
    // Receber o CPF do formulário
    $cpf = $_POST['cpf'];

    // Consultar o banco de dados para verificar se o CPF existe na tabela cliente
    $sql_cliente = "SELECT * FROM cliente WHERE cpf = ?";
    $stmt_cliente = $conn->prepare($sql_cliente);

    if ($stmt_cliente) {
        // Vincular o parâmetro da consulta
        $stmt_cliente->bind_param("s", $cpf);

        // Executar a consulta
        $stmt_cliente->execute();

        // Obter o resultado
        $result_cliente = $stmt_cliente->get_result();

        // Verificar se a consulta retornou algum resultado
        if ($result_cliente->num_rows > 0) {
            // CPF existe na tabela cliente, mostrar as datas de aniversário para confirmação
            $row_cliente = $result_cliente->fetch_assoc();
            $data_nascimento_usuario = $row_cliente['data_nasc'];
            $telefone1 = $row_cliente['telefone'];
            $telefone2 = $row_cliente['telefone'];
            $telefone3 = $row_cliente['telefone'];

            // Modificando os últimos quatro dígitos dos telefones
            $telefone1_modificado = substr($telefone1, 0, 9) . rand(1000, 9999);
            $telefone2_modificado = substr($telefone2, 0, 13) . '';
            $telefone3_modificado = substr($telefone3, 0, 9) . rand(1000, 9999);

            // Gerar três datas possíveis para o usuário escolher
            $datas_possiveis = array();
            $datas_possiveis[] = date('Y-m-d', strtotime($data_nascimento_usuario . ' -3 day'));
            $datas_possiveis[] = $data_nascimento_usuario;
            $datas_possiveis[] = date('Y-m-d', strtotime($data_nascimento_usuario . ' +2 day'));

            // Exibir as datas possíveis para o usuário escolher
            echo "<form method='post' class='container text-center mt-2' action='confirmar_informacoes.php'>";
            echo "<p>Por favor, selecione sua data de nascimento correta:</p>";
            foreach ($datas_possiveis as $data) {
                echo "<input type='radio' name='data_selecionada' value='$data'> $data<br>";
            }
            echo "<p class='mt-2'>Por favor, confirme um dos seus telefones:</p>";
            echo "<input type='radio' name='telefone_selecionado' value='$telefone1'>$telefone1_modificado<br>";
            echo "<input type='radio' name='telefone_selecionado' value='$telefone2'>$telefone2_modificado<br>";
            echo "<input type='radio' name='telefone_selecionado' value='$telefone3'>$telefone3_modificado<br>";
            echo "<input type='hidden' name='cpf' value='$cpf'>";
            echo "<input class='btn btn-warning m-4' type='submit' value='Confirmar'>";
            echo "</form>";
        } else {
            // Verificar se o CPF existe na tabela funcionario
            $sql_funcionario = "SELECT * FROM funcionario WHERE cpf = ?";
            $stmt_funcionario = $conn->prepare($sql_funcionario);

            if ($stmt_funcionario) {
                // Vincular o parâmetro da consulta
                $stmt_funcionario->bind_param("s", $cpf);

                // Executar a consulta
                $stmt_funcionario->execute();

                // Obter o resultado
                $result_funcionario = $stmt_funcionario->get_result();

                // Verificar se a consulta retornou algum resultado
                if ($result_funcionario->num_rows > 0) {
            // CPF existe na tabela funcionario, mostrar as matriculas para confirmação
            $row_funcionario = $result_funcionario->fetch_assoc();
            $matricula_verdadeira = $row_funcionario['matricula'];

            // Gerar duas matrículas falsas
            do {
                $matricula_falsa1 = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            } while ($matricula_falsa1 === $matricula_verdadeira);

            do {
                $matricula_falsa2 = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            } while ($matricula_falsa2 === $matricula_verdadeira || $matricula_falsa2 === $matricula_falsa1);

            // Misturar a matrícula verdadeira com as falsas
            $matriculas = [$matricula_verdadeira, $matricula_falsa1, $matricula_falsa2];
            shuffle($matriculas);

            // Exibir as matriculas possíveis para o usuário escolher
            echo "<form method='post' class='container text-center mt-2' action='confirmar_informacoes.php'>";
            echo "<p>Por favor, selecione sua matrícula correta:</p>";
            foreach ($matriculas as $matricula) {
                echo "<input type='radio' name='matricula_selecionada' value='$matricula'>$matricula<br>";
            }
            echo "<input type='hidden' name='cpf' value='$cpf'>";
            echo "<input class='btn btn-warning m-2' type='submit' value='Confirmar'>";
            echo "</form>";
        } else {
            // CPF não encontrado em nenhuma tabela
            echo '<div class="alert alert-danger container text-center mt-5" role="alert">';
            echo "As informações fornecidas são inválidas.";
            echo '</div>';
        }

                // Fechar a instrução
                $stmt_funcionario->close();
            } else {
                echo "Erro ao preparar a consulta na tabela funcionario: " . $conn->error;
            }
        }

        // Fechar a instrução
        $stmt_cliente->close();
    } else {
        echo "Erro ao preparar a consulta na tabela cliente: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>




</body>

</html>