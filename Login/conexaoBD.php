<?php
    /*conexaoBD.php*/

    try {        
        // conexão PDO    // IP, nomeBD, usuario, senha   
        $db = 'mysql:host=143.106.241.3;dbname=cl201283;charset=utf8';
        $user = 'cl201283';
        $passwd = '9rioi25sa4';
        $pdo = new PDO($db, $user, $passwd);
    
        // ativar o depurador de erros para gerar exceptions em caso de erros
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

    } catch (PDOException $e) {
        $output = 'Impossível conectar BD : ' . $e . '<br>';
        echo $output;
    }    

    function find_cliente_by_email_and_password($email, $senha) {
        // Conecte-se ao banco de dados usando o PDO
        $db = new PDO('mysql:host=143.106.241.3;dbname=cl201283', 'cl201283', '9rioi25sa4');
    
        // Prepare a consulta SQL para verificar se o nome de usuário e a senha estão corretos
        $stmt = $db->prepare("SELECT * FROM cliente WHERE email = :email AND senha = :senha");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
    
        // Retorne o resultado da consulta
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
?>