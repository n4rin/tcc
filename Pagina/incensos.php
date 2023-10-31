<?php
// Inicie a sessão
session_start();

// Inclua o arquivo de conexão com o banco de dados
require_once '../Login/conexaoBD.php';

// Verifique se o formulário foi enviado
if (isset($_POST['email']) && isset($_POST['senha'])) {
    // Use suas funções de CRUD para verificar se o nome de usuário e a senha estão corretos


    $cliente = find_cliente_by_email_and_password($_POST['email'], $_POST['senha']);

    // Verifique se o nome de usuário e a senha estão corretos
    if ($cliente) {
        // Armazene o nome de usuário na sessão
        $_SESSION['email'] = $_POST['email'];

        // Redirecione o usuário para a página de perfil
        header("Location: index.php");
        exit;
    } else {
        // Exiba uma mensagem de erro
        echo "Nome de usuário ou senha incorretos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivaTy - Incensos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="carrinho.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="../imagem/logo.PNG">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <header class="header">
        <a href="index.php" class="logo"><img src="../imagem/logo.PNG" alt=""></a>
        <nav class="navbar">
            <a href="cafes.php">Cafés</a>
            <a href="chas.php">Chás</a>
            <a href="incensos.php">Incensos</a>

        </nav>
        <nav class="navbar2">
                    <a href="#"><i class='bx bx-search'></i></a>
                    <a href="# class="shopping"><i class='bx bx-cart shopping'></i><span class="quantity">0</span></a>
                    <a href="<?php echo isset($_SESSION['email']) ? 'perfil.php' : '#'; ?>" class="btn-user"><i
                            class='bx bxs-user-circle'></i></a>
            
            <?php
            if (isset($_SESSION['email'])) {
                // O usuário está logado, exibir o ícone/botão de logout
                echo '<a href="logout.php" class="logout-link" style="font-size: 1.9rem;"><i class="bx bx-log-out-circle"> Sair</i></a>';
            } else {
            }
            ?>

            <!-- (boxicons) precisa terminar - realizar logout -->
            <!--<a href="logout.php" class="logout-link" style="font-size: 1.9rem;"><i class='bx bx-log-out-circle'> Sair</i></a>-->

            <script>
                document.querySelector('.logout-link').addEventListener('click', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Tem certeza?',
                        text: "Você será desconectado do site!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim, quero sair!',
                        //background: '#1AD162'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'logout.php';
                        }
                    })
                });
            </script>

    </header>

    <section class="section">
        <div class="wrapper">
            <span class="icon-close"><i class='bx bx-x'></i></span>
            <div class="logreg-box">
                <!--Login-->
                <div class="form-box login">
                    <div class="logreg-titulo">
                        <h2>Login</h2>
                        <p>Faça o login ou cadastre-se</p>
                    </div>

                    <form action="#" method="post" id="login-form">
                        <div class="input-box">
                            <span class="icon"><i class='bx bx-envelope'></i></span>
                            <input type="email" name="email" required>
                            <label>E-mail</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"><i class='bx bx-lock-alt'></i></span>
                            <input type="password" name="senha" required>
                            <label>Senha</label>
                        </div>
                        <div class="lembrar-senha">
                            <label for=""><input type="checkbox">Lembrar-me</label>
                            <a href="#">Esqueceu sua senha?</a>
                        </div>
                        <button type="submit" class="btn">Logar</button>
                        <div class="logreg-link">
                            <p>Ainda não tem uma conta? <a href="../Login/cadastro.php"
                                    class="registro-link">Cadastre-se aqui.</a></p>
                        </div>
                    </form>
                </div>

                <!--Cadastro-->
                <div class="form-box registro">
                    <div class="logreg-titulo">
                        <h2>Cadastro</h2>
                        <p>Preencha o cadastro com suas informações</p>
                    </div>

                    <form action="#">
                        <div class="input-box">
                            <span class="icon"><i class='bx bx-user'></i></span>
                            <input type="text" required>
                            <label>Nome de Usuário</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"><i class='bx bx-envelope'></i></span>
                            <input type="email" required>
                            <label>E-mail</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"><i class='bx bx-lock-alt'></i></span>
                            <input type="password" required>
                            <label>Senha</label>
                        </div>
                        <div class="lembrar-senha">
                            <label for=""><input type="checkbox">Estou ciente dos termos e condições</label>
                        </div>
                        <button type="submit" class="btn">Cadastrar</button>
                        <div class="logreg-link">
                            <p>Já é cadastrado? <a href="#" class="login-link">Faça login.</a></p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="opcao-midia">
                <a href="#">
                    <i class='bx bxl-google'></i>
                    <span>Continue with Google</span>
                </a>
                <a href="#">
                    <i class='bx bxl-facebook-circle'></i>
                    <span>Continue with Facebook</span>
                </a>
            </div>
        </div>
    </section>
    <section class="banner">
        <div class="banner-color">
            <div class="banner-img-incensos">
                <div class="banner-text">
                    <h2>INCENSOSSSSS</h2>
                    <p>incestos incestos incestos</p>
                </div>
            </div>
        </div>
    </section>

    <!--Produto-->
    <section>
        <div class="container">
            <h2>Incensos Rosália</h2>
            <hr>
            <div class="list"></div>
        </div>
    </section><br>

    <!--Footer-->
    <footer>
        <div id="footer-content">
            <div id="footer-contacts">
                <h2>LIVATY</h2>
                <p>Nos siga nas redes sociais</p>

                <div id="footer-social-media">
                    <a href="#" class="footer-link" id="instagram"><i class='bx bxl-instagram'></i></a>
                    <a href="#" class="footer-link" id="facebook"><i class='bx bxl-facebook-square'></i></a>
                    <a href="#" class="footer-link" id="whatsapp"><i class='bx bxl-whatsapp'></i></a>
                </div>
            </div>

            <ul class="footer-list">
                <li>
                    <h3>Atendimento</h3>
                </li>
                <li><a href="#" class="footer-link">Formas de Pagamento</a></li>
                <li><a href="#" class="footer-link">Catálogo</a></li>
                <li><a href="#" class="footer-link">Institucional</a></li>
            </ul>

            <ul class="footer-list">
                <li>
                    <h3>Produtos</h3>
                </li>
                <li><a href="#" class="footer-link">Cafés</a></li>
                <li><a href="#" class="footer-link">Chás</a></li>
                <li><a href="#" class="footer-link">Incensos</a></li>
            </ul>

            <div id="footer-map">
                <h3>Nossa sede:</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.4530145073554!2d-47.42621522712088!3d-22.562154025640524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8806c2c324933%3A0xe2108428886c8646!2sCol%C3%A9gio%20T%C3%A9cnico%20de%20Limeira%20-%20Unicamp!5e0!3m2!1spt-BR!2sbr!4v1696366241972!5m2!1spt-BR!2sbr"
                    width="300" height="200" style="border-radius:15px;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
            <div id="footer-copyright">
                &#169
                2023 all rights reserved
            </div>

    </footer>


    <script src="styles.js"></script>
    <script src="carrinho.js"></script>
</body>

</html>

<script>
    function validateForm() {
        var email = document.getElementsByName("email")[0].value;
        var senha = document.getElementsByName("senha")[0].value;
        if (email === "" || senha === "") {
            document.getElementById("error-msg").innerHTML = "É necessário preencher os campos para realizar o login";
            return false;
        }
        return true;
    }
</script>

<script>
    // Adicione um evento de clique ao botão de login
    document.getElementById('login-button').addEventListener('click', function () {
        // Envie o formulário de login automaticamente
        document.getElementById('login-form').submit();
    });
</script>

<script>
    document.querySelector('.btn-user').addEventListener('click', function () {
        if (!document.querySelector('.section').classList.contains('active')) {
            document.querySelector('.section').classList.add('active');
        }
    });
    document.querySelector('.icon-close').addEventListener('click', function () {
        document.querySelector('.section').classList.remove('active');
    });
    document.getElementById('login-form').addEventListener('submit', function (event) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xhr.open("POST", "index.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(new URLSearchParams(new FormData(event.target)).toString());
    });
</script>