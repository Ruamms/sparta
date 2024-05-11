<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>sparta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- mascaras jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <link rel="stylesheet" href="../public/style.css">
    <title>Perfil</title>
</head>

<body>
    <section>
        <?php
        session_start();
        include 'conexao.php';

        // Verificar se o email foi enviado via GET
        if (isset($_SESSION['perfil']) and ($_SESSION['perfil'] === 'cliente')) {
            $email = $_SESSION['email'];

            $conn = new mysqli('localhost', 'root', '', 'cadastro');

            if ($conn->connect_error) {
                die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
            }

            // Verificar se o email existe na tabela de clientes
            $verificarEmail = $conn->prepare("SELECT * FROM cliente WHERE email = ?");
            $verificarEmail->bind_param("s", $email);
            $verificarEmail->execute();
            $resultEmail = $verificarEmail->get_result();

            if ($resultEmail->num_rows > 0) {
                // email existe, então recuperamos os dados do cliente
                $cliente = $resultEmail->fetch_assoc();
            }

            // Fechar a declaração de verificação do email
            $verificarEmail->close();
        } else if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
            $usuario_id = $_GET['usuario_id'];

            // Busca os dados do cliente com base no ID do usuário
            $query = "SELECT * FROM cliente WHERE usuario_id = $usuario_id";
            $result = $conn->query($query);
            // Verifica se o cliente foi encontrado
            if ($result->num_rows > 0) {
                $cliente = $result->fetch_assoc();
                $email = $cliente['email'];
            }
        }
        // Preencher os campos do formulário com os dados do cliente
        $nome = $cliente['nome'];
        $telefone = $cliente['telefone'];
        $data_nasc = $cliente['data_nasc'];
        $cep = $cliente['cep'];
        $endereco = $cliente['endereco'];
        $numero = $cliente['numero'];
        $cidade = $cliente['cidade'];
        $estado = $cliente['estado'];
        $complemento = $cliente['complemento'];
        $numero_cartao = $cliente['numero_cartao'];
        $usuario_id = isset($cliente['usuario_id']) && !empty($cliente['usuario_id']) ? $cliente['usuario_id'] : $_GET['usuario_id'];

        // Fechar a conexão
        $conn->close();
        ?>
    </section>
    <!-- menu-->
    <?php
    if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'cliente') {
    ?>
        <div class="bg-warning text-center py-1">
            <p>FRETE GRÁTIS para todo o BRASIL em compras a partir de R$149,90. Prazo de entrega de 2 a 10 dias úteis.</p>
        </div>
        <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-1 box-shadow">
            <div class="container">

                <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!-- inicio-->
                        <li class="nav-item mr-5">
                            <p class="text-center"><a class="nav-link text-warning" href="../usuario/produtosWey.php"><i class="bi bi-house " data-bs-toggle="tooltip" data-bs-placement="top" title="inicio"></i><br>
                                    Inicio</a>
                            </p>
                        </li>
                        <!-- relatorio de compra-->
                        <li class="nav-item mr-5">
                            <p class="text-center"><a class="nav-link text-warning" href="../carrinho/relatorio/relatorio_compra.php"><i class="bi bi-bag-check " data-bs-toggle="tooltip" data-bs-placement="top" title="Minhas Compras"></i><br>
                                    Minhas compras</a>
                            </p>
                        </li>

                        <!-- carrinho de compra-->
                        <li class="nav-item mr-5">
                            <p class="text-center"><a class="nav-link text-warning" href="../carrinho/carrinho.php">
                                    <i class="bi bi-cart" data-bs-toggle="tooltip" data-bs-placement="top" title="Carrinho de Compras"></i><br>
                                    Carrinho</a></p>
                        </li>
                        <!-- sair-->
                        <li class="nav-item mr-5">
                            <p class="text-center"><a class="nav-link text-warning" href="../index.php">
                                    <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                                    Sair</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php
    } elseif (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'funcionario') {
    ?>
        <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-1 box-shadow">
            <div class="container">

                <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item mr-5">
                            <p class="text-center">
                                <a class="nav-link text-warning" href="../produto/lista_produtos.php">
                                    <i class="bi-box" data-bs-toggle="tooltip" data-bs-placement="top" title="Produtos"></i><br>
                                    Produtos</a>
                            </p>
                        </li>
                        <!--Perfil-->
                        <li class="nav-item mr-5">

                            <p class="text-center"> <a class="nav-link text-warning" href="../relatorio/relatorio.php">

                                    <i class="bi bi-clipboard2-data" data-bs-toggle="tooltip" data-bs-placement="top" title="relatorio"></i><br>
                                    Relatorio</a></p>

                        </li>
                        <li class="nav-item mr-5">
                            <p class="text-center">
                                <a class="nav-link text-warning" href="../adm/usuario_adm/usuarios.php">
                                    <i class="bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Usuarios"></i><br>
                                    Usuarios</a>
                            </p>
                        </li>
                        <!-- sair-->
                        <li class="nav-item mr-5">
                            <p class="text-center"><a class="nav-link text-warning" href="../../index.php">
                                    <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                                    Sair</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        </nav>
    <?php
    }
    ?>



    <section class="container mt-3">
        <h2 class="mt-3 ">Editar cadastro</h2>
        <form action="../adm/usuario_adm/salvar_edit_cliente.php?usuario_id=<?php echo $usuario_id; ?>" class="container" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="<?php echo $nome; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="numero_cartao">Número do Cartão de Crédito:</label>
                    <input type="text" class="form-control " id="numero_cartao" name="numero_cartao" placeholder="<?php echo $numero_cartao; ?>" pattern="\d{4}.\d{4}.\d{4}.\d{4}" title="Digite o número do cartão no formato 0000.0000.0000.0000">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="<?php echo $telefone; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="data_nasc">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data_nasc" name="data_nasc" value="<?php echo $data_nasc; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $email; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmar_email">Confirmar Email:</label>
                    <input type="confirmar_email" class="form-control" id="confirmar_email" name="confirmar_email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha">
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cep">CEP:</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="<?php echo $cep; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="<?php echo $endereco; ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="numero">Número:</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="<?php echo $numero; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="<?php echo $cidade; ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="estado">Estado:</label>
                    <input type="text" class="form-control" id="estado" name="estado" placeholder="<?php echo $estado; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="complemento">Complemento:</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" placeholder="<?php echo $complemento; ?>">
                </div>
            </div>
            <div class="text-center m-3">
                <button type="submit" class="btn w-100 btn-warning ">Editar cadastro</button>
            </div>
        </form>
    </section>
    <script>
        $(document).ready(function() {
            // Máscaras para os campos
            $('#numero_cartao').mask('0000.0000.0000.0000', {
                reverse: true
            });
            $('#telefone').mask('00-00000-0000', {
                reverse: true
            });
            $('#cep').mask('00000-000');

            // Evento blur para preencher o endereço usando a API ViaCEP
            $('#cep').blur(function() {
                var cep = $(this).val().replace('-', '');
                $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                    $('#endereco').val(data.logradouro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                });
            });

            // Evento de envio do formulário
            $('form').submit(function(event) {
                // Verificação das senhas
                var senha = $('#senha').val();
                var confirmarSenha = $('#confirmar_senha').val();
                if (senha !== confirmarSenha) {
                    alert('As senhas não são iguais. Por favor, corrija.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }

                // Verificação dos e-mails
                var email = $('#email').val();
                var confirmarEmail = $('#confirmar_email').val();
                if (email !== confirmarEmail) {
                    alert('Os e-mails não são iguais. Por favor, corrija.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }
            });

            // Se o campo de senha for preenchido, tornar o campo de confirmar senha obrigatório
            $('#senha').keyup(function() {
                var senha = $(this).val();
                if (senha.trim() !== '') {
                    $('#confirmar_senha').prop('required', true);
                } else {
                    $('#confirmar_senha').prop('required', false);
                }
            });

            // Se o campo de e-mail for preenchido, tornar o campo de confirmar e-mail obrigatório
            $('#email').keyup(function() {
                var email = $(this).val();
                if (email.trim() !== '') {
                    $('#confirmar_email').prop('required', true);
                } else {
                    $('#confirmar_email').prop('required', false);
                }
            });
        });
    </script>


</body>

</html>