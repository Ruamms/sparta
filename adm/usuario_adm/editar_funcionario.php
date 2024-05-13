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
    <!--  mascaras jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/style.css">
    <title>Editar Funcionario</title>
</head>

<body>
    <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-1 box-shadow">
        <div class="container">

            <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
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
                            <a class="nav-link text-warning" href="../usuario_adm/usuarios.php">
                                <i class="bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Usuarios"></i><br>
                                Usuarios</a>
                        </p>
                    </li>
                    <!-- sair-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning" href="../../index.php?logout=1">
                                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                                Sair</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="container">
        <h2 class="m-3">Editar Funcionario</h2>
        <?php
        include '../../usuario/conexao.php';

        // Verifica se o ID do usuário foi recebido e é válido
        if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
            $usuario_id = $_GET['usuario_id'];

            // Busca os dados do cliente com base no ID do usuário
            $query = "SELECT * FROM funcionario WHERE usuario_id = $usuario_id";
            $result = $conn->query($query);

            // Verifica se o cliente foi encontrado
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                // Preenche os campos do formulário com as informações do cliente
                $nome = $row['nome'];
                $matricula = $row['matricula'];
                $cpf = $row['cpf'];
                $cargo = $row['cargo'];
                $salario = $row['salario'];
                $data_contratacao = $row['data_contratacao'];
                $email = $row['email'];
                $endereco = $row['endereco'];
                $cep = $row['cep'];
                $numero = $row['numero'];
                $cidade = $row['cidade'];
                $estado = $row['estado'];
                $complemento = $row['complemento'];
                $usuario_id = isset($row['usuario_id']) && !empty($row['usuario_id']) ? $row['usuario_id'] : $_GET['usuario_id'];


                $nome = $row['nome'];

                // Agora você pode preencher os campos do formulário com essas variáveis
            } else {
                echo "Cliente não encontrado.";
            }
        } else {
            echo "ID do usuário inválido ou não fornecido.";
        }

        $conn->close();
        ?>
        <form action="salvar_edit_funcionario.php?usuario_id=<?php echo $usuario_id; ?>" method="post" class="m-3 container">
            <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="<?php echo $nome; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="data_contratacao">Data de Contratação:</label>
                    <input type="date" class="form-control" id="data_contratacao" name="data_contratacao" value="<?php echo $data_contratacao; ?>">
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
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="salario">Salário:</label>
                    <input type="text" class="form-control" id="salario" name="salario" pattern="^\d{1,3}(\.\d{3})*(,\d{2})?$" title="Digite um valor válido  Ex: 5.000,00" placeholder="<?php echo $salario; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="cargo">Cargo:</label>
                    <select class="form-control" id="cargo" name="cargo" placeholder="<?php echo $cargo; ?>">
                        <option value="gerente">Gerente</option>
                        <option value="coordenador">Coordenador</option>
                        <option value="analista">Analista</option>
                        <option value="assistente">Assistente</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-warning w-100 mt-3">Enviar</button>
        </form>

    </section>
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00', {
                reverse: true
            });
        });
        $(document).ready(function() {
            $('#cardNumber').mask('0000.0000.0000.0000', {
                reverse: true
            });
        });
        $(document).ready(function() {
            $('#telefone').mask('00-00000-0000', {
                reverse: true
            });
        });
        $(document).ready(function() {
            $('#matricula').mask('00000', {
                reverse: true
            });
        });
        $(document).ready(function() {
            $('#salario').mask('0.000,00', {
                reverse: true
            });
        });
        $('#cep').mask('00000-000');
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
    </script>

</body>

</html>