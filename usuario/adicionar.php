

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
    <!-- ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- mascaras jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="../public/style.css">
    <title>Adicionar usuário</title>
</head>

<body>
<?php
if (!isset($_SESSION)) {
    session_start();
}

function exibirMenuFuncionario() {
    ?>
    <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-1 box-shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../adm/produto/lista_produtos.php">
                                <i class="bi-box" data-bs-toggle="tooltip" data-bs-placement="top" title="Produtos"></i><br>
                                Produtos
                            </a>
                        </p>
                    </li>
                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../adm/relatorio/relatorio.php">
                                <i class="bi bi-clipboard2-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Relatorio"></i><br>
                                Relatorio
                            </a>
                        </p>
                    </li>
                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../adm/usuario_adm/usuarios.php">
                                <i class="bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Usuarios"></i><br>
                                Usuarios
                            </a>
                        </p>
                    </li>
                    <li class="nav-item mr-5">
                        <p class="text-center">
                            <a class="nav-link text-warning" href="../index.php?logout=1">
                                <i class="bi bi-box-arrow-right" data-bs-toggle="tooltip" data-bs-placement="top" title="Sair"></i><br>
                                Sair
                            </a>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}

function exibirMenuGenerico() {
    ?>
    <div class="bg-warning text-center py-1">
        <p>FRETE GRÁTIS para todo o BRASIL em compras a partir de R$149,90. Prazo de entrega de 2 a 10 dias úteis.</p>
    </div>
    <nav class="sticky-top navbar navbar-expand-md navbar-light bg-dark py-1 box-shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="imagem-login" src="../img/Sparta Suplementos - Logo.png" alt="sparta" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="../index.php">
                            <i class="bi bi-house" data-bs-toggle="tooltip" data-bs-placement="top" title="Inicio"></i><br>
                            Inicio
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}

if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'funcionario') {
    exibirMenuFuncionario();
} else {
    exibirMenuGenerico();
}
?>


    <h2 class="mt-3 text-center">Cadastro</h2>

    <section class="container mt-3">
        <form action="salvar.php" class="container" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required maxlength="14">
                    <span id="cpf-invalido" style="color: red; display: none;">CPF inválido</span>
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
            <div class="text-center m-3">
                <button type="submit" class="btn w-100 btn-warning ">Finalizar Cadastro</button>
            </div>
        </form>
    </section>

    <script>
        $(document).ready(function() {
            // Máscaras para os campos
            $('#cpf').mask('000.000.000-00', {
                reverse: true
            });
            $('#telefone').mask('00-00000-0000', {
                reverse: true
            });
            $('#cep').mask('00000-000');

            // Função para validar CPF
            function validarCPF(cpf) {
                cpf = cpf.replace(/[^\d]+/g, '');
                if (cpf == '') return false;
                // Elimina CPFs invalidos conhecidos
                if (cpf.length != 11 ||
                    cpf == "00000000000" ||
                    cpf == "11111111111" ||
                    cpf == "22222222222" ||
                    cpf == "33333333333" ||
                    cpf == "44444444444" ||
                    cpf == "55555555555" ||
                    cpf == "66666666666" ||
                    cpf == "77777777777" ||
                    cpf == "88888888888" ||
                    cpf == "99999999999")
                    return false;
                // Valida 1o digito
                add = 0;
                for (i = 0; i < 9; i++)
                    add += parseInt(cpf.charAt(i)) * (10 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(9)))
                    return false;
                // Valida 2o digito
                add = 0;
                for (i = 0; i < 10; i++)
                    add += parseInt(cpf.charAt(i)) * (11 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(10)))
                    return false;
                return true;
            }

            // Evento de blur para validar CPF
            $('#cpf').blur(function() {
                var cpf = $(this).val();
                if (!validarCPF(cpf)) {
                    $('#cpf-invalido').show();
                } else {
                    $('#cpf-invalido').hide();
                }
            });


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
        });
    </script>
</body>

</html>