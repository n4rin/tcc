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

function searchProductsByTag($tag)
{
    include("conexaoBD.php");

    // Consulta SQL
    $sql = "SELECT Codigo, Nome, precoVenda 
            FROM produto
            WHERE tag LIKE :tag";

    // Preparar a consulta
    $stmt = $pdo->prepare($sql);

    // Executar a consulta
    $stmt->execute(['tag' => '%' . $tag . '%']);

    // Retornar os resultadost
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivaTy - Chás</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="carrinho.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="../imagem/logo.PNG">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
<?php include '../nav/navbar.php'; ?>

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
                            <p>Ainda não tem uma conta? <a href="../Login/cadastro.php" class="registro-link">Cadastre-se aqui.</a></p>
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

            </div>
        </div>
    </section>
    <section class="banner">
        <div class="banner-color">
            <div class="banner-img-chas">
                <div class="banner-text">
                    <h2>CHÁS</h2>
                    <p>Nesta sessão você irá encontrar os melhores chás para sua tardes!!</p>
                </div>
            </div>
        </div>
    </section>

    <!--Produto-->
    <section>
        <div class="container" style="height: 50px">
            <h2>Cuide da saúde</h2>
            <hr>
            <div class="list"></div>
        </div>
    </section><br>
    <section>
        <?php
        function searchProductsByName($nome)
        {
            //session_start();

            // Inclua o arquivo de conexão com o banco de dados

            $pdo = new PDO('mysql:host=143.106.241.3;dbname=cl201283', 'cl201283', '9rioi25sa4');
            // Consulta SQL
            $sql = "SELECT id, Nome, precoVenda, imagem
            FROM produto
            WHERE nome LIKE :nome";

            // Preparar a consulta
            $stmt = $pdo->prepare($sql);

            // Executar a consulta
            $stmt->execute(['nome' => '%' . $nome . '%']);

            // Retornar os resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

    </section>

    <div class="list">
        <?php
        $products = searchProductsByName('cha');
        foreach ($products as $product) {
        ?>
            <div class="item">
                <img src=<?php echo $product['imagem']; ?> alt="Product Image">
                <div class="titulo"><?php echo $product['Nome']; ?></div>
                <div class="precos">R$ <?php echo number_format($product['precoVenda'], 2, ',', '.'); ?></div>
                <button href="cart.php" class="btn-produtc">Comprar</button>
            </div>
        <?php
        }
        ?>
    </div>

    <!--Footer-->
    <?php include '../nav/footer.php'; ?>

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
    document.getElementById('login-button').addEventListener('click', function() {
        // Envie o formulário de login automaticamente
        document.getElementById('login-form').submit();
    });
</script>

<script>
    document.querySelector('.btn-user').addEventListener('click', function() {
        if (!document.querySelector('.section').classList.contains('active')) {
            document.querySelector('.section').classList.add('active');
        }
    });
    document.querySelector('.icon-close').addEventListener('click', function() {
        document.querySelector('.section').classList.remove('active');
    });
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xhr.open("POST", "index.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(new URLSearchParams(new FormData(event.target)).toString());
    });
</script>