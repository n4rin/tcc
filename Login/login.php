<?php
// Inicie a sessão
session_start();

// Inclua o arquivo de conexão com o banco de dados
require_once 'conexaoBD.php';

// Verifique se o formulário foi enviado
if (isset($_POST['email']) && isset($_POST['senha'])) {
    // Use suas funções de CRUD para verificar se o nome de usuário e a senha estão corretos
    $cliente = find_cliente_by_email_and_password($_POST['email'], $_POST['senha']);

    // Verifique se o nome de usuário e a senha estão corretos
    if ($cliente) {
        // Armazene o nome de usuário na sessão
        $_SESSION['email'] = $_POST['senha'];

        // Redirecione o usuário para a página protegida
        header("Location: ../Pagina/index.php");
        exit;
    } else {
        // Exiba uma mensagem de erro
        echo "Nome de usuário ou senha incorretos";
    }
}
?>

<!-- talvez não seja necessária essa parte aqui-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../Imagens/iconG.png">
    <title>Login</title>

    <style>

        .cadastro{
            color: white;
        }

        body{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: #727557;
        }

        .box{
            width: 300px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background: #343a30;
            border-radius: 2px;
            text-align: center;
        }

        .box h1{
            color: white;
            text-transform: uppercase;
            font-weight: 500;   
        }

        .box input[type = "email"],.box input[type = "password"]{
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

        .box input[type = "submit"]{
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            padding: 14px 40px;
            outline: none;
            color: white;
            border-radius: 24px;
        }

        .box input[type = "submit"]:hover{
            background: #2ecc71;
        }
        
    </style>

</head>
<body>

<a href="../Pagina/index.php">
   <img src="../Imagens/iconP.png" alt="Image" style="position: absolute; top: 0; left: 44%;" width="250" height="120">
 </a> 

 <form action="" class="box" method="post" onsubmit="return validateForm()">
 <h1>login</h1>
 
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="senha" placeholder="Senha">
    <span id="error-msg" style="color: red;"></span>
    <input type="submit" name="submit" value="login">
    <a href="cadastro.php" class="cadastro"> Cadastre-se!
    </a>

 </form>
 
 <?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    //buscar no BD
if ( ($email == $_SESSION['email']) && ($senha == $_SESSION['senha']) ) {
     session_start();
     var_dump($_POST['email']);

     $_SESSION["email"] = $email;
     $_SESSION["logou"] = true;

 header("location:login_test.php");
    } else {
    if($email != $_SESSION['email']){
    echo "<script>document.getElementById('error-msg').innerHTML = 'Email incorreto. Cadastre um email corretamente.';</script>";
    }
    elseif($senha != $_SESSION['senha']){
    echo "<script>document.getElementById('error-msg').innerHTML = 'Senha incorreta.';</script>";
        }      
    }
}
?> 

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
 
</body>
</html>

</html>