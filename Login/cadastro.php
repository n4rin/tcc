<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="sweetalert2.all.min.js"></script>

<script>

</script>


<?php


function validarSenha($senha) {
    if (strlen($senha) < 8) {
        return false;
    }
    if (!preg_match('/\d/', $senha)) {
        return false;
    }
    return true;
}

function cadastro(){

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Adicione aqui os outros campos que você deseja validar
    try{
        $cpf = $_POST["cpf"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $dataNascimento = $_POST["dataNascimento"];

    if (!$nome || !$email || !$senha || !$dataNascimento || !$cpf /* Adicione aqui os outros campos que você deseja validar */) {
        echo "<script>document.getElementById('error-msg-cadastro').innerHTML = 'Por favor, preencha todos os campos <br>';</script>";
     }else if (!validarSenha($senha)) {
        echo "<script>document.getElementById('error-msg-cadastro').innerHTML = 'A senha deve ter pelo menos 8 caracteres e conter pelo menos 1 número. <br>';</script>";
    } else {
        // Inicia a sessão


        include("conexaoBD.php");

        $stmt = $pdo->prepare("select * from cliente where cpf = :cpf");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        $rows = $stmt->rowCount();;

        if($rows <= 0){
            $stmt = $pdo->prepare("insert into cliente (cpf, nome, email, senha, dataNascimento) values (:cpf, :nome, :email, :senha, :dataNascimento)");
             $stmt->bindParam(':cpf', $cpf);
             $stmt->bindParam(':nome', $nome);
             $stmt->bindParam(':email', $email);
             $stmt->bindParam(':senha', $senha);
             $stmt->bindParam(':dataNascimento', $dataNascimento);
             $stmt->execute();
             

             echo '<script type="text/javascript">'; 
             echo "Swal.fire('Cadastrado com sucesso!','Siga agora para a página principal do site.', 'success');";
             echo 'setTimeout(function(){location.href="../Pagina/index.php"} , 1000);';
             echo '</script>';

        } else{
            echo "<script>document.getElementById('error-msg-cadastro').innerHTML = 'Esse CPF já foi utilizado. <br>';</script>";
            //echo "<span id='error'> CPF já cadastrado!</span>";
        } }
    } catch(PDOException $e){
        echo 'Error: ' . $e->getMessage();
    }
    $pdo = null;
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagem/logo.PNG">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../Pagina/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
          @import url('https://fonts.googleapis.com/css2?family=REM:wght@300&display=swap');

        * {
        font-family: "REM", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }


        .login{
            color: white;
        }

        body{
            margin: 0;
            padding: 0;
        }

        .cad-titulo h2{
            font-size: 30px;
            color: white;
        }

        .cad-titulo p{
            font-size: 20px;
            color: white;
            align-items: center;
        }

        .box{
            width: 400px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            /* background: #0d6227; /* cor alternativa - não ficou boa */
            backdrop-filter: blur(25px);
            box-shadow: -1px 0 10px rgb(0, 0, 0, .2);
            border-left: 2px solid rgba(255, 255, 255, .1);
            border-radius: 15px;
            text-align: center;
        }

        .box h1{
            color: white;
            text-transform: uppercase;
            font-weight: 500;   
        }

        .box input[type = "email"],.box input[type = "password"],
        .box input[type="number"],.box input[type="text"],.box input[type="date"]{
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid rgb(158, 158, 158);
            padding: 14px 10px;
            width: 200px;
            outline: none;
            color: white;
            border-radius: 24px;
        }

        .box input[type = "submit"]{
            width: 100%;
            height: 45px;
            background: white;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 2px 5px rgb(0, 0, 0, .2);
            cursor: pointer;
            font-size: 18px;
            font-weight: 700;
            color: #222;
        }

        .box input[type = "submit"]:hover{
            background: transparent;
            backdrop-filter: blur(15px);
            border-color: white;
            color: white;
        }
        
        .form-label{
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid pink;
            padding: 14px 10px;
            width: 150px;
            outline: none;
            color: white;
            border-radius: 24px;
        }

        .form-select{
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #3498db;
            padding: 14px 10px;
            width: 200px;
            outline: none;
            color: white;
            border-radius: 24px;
        }

        #sucess {
            color: green;
            font-weight: bold;
        }

        #error {
            color: red;
            font-weight: bold;
        }

        #warning {
            color: orange;
            font-weight: bold;
        }

        .close{
            position: absolute;
            width: 45px;
            height: 45px;
            right: 0;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            padding: 10px;
            padding-right: 5px;
        }

        .close i{
            font-size: 45px;
            color: white;
        }



    </style>

</head>
<body>
<header class="header">
    <a href="../Pagina/index.php" class="logo"><img src="../imagem/logo.PNG" alt=""></a>
    <nav class="navbar">
        <a href="../Pagina/cafes.php">Cafés</a>
        <a href="../Pagina/chas.php">Chás</a>
        <a href="../Pagina/incensos.php">Incensos</a>

    </nav>
    <nav class="navbar2">
        <form method="post" action="search.php">
            <?php
            @include '../administracao/config.php';
      $select_rows = $conn->query("SELECT * FROM `cart`");
      if ($select_rows) {
         $row_count = $select_rows->rowCount();
      } else {
         die('query failed');
      }
      ?>
            <a href="../administracao/cart.php" class=" shopping"><i class='bx bx-cart shopping'></i><span><?php echo $row_count; ?></span></a>
            <a href="<?php echo isset($_SESSION['email']) ? 'perfil.php' : '#'; ?>" class="btn-user"><i
                    class='bx bxs-user-circle'></i></a>
        </form>
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

</header><br><br><br>

    <form id="campo" action="cadastro.php" class="box" method="post">
        <div class="cad-titulo">
          <h2>Cadastre-se</h2> 
          <p>Insira suas informações pessoais!</p>
        </div>

        <input id="nome" type="text" name="nome" placeholder="Nome completo">
        <input id="email"type="email" placeholder="Email" name="email">
        <input type="date" placeholder="Data de nascimento" name="dataNascimento">
        <input type="password" id="senha" placeholder="Senha" name="senha">
        <input type="password" name="senha" placeholder="Confirme sua senha">
        <input type="text" pattern="(\d{3}\.?\d{3}\.?\d{3}-?\d{2})|(\d{2}\.?\d{3}\.?\d{3}/?\d{4}-?\d{2})" name="cpf" placeholder="CPF">
        <input type="submit" value="Cadastre-se">
        <span id="error-msg-cadastro" style="color: #eb0000; font-weight: 700; font-size: 18px;"></span>
        <span id="error" style="color: red;"></span>
        <a href="../Pagina/index.php" class="login"> Já se cadastrou? Faça o login!</a>
       

    </form>
        
    <script src="../Pagina/styles.js"></script>
    </body>
    </html>


    <?php

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        try{
            $cpf = $_POST["cpf"];
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $dataNascimento = $_POST["dataNascimento"];
    
        if (!$nome || !$email || !$senha || !$dataNascimento || !$cpf /* Adicione aqui os outros campos que você deseja validar */) {
            echo "<script>document.getElementById('error-msg-cadastro').innerHTML = 'Por favor, preencha todos os campos <br>';</script>";
        } else{
            cadastro();
        }}

        catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
        }

        $pdo = null;

    }



    ?>