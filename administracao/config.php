<?php

// Configuração do banco de dados
$dsn = 'mysql:host=143.106.241.3;dbname=cl201283;charset=utf8';
$username = 'cl201283';
$password = '9rioi25sa4';

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
