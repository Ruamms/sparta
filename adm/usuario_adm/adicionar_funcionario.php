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
    <!--  ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!--  mascaras jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <link rel="stylesheet" href="../../public/style.css">
    <title>Adicionar Funcionario</title>
</head>

<body>
    <!-- menu-->
    <nav class="navbar navbar-expand-md navbar-light bg-dark p-2 box-shadow">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img class="imagem-login" src="../../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../usuario_adm/usuarios.php">
                                <i class="bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Usuarios"></i><br>
                                Usuarios</a>
                        </p>
                    </li>

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

                    <!-- sair-->
                    <li class="nav-item mr-5">
                        <p class="text-center"><a class="nav-link text-warning" href="../usuario_adm/login_adm.php">
                                <i class="bi bi-box-arrow-right " data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                                Sair</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="container mt-3">
        <h2 class="m-3 ">Funcionario</h2>
        <form action="salvar_funcionario.php" method="post" class="m-3 container">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required maxlength="14">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="data_nasc">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmar_email">Confirmar Email:</label>
                    <input type="confirmar_email" class="form-control" id="confirmar_email" name="confirmar_email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cep">CEP:</label>
                    <input type="text" class="form-control" id="cep" name="cep" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="numero">Número:</label>
                    <input type="text" class="form-control" id="numero" name="numero" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="estado">Estado:</label>
                    <input type="text" class="form-control" id="estado" name="estado" required readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="complemento">Complemento:</label>
                    <input type="text" class="form-control" id="complemento" name="complemento">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="salario">Salário:</label>
                    <input type="text" class="form-control" id="salario" name="salario" pattern="^\d{1,3}(\.\d{3})*(,\d{2})?$" title="Digite um valor válido  Ex: 5.000,00" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cargo">Cargo:</label>
                    <select class="form-control" id="cargo" name="cargo" required>
                        <option value="gerente">Gerente</option>
                        <option value="coordenador">Coordenador</option>
                        <option value="analista">Analista</option>
                        <option value="assistente">Assistente</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="data_contratacao">Data de Contratação:</label>
                    <input type="date" class="form-control" id="data_contratacao" name="data_contratacao" required>
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
            $('#telefone').mask('(00)00000-0000', {
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