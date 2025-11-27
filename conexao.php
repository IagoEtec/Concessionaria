<?php

// Codigo base de conexao usando PDO 
$host = 'localhost';
$dbname = 'concessionaria';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>